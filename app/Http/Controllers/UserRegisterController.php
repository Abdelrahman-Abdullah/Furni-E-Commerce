<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserRegisterController extends Controller
{
    public function create()
    {
        return view('Front.users.register');
    }
}
