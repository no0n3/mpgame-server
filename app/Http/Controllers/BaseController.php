<?php

namespace App\Http\Controllers;

class BaseController extends Controller {

    public function jsonResponse($data) {
        return response($data)
            ->header('Content-Type', 'application/json');
    }

}
