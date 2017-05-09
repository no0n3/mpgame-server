<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $logged = false;
        $status = 'not_logged';

//        $this->validateLogin($request);

        if ($this->guard()->check()) {
            $logged = true;
            $status = 'already_logged';
        } else if ($this->attemptLogin($request)) {
            $logged = true;
            $status = 'successfuly_logged';
        } else {
            $status = 'failed_loggin';
        }

        $this->incrementLoginAttempts($request);

        return $this->jsonResponse(['logged' => $logged, 'status' => $status]);
    }
}
