<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title> HRM | Login </title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- BEGIN  STYLES -->
{!!  HTML::style("assets/global/plugins/font-awesome/css/font-awesome.min.css")  !!}
{!!  HTML::style("assets/global/plugins/bootstrap/css/bootstrap.min.css")  !!}
{!!  HTML::style("assets/admin/pages/css/login-soft.css")  !!}
{!!  HTML::style("assets/global/css/components.css")  !!}
{!!  HTML::style("assets/admin/layout/css/layout.css")  !!}
{!!  HTML::style("assets/admin/layout/css/themes/darkblue.css")  !!}
{!! HTML::style('assets/global/plugins/froiden-helper/helper.css')  !!}
<!-- END STYLES -->

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
	<a href="javacript:;">
		<img src="{{$setting->getLogoImageAttribute()}}"  width="117px" />
	</a>
</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content">
	<!-- BEGIN LOGIN FORM -->
	{!!  Form::open(array('url' => '','id'=> 'adminLogin', 'class' =>'login-form'))  !!}

		<h3 class="form-title">Login to your Admin account</h3>
		<div id="alert">

		</div>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Email</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input class="form-control placeholder-no-fix" type="email" autocomplete="off" placeholder="Email" name="email"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
			</div>
		</div>

		<div class="form-actions">

			<button type="submit" class="btn blue pull-right" id="submitbutton" onclick="login();return false;">
			Login <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
		<hr>
		<div class="form-group text-center">
			<a href="{{route('front.login')}}"><label class="btn btn-sm green ">Go to Employee Panel</label></a>
		</div>

	{!! Form::close() !!}
	<!-- END LOGIN FORM -->
	
	
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
	  {{date('Y')}} &copy; {{$setting->website}}
</div>
<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
{!! HTML::script('assets/global/plugins/respond.min.js') !!}
{!! HTML::script('assets/global/plugins/excanvas.min.js') !!}
<![endif]-->
{!!  HTML::script("assets/global/plugins/jquery.min.js") !!}
{!!  HTML::script("assets/global/plugins/bootstrap/js/bootstrap.min.js")  !!}
{!!  HTML::script("assets/global/plugins/backstretch/jquery.backstretch.min.js")  !!}
{!!  HTML::script("assets/global/scripts/metronic.js")  !!}
{!!  HTML::script("assets/admin/layout/scripts/demo.js")  !!}
{!! HTML::script('assets/global/plugins/froiden-helper/helper.js') !!}

		<!-- END PAGE LEVEL SCRIPTS -->

<script>

jQuery(document).ready(function() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
  Metronic.init(); // init metronic core components
	
       // init background slide images
       $.backstretch([
			"{{ URL::asset('assets/admin/pages/media/bg/1.jpg') }}",
			"{{ URL::asset('assets/admin/pages/media/bg/2.jpg') }}",
			"{{ URL::asset('assets/admin/pages/media/bg/3.jpg') }}",
			"{{ URL::asset('assets/admin/pages/media/bg/4.jpg') }}"
        ], {
          fade: 1000,
          duration: 8000
    }
    );
});
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
		}
	});
	return false;
}
    
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>