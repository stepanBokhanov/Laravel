<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;
use App\Http\Requests\Admin\CommonRequest;
use App\Http\Requests\Admin\Notification\EditRequest;
use App\Http\Requests\Admin\Notification\UpdateRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\View;

/**
 * Class NotificationSettingsController
 * @package App\Http\Controllers\Admin
 */
class EmailSettingsController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->settingOpen = 'active open';
        $this->pageTitle = 'Email Settings';
    }

    /**
     * Show the form for editing the specified Admin.
     */
    public function edit(EditRequest $request)
    {
        $this->emailSettingActive = 'active';
        $this->setting = Setting::first();

        return View::make('admin.email_settings.edit', $this->data);
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return array
     */
    public function update(UpdateRequest $request, $id)
    {
        $setting = Setting::findOrFail($id);

        $setting->update($request->all());

        return Reply::success('Email setting update successfully');
    }

}
