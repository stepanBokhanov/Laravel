<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Froiden\Envato\Traits\AppBoot;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{

    use AppBoot;
    public $data = [];

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->data[$name];
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    /**
     * BaseController constructor.
     */
    public function __construct()
    {
        $this->showInstall();
        $this->setting = Setting::all()->first();

    }

    protected function setupLayout()
    {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

}

