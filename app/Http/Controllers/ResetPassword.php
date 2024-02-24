<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResetPassword extends Controller
{
    public function index()
    {
        return view('Front.users.forget-password');
    }



}
