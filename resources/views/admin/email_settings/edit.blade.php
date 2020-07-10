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
                        <i class="fa fa-cog"></i>Email Setting
                    </div>
                    <div class="tools">
                    </div>
                </div>

                <div class="portlet-body form">

                    <!------------------------ BEGIN FORM ---------------------->
                    {!!  Form::model($setting, ['method' => 'PUT','id' => 'email_form', 'class'=>'form-horizontal form-bordered'])  !!}
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Mail Driver : </label>
                            <div class="col-md-6">
                                <select class="form-control" name="mail_driver" id="mail_driver">
                                    <option value="mail" @if($setting->mail_driver=='mail')selected @endif>mail</option>
                                    <option value="smtp" @if($setting->mail_driver=='smtp')selected @endif>smtp</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Mail host : </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="mail_host"
                                       value="{{$setting->mail_host}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Mail Port : </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="mail_port"
                                       value="{{$setting->mail_port}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Mail Username : </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="mail_username"
                                       value="{{$setting->mail_username}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Mail Password : </label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="mail_password"
                                       value="{{$setting->mail_password}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Mail Encryption : </label>
                            <div class="col-md-6">
                                <select class="form-control" name="mail_encryption" id="mail_encryption">
                                    <option value="tls" @if($setting->mail_encryption=='tls')selected @endif>tls
                                    </option>
                                    <option value="ssl" @if($setting->mail_encryption=='ssl')selected @endif>ssl
                                    </option>
                                </select>
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

            <script>


                function updateNotification(id) {
                    var url = "{{ route('admin.email_settings.update',':id') }}";
                    url = url.replace(':id', id);
                    $.easyAjax({
                        type: 'POST',
                        url: url,
                        container: '#email_form',
                        data: $('#email_form').serialize(),
                    });
                }
            </script>
            <!-- END PAGE LEVEL PLUGINS -->
@stop