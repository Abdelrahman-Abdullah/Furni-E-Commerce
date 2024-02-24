<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use App\Notifications\SendEmailOTPCodeCoNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class ResetPassword extends Controller
{
    public function index()
    {
        return view('Front.users.forget-password');
    }
    public function getOtp(ResetPasswordRequest $request)
    {
        $user =  User::select('name','id')->where('email', $request->validated())->firstOrFail();
        // generate Code
        $code = Str::random(6);
        // save in session
        $request->session()->put('otp', $code);
        Notification::send($user, new SendEmailOTPCodeCoNotification($user));
        // Send Email To User
        // Check if the code is right
        // return view
    }

}
