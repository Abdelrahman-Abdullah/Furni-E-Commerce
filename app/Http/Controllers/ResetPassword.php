<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Http\Request;

class ResetPassword extends Controller
{
    public function index()
    {
        return view('Front.users.forget-password');
    }
    public function getOtp(ResetPasswordRequest $request)
    {
        dd("welome Gere");
    }

}
