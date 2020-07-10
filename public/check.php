<!DOCTYPE html>
<html>
<head>
    <title>Laravel Application - Server Requirements</title>
    <style>
        body {
            padding-top: 18px;
            font-family: sans-serif;
            background: #f9fafb;
            font-size: 14px;
        }

        #container {
            width: 600px;
            margin: 0 auto;
            background: #fff;
            border-radius: 10px;
            padding: 15px;
            border: 2px solid #f0f0f0;
            -webkit-box-shadow: 0px 1px 15px 1px rgba(90, 90, 90, 0.08);
            box-shadow: 0px 1px 15px 1px rgba(90, 90, 90, 0.08);
        }

        a {
            text-decoration: none;
            color: red;
        }

        h1 {
            text-align: center;
            color: #424242;
            border-bottom: 1px solid #e4e4e4;
            padding-bottom: 25px;
            font-size: 22px;
            font-weight: normal;
        }

        table {
            width: 100%;
            padding: 10px;
            border-radius: 3px;
        }

        table thead th {
            text-align: left;
            padding: 5px 0px 5px 0px;
        }

        table tbody td {
            padding: 5px 0px;
        }

        table tbody td:last-child, table thead th:last-child {
            text-align: right;
        }

        .label {
            padding: 3px 10px;
            border-radius: 4px;
            color: #fff;

        }

        .label.label-success {
            background: #4ac700;
        }

        .label.label-warning {
            background: #dc2020;
        }


        .logo {
            margin-bottom: 30px;
            margin-top: 20px;
            display: block;
        }

        .logo img {
            margin: 0 auto;
            display: block;
        }

        .scene {
            width: 100%;
            height: 100%;
            perspective: 600px;
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            align-items: center;
            justify-content: center;

        svg {
            width: 240px;
            height: 240px;
        }

        }

        @keyframes arrow-spin {
            50% {
                transform: rotateY(360deg);
            }
        }
    </style>
</head>
<body>
<?php
$error = false;

if (version_compare(PHP_VERSION, '7.1.3') >= 0) {
    $requirement1 = "<span class='label label-success'>v." . PHP_VERSION . '</span>';
} else {
    $error = true;
    $requirement1 = "<span class='label label-warning'>Your PHP version is " . PHP_VERSION . '</span>';
}

if (!extension_loaded('tokenizer')) {
    $error = true;
    $requirement2 = "<span class='label label-warning'>Not enabled</span>";
} else {
    $requirement2 = "<span class='label label-success'>Enabled</span>";
}

if (!extension_loaded('pdo')) {
    $error = true;
    $requirement3 = "<span class='label label-warning'>Not enabled</span>";
} else {
    $requirement3 = "<span class='label label-success'>Enabled</span>";
}

if (!extension_loaded('curl')) {
    $error = true;
    $requirement4 = "<span class='label label-warning'>Not enabled</span>";
} else {
    $requirement4 = "<span class='label label-success'>Enabled</span>";
}

if (!extension_loaded('openssl')) {
    $error = true;
    $requirement5 = "<span class='label label-warning'>Not enabled</span>";
} else {
    $requirement5 = "<span class='label label-success'>Enabled</span>";
}

if (!extension_loaded('mbstring')) {
    $error = true;
    $requirement6 = "<span class='label label-warning'>Not enabled</span>";
} else {
    $requirement6 = "<span class='label label-success'>Enabled</span>";
}

if (!extension_loaded('ctype') && !function_exists('ctype')) {
    $error = true;
    $requirement7 = "<span class='label label-warning'>Not enabled</span>";
} else {
    $requirement7 = "<span class='label label-success'>Enabled</span>";
}


if (!extension_loaded('gd')) {
    $error = true;
    $requirement9 = "<span class='label label-warning'>Not enabled</span>";
} else {
    $requirement9 = "<span class='label label-success'>Enabled</span>";
}

if (!extension_loaded('zip')) {
    $error = true;
    $requirement10 = "<span class='label label-warning'>Zip Extension is not enabled</span>";
} else {
    $requirement10 = "<span class='label label-success'>Enabled</span>";
}

$url_f_open = ini_get('allow_url_fopen');
if ($url_f_open != "1" && $url_f_open != 'On') {
    $error = true;
    $requirement11 = "<span class='label label-warning'>Allow_url_fopen is not enabled!</span>";
} else {
    $requirement11 = "<span class='label label-success'>Enabled</span>";
}

