@extends('admin.adminlayouts.adminlayout')

@section('head')
    <!-- BEGIN PAGE LEVEL STYLES -->
    {!! HTML::style("assets/global/plugins/bootstrap-select/bootstrap-select.min.css") !!}
    {!! HTML::style("assets/global/plugins/select2/select2.css") !!}
    {!! HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css") !!}

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
						<a href="{{ route('admin.noticeboards.index') }}">Notice</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="">New Notice</a>
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
								<i class="fa fa-plus"></i>New Notice
							</div>
							<div class="tools">
							</div>
						</div>

						<div class="portlet-body form">

						<!-- BEGIN FORM-->
						{!! Form::open(array('id'=>'notice_store_form','class'=>'form-horizontal form-bordered','method'=>'POST')) !!}


                                    <div class="form-body">

                                        <div class="form-group">
                                        <label class="col-md-2 control-label">Title: <span class="required">
                                        * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="title" placeholder="Title" value="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                        <label class="col-md-2 control-label">Description: <span class="required">
                                            * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <textarea class="form-control" name="description"  id="description"></textarea>

                                            </div>
                                        </div>


                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">

                                                       <button type="button" onclick="storeNotice(); return false;"   class="btn green">
																								<i class="fa fa-plus"></i>	Submit </button>

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
{!! HTML::script("assets/global/plugins/bootstrap-select/bootstrap-select.min.js") !!}
{!! HTML::script("assets/global/plugins/select2/select2.min.js") !!}
{!! HTML::script("assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js") !!}
{!! HTML::script("assets/global/plugins/tinymce/tinymce.min.js") !!}
 <script>
 tinymce.init({selector:'textarea'});
 // Javascript function to update the company info and Bank Info
 function storeNotice(){

	 tinyMCE.triggerSave();
	 var val = $('#description').val();

	 var url = "{{ route('admin.noticeboards.store') }}";
	 $.easyAjax({
		 type: 'POST',
		 url: url,
		 container: '#notice_store_form',
		 data: $('#notice_store_form').serialize(),
	 });
 }
 </script>
<!-- END PAGE LEVEL PLUGINS -->
@stop