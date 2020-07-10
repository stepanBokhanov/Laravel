<html>
<head>
    <title>{{ ucwords(config('froiden_envato.envato_product_name'))}} Not installed</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="//envato.froid.works/plugins/froiden-helper/helper.css">
    <link href="//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<?php
$latestLaravelVersion = '5.8';

$laravelVersion = (isset($_GET['v'])) ? (string)$_GET['v'] : $latestLaravelVersion;

if (!in_array($laravelVersion, array('5.8'))) {
    $laravelVersion = $latestLaravelVersion;
}


$reqList = array(
    '5.8' => array(
        'php' => '7.1.3',
        'mcrypt' => false,
        'openssl' => true,
        'pdo' => true,
        'mbstring' => true,
        'tokenizer' => true,
        'xml' => true,
        'ctype' => true,
        'json' => true,
        'obs' => ''
    )
);


$strOk = '<i class="fa fa fa-check-circle text-success"></i>';
$strFail = '<i class="fa fa-times text-danger"></i>';
$strUnknown = '<i class="fa fa-question"></i>';

$requirements = array();


// PHP Version
if (is_array($reqList[$laravelVersion]['php'])) {
    $requirements['php_version'] = true;
    foreach ($reqList[$laravelVersion]['php'] as $operator => $version) {
        if (!version_compare(PHP_VERSION, $version, $operator)) {
            $requirements['php_version'] = false;
            break;
        }
    }
} else {
    $requirements['php_version'] = version_compare(PHP_VERSION, $reqList[$laravelVersion]['php'], ">=");
}

// OpenSSL PHP Extension
$requirements['openssl_enabled'] = extension_loaded("openssl");

// PDO PHP Extension
$requirements['pdo_enabled'] = defined('PDO::ATTR_DRIVER_NAME');

// Mbstring PHP Extension
$requirements['mbstring_enabled'] = extension_loaded("mbstring");

// Tokenizer PHP Extension
$requirements['tokenizer_enabled'] = extension_loaded("tokenizer");

// XML PHP Extension
$requirements['xml_enabled'] = extension_loaded("xml");

// CTYPE PHP Extension
$requirements['ctype_enabled'] = extension_loaded("ctype");

// JSON PHP Extension
$requirements['json_enabled'] = extension_loaded("json");

// Mcrypt
$requirements['mcrypt_enabled'] = extension_loaded("mcrypt_encrypt");

// mod_rewrite
$requirements['mod_rewrite_enabled'] = null;

if (function_exists('apache_get_modules')) {
    $requirements['mod_rewrite_enabled'] = in_array('mod_rewrite', apache_get_modules());
}

?>

<body>
<!-- Page Content -->
<div class="container">
    <div class="row" style="margin-top: 30px">
        <div class="text-center m-t-20 mt-20" style="background: #ababab;padding: 10px">
            <img class="text-center" src="{{ asset('assets/global/img/hrm-logo.png') }}" style="max-width: 100px" alt="Home"/>
        </div>
        <div class="bs-example" data-example-id="alerts-with-links" style="margin-top:10px ">


            <div class="alert alert-warning" role="alert"><strong>{{ ucwords(config('froiden_envato.envato_product_name'))}} not installed!</strong> Visit <a
                    href="{{ url('/install')}}"
                    class="alert-link">{{ url('/install')}}</a>
                to get the installer.
            </div>

        </div>


        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Server Requirements.
                    @if (version_compare(PHP_VERSION, '7.1.3') > 0)
                        <span class="pull-right">Current PHP Version: {{ phpversion() }} <i
                                class="fa fa fa-check-circle text-success"></i></span>
                    @else
                        <span class="pull-right">Current PHP Version: {{ phpversion() }} <i data-toggle="tooltip"
                                                                                            data-original-title="PHP Update Required"
                                                                                            class="fa fa fa-warning text-danger"></i></span>
                    @endif</h3>
            </div>
            <div class="panel-body">
                <div class="wrapper">

                    <p>
                        PHP <?php

                        if (is_array($reqList[$laravelVersion]['php'])) {
                            $phpVersions = array();
                            foreach ($reqList[$laravelVersion]['php'] as $operator => $version) {
                                $phpVersions[] = "{$operator} {$version}";
                            }
                            echo implode(" && ", $phpVersions);
                        } else {
                            echo ">= " . $reqList[$laravelVersion]['php'];
                        }

                        echo " " . ($requirements['php_version'] ? $strOk : $strFail); ?>
                    </p>


                    <?php if ($reqList[$laravelVersion]['openssl']) : ?>
                    <p>OpenSSL PHP Extension <?php echo $requirements['openssl_enabled'] ? $strOk : $strFail; ?></p>
                    <?php endif; ?>

                    <?php if ($reqList[$laravelVersion]['pdo']) : ?>
                    <p>PDO PHP Extension <?php echo $requirements['pdo_enabled'] ? $strOk : $strFail; ?></p>
                    <?php endif ?>

                    <?php if ($reqList[$laravelVersion]['mbstring']) : ?>
                    <p>Mbstring PHP Extension <?php echo $requirements['mbstring_enabled'] ? $strOk : $strFail; ?></p>
                    <?php endif ?>

                    <?php if ($reqList[$laravelVersion]['tokenizer']) : ?>
                    <p>Tokenizer PHP Extension <?php echo $requirements['tokenizer_enabled'] ? $strOk : $strFail; ?></p>
                    <?php endif ?>


                    <?php if ($reqList[$laravelVersion]['xml']) : ?>
                    <p>XML PHP Extension <?php echo $requirements['xml_enabled'] ? $strOk : $strFail; ?></p>
                    <?php endif ?>

                    <?php if ($reqList[$laravelVersion]['ctype']) : ?>
                    <p>CTYPE PHP Extension <?php echo $requirements['ctype_enabled'] ? $strOk : $strFail; ?></p>
                    <?php endif ?>

                    <?php if ($reqList[$laravelVersion]['json']) : ?>
                    <p>JSON PHP Extension <?php echo $requirements['json_enabled'] ? $strOk : $strFail; ?></p>
                    <?php endif ?>

                    <?php if ($reqList[$laravelVersion]['mcrypt']) : ?>
                    <p>Mcrypt PHP Extension <?php echo $requirements['mcrypt_enabled'] ? $strOk : $strFail; ?></p>
                    <?php endif ?>

                    <?php if (!empty($reqList[$laravelVersion]['obs'])): ?>
                    <p class="obs"><?php echo $reqList[$laravelVersion]['obs'] ?></p>
                    <?php endif; ?>

                </div>
            </div>
        </div>

    </div>
</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>
