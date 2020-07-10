@extends('front.layouts.frontlayout')

@section('mainarea')
    <div class="col-md-9">
        <!--Profile Body-->
        <div class="profile-body">
            <div class="row margin-bottom-20">
                <!--Profile Post-->
                <div class="col-sm-6">
                    <div class="panel panel-profile no-bg">
                        <div class="panel-heading overflow-h">
                            <h2 class="panel-title heading-sm pull-left"><i class="fa fa-pencil"></i>Personal Details
                            </h2>
                        </div>
                        <div class="panel-body panelHolder">
                            <table class="table table-light margin-bottom-0">
                                <tbody>
                                <tr>
                                    <td>
                                        <span class="primary-link">Name</span>
                                    </td>
                                    <td>
                                        {{$employee->fullName}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="primary-link">Father's Name</span>
                                    </td>
                                    <td>
                                        {{$employee->fatherName}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="primary-link">DOB</span>
                                    </td>
                                    <td>
                                        {{ date('d-M-Y',strtotime($employee->date_of_birth))}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="primary-link">Gender</span>
                                    </td>
                                    <td>
                                        {{ucfirst($employee->gender)}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="primary-link">Email</span>
                                    </td>
                                    <td>
                                        {{$employee->email}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="primary-link">Phone</span>
                                    </td>
                                    <td>
                                        {{$employee->mobileNumber}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="primary-link">Local Address</span>
                                    </td>
                                    <td>
                                        {{$employee->localAddress}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="primary-link">Permanent Address</span>
                                    </td>
                                    <td>
                                        {{$employee->permanentAddress}}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="panel panel-profile no-bg margin-top-20">
                        <div class="panel-heading overflow-h">
                            <h2 class="panel-title heading-sm pull-left"><i class="fa fa-briefcase"></i>Company Details
                            </h2>
                        </div>
                        <div class="panel-body panelHolder">
                            <table class="table table-light margin-bottom-0">
                                <tbody>
                                <tr>
                                    <td>
                                        <span class="primary-link">Employee ID</span>
                                    </td>
                                    <td>
                                        {{$employee->employeeID}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="primary-link">Department</span>
                                    </td>
                                    <td>
                                        {{$employee->getDesignation->department->deptName}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="primary-link">Designation</span>
                                    </td>
                                    <td>
                                        {{$employee->getDesignation->designation}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="primary-link">Date of Joining</span>
                                    </td>
                                    <td>
                                        {{date('d-M-Y',strtotime($employee->joiningDate))}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="primary-link">Salary ( <i
                                                    class="fa {{$setting->currency_icon}}"></i> )</span>
                                    </td>
                                    <td>

                                        @foreach($employee->getSalary as $salary)
                                            <p>{{$salary->type}} : {{$salary->salary}} <i
                                                        class="fa {{$setting->currency_icon}}"></i></p>
                                        @endforeach


                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="panel panel-profile no-bg margin-top-20">
                        <div class="panel-heading overflow-h">
                            <h2 class="panel-title heading-sm pull-left"><i class="fa fa-pencil"></i>Bank Details</h2>
                        </div>
                        <div class="panel-body panelHolder">
                            <table class="table table-light margin-bottom-0">
                                <tbody>
                                <tr>
                                    <td>
                                        <span class="primary-link">Account Holder Name</span>
                                    </td>
                                    <td>
                                        {{$employee->getBankDetail->accountName ?? ''}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="primary-link">Account Number</span>
                                    </td>
                                    <td>
                                        {{$employee->getBankDetail->accountNumber ?? ''}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="primary-link">Bank Name</span>
                                    </td>
                                    <td>
                                        {{$employee->getBankDetail->bank ?? ''}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="primary-link">PAN Number</span>
                                    </td>
                                    <td>
                                        {{$employee->getBankDetail->pan ?? ''}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="primary-link">IFSC Code</span>
                                    </td>
                                    <td>
                                        {{$employee->getBankDetail->ifsc ?? ''}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="primary-link">Branch</span>
                                    </td>
                                    <td>
                                        {{$employee->getBankDetail->branch ?? ''}}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--End Profile Post-->

                <!--Notice Board -->
                <div class="col-sm-6 md-margin-bottom-20">
                    <div class="panel panel-profile no-bg">
                        <div class="panel-heading overflow-h">
                            <h2 class="panel-title heading-sm pull-left"><i class="fa fa-bullhorn"></i>Notice Board</h2>
                        </div>
                        <div id="scrollbar2" class="panel-body contentHolder">
                            @if(count($noticeboards))
                                @foreach($noticeboards as $notice)
                                    <div class="profile-event">
                                        <div class="date-formats">
                                            <span>{{date('d',strtotime($notice->created_at))}}</span>
                                            <small>{{date('m, Y',strtotime($notice->created_at))}}</small>
                                        </div>
                                        <div class="overflow-h">
                                            <h3 class="heading-xs" onclick="showNotice({{$notice->id}});return false;">
                                                <a href="javascript:;">{{$notice->title}}</a></h3>
                                            <p>{!! \Illuminate\Support\Str::words($notice->description, 100,'....')  !!}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                    </div>

                    <div class="panel panel-profile margin-top-20">
                        <div class="panel-heading overflow-h">
                            <h2 class="panel-title heading-sm pull-left"><i class="fa fa-send"></i> Upcoming Holidays
                            </h2>
                        </div>
                        <div id="scrollbar3" class="panel-body contentHolder">

                            @forelse($holidays as $holiday)
                                {{--Check for upcoming Holidays--}}

                                <div class="alert-blocks alert-blocks-{{$holiday_color[$holiday->id%count($holiday_color)]}}">
                                    <div class="overflow-h">
                                        <strong class="color-{{$holiday_font_color[$holiday->id%count($holiday_font_color)]}}">{{$holiday->occassion}}
                                            <small class="pull-right">
                                                <em>{{date('d M Y',strtotime($holiday->date))}}</em></small>
                                        </strong>
                                    </div>
                                </div>
                            @empty
                                    <div class="text-center" style="padding: 100px;">

                                           No Holiday
                                    </div>
                            @endforelse

                        </div>
                    </div>

                    <div class="panel panel-profile margin-top-20">
                        <div class="panel-heading overflow-h">
                            <h2 class="panel-title heading-sm pull-left"><i class="fa fa-trophy"></i> Awards</h2>
                        </div>
                        <div id="scrollbar3" class="panel-body contentHolder">

                            @foreach($userAwards as $award)
                                <div class="alert-blocks award-list" onclick="showAwardDetails({{$award->id}});return false;">
                                    <div class="overflow-h">
                                        <strong class="color-dark">
                                            <small class="pull-right">
                                                <em>{{ucfirst($award->forMonth)}} {{$award->forYear}}</em></small>
                                        </strong>
                                        <small class="award-name">{{$award->awardName}}</small>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>
                <!--End Profile Event-->

            </div><!--/end row-->

            <hr>

            <!--Profile Blog-->
            <div class="panel panel-profile">
                <div class="panel-heading overflow-h">
                    <h2 class="panel-title heading-sm pull-left"><i class="fa fa-tasks"></i>Attendance</h2>
                </div>
                <div class="panel-body panelHolder">

                    <div class="alert-blocks alert-blocks-info">
                        <div class="overflow-h">
                            <strong class="color-dark">Last absent
                                <small class="pull-right">
                                    <em>{{$employee->lastAbsent($employee->employeeID,'date')}}</em></small>
                            </strong>
                            <small class="award-name">{{$employee->lastAbsent($employee->employeeID)}}</small>
                        </div>
                    </div>

                    <div id='calendar'></div>

                </div>
            </div><!--/end row-->
            <!--End Profile Blog-->

        </div>
        <!--End Profile Body-->
    </div>


    {{--------------------------Show Notice MODALS-----------------}}




    <div class="modal fade show_notice in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myLargeModalLabel" class="modal-title show-notice-title">
                        {{--Notice Title using Javascript--}}
                    </h4>
                </div>
                <div class="modal-body" id="show-notice-body">
                    {{--Notice full Description using Javascript--}}
                </div>
            </div>
        </div>
    </div>



    {{------------------------END Notice MODALS---------------------}}
@endsection

@section('footerjs')
    <script>
        $(document).ready(function () {

            $('#calendar').fullCalendar({
                //			defaultDate: '2014-11-12',
                editable: false,
                eventLimit: true, // allow "more" link when too many events
                eventRender: function (event, element) {
                    if (event.className == "holiday") {
                        var dataToFind = moment(event.start).format('YYYY-MM-DD');
                        $('.fc-day[data-date="' + dataToFind + '"]').css('background', 'rgba(255, 224, 205, 1)');
                    }
                },
                events: [

                        {{-- Attendance on calendar --}}
                        @foreach($attendance as $attend)
                    {

                        title: "{{$attend->status}}",
                        start: '{{$attend->date}}',

                        @if($attend->status=='absent')
                        color: '#e50000',
                        title: "{{$attend->status}}-{{$attend->leaveType}}",
                        @endif


                    },
                        @endforeach

                        {{--Holidays on Calendar--}}
                        @foreach($holidays as $holiday)
                    {
                        className: "holiday",
                        title: "{{$holiday->occassion}}",
                        start: '{{$holiday->date}}',
                        color: 'grey'

                    },
                    @endforeach
                ]
            });
        });
    </script>
@endsection


