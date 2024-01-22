<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserSessionController extends Controller
{
    public function create()
    {
        return view('Front.users.login');
    }

}
