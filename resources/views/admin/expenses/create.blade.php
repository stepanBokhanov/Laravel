@extends('admin.adminlayouts.adminlayout')

@section('head')
    <!-- BEGIN PAGE LEVEL STYLES -->
    {!!  HTML::style("assets/global/plugins/bootstrap-datepicker/css/datepicker3.css")  !!}
    {!!  HTML::style("assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css")  !!}
    <!-- BEGIN THEME STYLES -->
@stop


@section('mainarea')


    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">
        {{$pageTitle}} Add page
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="{{route('admin.dashboard.index')}}">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="{{ route('admin.expenses.index') }}">expenses</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="">Add Item</a>
            </li>
        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            {{--INLCUDE ERROR MESSAGE BOX--}}
            @include('admin.common.error')
            {{--END ERROR MESSAGE BOX--}}


            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-plus"></i>Add New item
                    </div>
                    <div class="tools">
                    </div>
                </div>

                <div class="portlet-body form">

                    <!-- BEGIN FORM-->
                    {!! Form::open(array('class'=>'form-horizontal form-bordered','method'=>'POST','files'=>true, 'id' => 'expenses_store_form')) !!}


                    <div class="form-body">

                        <div class="form-group">
                            <label class="col-md-2 control-label">Item Name: <span class="required">
                                        * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="itemName" placeholder="Item Name"
                                       value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Purchase From:
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="purchaseFrom" placeholder="Purchase From"
                                       value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Purchase Date:
                            </label>
                            <div class="col-md-6">
                                <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy"
                                     data-date-viewmode="years">
                                    <input type="text" class="form-control" name="purchaseDate" readonly>
                                    <span class="input-group-btn">
                                                                   <button class="btn default" type="button"><i
                                                                               class="fa fa-calendar"></i></button>
                                                                   </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Amount price:<span class="required">  * </span> <span
                                        class="fa {{$setting->currency_icon}}"></span></label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="price" placeholder="Price of Item"
                                       value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Attach Bill:</label>

                            <div class="col-md-6">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="input-group input-large">
                                        <div class="form-control uneditable-input" data-trigger="fileinput">
                                            <i class="fa fa-file fileinput-exists"></i>&nbsp; <span
                                                    class="fileinput-filename">
                                                                               </span>
                                        </div>
                                        <span class="input-group-addon btn default btn-file">
                                                                           <span class="fileinput-new">
                                                                           Select file </span>
                                                                           <span class="fileinput-exists">
                                                                           Change </span>
                                                                           <input type="file" name="bill">
                                                                           </span>
                                        <a href="#" class="input-group-addon btn btn-sm red fileinput-exists"
                                           data-dismiss="fileinput">
                                            Remove </a>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="button" onclick="storeExpenses();return false;" class="btn green"><i
                                                class="fa fa-check"></i> Submit
                                    </button>

                                </div>
                            </div>
                        </div>
                    {!!  Form::close()  !!}
                    <!-- END FORM-->

                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->

            </div>
        </div>
        <!-- END PAGE CONTENT-->


    @stop

    @section('footerjs')

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        {!!  HTML::script("assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js")  !!}
        {!!  HTML::script("assets/admin/pages/scripts/components-pickers.js")  !!}
        {!!  HTML::script("assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js")  !!}
        <!-- END PAGE LEVEL PLUGINS -->
            <script>
                jQuery(document).ready(function () {
                    ComponentsPickers.init();
                });

                // Javascript function to update the company info and Bank Info
                function storeExpenses() {
                    var url = "{{ route('admin.expenses.store') }}";
                    $.easyAjax({
                        type: 'POST',
                        url: url,
                        container: '#expenses_store_form',
                        file: true
                    });
                }
            </script>
@stop