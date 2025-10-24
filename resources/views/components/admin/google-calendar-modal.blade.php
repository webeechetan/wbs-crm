<!-- Google Meeting Modal -->
<div class="modal fade" id="googleCalendarModal" tabindex="-1" aria-labelledby="googleMeetingModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="googleMeetingModalLabel"><i class='bx bx-calendar'></i> Schedule Google Meeting</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <hr class="mb-0">
      <div class="modal-body">
        <form id="googleMeetingForm" method="POST" action="{{ route('google.oauth') }}">
          @csrf
          <input type="hidden" name="inquiry_id" id="inquiryId" value="">
          <input type="hidden" name="attendees" id="attendeesInput">
          <div class="row mb-3">
            <div class="col-md-4">
              <label for="meetingTitle" class="form-label">Event Title</label>
              <input type="text" class="form-control" id="meetingTitle" name="title" placeholder="e.g. Demo with Client" required>
            </div>
            <div class="col-md-4">
              <label for="meetingType" class="form-label">Meeting Type</label>
              <select class="form-select" id="meetingType" name="meeting_type">
                <option value="Asia/Kolkata" selected>Video Call (Google Meet)</option>
                <option value="UTC">In Person Meeting</option>
                <option value="America/New_York">Phone Call</option>
              </select>
            </div>
            <div class="col-md-4">
              <label for="meetingTimezone" class="form-label">Timezone</label>
              <select class="form-select" id="meetingTimezone" name="timezone">
                <option value="Asia/Kolkata" selected>Asia/Kolkata (IST)</option>
                <option value="UTC">UTC</option>
                <option value="America/New_York">America/New_York</option>
                <option value="Europe/London">Europe/London</option>
                <option value="Asia/Dubai">Asia/Dubai</option>
                <option value="Australia/Sydney">Australia/Sydney</option>
              </select>
            </div>
          </div>

          <div class="mb-3">
            <label for="meetingDescription" class="form-label">Description</label>
            <textarea class="form-control" id="meetingDescription" name="description" rows="2" placeholder="Agenda, notes, or meeting details..."></textarea>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="startAt" class="form-label">Start Date & Time</label>
              <input type="datetime-local" class="form-control" id="startAt" name="start_at" required>
            </div>
            <div class="col-md-6">
              <label for="endAt" class="form-label">End Date & Time</label>
              <input type="datetime-local" class="form-control" id="endAt" name="end_at" required>
            </div>
          </div>

          <div class="mb-3">
            <label for="attendees" class="form-label">Attendees (comma-separated emails)</label>
            <input type="text" class="form-control" id="attendees" name="attendees" placeholder="john@example.com, jane@example.com">
            <div class="form-text">Each attendee will receive an invite in their Google Calendar.</div>
          </div>

          <div id="meetingAlert" class="alert d-none"></div>

          <div class="text-end">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Create Google Meeting</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
