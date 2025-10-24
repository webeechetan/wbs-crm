@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('styles')@endsection

@section('content')
{{-- Filters --}}
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="card-title mb-0">
                    <h3 class="m-0 me-2 text-primary mb-2">Dashboard</h3>
                    <div>
                        @if(request()->get('from_date') && request()->get('to_date'))
                        {{ request()->get('from_date') }} - {{ request()->get('to_date') }}
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <a href="{{ route('dashboard', ['from_date' => date('Y-m-d'),'to_date' => date('Y-m-d')]) }}"
                        class="me-2">
                        <button class="btn btn-primary btn-sm">Today</button>
                    </a>

                    <a href="{{ route('dashboard', ['from_date' => date('Y-m-d', strtotime('-1 days')),'to_date' => date('Y-m-d', strtotime('-1 days'))]) }}"
                        class="me-2">
                        <button class="btn btn-primary btn-sm">Yesterday</button>
                    </a>

                    <a href="{{ route('dashboard', ['from_date' => date('Y-m-d', strtotime('-7 days')),'to_date' => date('Y-m-d')]) }}"
                        class="me-2">
                        <button class="btn btn-primary btn-sm">Last 7 Days</button>
                    </a>

                    <a href="{{ route('dashboard', ['from_date' => date('Y-m-d', strtotime('-30 days')),'to_date' => date('Y-m-d')]) }}"
                        class="me-2">
                        <button class="btn btn-primary btn-sm">Last 30 Days</button>
                    </a>
                    <a class="">
                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Date filter
                        </button>
                        <div class="dropdown-menu dropdown filter-form-dropdown" aria-labelledby="dropdownMenuButton">
                            <form action="{{ route('dashboard') }}" method="GET" class="dropdown-item">
                                <div class="filter-form">
                                    <div>
                                        <div class="form-group d-flex gap-2 align-items-center mb-3">
                                            <label for="from_date">From</label>
                                            <input type="date" name="from_date" id="from_date" class="form-control"
                                                value="{{ request()->get('from_date') }}">
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-group d-flex gap-2 align-items-center mb-3">
                                            <label for="to_date">To</label>
                                            <input type="date" name="to_date" id="to_date" class="form-control"
                                                value="{{ request()->get('to_date') }}">
                                        </div>
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-primary btn-sm w-100">Apply</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Leads count by Status --}}

<div class="row">



</div>

