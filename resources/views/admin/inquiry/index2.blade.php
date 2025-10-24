@extends('admin.layouts.app')

@section('content')
<!-- Header -->
<div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between mb-1">
    <div class="mb-3 mb-sm-0">
        <h1 class="h3 h-sm-2 fw-semibold">Inquiries</h1>
    </div>
    <div class="d-flex align-items-center gap-2">
        <button type="button" class="btn btn-outline-dark d-none d-sm-inline-flex align-items-center">
            Export
        </button>
        <a href="{{ route('inquiries.create') }}" type="button" class="btn btn-primary d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus me-2"
                viewBox="0 0 16 16">
                <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg>
            <span class="d-none d-sm-inline">Add Inquiry</span>
            <span class="d-inline d-sm-none">Add</span>
        </a>
    </div>
</div>
<div class="row">
    <div class="col-12 inquiry-table">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between position-relative">
                <!-- <h5 class="mb-0">Inquiries</h5> -->
                {{-- search inquiry --}}
                <div class="custom_search_filter">
                    <form action="{{ route('inquiries.index') }}" method="GET">
                        <input type="text" class="form-control" id="search" name="search" placeholder="Search" value="{{ request()->search }}">
                        <div class="custom_search_filter_inputMask"><i class='bx bx-search'></i></div>
                    </form>
                </div>
                <div class="custom_search_filter_pop">
                    <div class="custom_search_filter_pop_wrap">
                        
                        <h5 >Filter By: <span class="filter_by_name">Rej</span></h5>
                        <hr>
                        <div class="custom_search_filter_pop_body">
                            <div class="custom_search_filter_pop_left">
                                <div class="search_loader text-center">
                                    <div class="spinner-border spinner-border-lg text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                                <div class="demo-inline-spacing mt-3 ">
                                    <div class="list-group list-group-flush search_result_list">
                                      <a href="javascript:void(0);" class="list-group-item list-group-item-action">Bear claw cake biscuit</a>
                                    </div>
                                </div>
                            </div>
                            <div class="custom_search_filter_pop_right ">
                                <div class="search_loader-right text-center">
                                    <div class="spinner-border spinner-border-lg text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                                <div class="custom_search_filter_pop_card">
                                    <div class="custom_search_filter_pop_card-header">
                                        <h5 class="">Rajesh Kumar</h5>
                                        <div class="custom_search_filter_pop_right_headDate">26 Jan 2023</div>
                                        <ul class="custom_search_filter_pop_right_basicInfo">
                                            <li><span><i class='bx bx-envelope'></i></span><span>xyz@gmail.com</span></li>
                                            <li><span><i class='bx bx-phone'></i></span><span>+91 7507507501</span></li>
                                            <li><span><i class='bx bx-calendar' ></i></span><span>26 Jan 2023</span></li>
                                        </ul>
                                    </div>
                                    <div class="custom_search_filter_pop_card-body mt-4">
                                        <h6>Other Information</h6>
                                        <ul>
                                            <li>Source: <span>Bigin</span></li>
                                            <li>Company Name: <span>Webeesocial Pvt. Ltd.</span></li>
                                            <li>Requirements: <span>We have started a new venture in <a href="#" class="inq_readMore"><small>Read More</small></a></span></li>
                                            <li>Budget: <span>500000</span></li>
                                            <li>L1: <span>Done <i class="bx bx-show view_details_btn" data-details=""></i></span></li>
                                            <li>Brief: <span>Not Done</span></li>
                                            <li>Handled By: <span>Chetan Singh</span></li>
                                            <li>Commercials Sent: <span class="batch_style text-danger">No</span></li>
                                            <li>Status: <span class="batch_style text-warniing">AWOL</span></li>
                                            <li>Contacted On: <span>26 Jan 2022</span></li>
                                            <li>Last Client Contact: <span>26 Jan 2022</span></li>
                                            <li>Last Contact: <span>28 Jan 2022</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center">
                    {{-- add new inquiry --}}

                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('export.inquiries') }}" class="btn btn-primary btn-sm me-3">Download</a>
                    @endif

                    <a href="{{ route('inquiries.create') }}"><small class="btn btn-primary btn-sm">Add New</small></a>

                    
                    <div class="header_option_btn ms-3" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false">
                        <span><i class='bx bx-columns text-primary'></i></span> <span>Columns</span>
                    </div>
                    <div class="dropdown-menu dropdown popover_filters" aria-labelledby="dropdownMenuButton">
                        <div class="dropdown_body columns_options">
                            <a class="toggle-vis active" data-column="1"> Date</a>
                            <a class="toggle-vis active" data-column="2">Name</a>
                            <a class="toggle-vis active" data-column="3">Company</a>
                            <a class="toggle-vis active" data-column="4">Requirements</a>
                            <a class="toggle-vis active" data-column="5">Budget</a>
                            <a class="toggle-vis active" data-column="6">L1</a>
                            <a class="toggle-vis active" data-column="7">Brief</a>
                            <a class="toggle-vis active" data-column="8">Handled By</a>
                            <a class="toggle-vis active" data-column="9">Status</a>
                            <a class="toggle-vis active" data-column="10">Actions</a>
                        </div>
                    </div>

                    <div class="cust_popover-main">
                        <div class="cust_popover header_option_btn ms-3" data-custom-popover="1"><span><i class='bx bx-filter-alt text-primary'></i></span> <span>Filter</span></div>
                        <div id="1" class="cust_popover_content pos_right">
                            <div class="cust_popover_content-wrap">
                                <p><b>Filter By Status</b></p>
                                <form action="">
                                    <div class="filter_btns">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="true" name="awol" {{ request()->awol ? 'checked' : '' }} />
                                            <label class="form-check-label" for="defaultCheck1">AWOL</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="true" name="converted" {{ request()->converted ? 'checked' : '' }} />
                                            <label class="form-check-label" for="defaultCheck1">Converted</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="true" name="new-lead" {{ request()->{'new-lead'} ? 'checked' : '' }} />
                                            <label class="form-check-label" for="defaultCheck1">New Lead</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="true" name="qualified-lead" {{ request()->{'qualified-lead'} ? 'checked' : '' }} />
                                            <label class="form-check-label" for="defaultCheck1">Qualified Lead</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="true" name="oppurtunity" {{ request()->oppurtunity ? 'checked' : '' }} />
                                            <label class="form-check-label" for="defaultCheck1">Opportunity</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="true" name="dont-want" {{ request()->{'dont-want'} ? 'checked' : '' }} />
                                            <label class="form-check-label" for="defaultCheck1">Don't Want</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="true" name="lost" {{ request()->{'lost'} ? 'checked' : '' }} />
                                            <label class="form-check-label" for="defaultCheck1">Lost</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="true" name="seems-interesting" {{ request()->{'seems-interesting'} ? 'checked' : '' }} />
                                            <label class="form-check-label" for="defaultCheck1">Seems Interesting</label>
                                        </div>

                                    </div>
                                    <hr>
                                    <p class="mt-3"><b>Filter By Handle</b></p>
                                    <div class="filter_btns">
                                        @foreach($users as $user)
                                                <div class="form-check">
                                                    @if(request()->users && in_array($user->id, request()->users))
                                                        <input class="form-check-input" type="checkbox" value="{{ $user->id }}" name="users[]" checked>
                                                    @else
                                                        <input class="form-check-input" type="checkbox" value="{{ $user->id }}" name="users[]" >
                                                    @endif
                                                        <label class="form-check-label" for="defaultCheck1">{{ $user->name }}</label>
                                                </div>
                                        @endforeach
                                    </div>
                                    <hr>

                                @if (auth()->user()->role === 'admin')
                                    <p class="mt-3"><b>Filter By Favorite</b></p>
                                    <div class="filter_btns">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="true" name="important" {{ request()->important ? 'checked' : '' }} />
                                            <label class="form-check-label" for="defaultCheck1">Favorite</label>
                                        </div>
                                    </div>
                                    <hr>
                                @endif

                                    <!-- end -->
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ route('inquiries.index') }}" class="btn btn-underline clear_all_btn">Clear all</a>
                                        <button class="btn btn-primary btn-sm">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if(session('google_meeting_success'))
                @php $g = session('google_meeting_success'); @endphp
                <div class="alert alert-success">
                    Google meeting created. <br>
                    <strong>Meet Link:</strong> <a href="{{ $g['hangoutLink'] }}" target="_blank">{{ $g['hangoutLink'] }}</a>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif


                <table class="table table-hover pb-3" id="inquiryTable">
                    <thead>
                        <tr>
                            <th width="0"></th>
                            <th scope="col" width="80">Date</th>
                            <th scope="col">Name</th>
                            <th scope="col">Company</th>
                            <th scope="col">Requirements</th>
                            <th scope="col" width="100">Budget</th>
                            <th scope="col" style="text-align: center;" width="70">L1 </th>
                            <th scope="col" style="text-align: center;" width="70">Brief</th>
                            <th scope="col" width="90">Handled By</th>
                            <th scope="col" style="text-align: center;">Status</th>
                            <th scope="col">Actions</th>
                            <th scope="col">Lead Source</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Commercials</th>
                            <th scope="col" style="text-align: center;">Contacted</th>
                            <th scope="col">Last Client Contacted</th>
                            <th scope="col">Last Contacted</th>
                        </tr>
                    </thead>
                    <tbody>

                      

                        @foreach ($inquiries as $inquiry)

                        @php
                             $isDisabled = in_array($inquiry->lead_status, ["Don't Want", "Lost"]) ? 'inquiry_row_fade' : '';
                        @endphp
                    
                        <tr class="{{ $isDisabled }}">
                            <td class="details-control">
                                <a href="javascript:;" data-bs-toggle="tooltip" data-bs-original-title="Expand Inquiry"><i class="bx bx-plus"></i></a>
                            </td>
                            <td>
                                {{ Carbon\Carbon::parse($inquiry->created_at)->format('d M Y') }}
                            </td>
                            
                            <td>{{ $inquiry->first_name }}</td>
                            <td>{{ $inquiry->company_name }}</td>
                            <td>
                                @if($inquiry->requirements && strlen($inquiry->requirements) > 50)
                                    {{ substr($inquiry->requirements, 0, 50) }}...<a href="#"class="inq_readMore view_details_btn" data-details="{{$inquiry->requirements}}">Read More</a>
                                @else
                                    {{ $inquiry->requirements }}
                                @endif
                            </td>
                            <td>{{ $inquiry->budget }}</td>
                            <td>
                                @php
                                $L1 = ['Done', 'Not Done', 'Didnt Pick'];
                                
                                if ($inquiry->L1 == 'Done') {
                                    $bg_color = 'text-success';
                                } elseif ($inquiry->L1 == 'Didnt Pick') {
                                    $bg_color = 'text-dark'; // You can use 'text-dark' or any other dark color class
                                } else {
                                    $bg_color = 'text-danger';
                                }
                                @endphp
                              
                                <select name="L1" id="L1" class="form-control L1 {{$bg_color}}" {{ $inquiry->lead_status == "Don't Want" ? 'disabled' : '' }}>
                                    @if($inquiry->L1=='Done')
                                        <option value="Done" data-inquiryId="{{ $inquiry->id }}" selected>Done</option>
                                        <option value="Not Done" data-inquiryId="{{ $inquiry->id }}">Not Done</option>
                                        <option value="Didnt Pick" data-inquiryId="{{ $inquiry->id }}">Didn't Pick</option>
                                    @elseif($inquiry->L1=='Not Done')
                                        <option value="Not Done" data-inquiryId="{{ $inquiry->id }}" selected>Not Done</option>
                                        <option value="Done" data-inquiryId="{{ $inquiry->id }}">Done</option>
                                        <option value="Didnt Pick" data-inquiryId="{{ $inquiry->id }}">Didn't Pick</option>
                                    @elseif($inquiry->L1=='Didnt Pick')
                                        <option value="Didnt Pick" data-inquiryId="{{ $inquiry->id }}" selected>Didn't Pick</option>
                                        <option value="Done" data-inquiryId="{{ $inquiry->id }}">Done</option>
                                        <option value="Not Done" data-inquiryId="{{ $inquiry->id }}">Not Done</option>
                                    @else
                                        <option value="Not Done" data-inquiryId="{{ $inquiry->id }}">Not Done</option>
                                        <option value="Didnt Pick" data-inquiryId="{{ $inquiry->id }}">Didn't Pick</option>
                                        <option value="Done" data-inquiryId="{{ $inquiry->id }}">Done</option>
                                    @endif
                                </select>
                                {{-- view L1 minutes in popover if li is done  --}}

                                @if($inquiry->L1 == 'Done')
                                    <button class="btn btn-primary btn-sm view-action-btn view_details_btn " type="button" data-details="{{$inquiry->L1_minutes}}">
                                        <i class="bx bx-show view_details_btn" data-details="{{$inquiry->L1_minutes}}"></i>
                                    </button>
                                @endif
                            </td>
                            <td>

                                @php
                                $brief = ['Done', 'Not Done'];
                                $bg_color = $inquiry->brief == 'Done' ? 'text-success' : 'text-danger';
                                @endphp



                                <select name="brief" id="brief" class="form-control brief {{ $bg_color }}" {{ $inquiry->lead_status == "Don't Want" || $inquiry->lead_status == "Lost" ? 'disabled' : '' }}>
                                    @if($inquiry->brief=='Done')
                                    <option value="Done" data-inquiryId="{{ $inquiry->id }}" selected>Done</option>
                                    <option value="Not Done" data-inquiryId="{{ $inquiry->id }}">Not Done</option>
                                    @else
                                    <option value="Not Done" data-inquiryId="{{ $inquiry->id }}" selected>Not Done</option>
                                    <option value="Done" data-inquiryId="{{ $inquiry->id }}">Done</option>
                                    @endif
                                </select>

                                @if($inquiry->brief == 'Done')
                                <button class="btn btn-primary btn-sm view-action-btn view_details_btn" type="button" data-details="{{$inquiry->brief_details}}">
                                    <i class="bx bx-show view_details_btn" data-details="{{$inquiry->brief_details}}"></i>
                                </button>
                                @endif
                            </td>
                            <td>

                            
                                <select name="handledBy" class="form-control handledBy" {{ $inquiry->lead_status == "Don't Want" || $inquiry->lead_status == "Lost" ? 'disabled' : '' }}>
                                    {{-- <option value="">Handled By</option> --}}
                                    @foreach($users as $user)
                                    @if($user->id == $inquiry->handled_by)
                                    <option value="{{$user->id}}" data-inquiryId="{{ $inquiry->id }}" selected>{{$user->name}}</option>
                                    @continue
                                    @endif
                                    <option value="{{$user->id}}" data-inquiryId="{{ $inquiry->id }}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                @php
                                $leads = ['New Lead', 'Opportunity', 'Qualified Lead', 'AWOL', 'Converted',"Don't Want","Lost","Seems Interesting"];
                                $bg_color = '';
                                if($inquiry->lead_status == 'New Lead') {
                                    $bg_color = 'text-warning';
                                } elseif($inquiry->lead_status == 'Opportunity') {
                                    $bg_color = 'text-success';
                                } elseif($inquiry->lead_status == 'Qualified Lead') {
                                    $bg_color = 'text-info';
                                } elseif($inquiry->lead_status == 'AWOL') {
                                    $bg_color = 'text-danger';
                                } elseif($inquiry->lead_status == 'Converted') {
                                    $bg_color = 'text-success';
                                } elseif($inquiry->lead_status == "Don't Want") {
                                    $bg_color = 'text-dont-want';
                                }elseif($inquiry->lead_status == "Lost") {
                                    $bg_color = 'text-dont-want';
                                }elseif($inquiry->lead_status == "Seems Interesting") {
                                    $bg_color = 'text-info';
                                }

                                @endphp
                                <select name="lead_status" class="form-control lead_status {{ $bg_color }}">
                                    @foreach($leads as $lead)
                                        @if($lead == $inquiry->lead_status)
                                            <option value="{{$lead}}" data-inquiryId="{{ $inquiry->id }}" selected>{{$lead}}</option>
                                            @continue
                                        @endif
                                        <option value="{{$lead}}" data-inquiryId="{{ $inquiry->id }}">{{$lead}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <div class="d-flex gap-2 flex-wrap align-item-center">
                                                                        
                                    @if (auth()->user()->role === 'admin')
                                        <i class=" mark-important bx bxs-star" style="color: {{ $inquiry->important ? 'gold' : 'gray' }}" data-important="{{ $inquiry->important }}" data-id="{{ $inquiry->id }}" data-bs-toggle="tooltip" title="{{ $inquiry->important ? 'Starred' : 'Not Starred' }}"></i>
                                    @endif
                                    
                                    <a href="{{ route('inquiries.edit', $inquiry->id) }}" data-bs-toggle="tooltip" data-bs-original-title="Edit Inquiry"><i class='bx bx-edit text-primary'></i></a>
                                    <form action="{{ route('inquiries.destroy', $inquiry->id) }}" method="POST" class="d-inline delete_form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" data-bs-toggle="tooltip" data-bs-original-title="Delete Inquiry" style="background: none; border: none; padding: 0; margin: 0;">
                                            <i class='bx bx-trash text-danger'></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('inquiries.view-actions',$inquiry->id) }}" data-bs-toggle="tooltip" data-bs-original-title="Inquiry Actions"><i class='bx bx-timer text-warning'></i> <!-- : {{ count($inquiry->logs) }} --></a>
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#googleCalendarModal" data-bs-original-title="Schedule Meeting" class="schedule_meeting_btn" data-inquiryId="{{ $inquiry->id }}">
                                        <i class='bx bx-headphone text-warning'></i>
                                    </a>
                                    

                                </div>
                            </td>
                            <td>{{ $inquiry->lead_source }}</td>
                            <td>{{ $inquiry->email }}</td>
                            <td>{{ $inquiry->phone }}</td>
                            <td>
                                @php
                                $commercial = ['Yes', 'No'];
                                $bg_color = $inquiry->commercial == '1' ? 'text-success' : 'text-danger';
                                @endphp
                                <select name="commercial" id="commercial" class="form-control commercial {{ $bg_color }}" {{ $inquiry->lead_status == "Don't Want" || $inquiry->lead_status == "Lost" ? 'disabled' : '' }}>
                                    <option value="1" data-inquiryId="{{ $inquiry->id }}" {{ $inquiry->commercial == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" data-inquiryId="{{ $inquiry->id }}" {{ $inquiry->commercial == 0 ? 'selected' : '' }}>No</option>
                                </select>
                            </td>
                            <td>
                                <input style="max-width: 120px;" type="date" class="form-control first_contacted" value="{{
                                            $inquiry->first_contacted ? Carbon\Carbon::parse($inquiry->first_contacted)->format('Y-m-d') : ''
                                            }}" data-inquiryId="{{ $inquiry->id }}" name="first_contacted" {{ $inquiry->lead_status == "Don't Want" || $inquiry->lead_status == "Lost" ? 'disabled' : '' }}>
                            </td>
                            <td>
                                <input style="max-width: 120px;" type="date" class="form-control last_client_contacted" value="{{
                                            $inquiry->last_client_contacted ? Carbon\Carbon::parse($inquiry->last_client_contacted)->format('Y-m-d') : ''
                                            }}" data-inquiryId="{{ $inquiry->id }}" name="last_client_contacted" {{ $inquiry->lead_status == "Don't Want" || $inquiry->lead_status == "Lost" ? 'disabled' : '' }}>
                            </td>
                            <td>
                                <input style="max-width: 120px;" type="date" class="form-control last_contacted" value="{{
                                            $inquiry->last_contacted ? Carbon\Carbon::parse($inquiry->last_contacted)->format('Y-m-d') : ''
                                            }}" data-inquiryId="{{ $inquiry->id }}" name="last_contacted" {{ $inquiry->lead_status == "Don't Want" || $inquiry->lead_status == "Lost" ? 'disabled' : '' }}>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    {{ $inquiries->links() }}
                </table>
            </div>
        </div>
    </div>
