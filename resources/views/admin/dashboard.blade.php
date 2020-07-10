@extends('admin.adminlayouts.adminlayout')

@section('head')

    <!-- BEGIN PAGE LEVEL STYLES -->
    {!! HTML::style("assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css") !!}
    {!! HTML::style("assets/global/plugins/select2/select2.css") !!}
    {!! HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css") !!}
    {!! HTML::style("assets/global/plugins/fullcalendar/fullcalendar.min.css") !!}
    <!-- BEGIN THEME STYLES -->

@stop
@section('mainarea')



    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">
        Dashboard
        <small>reports & statistics</small>
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="{{route('admin.dashboard.index')}}">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Dashboard</a>
            </li>
        </ul>

    </div>
    <!-- END PAGE HEADER-->


    @php($updateVersionInfo = \Froiden\Envato\Functions\EnvatoUpdate::updateVersionInfo())
    @if(isset($updateVersionInfo['lastVersion']))
        <div class="note note-info row">
            <div class="col-md-10"><i class="fa fa-gift"></i> @lang('core.newUpdate') <label
                    class="label label-success">{{ $updateVersionInfo['lastVersion'] }}</label></div>
            <div class="col-md-2">
                <a href="{{route('admin.updateVersion.index')}}"
                   class="btn btn-success btn-small">@lang('core.updateNow')
                    <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>

    @endif


    {{--calender--}}
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue calendar">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>{!! Lang::get('core.attendance') !!}
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">

                        <div class="col-md-9 col-sm-12">
                            <div id="calendar" class="has-toolbar">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <p>
                            <h3><a href="#" class="btn btn-sm red"></a> {!! Lang::get('core.absent') !!}</h3></p>
                            <p>
                            <h3><a href="#" class="btn btn-sm blue"></a> {!! Lang::get('core.present') !!}</h3></p>

                        </div>
                    </div>
                    <!-- END CALENDAR PORTLET-->
                </div>
            </div>
        </div>

    </div>


    <!-- BEGIN DASHBOARD STATS -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        Expense Report
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="expenseChart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                </div>
            </div>

        </div>
    </div>
        <div class="modal fade bs-modal-md in" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModal"
             aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Do you like HRM? Help us Grow :)</h4>

                    </div>
                    <div class="modal-body">
                        <div class="note note-info font-14 m-l-5">

                            We hope you love it. If you do, would you mind taking 10 seconds to leave me a short review on codecanyon?
                            <br>
                            This helps us to continue providing great products, and helps potential buyers to make confident decisions.
                            <hr>
                            Thank you in advance for your review and for being a preferred customer.

                            <hr>

                            <p class="text-center">
                                <a href="{{\Froiden\Envato\Functions\EnvatoUpdate::reviewUrl()}}"> <img src="{{asset('assets/global/img/hrm-review.png')}}" alt=""></a>
                                <button type="button" class="btn btn-link" data-dismiss="modal" onclick="hideReviewModal('closed_permanently_button_pressed')">Hide Pop up permanently</button>
                                <button type="button" class="btn btn-link" data-dismiss="modal" onclick="hideReviewModal('already_reviewed_button_pressed')">Already Reviewed</button>
                            </p>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{\Froiden\Envato\Functions\EnvatoUpdate::reviewUrl()}}" target="_blank" type="button" class="btn btn-success">Give Review</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END DASHBOARD STATS -->
    @endsection

    @section('footerjs')


        <!-- BEGIN PAGE LEVEL PLUGINS -->
            {!! HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js") !!}
            {!! HTML::script("assets/global/plugins/bootstrap-select/bootstrap-select.min.js") !!}
            {!! HTML::script("assets/global/plugins/select2/select2.min.js") !!}

            {!! HTML::script("assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js") !!}
            {!! HTML::script("assets/admin/pages/scripts/components-dropdowns.js") !!}


            {!! HTML::script('assets/admin/pages/scripts/ui-blockui.js') !!}
            {!! HTML::script("assets/global/plugins/moment.min.js") !!}
            {!! HTML::script("assets/global/plugins/fullcalendar/fullcalendar.min.js") !!}
            <script src="https://code.highcharts.com/highcharts.js"></script>
            <script src="https://code.highcharts.com/modules/exporting.js"></script>



            <script>
                jQuery(document).ready(function () {
                    Calendar.init();
                    UIBlockUI.init();
                    ComponentsDropdowns.init();
                });

                var Calendar = function () {

                    return {
                        //main function to initiate the module
                        init: function () {
                            Calendar.initCalendar();
                        },

                        initCalendar: function () {

                            if (!jQuery().fullCalendar) {
                                return;
                            }

                            var date = new Date();
                            var d = date.getDate();
                            var m = date.getMonth();
                            var y = date.getFullYear();

                            var h = {};


                            if ($('#calendar').parents(".portlet").width() <= 720) {
                                $('#calendar').addClass("mobile");
                                h = {
                                    left: 'title, prev, next',
                                    center: '',
                                    right: 'today,month'
                                };
                            } else {
                                $('#calendar').removeClass("mobile");
                                h = {
                                    left: 'title',
                                    center: '',
                                    right: 'prev,next,today'
                                };
                            }

                            $('#calendar').fullCalendar('destroy'); // destroy the calendar
                            $('#calendar').fullCalendar({ //re-initialize the calendar
                                header: h,
                                defaultView: 'month',
                                eventRender: function (event, element) {
                                    if (event.className == "holiday") {
                                        var dataToFind = moment(event.start).format('YYYY-MM-DD');
                                        $('.fc-day[data-date="' + dataToFind + '"]').css('background', 'rgba(255, 224, 205, 1)');
                                    }
                                },
                                events: [
                                        {{--Holidays on Calendar--}}
                                        @foreach($holidays as $holiday)
                                    {
                                        className: "holiday",
                                        title: "{{$holiday->occassion}}",
                                        start: '{{$holiday->date}}',

                                        color: 'grey'

                                    },

                                        @endforeach
                                        {{-- Attandance on calendar --}}
                                        @foreach($attendance as $index=>$attend)

                                        @if($attend[0]!='all present')
                                            @foreach($attend as $em)
                                            {
                                                title: "Name: {{\Illuminate\Support\Str::words($em['fullName'],1,'')}}\n Type: {{ $em['type'] }}",
                                                start: '{{$index}}',
                                                color: '#e50000'

                                            },
                                            @endforeach
                                            @else
                                            {
                                                title: 'all present',
                                                start: '{{$index}}'

                                            },
                                        @endif

                                    @endforeach

                                ]
                            });
                        }
                    };
                }();

                $(function () {

                    $('#expenseChart').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Monthly Expense Report ' + new Date().getFullYear()
                        },
                        xAxis: {
                            categories: [
                                'Jan',
                                'Feb',
                                'Mar',
                                'Apr',
                                'May',
                                'Jun',
                                'Jul',
                                'Aug',
                                'Sep',
                                'Oct',
                                'Nov',
                                'Dec'
                            ],
                            crosshair: true
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                useHTML: true,
                                text: 'Expense in ( <span class="fa {!! $setting->currency_icon !!}"></span> )'
                            }
                        },
                        tooltip: {
                            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                '<td style="padding:0"><b>{point.y:.1f} <span class="fa {!! $setting->currency_icon !!}"></span></b></td></tr>',
                            footerFormat: '</table>',
                            shared: true,
                            useHTML: true
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series: [{
                            name: 'Expense',
                            data: [{!!$expense!!}]

                        }]
                    });
                });
            </script>

            <!-- END PAGE LEVEL PLUGINS -->
        <script>
            @if(\Froiden\Envato\Functions\EnvatoUpdate::showReview())
            $(document).ready(function () {
                $('#reviewModal').modal('show');
            })
            function hideReviewModal(type) {
                var url = "{{ route('hide-review-modal',':type') }}";
                url = url.replace(':type', type);

                $.easyAjax({
                    url: url,
                    type: "GET",
                    container: "#reviewModal",
                });
            }
            @endif
        </script>
@endsection
