@extends('admin.adminlayouts.adminlayout')

@section('head')


    <!-- BEGIN PAGE LEVEL STYLES -->
    {!! HTML::style("assets/global/plugins/bootstrap-datepicker/css/datepicker3.css") !!}
    {!! HTML::style("assets/global/plugins/select2/select2.css") !!}

    <!-- END PAGE LEVEL STYLES -->

@stop


@section('mainarea')

    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">
        {{$pageTitle}}
        <small>Holidays List</small>
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="{{route('admin.dashboard.index')}}">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Holidays</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Holidays list of {{ \Illuminate\Support\Carbon::now()->format('Y') }} </a>
            </li>
        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->

    <div id="load">
        {{--INLCUDE ERROR MESSAGE BOX--}}
        @include('admin.common.error')
        {{--END ERROR MESSAGE BOX--}}
    </div>


    <div class="row">
        <div class="col-md-3"><a class="btn green" onclick="showAdd()">
                Add Holidays
                <i class="fa fa-plus"></i> </a></div>
        <div class="col-md-offset-6 col-md-3 ">
            @if($number_of_sundays>$holidays_in_db)
                <a class="btn green" href="javascript:;" onclick="markFriday();">
                    Mark All Friday Holiday
                    <i class="fa fa-check"></i> </a>
            @endif

        </div>

    </div>
    <form id='preassigned_form'>
        <div class="row" style="margin-top: 20px">
            <div class="col-md-3">
                <div class="form-group">
                    <select class="form-control select2" id="kt_select2_1" name="emp_id">
                        <option value="0">Give all</option>
                        @foreach($employees as $employee)
                        <option value="{{$employee->id}}">{{$employee->fullName}}</option>
                        @endforeach
                    </select>
                </div>
            </div>                                        
            <div class="col-md-3">
                <input class="form-control form-control-inline input-medium" name="preassigned" type="number" placeholder="preassigned-holidays">
            </div>
            <div class="col-md-3 pull-right">
                <a href="javascript:;" onclick="preassigned()" class="btn green">submit</a>
            </div>
        </div>
    </form>
    <hr>
    <div class="row">
        <div class="col-md-3">
            <ul class="ver-inline-menu tabbable margin-bottom-10">
                @foreach($months as $month)
                    <li @if($month == $currentMonth) class="active" @endif >
                        <a data-toggle="tab" href="#{{ $month }}">
                            <i class="fa fa-calendar"></i> {{ $month }} </a>
                        <span class="after">
                                    </span>
                    </li>
                @endforeach

            </ul>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                @foreach($months as $month)
                    <div id="{{$month}}" class="tab-pane @if($month == $currentMonth) active @endif">
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-calendar"></i>{{$month}}
                                </div>

                            </div>
                            <div class="portlet-body">
                                <div class="table-scrollable">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th> #</th>
                                            <th> Date</th>
                                            <th> Occasion</th>
                                            <th> Day</th>
                                            <th> Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($holidaysArray[$month]))

                                            @for($i=0;$i<count($holidaysArray[$month]['date']);$i++)

                                                <tr id="row{{ $holidaysArray[$month]['id'][$i] }}">
                                                    <td> {{($i+1)}} </td>
                                                    <td> {{ $holidaysArray[$month]['date'][$i] }} </td>
                                                    <td> {{ $holidaysArray[$month]['ocassion'][$i] }} </td>
                                                    <td> {{ $holidaysArray[$month]['day'][$i] }} </td>
                                                    <td>
                                                        <button type="button"
                                                                onclick="del('{{ $holidaysArray[$month]['id'][$i] }}',' {{ $holidaysArray[$month]['date'][$i] }}')"
                                                                href="#" class="btn btn-xs red">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endfor
                                        @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->

    {{--Add Holidays MODALS--}}


    {{--Add Holidays MODALS--}}

    {{--DELETE MODAL CALLING--}}
    @include('admin.include.delete-modal')
    @include('include.show-modal')
    {{--DELETE MODAL CALLING END--}}

@stop

@section('footerjs')

    {{--Page Level JS--}}
    {!! HTML::script("assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js") !!}
    {!! HTML::script("assets/admin/pages/scripts/components-pickers.js") !!}
    {!! HTML::script("assets/global/plugins/select2/select2.js") !!}
    {{--Page Level js end--}}
    <script>
        jQuery(document).ready(function () {

            ComponentsPickers.init();

        });

        // Javascript function to update the company info and Bank Info
        function storeHolidays() {

            var url = "{{ route('admin.holidays.store') }}";
            $.easyAjax({
                type: 'POST',
                url: url,
                container: '#add_holiday_form',
                data: $('#add_holiday_form').serialize(),
                success: function () {
                    $('#showModal').modal('hide');
                    location.reload(true);
                }
            });
        }
        //Javascript function to pre-assign holiday
        function preassigned() {
            var url = "{{ route('admin.holidays.preassign') }}";
            $.easyAjax({
                type: 'POST',
                url: url,
                container: '#preassigned_form',
                data: $('#preassigned_form').serialize(),
                success: function () {
                    location.reload(true);
                }
            });
        }


        // Show Create Department Modal
        function showAdd() {
            var url = "{{ route('admin.holidays.create') }}";
            $.ajaxModal('#showModal', url);
        }

        // Show Delete Modal
        function del(id, date) {

            $('#deleteModal').modal('show');

            $("#deleteModal").find('#info').html('Are you sure ! You want to delete <strong>' + date + '</strong> ?');

            $('#deleteModal').find("#delete").off().click(function () {

                var url = "{{ route('admin.holidays.destroy',':id') }}";
                url = url.replace(':id', id);

                var token = "{{ csrf_token() }}";

                $.easyAjax({
                    type: 'DELETE',
                    url: url,
                    data: {'_token': token},
                    container: "#deleteModal",
                    success: function (response) {
                        if (response.status == "success") {
                            $('#deleteModal').modal('hide');
                            $("html, body").animate({scrollTop: 0}, "slow");
                            $('#row' + id).fadeOut(500);
                            //location.reload(true);
                            // TODO: table reload fnDraw
//							table.dataTable.fnDraw();
                        }
                    }
                });

            });
        }

        function markFriday() {
            $.easyAjax({
                type: 'GET',
                url: "{{ URL::to('admin/holidays/mark_friday ')}}",
                data: {},
            });
        }
    </script>
@stop
