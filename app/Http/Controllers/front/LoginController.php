<?php

namespace App\Http\Controllers\front;

use App\Classes\Reply;
use App\Http\Controllers\BaseController;
use App\Http\Requests\FrontUser\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

/**
 * Class LoginController
 * @package App\Http\Controllers\front
 */
class LoginController extends BaseController
{

    /**
     * LoginController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'Login Page';
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        if (Auth::guard('employees')->check()) {
            return Redirect::route('dashboard.index');
        }

        return View::make('front.login', $this->data);

    }

    /**
     * @param LoginRequest $request
     * @return array
     */
    public function ajaxLogin(LoginRequest $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
            'status' => 'active'
        ];

        // Check if employee exists in database with the credentials of not
        if (Auth::guard('employees')->attempt($data,$request->remember)) {
            return Reply::redirect(route('dashboard.index'), 'messages.loginSuccess');
        }

        // For Blocked Users
        $data['status'] = 'inactive';

        if (Auth::guard('employees')->validate($data)) {
            return Reply::error('messages.accountBlocked');
        }

        // Invalid user
        return Reply::error('messages.incorrectLogin');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::guard('employees')->logout();

        return Redirect::route('front.login');
    }

}
