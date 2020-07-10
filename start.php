<?php

/*
|--------------------------------------------------------------------------
| Register Namespaces And Routes
|--------------------------------------------------------------------------
|
| When a module starting, this file will executed automatically. This helps
| to register some namespaces like translator or view. Also this file
| will load the routes file for each module. You may also modify
| this file as you want.
|
*/

use Illuminate\Support\Str;

//require __DIR__ . '/routes/web.php';

if (!function_exists('user')) {

    /**
     * Return current logged in user
     */
    function user()
    {
        $user = \Illuminate\Support\Facades\Auth::guard('employees')->user();

        if (is_a($user, 'App\Models\Employee')) {
            session('user', $user);

            return $user;
        } else {
            return null;
        }
    }

}


if (!function_exists('admin')) {

    /**
     * Returns current school according to the current domain
     * @return School|null
     */
    function admin()
    {
        $admin = \Illuminate\Support\Facades\Auth::guard('admin')->user();
        if (is_a($admin, 'App\Models\Admin')) {
            session('admin', $admin);
            return $admin;
        } else {
            return null;
        }
    }

}

if (!function_exists('asset_url')) {

    // @codingStandardsIgnoreLine
    function asset_url($path, $type)
    {
        if ($type !== null)
            $path = 'user-uploads/employee_documents/' . $type . '/' . $path;
        else
            $path = 'user-uploads/' . $path;
        $storageUrl = $path;

        if (!Str::startsWith($storageUrl, 'http')) {
            return url($storageUrl);
        } else {
            return $storageUrl;
        }
    }

}
