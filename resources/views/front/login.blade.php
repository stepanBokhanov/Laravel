<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
    <title>{{$setting->website}} | Login Page</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">


    <!-- CSS Global Compulsory -->
    {!! HTML::style('front_assets/plugins/bootstrap/css/bootstrap.min.css') !!}
    {!! HTML::style('front_assets/css/style.css') !!}

    <!-- CSS Implementing Plugins -->
    {!! HTML::style('front_assets/plugins/line-icons/line-icons.css') !!}
    {!! HTML::style('front_assets/plugins/font-awesome/css/font-awesome.min.css') !!}

    <!-- CSS Page Style -->
    {!! HTML::style('front_assets/css/pages/page_log_reg_v2.css') !!}

    <!-- CSS Theme -->
    {!! HTML::style('front_assets/css/theme-colors/default.css') !!}

    <!-- CSS Customization -->
    {!! HTML::style('front_assets/css/custom.css') !!}
    {!! HTML::style('assets/global/plugins/froiden-helper/helper.css')  !!}
</head> 

<body>
<!--=== Content Part ===-->    
<div class="container">
    <!--Reg Block-->
    {!!  Form::open(array('id'=>'login-form'))  !!}
    <div class="reg-block">
        <div class="reg-block-header">
            <h2><img src="{{$setting->getLogoImageAttribute()}}" width="117px" /></h2>
            <h3 class="text-center">Employee Panel</h3>
        </div>

        <div id="alert"></div>

        <div class="form-group rem margin-bottom-20">
            <div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input type="email" class="form-control" id="email" name="email"
                           placeholder="{{ trans('core.email') }}" required>
                </div>
            </div>
        </div>

        <div class="form-group rem margin-bottom-20">
            <div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password"
                           placeholder="{{ trans('core.password') }}"
                           required>
                </div>
            </div>
        </div>

        <label style="font-weight: normal;" class="margin-bottom-20 rem">
            <input type="checkbox" name="remember"> Always stay signed in
        </label>

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <button type="submit" class="btn-u btn-block input-group" id="submitbutton"
                        onclick="login(); return false;">{{trans('core.btnLogin')}}</button>
            </div>
        </div>
    </div>
    <!--End Reg Block-->
    {!! Form::close() !!}
</div><!--/container-->
<!--=== End Content Part ===-->
<!-- JS Global Compulsory -->
{!! HTML::script('front_assets/plugins/jquery/jquery.min.js') !!}
{!! HTML::script('front_assets/plugins/jquery/jquery-migrate.min.js') !!}
{!! HTML::script('front_assets/plugins/bootstrap/js/bootstrap.min.js') !!}

<!-- JS Implementing Plugins -->
{!! HTML::script('front_assets/plugins/back-to-top.js') !!}
{!! HTML::script('front_assets/plugins/backstretch/jquery.backstretch.min.js') !!}
{!! HTML::script('assets/global/plugins/froiden-helper/helper.js') !!}

<script type="text/javascript">
    $.backstretch([
    "{{URL::asset('front_assets/img/bg/5.jpg')}}",
    "{{URL::asset('front_assets/img/bg/4.jpg')}}"

    ], {
        fade: 1000,
        duration: 7000
    });
</script>

<!--[if lt IE 9]>
{!! HTML::script('front_assets/plugins/respond.js') !!}
{!! HTML::script('front_assets/plugins/html5shiv.js') !!}
{!! HTML::script('front_assets/js/plugins/placeholder-IE-fixes.js') !!}


<![endif]-->
<!-- JS Customization -->

<script>
    function login(){

        $.easyAjax({
            type: 'POST',
            url: "{{route('login')}}",
            data: $('#login-form').serialize(),
            container: "#login-form",
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
</body>
</html> 