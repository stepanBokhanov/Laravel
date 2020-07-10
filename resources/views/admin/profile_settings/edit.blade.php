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
						<a href="{{ route('admin.notificationSettings.edit',$admin->id) }}">Settings</a>
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
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cog"></i>Login Details {{$pageTitle}}
							</div>
							<div class="tools">
							</div>
						</div>

						<div class="portlet-body form">

						<!------------------------ BEGIN FORM---------------------->
						{!!  Form::model($admin, ['method' => 'PUT', 'id'=> 'update_profile_form','class'=>'form-horizontal form-bordered'])  !!}

                                    <div class="form-body">
                                        <div class="form-group">
                                        <label class="col-md-2 control-label">Name: <span class="required">
                                        * </span>
                                            </label>
                                            <div class="col-md-6 form-group">
                                                <input type="text" class="form-control" name="name" placeholder="Administrator Name" value="{{ $admin->name }}">
                                                <input type="hidden" name="type" value="name">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                        <label class="col-md-2 control-label">Login Email: <span class="required">
                                            * </span>
                                            </label>
                                            <div class="col-md-6 form-group">
                                                <input type="text" class="form-control" name="email" placeholder="Email" value="{{ $admin->email}}" >
                                            </div>
                                        </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button type="button" onclick="updateProfile({{$admin->id}}, 'update_profile_form');return false;"   class="btn green"><i class="fa fa-check"></i> Submit</button>

                                                    </div>
                                                </div>
                                            </div>
                        						{!!  Form::close()  !!}
                       <!------------------------- END FORM ----------------------->

						</div>
					    </div>
					<!-- END EXAMPLE TABLE PORTLET-->
					
				    </div>
				                <div class="portlet box blue">
                						<div class="portlet-title">
                							<div class="caption">
                								<i class="fa fa-key"></i>Change Password
                							</div>
                							<div class="tools">
                							</div>
                						</div>

                						<div class="portlet-body form">

                						<!------------------------ BEGIN FORM Change Password---------------------->
                						{!!  Form::model($admin, ['method' => 'PUT','id'=> 'update_password_form', 'class'=>'form-horizontal form-bordered'])  !!}

                                                    <div class="form-body">

                                                        <div class="form-group">
                                                        <label class="col-md-2 control-label">Password: <span class="required">
                                                        * </span>
                                                            </label>
                                                            <div class="col-md-6 form-group">
                                                                <input type="password" class="form-control" name="password" placeholder="Password" >
                                                                <input type="hidden" name="type" value="password">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                        <label class="col-md-2 control-label">Confirm password: <span class="required">
                                                            * </span>
                                                            </label>
                                                            <div class="col-md-6 form-group">
                                                                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" >
                                                            </div>
                                                        </div>
                                                            <div class="form-actions">
                                                                <div class="row">
                                                                    <div class="col-md-offset-3 col-md-9">
                                                                        <button type="button" onclick="updateProfile({{$admin->id}}, 'update_password_form');return false;"   class="btn green"><i class="fa fa-check"></i> Submit</button>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                    {!!  Form::close()  !!}
                                       <!------------------------- END FORM Change Password ----------------------->

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
        jQuery(document).ready(function() {

           ComponentsDropdowns.init();
        });
        function updateProfile(id,div){
            var divID = '#'+div;
            var url = "{{ route('admin.profile_settings.update',':id') }}";
            url = url.replace(':id',id);
            $.easyAjax({
                type: 'POST',
                url: url,
                container: divID,
                data: $(divID).serialize(),
            });
        }
    </script>
<!-- END PAGE LEVEL PLUGINS -->
@stop