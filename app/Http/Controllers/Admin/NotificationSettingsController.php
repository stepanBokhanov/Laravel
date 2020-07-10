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
class NotificationSettingsController extends AdminBaseController
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
        $this->notificationSettingActive = 'active';
        $this->setting = Setting::all()->first();

        return View::make('admin.notificationSettings.edit', $this->data);
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return array
     */
    public function update(UpdateRequest $request, $id)
    {
        $setting = Setting::findOrFail($id);

        $setting->award_notification = (isset($request->award_notification)) ? '1' : '0';
        $setting->leave_notification = (isset($request->leave_notification)) ? '1' : '0';
        $setting->attendance_notification = (isset($request->attendance_notification)) ? '1' : '0';
        $setting->notice_notification = (isset($request->notice_notification)) ? '1' : '0';
        $setting->employee_add = (isset($request->employee_add)) ? '1' : '0';

        $setting->save();

        return Reply::success('Notification setting changed successfully');
    }

    /**
     * @param CommonRequest $request
     * @return array
     */
    public function ajax_update_notification(CommonRequest $request)
    {
        $setting = Setting::first();
        $input[$request->type] = $request->value;
        $setting->update($input);

        return Reply::success('Notification setting changed');
    }

}