?>
<div id="container">
    <div class="logo">
        <a href="https://codecanyon.net/user/ajay138">
            <img width="180px" src="data:image/png;base64,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"></a>
    </div>
    <h1><a href="https://codecanyon.net/user/ajay138">Application</a> - Server Requirements</h1>

    <div class="scene" id="scene">
        <svg
            version="1.1"
            id="dc-spinner"
            xmlns="http://www.w3.org/2000/svg"
            x="0px" y="0px"
            width="100" height="100"
            viewBox="0 0 38 38"
            preserveAspectRatio="xMinYMin meet"
        >
            <text x="14" y="21" font-family="Monaco" font-size="2px" style="letter-spacing:0.6" fill="grey">LOADING
                <animate
                    attributeName="opacity"
                    values="0;1;0" dur="1.8s"
                    repeatCount="indefinite"/>
            </text>
            <path fill="#373a42" d="M20,35c-8.271,0-15-6.729-15-15S11.729,5,20,5s15,6.729,15,15S28.271,35,20,35z M20,5.203
    C11.841,5.203,5.203,11.841,5.203,20c0,8.159,6.638,14.797,14.797,14.797S34.797,28.159,34.797,20
    C34.797,11.841,28.159,5.203,20,5.203z">
            </path>

            <path fill="#373a42" d="M20,33.125c-7.237,0-13.125-5.888-13.125-13.125S12.763,6.875,20,6.875S33.125,12.763,33.125,20
    S27.237,33.125,20,33.125z M20,7.078C12.875,7.078,7.078,12.875,7.078,20c0,7.125,5.797,12.922,12.922,12.922
    S32.922,27.125,32.922,20C32.922,12.875,27.125,7.078,20,7.078z">
            </path>

            <path fill="#2AA198" stroke="#2AA198" stroke-width="0.6027" stroke-miterlimit="10" d="M5.203,20
            c0-8.159,6.638-14.797,14.797-14.797V5C11.729,5,5,11.729,5,20s6.729,15,15,15v-0.203C11.841,34.797,5.203,28.159,5.203,20z">
                <animateTransform
                    attributeName="transform"
                    type="rotate"
                    from="0 20 20"
                    to="360 20 20"
                    calcMode="spline"
                    keySplines="0.4, 0, 0.2, 1"
                    keyTimes="0;1"
                    dur="2s"
                    repeatCount="indefinite"/>
            </path>

            <path fill="#859900" stroke="#859900" stroke-width="0.2027" stroke-miterlimit="10" d="M7.078,20
  c0-7.125,5.797-12.922,12.922-12.922V6.875C12.763,6.875,6.875,12.763,6.875,20S12.763,33.125,20,33.125v-0.203
  C12.875,32.922,7.078,27.125,7.078,20z">
                <animateTransform
                    attributeName="transform"
                    type="rotate"
                    from="0 20 20"
                    to="360 20 20"
                    dur="1.8s"
                    repeatCount="indefinite"/>
            </path>
        </svg>
    </div>


    <table class="table table-hover" id="requirements" style="display:none;">
        <thead>
        <tr>
            <th>Requirements</th>
            <th>Result</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>PHP 7.1.3+</td>
            <td><?php echo $requirement1; ?></td>
        </tr>
        <tr>
            <td>TOKENIZER</td>
            <td><?php echo $requirement2; ?></td>
        </tr>
        <tr>
            <td>PDO PHP Extension</td>
            <td><?php echo $requirement3; ?></td>
        </tr>
        <tr>
            <td>cURL PHP Extension</td>
            <td><?php echo $requirement4; ?></td>
        </tr>
        <tr>
            <td>OpenSSL PHP Extension</td>
            <td><?php echo $requirement5; ?></td>
        </tr>
        <tr>
            <td>MBString PHP Extension</td>
            <td><?php echo $requirement6; ?></td>
        </tr>


        <tr>
            <td>GD PHP Extension</td>
            <td><?php echo $requirement9; ?></td>
        </tr>
        <tr>
            <td>Zip PHP Extension</td>
            <td><?php echo $requirement10; ?></td>
        </tr>
        <tr>
            <td>allow_url_fopen</td>
            <td><?php echo $requirement11; ?></td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="3">
                <br/>
                <br/>
                Additionally you will need <b>mod_rewrite</b> enabled in your server. <br/><small>(this script unable to
                    check if mod_rewrite extension is allowed in your server, consult with your hosting provider for
                    this extension)</small>
            </td>
        </tr>
        </tfoot>
    </table>
    <br/>

</div>
<script>
    var scene = {
        complete: function () {
            var scene = document.getElementById("scene");
            scene.remove(scene);
        }
    };
    document.addEventListener("readystatechange", function () {
        if (document.readyState === "complete") {
            setTimeout(function () {
                scene.complete();
                var requirements = document.getElementById("requirements");
                requirements.style['display'] = null;
            }, 3000);
        }
    });
</script>
</body>
</html>
