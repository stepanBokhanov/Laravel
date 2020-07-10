<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;
use App\Http\Requests\Admin\LoginRequest;
use Carbon\Carbon;
use Froiden\Envato\Traits\AppBoot;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class AdminLoginController extends AdminBaseController
{

    use AppBoot;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     * Redirect to dashboard if logged in
     */
    public function index()
    {

        if (!$this->isLegal()) {
            return redirect('verify-purchase')->with('redirectUrl', request()->route()->getName());
        }

        if (Auth::guard('admin')->check()) {
            return Redirect::route('admin.dashboard.index');
        }

        return View::make('admin/login', $this->data);

    }

    /**
     * @param LoginRequest $request
     * @return array
     */
    public function ajaxAdminLogin(LoginRequest $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::guard('admin')->attempt($data, true)) {

            $user = admin();
            $user->last_login = Carbon::now();
            $user->save();
            Session::put('lock', '0'); // Reset the lock screen session;

            return Reply::redirect(route('admin.dashboard.index'), 'messages.loginSuccess');
        }


        return Reply::error('messages.incorrectLogin');

    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * When logout button of admin panel is clicked.This method is called.This method destroys all the
     * the session stored and redirect to the Login Page
     */
    public function logout()
    {
        Auth::guard('admin')->logout();

        return Redirect::route('admin.getlogin');
    }
}
