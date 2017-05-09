<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController {

    public function getUser(Request $request) {
        if (Auth::guard()->check()) {
            $user = User::getUserData($request->user()->id);
        } else {
            $user = [];
        }

        return response($user)
            ->header('Content-Type', 'application/json');
    }

}
