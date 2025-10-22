<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\InquiryActivity;
use App\Models\InquiryLog;

class GoogleCalendarController extends Controller
{
    protected function getClient()
    {
        $client = new Google_Client();
        $client->setClientId(config('app.google_client_id') ?? env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(config('app.google_client_secret') ?? env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $client->setAccessType('offline'); // request refresh token
        $client->setPrompt('consent');     // ensure refresh_token is returned first time
        $client->setScopes([
            Google_Service_Calendar::CALENDAR_EVENTS,
            'openid',
            'email',
            'profile',
        ]);
        $client->setApplicationName('CRM Test App');

        return $client;
    }

    /**
     * Step 1: store posted form data in session and either:
     *  - redirect to Google consent (if no tokens),
     *  - or if tokens already in session, redirect to create-event directly.
     */
    public function redirectToGoogle(Request $request)
    {
        // store form data in session for post-auth creation
        $formData = $request->only([
            'title','description','start_at','end_at','timezone','attendees','inquiry_id'
        ]);
        session(['form_data' => $formData]);

        // if we already have google tokens in session, skip OAuth and create event immediately
        $accessToken = session('google_access_token');
        $refreshToken = session('google_refresh_token');
        if ($accessToken || $refreshToken) {
            // user already authorized in this session: go create the event
            return redirect()->route('google.create_event');
        }

        // otherwise start OAuth consent flow
        $client = $this->getClient();
        $authUrl = $client->createAuthUrl();

        return redirect()->away($authUrl);
    }

    /**
     * Step 2: OAuth callback — exchange code for tokens and save them in session.
     */
    public function handleGoogleCallback(Request $request)
    {
        $client = $this->getClient();

        if (! $request->has('code')) {
            return response('No code parameter in callback', 400);
        }

        $token = $client->fetchAccessTokenWithAuthCode($request->get('code'));
        if (array_key_exists('error', $token)) {
            return response()->json(['error' => $token], 500);
        }

        // store token in session for this quick test run (do NOT use session for prod refresh tokens)
        session([
            'google_access_token' => $token['access_token'] ?? null,
            'google_refresh_token' => $token['refresh_token'] ?? null,
            'google_token_expires_in' => $token['expires_in'] ?? null,
            'google_token_created' => $token['created'] ?? time(),
        ]);

        // now redirect to create-event which will read form_data from session and create event
        return redirect()->route('google.create_event');
    }

    /**
     * Step 3: create event using stored form_data (or direct GET). Clears session form_data after creation.
     * Supports:
     *  - GET (after OAuth redirect) — returns a redirect back with a flash message.
     *  - POST (AJAX) — returns JSON if Accept JSON.
     */
    public function createCalendarEvent(Request $request)
    {
        // If POSTed directly (AJAX) with body and session tokens, allow it too.
        $posted = $request->only(['title','description','start_at','end_at','timezone','attendees','inquiry_id']);

        // Prefer posted payload (for AJAX), otherwise use session-stored form_data
        $formData = array_filter($posted) ?: session('form_data', []);

        if (empty($formData)) {
            // No form data found — redirect back to UI
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'error' => 'No meeting data found in request or session.'], 422);
            }
            return redirect()->back()->with('error', 'No meeting data found. Please resubmit the form.');
        }

        // tokens from session
        $accessToken = session('google_access_token');
        $refreshToken = session('google_refresh_token');