</div>

<x-admin.google-calendar-modal />

{{-- l1 minutes model --}}

<div class="modal fade" id="L1Minutes" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">L1 Minutes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" id="l1_minutes_form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <textarea id="l1_minutes" name="l1_minutes" class="form-control" placeholder="Type Here..."></textarea>
                        </div>
                        <input type="hidden" id="inquiry_id_for_li_minutes" name="inquiry_id_for_li_minutes">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Minutes</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- brief details modal --}}

<div class="modal cust_mod_style fade" id="brief_details_modal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Brief Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" id="brief_details_form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameSmall" class="form-label">Brief Details</label>
                            <textarea id="brief_details" name="brief_details" class="form-control" placeholder="brief_details"></textarea>
                        </div>
                        <input type="hidden" id="inquiry_id_for_brief_details" name="inquiry_id_for_brief_details">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Details</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- l1 and brief detials modal --}}
<div class="modal cust_mod_style fade" id="details_modal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">L1 Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row details_area">
                    strtotime
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script src="https://momentjs.com/downloads/moment.js" ></script>
<script>
    document.getElementById('googleMeetingForm').addEventListener('submit', function(e){
    // combine attendees field into a single hidden input for session storage
    const attendeesRaw = document.getElementById('attendees').value || '';
    document.getElementById('attendeesInput').value = attendeesRaw;
    // normal form submit will continue and redirect to OAuth (if needed)
    });


    $(document).ready(function() {

        $(".schedule_meeting_btn").click(function() {
            let inquiryId = $(this).data('inquiryid');
            $("#inquiryId").val(inquiryId);
        });

        // hide search area

        $(".custom_search_filter_pop").hide();
        $(".search_loader").hide();
        $(".custom_search_filter_pop_right").hide();
        $(".search_loader-right").hide();

        // init CK editors

        ClassicEditor
            .create(document.querySelector('#l1_minutes'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
                heading: {
                    options: [{
                            model: 'paragraph',
                            title: 'Paragraph',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Heading 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Heading 2',
                            class: 'ck-heading_heading2'
                        }
                    ]
                }
            })
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#brief_details'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
                heading: {
                    options: [{
                            model: 'paragraph',
                            title: 'Paragraph',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Heading 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Heading 2',
                            class: 'ck-heading_heading2'
                        }
                    ]
                }
            })
            .catch(error => {
                console.error(error);
            });

        let table = $('#inquiryTable').DataTable({
            responsive: true,
            pageLength: 100,
            paging: false,
            searching: false,
            "dom": 'rt<"bottom"lip><"clear">',
        });

        // set default hide columns

        table.columns([11,12, 13, 14, 15, 16, 17]).visible(false);

        // formating function 

        function format(d) {
            console.log(d);
            return `<div class="cust-tr">
                <div class="cust-tr-col">
                    <span>Source</span>
                    <span>${d[11]}</span>
                </div>
                <div class="cust-tr-col">
                    <span>Email</span>
                    <span>${d[12]}</span>
                </div>
                <div class="cust-tr-col">
                    <span>Contact</span>
                    <span>${d[13]}</span>
                </div>
                <div class="cust-tr-col commercials_col">
                    <span>Commercials sent</span>
                    <span>${d[14]}</span>
                </div>
                <div class="cust-tr-col">
                    <span>First Contact</span>
                    <span>${d[15]}</span>
                </div>
                <div class="cust-tr-col">
                    <span>Last Client Contact</span>
                    <span>${d[16]}</span>
                </div>
                <div class="cust-tr-col">
                    <span>Last Contact</span>
                    <span>${d[17]}</span>
                </div>
            </table>`;
        }

        // search inquiry

        $("#search").keyup(function(e) {
            e.preventDefault();
            let search = $(this).val();
            if(search.length <= 2){
                $(".custom_search_filter_pop").hide();
                return false;
            }
            $(".search_loader").show();
            $(".custom_search_filter_pop").show();
            $(".filter_by_name").html(search);

            $.post("{{ route('inquiries.search') }}", {
                search: search,
                "_token": "{{ csrf_token() }}",
            }, function(data) {
                if(data.inquiries.length == 0){
                    $(".search_result_list").html('<li class="searched_result"><a href="#"><span><i class="bx bx-error"></i></span> No Result Found</a></li>');
                    $(".search_loader").hide();
                    return false;
                }
                let html = '';
                data.inquiries.forEach(inquiry => {
                        html += `<a href="javascript:void(0);" class="list-group-item list-group-item-action searched_result" data-id="${inquiry.id}">
                            ${inquiry.first_name} ${inquiry.last_name} <span class="text-muted">(${inquiry.company_name})</span>
                            
                            </a>`;
                });
                $(".search_result_list").html(html);
                $(".search_loader").hide();
                
            });
        });

        // Add event listener for opening and closing details

        $('#inquiryTable tbody').on('click', 'td.details-control', function(e) {
            let tr = e.target.closest('tr');
            let row = table.row(tr);

            if (row.child.isShown()) {
                row.child.hide();
            } else {
                row.child(format(row.data())).show();
            }
        });

        // open popover on click of actions button
        $('.cust_popover').click(function() {
            let cust_popover_id = $(this).data('custom-popover');
            $('#' + cust_popover_id).toggleClass('active');
        });

        $("#dropdownMenuButton").click(function() {
            $(".popover_filters").toggle();
        });

        // hide popover on click of outside

        $(document).mouseup(function(e) {
            var container = $(".cust_popover_content");

            if (!container.is(e.target) && container.has(e.target).length === 0) {
                container.removeClass('active');
            }
        });

        $(document).mouseup(function(e) {
            var container = $(".popover_filters");

            if (!container.is(e.target) && container.has(e.target).length === 0) {
                container.hide();
            }
        });

        // toggle columns

        $('a.toggle-vis').on('click', function(e) {
            e.preventDefault();
            let column = table.column($(this).attr('data-column'));
            column.visible(!column.visible());

            // add remove active class

            $(this).toggleClass('active');

        });

        // view l1 and brief details modal

        $(document).on("click", ".view_details_btn", function() {
            let details = $(this).data('details');
            $(".details_area").html(details);
            $("#details_modal").modal('show');
        });


        $(document).on("change", ".handledBy", function() {
            let user_id = $(this).val();
            let inquiryId = $(this).find(':selected').data('inquiryid');
            $.post("{{ route('inquiries.update') }}", {
                user_id: user_id,
                inquiryId: inquiryId,
                "_token": "{{ csrf_token() }}",
            }, function(data) {
                if (data.success) {
                    toast('Success', 'Assigned Successfully!', 'success');
                } else {
                    toast('Error', data.message, 'error');
                }
            });
        });

        $(document).on("change", ".lead_status", function() {
            let lead_status = $(this).val();

            // toggle text-success & text-danger according to lead status
            if (lead_status == 'New Lead') {
                $(this).removeClass('text-success text-info text-danger text-dont-want').addClass('text-warning');
            } else if (lead_status == 'Opportunity') {
                $(this).removeClass('text-success text-info text-danger text-dont-want').addClass('text-success');
            } else if (lead_status == 'Qualified Lead') {
                $(this).removeClass('text-success text-info text-danger text-dont-want').addClass('text-info');
            } else if (lead_status == 'AWOL') {
                $(this).removeClass('text-success text-info text-danger text-dont-want').addClass('text-danger');
            } else if (lead_status == 'Converted') {
                $(this).removeClass('text-success text-info text-danger text-dont-want').addClass('text-success');
            }else if (lead_status == "Don't Want") {
                $(this).removeClass('text-success text-info text-danger text-dont-want').addClass('text-dont-want');
            }else if(lead_status == "Lost"){
                $(this).removeClass('text-success text-info text-danger text-dont-want').addClass('text-dont-want');
            }else if(lead_status == "Seems Interesting"){
                $(this).removeClass('text-success text-info text-danger text-dont-want').addClass('text-info');
            }

            let inquiryId = $(this).find(':selected').data('inquiryid');
            $.post("{{ route('inquiries.update-status') }}", {
                lead_status: lead_status,
                inquiryId: inquiryId,
                "_token": "{{ csrf_token() }}",
            }, function(data) {
                if (data.success) {
                    toast('Success', 'Status Updated Successfully!', 'success');
                    location.reload();
                } else {
                    toast('Error', data.message, 'error');
                }
            });
        });

        // change L1 status
        $(document).on("change", ".L1", function() {
            let L1 = $(this).val();
            if (L1 == 'Done') {
                $("#L1Minutes").modal('show');
                $(this).removeClass('text-danger text-dark').addClass('text-success');
                // add view details button
                let view_btn = `
                <button class="btn btn-primary btn-sm view-action-btn view_details_btn" type="button" data-details="">
                    <i class="bx bx-show view_details_btn" data-details=""></i>
                </button>
                `;
                $(this).parent().append(view_btn);
            } else if (L1 == 'Didnt Pick') {
                $(this).removeClass('text-success text-danger').addClass('text-dark');
                $(this).parent().find('.view_details_btn').remove();
            } else {
                $(this).removeClass('text-success text-dark').addClass('text-danger');
                $(this).parent().find('.view_details_btn').remove();
            }

            let inquiryId = $(this).find(':selected').data('inquiryid');
            $("#inquiry_id_for_li_minutes").val(inquiryId);
            $.post("{{ route('inquiries.update-l1') }}", {
                L1: L1,
                inquiryId: inquiryId,
                "_token": "{{ csrf_token() }}",
            }, function(data) {
                if (data.success) {
                    if(L1=='Didnt Pick'){
                        location.reload();
                    }
                    toast('Success', 'L1 Status Updated Successfully!', 'success');

                } else {
                    toast('Error', data.message, 'error');
                }
            });
        });

        // save l1 minutes

        $("#l1_minutes_form").submit(function(e) {
            e.preventDefault();
            let l1_minutes = $("#l1_minutes").val();
            let inquiryId = $("#inquiry_id_for_li_minutes").val();
            $.post("{{ route('inquiries.save-l1-minutes') }}", {
                l1_minutes: l1_minutes,
                inquiryId: inquiryId,
                "_token": "{{ csrf_token() }}",
            }, function(data) {
                if (data.success) {
                    toast('Success', 'L1 Minutes Saved Successfully!', 'success');
                    $("#L1Minutes").modal('hide');
                    location.reload();
                } else {
                    toast('Error', data.message, 'error');
                }
            });
        });

        // change breaf status
        $(document).on("change", ".brief", function() {
            let brief = $(this).val();
            let inquiryId = $(this).find(':selected').data('inquiryid');
            $("#inquiry_id_for_brief_details").val(inquiryId);
            if (brief == 'Done') {
                $("#brief_details_modal").modal('show');
                $(this).removeClass('text-danger').addClass('text-success');
                // add view details button
                let view_btn = `<button class="btn btn-primary btn-sm view-action-btn view_details_btn" type="button" data-details="">
                    <i class="bx bx-show view_details_btn" data-details=""></i>
                </button>`;
                $(this).parent().append(view_btn);
            }else{
                $(this).removeClass('text-success').addClass('text-danger');
                $(this).parent().find('.view_details_btn').remove();
            }

            $.post("{{ route('inquiries.update-brief-status') }}", {
                brief: brief,
                inquiryId: inquiryId,
                "_token": "{{ csrf_token() }}",
            }, function(data) {
                if (data.success) {
                    toast('Success', 'Brief Status Updated Successfully!', 'success');
                } else {
                    toast('Error', data.message, 'error');
                }
            });
        });

        // save brief details

        $("#brief_details_form").submit(function(e) {
            e.preventDefault();
            let brief_details = $("#brief_details").val();
            let inquiryId = $("#inquiry_id_for_brief_details").val();
            $.post("{{ route('inquiries.save-brief-details') }}", {
                brief_details: brief_details,
                inquiryId: inquiryId,
                "_token": "{{ csrf_token() }}",
            }, function(data) {
                if (data.success) {
                    toast('Success', 'Brief Details Saved Successfully!', 'success');
                    $("#brief_details_modal").modal('hide');
                    location.reload();
                } else {
                    toast('Error', data.message, 'error');
                }
            });
        });

        // change first contacted date

        $(document).on("change", ".first_contacted", function() {
            let first_contacted = $(this).val();
            let inquiryId = $(this).data('inquiryid');
            $.post("{{ route('inquiries.update-first-contacted') }}", {
                first_contacted: first_contacted,
                inquiryId: inquiryId,
                "_token": "{{ csrf_token() }}",
            }, function(data) {
                if (data.success) {
                    toast('Success', 'First Contacted Date Updated Successfully!', 'success');
                } else {
                    toast('Error', data.message, 'error');
                }
            });
        });

        // change last client contacted date
        $(document).on("change", ".last_client_contacted", function() {
            let last_client_contacted = $(this).val();
            let inquiryId = $(this).data('inquiryid');
            $.post("{{ route('inquiries.update-last-client-contacted') }}", {
                last_client_contacted: last_client_contacted,
                inquiryId: inquiryId,
                "_token": "{{ csrf_token() }}",
            }, function(data) {
                if (data.success) {
                    toast('Success', 'Last Client Contacted Date Updated Successfully!', 'success');
                } else {
                    toast('Error', data.message, 'error');
                }
            });
        });

        // change last contacted date
        $(document).on("change", ".last_contacted", function() {
            let last_contacted = $(this).val();
            let inquiryId = $(this).data('inquiryid');
            $.post("{{ route('inquiries.update-last-contacted') }}", {
                last_contacted: last_contacted,
                inquiryId: inquiryId,
                "_token": "{{ csrf_token() }}",
            }, function(data) {
                if (data.success) {
                    toast('Success', 'Last Contacted Date Updated Successfully!', 'success');
                } else {
                    toast('Error', data.message, 'error');
                }
            });
        });

        // change commercial status

        $(document).on("change", ".commercial", function() {
            let commercial = $(this).val();
            let inquiryId = $(this).find(':selected').data('inquiryid');
            $.post("{{ route('inquiries.update-commercial') }}", {
                commercial: commercial,
                inquiryId: inquiryId,
                "_token": "{{ csrf_token() }}",
            }, function(data) {
                if (data.success) {
                    toast('Success', 'Commercial Status Updated Successfully!', 'success');
                    location.reload();
                } else {
                    toast('Error', data.message, 'error');
                }
            });
        });

        //color change or selection

        $(document).ready(function() {
            // Change row color on hover
            $('#inquiryTable tbody tr').hover(
                function() {
                    $(this).addClass('hovered');
                },
                function() {
                    $(this).removeClass('hovered');
                }
            );

            // Change row color on click or hover 
            $('#inquiryTable tbody tr').click(function() {
                $(this).toggleClass('clicked');
            });
        });

        // confirm delete action

        $(".delete_form").submit(function(e) {
            e.preventDefault();
            let form = $(this);
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this inquiry!",
                icon: 'warning',
                iconColor: '#1fb37a',
                showCancelButton: true,
                confirmButtonColor: '#1fb37a',
                cancelButtonColor: '#d33',

                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.unbind('submit').submit();
                }
            });

        });