<div class="row">
    <div class="col-md-2">
        <div class="card mb-4">
            <a href="{{ route('inquiries.index') }}">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="avatar flex-shrink-0 me-2">
                            <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-border-all"></i></span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <p class="mb-0">Total Leads</p>
                            </div>
                            <div class="user-progress">
                                <small class="fw-semibold badge bg-primary">{{ count($enquiries) }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    @foreach($inquiryCountByLeadStatus['lead_status'] as $inquiry)

    @php
    $bx_icon = 'bx bx-mobile-alt';

    if($inquiry=='Converted'){
    $bx_icon = 'bx bx-smile text-success';
    }

    if($inquiry=='AWOL'){
    $bx_icon = 'bx bx-angry text-danger';
    }

    if($inquiry=='New Lead'){
    $bx_icon = 'bx bx-run';
    }

    if($inquiry=='Qualified Lead'){
    $bx_icon = 'bx bx-circle';
    }
    $url = '';
    if($inquiry=='New Lead'){
    $url = route('inquiries.index').'?new-lead=true';
    }
    if($inquiry=='Qualified Lead'){
    $url = route('inquiries.index').'?qualified-lead=true';
    }
    if($inquiry=='Converted'){
    $url = route('inquiries.index').'?converted=true';
    }
    if($inquiry=='AWOL'){
    $url = route('inquiries.index').'?awol=true';
    }
    if($inquiry=='Opportunity'){
    $url = route('inquiries.index').'?oppurtunity=true';
    }
    @endphp
    <div class="col-md-2">
        <div class="card mb-4">
            <a href="{{ $url }}">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="avatar flex-shrink-0 me-2">
                            <span class="avatar-initial rounded bg-label-primary"><i class="{{$bx_icon}}"></i></span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div>
                                <p class="mb-0">{{$inquiry}}</p>
                            </div>
                            <div class="user-progress">
                                <small class="fw-semibold badge bg-primary">
                                    {{ $inquiryCountByLeadStatus['counts'][$loop->index] }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    @endforeach
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h6>Upcoming Events</h6>
            </div>
            <div class="card-body">
                <div style="height: 400px; overflow-y: auto;">
                    <div class="d-flex flex-column gap-3">
                        <!-- Card 1 -->
                        <div class="card shadow-none border text-dark rounded-4 p-3">
                            <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-3">
                                <div class="d-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-2 text-white" style="width:40px; height:40px;">
                                    <i class='bx bx-video' ></i>
                                </div>
                                <div>
                                <h6 class="fw-semibold mb-1">Product Demo - Acme Corp</h6>
                                <div class="d-flex align-items-center gap-2 text-muted small">
                                    <span>Wed, Oct 2</span>
                                    <span>•</span>
                                    <span>14:00</span>
                                    <span>•</span>
                                    <span>1 attendee(s)</span>
                                </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-secondary">Video</span>
                                <button class="btn px-1">Edit</button>
                            </div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="card shadow-none border text-dark rounded-4 p-3">
                            <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-3">
                                <div class="d-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-2 text-white" style="width:40px; height:40px;">
                                    <i class='bx bx-phone' ></i>
                                </div>
                                <div>
                                <h6 class="fw-semibold mb-1">Follow-up Call - TechStart</h6>
                                <div class="d-flex align-items-center gap-2 text-muted small">
                                    <span>Wed, Oct 2</span>
                                    <span>•</span>
                                    <span>16:00</span>
                                    <span>•</span>
                                    <span>1 attendee(s)</span>
                                </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-secondary">Phone</span>
                                <button class="btn px-1">Edit</button>
                            </div>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="card shadow-none border text-dark rounded-4 p-3">
                            <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-3">
                                <div class="d-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-2 text-white" style="width:40px; height:40px;">
                                    <i class='bx bx-user' ></i>
                                </div>
                                <div>
                                <h6 class="fw-semibold mb-1">Proposal Review - GrowthCo</h6>
                                <div class="d-flex align-items-center gap-2 text-muted small">
                                    <span>Thu, Oct 3</span>
                                    <span>•</span>
                                    <span>11:00</span>
                                    <span>•</span>
                                    <span>1 attendee(s)</span>
                                </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-secondary">In-person</span>
                                <button class="btn px-1">Edit</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h6>Recent Activities</h6>
            </div>
            <div class="card-body">
                <div style="height: 400px; overflow-y: auto;">
                    <div class="d-flex flex-column gap-3">
                        <!-- Activity -->
                        <div class="d-flex gap-3">
                            <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-white" style="width: 40px; height: 40px;">
                                <i class='bx bxs-phone' ></i>
                            </div>
                            <div class="flex-grow-1">
                            <div class="d-flex justify-content-between">
                                <h6 class="fw-semibold mb-0">Called Sarah Johnson</h6>
                                <small class="text-muted">2 hours ago</small>
                            </div>
                            <p class="text-muted small mb-1">Discussed their marketing automation needs. Very interested in our enterprise package.</p>
                            <div class="d-flex gap-4 small text-muted">
                                <span>by John Doe</span>
                            </div>
                            </div>
                        </div>
                        <hr style="margin: 0;">
                        <!-- Activity -->
                        <div class="d-flex gap-3">
                            <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-white" style="width: 40px; height: 40px;">
                                <i class='bx bx-notepad' ></i>
                            </div>
                            <div class="flex-grow-1">
                            <div class="d-flex justify-content-between">
                                <h6 class="fw-semibold mb-0">Brief discussed with Sarah Johnson</h6>
                                <small class="text-muted">1 day ago</small>
                            </div>
                            <p class="text-muted small mb-1">Discussed their marketing automation needs. Very interested in our enterprise package.</p>
                            <div class="d-flex gap-4 small text-muted">
                                <span>by John Doe</span>
                            </div>
                            </div>
                        </div>
                        <hr style="margin: 0;">
                        <!-- Activity -->
                        <div class="d-flex gap-3">
                            <div class="d-flex align-items-center justify-content-center rounded-circle bg-danger bg-opacity-10 text-white" style="width: 40px; height: 40px;">
                                <i class='bx bx-notepad' ></i>
                            </div>
                            <div class="flex-grow-1">
                            <div class="d-flex justify-content-between">
                                <h6 class="fw-semibold mb-0">Changed the Brief status from ‘Done’ to ‘Not Done’ for Sarah Johnson</h6>
                                <small class="text-muted">1 day ago</small>
                            </div>
                            <div class="d-flex gap-4 small text-muted">
                                <span>by John Doe</span>
                            </div>
                            </div>
                        </div>
                        <hr style="margin: 0;">
                        <!-- Activity -->
                        <div class="d-flex gap-3">
                            <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-white" style="width: 40px; height: 40px;">
                                <i class='bx bx-user' ></i>
                            </div>
                            <div class="flex-grow-1">
                            <div class="d-flex justify-content-between">
                                <h6 class="fw-semibold mb-0">Assigned ‘Sarah Johnson lead’ to Sahir Kumar</h6>
                                <small class="text-muted">1 day ago</small>
                            </div>
                            <div class="d-flex gap-4 small text-muted">
                                <span>by John Doe</span>
                            </div>
                            </div>
                        </div>
                        <hr style="margin: 0;">
                        <!-- Activity -->
                        <div class="d-flex gap-3">
                            <div class="d-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10 text-white" style="width: 40px; height: 40px;">
                                <i class='bx bxs-calendar-alt' ></i>
                            </div>
                            <div class="flex-grow-1">
                            <div class="d-flex justify-content-between">
                                <h6 class="fw-semibold mb-0">Scheduled Video call (Google meet) invite with sarah johnson</h6>
                                <small class="text-muted">1 day ago</small>
                            </div>
                            <p class="text-muted small mb-1">Sent pricing information and case studies as requested.</p>
                            <div class="d-flex gap-4 small text-muted">
                                <span>by John Doe</span>
                            </div>
                            </div>
                        </div>
                        <hr style="margin: 0;">
                        <!-- Activity -->
                        <div class="d-flex gap-3">
                            <div class="d-flex align-items-center justify-content-center rounded-circle bg-secondary bg-opacity-10 text-white" style="width: 40px; height: 40px;">
                                <i class='bx bx-line-chart' ></i>
                            </div>
                            <div class="flex-grow-1">
                            <div class="d-flex justify-content-between">
                                <h6 class="fw-semibold mb-0">Changed the status from ‘New Lead’ to ‘Opportunity’ for Sarah Johnson</h6>
                                <small class="text-muted">3 days ago</small>
                            </div>
                            <div class="d-flex gap-4 small text-muted">
                                <span>by John Doe</span>
                            </div>
                            </div>
                        </div>
                        <hr style="margin: 0;">
                        <!-- Activity -->
                        <div class="d-flex gap-3">
                            <div class="d-flex align-items-center justify-content-center rounded-circle bg-dark bg-opacity-10 text-white" style="width: 40px; height: 40px;">
                                <i class='bx bx-user-pin' ></i>
                            </div>
                            <div class="flex-grow-1">
                            <div class="d-flex justify-content-between">
                                <h6 class="fw-semibold mb-0">Lead captured from website</h6>
                                <small class="text-muted">5 days ago</small>
                            </div>
                            <p class="text-muted small mb-1">Downloaded pricing guide from our website.</p>
                            <div class="d-flex gap-4 small text-muted">
                                <span>by System</span>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row mb-4">
    {{-- inquiry count month wise --}}

    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body px-0">
                <div id="inquiryChart"></div>
            </div>
        </div>
    </div>

    {{-- inquiry count source wise --}}

    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body ">
                <div id="inquirySourceChart"></div>
            </div>
        </div>
    </div>

</div>
<div class="row">
    {{-- lead count by team --}}

    <h5 class="mt-1">Leads Count By Team</h5>
    @foreach($users as $user)
    <div class="col-md-4 mt-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex mb-2 justify-content-center align-items-center flex-column">
                    <div class="avatar flex-shrink-0 ">
                        <span class="avatar-initial rounded bg-label-primary"><img
                                src="https://ui-avatars.com/api/?name={{ $user->name }}&&background=random&&rounded=true&&color=fff"
                                alt=""></span>
                    </div>
                    <div class="team-count w-100 justify-content-center">
                        <h5 class="mt-2">{{$user->name}}</h5>
                    </div>
                </div>
                <div class="fw-semibold team-count-small">
                    <span><b>Total Assigned : {{ $user->inquiries->count() }}</b> </span>
                    <span class="text-primary">New Lead : {{ $user->inquiries->where('lead_status','Lead')->count()
                        }}</span>
                    <span class="text-warning">Qualified Lead : {{ $user->inquiries->where('lead_status','Qualified
                        Lead')->count() }}</span>
                    <span class="text-success">Converted : {{
                        $user->inquiries->where('lead_status','Converted')->count() }}</span>
                    <span class="text-danger">AWOL : {{ $user->inquiries->where('lead_status','AWOL')->count() }}</span>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    $(document).ready(function () {
        let inquiryData = @json($chartDataForInquiry);
        var options = {
            series: [
                {
                    name: 'Total Inquiries',
                    data: inquiryData['all_lead_count'],
                },
                {
                    name: 'AWOL',
                    data: inquiryData['awol_counts']
                },
                {
                    name: 'Converted',
                    data: inquiryData['converted_counts']
                },
                {
                    name: 'New Lead',
                    data: inquiryData['new_lead_counts'],
                },
                {
                    name: 'Qualified Lead',
                    data: inquiryData['qualified_lead_counts']
                }

            ],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: false
                }
            },
            dataLabels: {
                enabled: true
            },
            stroke: {
                curve: 'straight'
            },
            title: {
                text: 'Inquiries Count Month Wise',
                align: 'left'

            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: inquiryData['months'],
            }
        };

        var chart = new ApexCharts(document.querySelector("#inquiryChart"), options);
        chart.render();
        chart.toggleSeries('AWOL');
        chart.toggleSeries('Converted');
        chart.toggleSeries('New Lead');
        chart.toggleSeries('Qualified Lead');


        // inquiry count source wise chart

        let inquirySourceData = @json($inquiryCountBySource);
        var options = {
            series: [{
                name: 'Inquiries',
                data: inquirySourceData['counts']
            }],
            chart: {
                height: 350,
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    borderRadius: 10,
                    dataLabels: {
                        position: 'top',
                    },
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    let percentage = (val / inquirySourceData.counts.reduce((a, b) => a + b, 0)) * 100;
                    return percentage.toFixed(2) + "%";
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#304758"]
                }
            },

            xaxis: {
                categories: inquirySourceData['lead_source'],
                position: 'top',
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                crosshairs: {
                    fill: {
                        type: 'gradient',
                        gradient: {
                            colorFrom: '#BED1E6',
                            colorTo: '#BED1E6',
                            stops: [0, 100],
                            opacityFrom: 0.4,
                            opacityTo: 0.5,
                        }
                    }
                },
                tooltip: {
                    enabled: true,
                },
            },
            yaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: true,
                },
                labels: {
                    show: true,
                    formatter: function (val) {
                        return val;
                    }
                },

            },
            title: {
                text: 'Inquiries Count Source Wise',
                floating: true,
                offsetY: 330,
                align: 'center',
                style: {
                    color: '#444'
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#inquirySourceChart"), options);
        chart.render();


    });
</script>
@endsection