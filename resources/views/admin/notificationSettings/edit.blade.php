@extends('admin.adminlayouts.adminlayout')



@section('mainarea')


    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">
        {{$pageTitle}}
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="{{route('admin.dashboard.index')}}">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>

            <li>
                <a href=""> Email Setting</a>
            </li>
        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div id="load">

                {{--INLCUDE ERROR MESSAGE BOX--}}
                @include('admin.common.error')
                {{--END ERROR MESSAGE BOX--}}


            </div>
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cog"></i>Email Notifications
                    </div>
                    <div class="tools">
                    </div>
                </div>

                <div class="portlet-body form">

                    <!------------------------ BEGIN FORM ---------------------->
                    {!!  Form::model($setting, ['method' => 'PUT','id' => 'notificationSettings_form', 'class'=>'form-horizontal form-bordered'])  !!}
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Award : </label>
                            <div class="col-md-6">
                                <input type="checkbox" value="1" class="make-switch" name="award_notification"
                                       @if($setting->award_notification==1)checked @endif data-on-color="success"
                                       data-on-text="Yes" data-off-text="No" data-off-color="danger">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Attendance Marked:</label>
                            <div class="col-md-6">
                                <input type="checkbox" value="1" class="make-switch" name="attendance_notification"
                                       @if($setting->attendance_notification==1)checked @endif data-on-color="success"
                                       data-on-text="Yes" data-off-text="No" data-off-color="danger">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Notice Board:</label>
                            <div class="col-md-6">
                                <input type="checkbox" value="1" class="make-switch" name="notice_notification"
                                       @if($setting->notice_notification==1)checked @endif data-on-color="success"
                                       data-on-text="Yes" data-off-text="No" data-off-color="danger">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-2 control-label">Leave Application:</label>
                            <div class="col-md-6">
                                <input type="checkbox" value="1" class="make-switch" name="leave_notification"
                                       @if($setting->leave_notification==1)checked @endif data-on-color="success"
                                       data-on-text="Yes" data-off-text="No" data-off-color="danger">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Employee Add:</label>
                            <div class="col-md-6">
                                <input type="checkbox" value="1" class="make-switch" name="employee_add"
                                       @if($setting->employee_add==1)checked @endif data-on-color="success"
                                       data-on-text="Yes" data-off-text="No" data-off-color="danger">
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="button" onclick="updateNotification({{$setting->id}});"
                                            class="btn green"><i class="fa fa-check"></i> Submit
                                    </button>

                                </div>
                            </div>
                        </div>
                    {!!  Form::close()  !!}
                    <!------------------------- END FORM ----------------------->

                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->

            </div>

        </div>
        <!-- END PAGE CONTENT-->


    @stop

    @section('footerjs')

        <!-- BEGIN PAGE LEVEL PLUGINS -->
            {!!  HTML::script("assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js")  !!}
            {!!  HTML::script('assets/global/plugins/bootstrap-select/bootstrap-select.min.js')  !!}
            {!!  HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js") !!}
            {!!  HTML::script('assets/global/plugins/select2/select2.min.js')  !!}
            {!!  HTML::script('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js')  !!}
            {!!  HTML::script('assets/admin/pages/scripts/components-dropdowns.js')  !!}



            <script>
                jQuery(document).ready(function () {
                    ComponentsDropdowns.init();
                });

                function updateNotification(id) {
                    var url = "{{ route('admin.notificationSettings.update',':id') }}";
                    url = url.replace(':id', id);
                    $.easyAjax({
                        type: 'POST',
                        url: url,
                        container: '#notificationSettings_form',
                        data: $('#notificationSettings_form').serialize(),
                    });
                }
            </script>
            <!-- END PAGE LEVEL PLUGINS -->
@stop