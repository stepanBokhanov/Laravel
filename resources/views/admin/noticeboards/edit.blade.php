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
						<a href="">Edit Notice</a>
					</li>
				</ul>
			
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->

							<div class="row ">
                        				<div class="col-md-6">


                                        </div>
                        				<div class="col-md-6 form-group text-right">

                        				<span id="load_notification"></span>
                        					 <input  type="checkbox"  onchange="ToggleEmailNotification('notice_notification');return false;" class="make-switch" name="notice_notification" @if($setting->notice_notification==1)checked	@endif data-on-color="success" data-on-text="Yes" data-off-text="No" data-off-color="danger">
                        					<strong>Email Notification</strong><br>


                        				</div>
                                     </div>
                                     <hr>

			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->

                {{--INLCUDE ERROR MESSAGE BOX--}}
                      @include('admin.common.error')
                {{--END ERROR MESSAGE BOX--}}


					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-edit"></i>Edit Notice
							</div>
							<div class="tools">
							</div>
						</div>

						<div class="portlet-body form">

						<!-- BEGIN FORM-->
						{!! Form::open(array( 'id' => 'edit_noticeboards_form','class'=>'form-horizontal form-bordered','method'=>'PUT')) !!}


                                    <div class="form-body">

                                        <div class="form-group">
                                        <label class="col-md-2 control-label">Title: <span class="required">
                                        * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="title" placeholder="Title" value="{{$notice->title}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                        <label class="col-md-2 control-label">Description: <span class="required">
                                            * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <textarea class="form-control" name="description" rows="3">{{$notice->description}}</textarea>

                                            </div>
                                        </div>
                                         <div class="form-group">
                                                        <label class="col-md-2 control-label">Description: <span class="required">
                                                            * </span>
                                                            </label>
                                                            <div class="col-md-6">
                                    <select class="form-control" name="status">
                                                    <option value="active" @if($notice->status=='active')selected @endif >Active</option>
                                                    <option value="inactive" @if($notice->status=='inactive')selected @endif>Inactive</option>

                                    </select>

                                                    </div>
                                                    </div>

                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                               <button type="button" onclick="updateNotice({{$notice->id}});return false;"   class="btn green">
                                               												<i class="fa fa-check"></i>	Update </button>


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
  {!! HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js") !!}
{!! HTML::script("assets/global/plugins/select2/select2.min.js") !!}
{!! HTML::script("assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js") !!}
{!! HTML::script("assets/global/plugins/tinymce/tinymce.min.js") !!}
 <script>
 tinymce.init({selector:'textarea'});
 function updateNotice(id){

	 tinyMCE.triggerSave();
	 var val = $('#description').val();

	 var url = "{{ route('admin.noticeboards.update',':id') }}";
	 url = url.replace(':id',id);
	 $.easyAjax({
		 type: 'POST',
		 url: url,
		 container: '#edit_noticeboards_form',
		 data: $('#edit_noticeboards_form').serialize(),
	 });
 }
 </script>
<!-- END PAGE LEVEL PLUGINS -->
@stop