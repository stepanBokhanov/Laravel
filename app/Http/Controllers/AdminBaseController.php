<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AdminBaseController extends Controller
{

    public $data = [];

    public function __get($name)
    {
        return $this->data[$name];
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    public function __construct()
    {
        $this->showInstall();
        $this->setting = Setting::first();
        $this->pending_applications = Attendance::where('application_status', '=', 'pending')->get();


        $this->middleware(function ($request, $next) {
            $this->loggedAdmin = Auth::guard('admin')->user();

            config(['froiden_envato.allow_users_id' => true]);
            return $next($request);
        });

    }

    protected function setupLayout()
    {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

}
