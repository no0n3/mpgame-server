<?php

namespace App\Http\Controllers;

class UserController extends BaseController {

    public function getUser() {
        $user = \App\User::getUserData(1);

        return response($user)
            ->header('Content-Type', 'application/json');
    }

}