$(document).ready(function() {
    $('[data-bs-toggle="tooltip"]').tooltip(); // Initialize tooltips

    $(".mark-important").click(function(e) {
        
        let inquiryId = $(this).data('id'); 
        let important = $(this).data('important');

        if(important == 1){
            $(this).css({'color':'gray'});
            $(this).data('important', 0);
        
        }else{
            console.log('gold')
            console.log($(this));
            $(this).css({'color':'gold'});
            $(this).data('important', 1);
        }

        $.post("{{ route('inquiries.important') }}", {
            inquiryId: inquiryId,
            marked: !important,
            "_token": "{{ csrf_token() }}" 
        }, function(data) {
            if (data.success) {
                let msg = important ? 'Unmarked' : 'Marked';
                toast('Success', 'Inquiry '+msg+' as Important!', 'success');
            } else {
                toast('Error', data.message, 'error');
            }
        });
    });
});



        // view inquiry

        $(document).on("click", ".searched_result", function(e) {
            e.preventDefault();
            $(".search_loader-right").show();
            let id = $(this).data('id');
            $.get("{{ route('inquiries.view') }}/"+id, function(data) {
                let html = `
                        <div class="custom_search_filter_pop_card-header ">
                            <h5 class="">${data.inquiry.first_name} ${data.inquiry.last_name} <a href="{{ route('inquiries.edit') }}/${data.inquiry.id}"><i class='bx bx-pencil'></i></a></h5>
                            <div class="custom_search_filter_pop_right_headDate">${
                                moment(data.inquiry.created_at).format('Y-MM-DD')
                            }</div>
                            <ul class="custom_search_filter_pop_right_basicInfo">
                                <li><span><i class='bx bx-envelope'></i></span><span>${data.inquiry.email}</span></li>
                                <li><span><i class='bx bx-phone'></i></span><span>${data.inquiry.phone}</span></li>
                            </ul>
                        </div>
                        <div class="custom_search_filter_pop_card-body mt-4">
                            <h6>Other Information</h6>
                            <ul>
                                <li>Source: <span>${data.inquiry.lead_source}</span></li>
                                <li>Company Name: <span>${data.inquiry.company_name}</span></li>
                                <li>Requirements: <span>${data.inquiry.requirements}</span></li>
                                <li>Budget: <span>${data.inquiry.budget}</span></li>
                                <li>L1:
                                    <span>
                                        <select name="L1" class="form-control L1 ${ data.inquiry.L1=='Done'? 'text-success' : data.inquiry.L1=='Didnt Pick'? 'text-dark' : 'text-danger' }">
                                            <option value="Not Done" data-inquiryId="${data.inquiry.id}" ${data.inquiry.L1 == 'Not Done' ? 'selected' : ''}>Not Done</option>
                                            <option value="Done" data-inquiryId="${data.inquiry.id}" ${data.inquiry.L1 == 'Done' ? 'selected' : ''}>Done</option>
                                            <option value="Didnt Pick" data-inquiryId="${data.inquiry.id}" ${data.inquiry.L1 == 'Didnt Pick' ? 'selected' : ''}>Didn't Pick</option>
                                        </select>
                                    </span>
                                </li>
                                <li>Brief:
                                        <span>
                                            <select name="brief" class="form-control brief ${ data.inquiry.brief=='Done'? 'text-success' : 'text-danger' }">
                                                <option value="Not Done" data-inquiryId="${data.inquiry.id}" ${data.inquiry.brief == 'Not Done' ? 'selected' : ''}>Not Done</option>
                                                <option value="Done" data-inquiryId="${data.inquiry.id}" ${data.inquiry.brief == 'Done' ? 'selected' : ''}>Done</option>
                                            </select>
                                        </span>
                                </li>
                                <li>Handled By: 
                                    <span>
                                        <select name="handled_by" class="form-control handledBy">
                                            <option value="">Handled By</option>
                                            <option value="${
                                                data.inquiry.handled_by ? data.inquiry.handled_by.id : '1'
                                            }" selected>${
                                                data.inquiry.handled_by ? data.inquiry.handled_by.name : 'Admin'
                                            }</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}" data-inquiryId="${data.inquiry.id}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </span>
                                </li>
                                <li>Commercials Sent: 
                                    <span>
                                        <select name="commercial" id="commercial" class="form-control commercial ${ data.inquiry.commercial==1? 'text-success' : 'text-danger' }">
                                            <option value="0" data-inquiryId="${data.inquiry.id}" ${data.inquiry.commercial == 0 ? 'selected' : ''}>No</option>
                                            <option value="1" data-inquiryId="${data.inquiry.id}" ${data.inquiry.commercial == 1 ? 'selected' : ''}>Yes</option>
                                        </select>
                                    </span>
                                </li>
                                <li>Status: 
                                    <span>
                                        <select name="lead_status" class="form-control lead_status ${ data.inquiry.lead_status=='New Lead'? 'text-warning' : data.inquiry.lead_status=='Opportunity'? 'text-success' : data.inquiry.lead_status=='Qualified Lead'? 'text-info' : data.inquiry.lead_status=='AWOL'? 'text-danger' : data.inquiry.lead_status=='Converted'? 'text-success' : 'text-dont-want' }">
                                            <option value="New Lead" data-inquiryId="${data.inquiry.id}" ${data.inquiry.lead_status == 'New Lead' ? 'selected' : ''}>New Lead</option>
                                            <option value="Opportunity" data-inquiryId="${data.inquiry.id}" ${data.inquiry.lead_status == 'Opportunity' ? 'selected' : ''}>Opportunity</option>
                                            <option value="Qualified Lead" data-inquiryId="${data.inquiry.id}" ${data.inquiry.lead_status == 'Qualified Lead' ? 'selected' : ''}>Qualified Lead</option>
                                            <option value="AWOL" data-inquiryId="${data.inquiry.id}" ${data.inquiry.lead_status == 'AWOL' ? 'selected' : ''}>AWOL</option>
                                            <option value="Converted" data-inquiryId="${data.inquiry.id}" ${data.inquiry.lead_status == 'Converted' ? 'selected' : ''}>Converted</option>
                                            <option value="Don't Want" data-inquiryId="${data.inquiry.id}" ${data.inquiry.lead_status == "Don't Want" ? 'selected' : ''}>Don't Want</option>
                                        </select>
                                    </span>
                                </li>
                                <li>Contacted On:
                                    <span>
                                        <input type="date" class="form-control first_contacted" value="${
                                                moment(data.inquiry.first_contacted).format('Y-MM-DD')
                                            }" data-inquiryId="${data.inquiry.id}" name="first_contacted">
                                    </span>
                                </li>
                                <li>Last Client Contact: 
                                    <span>
                                        <input type="date" class="form-control last_client_contacted" value="${
                                                moment(data.inquiry.last_client_contacted).format('Y-MM-DD')
                                            }" data-inquiryId="${data.inquiry.id}" name="last_client_contacted">
                                    </span>
                                </li>
                                <li>Last Contact:
                                    <span>
                                        <input type="date" class="form-control last_contacted" value="${
                                                moment(data.inquiry.last_contacted).format('Y-MM-DD')
                                            }" data-inquiryId="${data.inquiry.id}" name="last_contacted">
                                    <span>
                                </li>
                            </ul>
                        </div>
                `;
                $(".custom_search_filter_pop_card").html(html);
                $(".custom_search_filter_pop_right").show();
                $(".search_loader-right").hide();
            });
        });





    });
</script>
@endsection