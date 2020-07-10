<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use ZanySoft\Zip\Zip;

class AdminUpdateVersionController extends AdminBaseController
{


    public function __construct()
    {
        parent::__construct();
        parent::__construct();
        $this->pageTitle = 'Update Log';
        $this->settingOpen = 'active open';
        $this->updateSettingActive = 'active';
    }

    public function index()
    {

        return view('admin.update-version.index', $this->data);
    }
}
