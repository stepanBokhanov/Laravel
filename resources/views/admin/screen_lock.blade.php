<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Screen Lock</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">

<!-- BEGIN GLOBAL MANDATORY STYLES -->
{!! HTML::style('https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all') !!}
{!! HTML::style('assets/global/plugins/font-awesome/css/font-awesome.min.css') !!}
{!! HTML::style('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') !!}
{!! HTML::style('assets/global/plugins/bootstrap/css/bootstrap.min.css') !!}
{!! HTML::style('assets/global/plugins/uniform/css/uniform.default.css') !!}
{!! HTML::style('assets/admin/pages/css/lock2.css') !!}
{!! HTML::style('assets/global/css/components.css') !!}
{!! HTML::style('assets/global/css/plugins.css') !!}
{!! HTML::style('assets/admin/layout/css/layout.css') !!}
{!! HTML::style('assets/admin/layout/css/themes/darkblue.css') !!}
{!! HTML::style('assets/admin/layout/css/custom.css') !!}
{!! HTML::style('assets/global/plugins/froiden-helper/helper.css')  !!}


		<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body>
<div class="page-lock">
	<div class="page-logo" align="center">
		<a class="brand" href="javascript:;">
			<img src="{{$setting->getLogoImageAttribute()}}" height="30px" width="117px" />
		</a>
	</div>
	<div class="page-body">
		<div class="page-lock-info">
			<h1>{{ $loggedAdmin->name}}</h1>
			<span class="email">
			{{ $loggedAdmin->email}} </span>
			<span class="locked">
			Locked </span>
			<div id='alert'></div>
			{!!  Form::open(array('url' => '','class' =>'form-inline', 'id' => 'adminLogin'))  !!}


				<div class="input-group input-medium form-group">
					<input type="password" class="form-control" name="password" placeholder="Password">
					<input type="hidden" class="form-control" name="email" value="{{ $loggedAdmin->email}}">
					<span class="input-group-btn">
					<button type="button" class="btn blue icn-only" onclick="login();return false;" id="submitbutton"><i class="m-icon-swapright m-icon-white"></i></button>
					</span>

				</div>
				<span id="errorDiv" style="color: red;" class="help-block help-block-error"></span>
				<!-- /input-group -->
				<div class="relogin">
					<a href="{{ URL::to('admin/logout')}}">
					Not {{ $loggedAdmin->name}} ? </a>
				</div>
				
			{!!  Form::close() !!}
		</div>
	</div>
	<div class="page-footer-custom" style="text-align:center !important;">
		  {{\Illuminate\Support\Carbon::now()->format('Y')}} &copy; {{$setting->website}}
	</div>
</div>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
{!! HTML::script('assets/global/plugins/respond.min.js') !!}
{!! HTML::script('assets/global/plugins/excanvas.min.js') !!}
<![endif]-->
{!! HTML::script('assets/global/plugins/jquery.min.js') !!}
{!! HTML::script('assets/global/plugins/jquery-migrate.min.js') !!}
{!! HTML::script('assets/global/plugins/bootstrap/js/bootstrap.min.js') !!}
{!! HTML::script('assets/global/plugins/jquery.blockui.min.js') !!}
{!! HTML::script('assets/global/plugins/uniform/jquery.uniform.min.js') !!}
{!! HTML::script('assets/global/plugins/jquery.cokie.min.js') !!}
{!! HTML::script('assets/global/plugins/backstretch/jquery.backstretch.min.js') !!}
{!! HTML::script('assets/global/scripts/metronic.js') !!}
{!! HTML::script('assets/admin/layout/scripts/layout.js') !!}
{!! HTML::script('assets/admin/layout/scripts/demo.js') !!}
{!! HTML::script('assets/admin/pages/scripts/lock.js') !!}
{!! HTML::script('assets/global/plugins/froiden-helper/helper.js') !!}

<script>
jQuery(document).ready(function() {
    Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
    Lock.init();
    Demo.init();
});
 var Lock = function () {

        return {
            //main function to initiate the module
            init: function () {

                 $.backstretch([
                     "{{ URL::asset('assets/admin/pages/media/bg/1.jpg') }}",
                     "{{ URL::asset('assets/admin/pages/media/bg/2.jpg') }}",
                     "{{ URL::asset('assets/admin/pages/media/bg/3.jpg') }}",
                     "{{ URL::asset('assets/admin/pages/media/bg/4.jpg') }}",
    		        ], {
    		          fade: 1000,
    		          duration: 8000
    		      });
            }

        };

    }();
</script>

<script>
function login(){
	$.easyAjax({
		type: 'POST',
		url: "{{route('admin.login')}}",
		data: $('#adminLogin').serialize(),
		container: "#adminLogin",
		messagePosition: 'inline',
		success: function (response) {
			if (response.status == "success") {
				$('#login-form')[0].reset();
			}
		},
		error: function (response) {
			//console.log();
			$('#errorDiv').html(response.responseJSON.errors.password[0]);


		}
	});
	return false;
}
    
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>