        if (!$accessToken && !$refreshToken) {
            // not authorized: redirect to OAuth start (this will store form_data)
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'need_oauth' => true, 'oauth_url' => route('google.oauth')], 401);
            }
            return redirect()->route('google.oauth');
        }

        // Normalize field defaults
        $tz = $formData['timezone'] ?? env('APP_TIMEZONE', 'Asia/Kolkata');
        try {
            $start = Carbon::parse($formData['start_at'], $tz);
            $end = Carbon::parse($formData['end_at'], $tz);
        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'error' => 'Invalid date format: '.$e->getMessage()], 422);
            }
            return redirect()->back()->with('error', 'Invalid date format.');
        }

        // Normalize attendees: allow string comma-separated or array
        $rawAttendees = $formData['attendees'] ?? [];
        if (is_string($rawAttendees)) {
            $rawAttendees = array_filter(array_map('trim', explode(',', $rawAttendees)));
        }
        $attendees = [];
        foreach ($rawAttendees as $a) {
            if (empty($a)) continue;
            // if object-like (e.g., posted as JSON), handle arrays
            if (is_array($a)) {
                $email = $a['email'] ?? null;
            } else {
                $email = $a;
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) continue;
            $att = ['email' => $email];
            $attendees[] = $att;
        }

        // Build Google client & refresh if needed
        $client = $this->getClient();
        $creds = [];
        if ($accessToken) $creds['access_token'] = $accessToken;
        if ($refreshToken) $creds['refresh_token'] = $refreshToken;
        $client->setAccessToken($creds);

        if ($client->isAccessTokenExpired() && $refreshToken) {
            $client->fetchAccessTokenWithRefreshToken($refreshToken);
            $newToken = $client->getAccessToken();
            session([
                'google_access_token' => $newToken['access_token'] ?? $newToken,
                'google_token_created' => $newToken['created'] ?? time(),
                'google_token_expires_in' => $newToken['expires_in'] ?? null
            ]);
        }

        $service = new Google_Service_Calendar($client);

        $eventData = [
            'summary' => $formData['title'] ?? 'CRM Meeting',
            'description' => $formData['description'] ?? 'Created via CRM',
            'start' => [
                'dateTime' => $start->toIso8601String(),
                'timeZone' => $tz,
            ],
            'end' => [
                'dateTime' => $end->toIso8601String(),
                'timeZone' => $tz,
            ],
            'attendees' => $attendees,
            'conferenceData' => [
                'createRequest' => [
                    'requestId' => 'crm-' . (string) Str::uuid(),
                    'conferenceSolutionKey' => ['type' => 'hangoutsMeet'],
                ],
            ],
            'reminders' => ['useDefault' => true],
        ];

        $event = new Google_Service_Calendar_Event($eventData);

        try {
            $createdEvent = $service->events->insert(
                'primary',
                $event,
                ['conferenceDataVersion' => 1, 'sendUpdates' => 'all']
            );

            // cleanup stored form_data now that event is created
            session()->forget('form_data');

            $responsePayload = [
                'success' => true,
                'google_event_id' => $createdEvent->getId(),
                'hangoutLink' => $createdEvent->getHangoutLink() ?: ($createdEvent->getConferenceData()?->getEntryPoints()[0]->getUri() ?? null),
                'calendar' => $createdEvent->getOrganizer()?->getEmail() ?? 'primary',
                'raw' => $createdEvent->toSimpleObject(),
            ];

            if ($request->wantsJson()) {
                return response()->json($responsePayload);
            }

            // save inquiry activity 

            $InquiryActivity = new InquiryActivity();
            $InquiryActivity->inquiry_id = $formData['inquiry_id'];
            $InquiryActivity->activity_type = 'meeting';
            $InquiryActivity->details = 'Google Meet scheduled: '.$responsePayload['hangoutLink'];
            $InquiryActivity->created_by = auth()->user()->id ?? null;
            $InquiryActivity->additional_data = json_encode($responsePayload);
            $InquiryActivity->created_at = now();
            $InquiryActivity->activity_at = $start;

            $InquiryActivity->save();

            $InquiryLogs = new InquiryLog();
            $InquiryLogs->inquiry_id = $formData['inquiry_id'];

            $log  = 'Google Meet scheduled on '. $start->format('d M Y \a\t h:i A').' ';
            $log .= ' (Link: '.$responsePayload['hangoutLink'].')';
            $log .= ' by '.(auth()->user()->name ?? 'System');
            $log .= '.';


            $InquiryLogs->log = $log;
            $InquiryLogs->save();

            // For browser flow, redirect back with a flash message and optional link in session
            return redirect()->back()->with('google_meeting_success', $responsePayload);

        } catch (\Exception $e) {
            $error = $e->getMessage();
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'error' => $error], 500);
            }
            return redirect()->back()->with('error', 'Failed to create Google event: '.$error);
        }
    }
}
