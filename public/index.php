<?php

if(!file_exists('../.env')){
    $GLOBALS["error_type"] = "env-missing";
    include('error_install.php');
    exit(1);
}

if (version_compare(PHP_VERSION, '7.1.3') < 0){
    $GLOBALS["error_type"] = "php-version";
    include('error_install.php');
    exit(1);
}
/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */
changeEnvironmentVariable();

function changeEnvironmentVariable()
{

    $path = '../.env';
    if (file_exists($path)) {
        //Try to read the current content of .env
        $current = file_get_contents($path);

        //Store the key
        $original = [];
        if (preg_match('/^DB_PASSWORD=(.+)$/m', $current, $original)) {
            //Write the original key to console
            //Overwrite with new key

            $current = preg_replace('/^DB_PASSWORD=.+$/m', 'DB_PASSWORD="' . $original[1] . '"', $current);

            // Check if sting has double quote or not
            if (strpos($original[1], '"') === false) {
                file_put_contents($path, $current);
            }
        }
    }
}
/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels nice to relax.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let us turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight our users.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
