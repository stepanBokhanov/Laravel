<html>
<head>
    <title>Product Not installed</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>


<body>
<!-- Page Content -->
<div class="container">
    <div class="row" style="margin-top: 30px">
        <div class="text-center m-t-20 mt-20">
            <h2>Fix the following errors to run installer</h2>
        </div>

        <?php if ($GLOBALS['error_type'] == 'php-version') { ?>
            <div class="alert alert-danger">
                <strong>Lower PHP version! </strong> Your php version is lower than 7.1.3. Please upgrade your version
                to make it work
                <p class="pull-right">Server PHP version: <b><?php echo phpversion(); ?></b></p>
            </div>

        <?php } else { ?>
            <div class="alert alert-danger">
                <strong>.env file missing! </strong> You forgot to upload the .env file. For more info visit <a
                        href="https://envato-froiden.freshdesk.com/a/solutions/articles/43000491463-showing-500-page-on-install-page"
                        target="_blank">https://envato-froiden.freshdesk.com/a/solutions/articles/43000491463-showing-500-page-on-install-page</a>
            </div>
        <?php } ?>
    </div>
</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>
