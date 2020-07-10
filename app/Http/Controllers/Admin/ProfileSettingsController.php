<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;
use App\Http\Requests\Admin\Profile\EditRequest;
use App\Http\Requests\Admin\Profile\UpdateRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

/**
 * Class ProfileSettingsController
 * @package App\Http\Controllers\Admin
 */
class ProfileSettingsController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->settingOpen = 'active open';
        $this->pageTitle = 'Settings';
    }

    /**
     * Show the form for editing the specified Admin.
     */
    public function edit(EditRequest $request)
    {
        $this->admin = Admin::find(Auth::guard('admin')->user()->id);
        $this->profileSettingActive = 'active';

        return View::make('admin.profile_settings.edit', $this->data);
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return array
     */
    public function update(UpdateRequest $request, $id)
    {
        $admin = Admin::findOrFail(Auth::guard('admin')->user()->id);

        // Name and email change
        if ($request->type == 'name') {
            $admin->name = $request->name;
            $admin->email = $request->email;
        } else {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return Reply::success('Profile detail updated successfully');
    }

}
