<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Files;
use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;
use App\Http\Requests\Admin\Setting\EditRequest;
use App\Http\Requests\Admin\Setting\UpdateRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\View;

/**
 * Class SettingsController
 * @package App\Http\Controllers\Admin
 */
class SettingsController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->settingOpen = 'active open';
        $this->pageTitle = 'Settings';
    }

    /**
     * @param EditRequest $request
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(EditRequest $request)
    {
        $this->settingActive = 'active';
        $this->setting = Setting::all()->first();

        return View::make('admin.settings.edit', $this->data);
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function update(UpdateRequest $request, $id)
    {
        $setting = Setting::first();

        // Logo Image Upload
        if ($request->logo) {
            $file = new Files();
            $setting->logo = $file->upload($request->logo, 'setting/logo');
        }

        $currencyArray = explode(':', $request->currency);
        $setting->currency_icon = $currencyArray[0];
        $setting->currency = $currencyArray[1];

        $setting->website = $request->website;
        $setting->email = $request->email;
        $setting->name = $request->name;
        $setting->save();

        return Reply::redirect(route('admin.settings.edit','setting'));
    }

}
