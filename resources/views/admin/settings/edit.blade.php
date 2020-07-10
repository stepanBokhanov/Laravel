@extends('admin.adminlayouts.adminlayout')

@section('head')

    <!-- BEGIN PAGE LEVEL STYLES -->
    {!!  HTML::style("assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css")  !!}
    {!!  HTML::style("assets/global/plugins/bootstrap-select/bootstrap-select.min.css")  !!}
    {!!  HTML::style("assets/global/plugins/select2/select2.css")  !!}
    {!!  HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css")  !!}

    <!-- BEGIN THEME STYLES -->
@stop


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
                <a href="{{ route('admin.settings.edit','setting') }}">Settings</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href=""> Setting</a>
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
                        <i class="fa fa-cogs"></i>Edit {{$pageTitle}}
                    </div>
                    <div class="tools">
                    </div>
                </div>

                <div class="portlet-body form">

                    <!------------------------ BEGIN FORM---------------------->
                    {!!  Form::model($setting, ['method' => 'PUT','files' => true,'class'=>'form-horizontal form-bordered' , 'id' => 'edit_setting_form'])  !!}

                    <div class="form-body">

                        <div class="form-group">
                            <label class="control-label col-md-2">Website Logo</label>
                            <div class="col-md-6">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">

                                        <img src="{{$setting->getLogoImageAttribute()}}" height="30px" width="117px"/>

                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"
                                         style="max-width: 200px; max-height: 150px;">
                                    </div>
                                    <div>
                                                       <span class="btn default btn-file">
                                                       <span class="fileinput-new">
                                                       Change image </span>
                                                       <span class="fileinput-exists">
                                                       Change </span>
                                                       <input type="file" name="logo">
                                                       </span>
                                        <a href="#" class="btn btn-sm red fileinput-exists" data-dismiss="fileinput">
                                            Remove </a>
                                    </div>
                                </div>
                                <div class="clearfix margin-top-10">
                                                        <span class="label label-danger">
                                                        NOTE! </span> Image Size must be 117px x 30px

                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Website: <span class="required">
                                        * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="website" placeholder="Website Title"
                                       value="{{ $setting->website }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Email: <span class="required">
                                            * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="email" placeholder="Email"
                                       value="{{ $setting->email}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Name: <span class="required">  * </span></label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" placeholder="Name"
                                       value="{{ $setting->name}}">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-2">Currency</label>
                            <div class="col-md-6">
                                <select class="bs-select form-control" data-show-subtext="true" name="currency">
                                    <option data-icon="fa-inr" value="fa-inr:INR"
                                            @if($setting->currency=='INR') selected @endif>INR
                                    </option>
                                    <option data-icon="fa-usd" value="fa-usd:USD"
                                            @if($setting->currency=='USD') selected @endif>USD
                                    </option>
                                    <option data-icon="fa-euro" value="fa-euro:EURO"
                                            @if($setting->currency=='EURO') selected @endif >EURO
                                    </option>
                                    <option data-icon="fa-gbp" value="fa-gbp:GBP"
                                            @if($setting->currency=='GBP') selected @endif>GBP
                                    </option>
                                    <option data-icon="fa-jpy" value="fa-jpy:JPY"
                                            @if($setting->currency=='JPY') selected @endif >JPY
                                    </option>
                                    <option data-icon="fa-yen" value="fa-yen:YEN"
                                            @if($setting->currency=='YEN') selected @endif>YEN
                                    </option>
                                    <option data-icon="fa-won" value="fa-won:WON"
                                            @if($setting->currency=='WON') selected @endif>WON
                                    </option>
                                    <option data-icon="fa-try" value="fa-try:TRY"
                                            @if($setting->currency=='TRY') selected @endif>TRY
                                    </option>
                                    <option data-icon="fa-rub" value="fa-yen:YEN"
                                            @if($setting->currency=='RUB') selected @endif>RUB
                                    </option>
                                    <option data-icon="fa-rmb" value="fa-rmb:RMB"
                                            @if($setting->currency=='RMB') selected @endif>RMB
                                    </option>
                                    <option data-icon="fa-krw" value="fa-krw:KRW"
                                            @if($setting->currency=='KRW') selected @endif>KRW
                                    </option>
                                    <option data-icon="fa-btc" value="fa-btc:BTC"
                                            @if($setting->currency=='BTC') selected @endif>BTC
                                    </option>
                                    <option data-icon="fa-xof" value="fa-xof:XOF"
                                            @if($setting->currency=='XOF') selected @endif>XOF
                                    </option>
                                    <option data-icon="fa-myr" value="fa-myr:MYR"
                                            @if($setting->currency=='MYR') selected @endif>MYR
                                    </option>
                                    <option data-icon="fa-pkr" value="fa-pkr:PKR"
                                            @if($setting->currency=='PKR') selected @endif>PKR
                                    </option>

                                </select>
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="button" onclick="updateSetting({{$setting->id}})"
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

            {!!  HTML::script('assets/global/plugins/select2/select2.min.js')  !!}
            {!!  HTML::script('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js')  !!}
            {!!  HTML::script('assets/admin/pages/scripts/components-dropdowns.js')  !!}



            <script>
                jQuery(document).ready(function () {

                    ComponentsDropdowns.init();
                });

                function updateSetting(id) {

                    var url = "{{ route('admin.settings.update',':id') }}";
                    url = url.replace(':id', id);
                    $.easyAjax({
                        type: 'POST',
                        url: url,
                        container: '#edit_setting_form',
                        file: true
                    });
                }
            </script>
            <!-- END PAGE LEVEL PLUGINS -->
@stop