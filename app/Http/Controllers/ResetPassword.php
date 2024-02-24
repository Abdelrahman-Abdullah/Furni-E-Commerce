<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgetPasswordRequest;
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
    public function getOtp(ForgetPasswordRequest $request)
    {
        $user =  User::select('name','id')->where('email', $request->validated())->firstOrFail();
        // generate Code
        $code = Str::random(6);
        // save in session
        $request->session()->put('otp', $code);
        // Send Email To User
        Notification::send($user, new SendEmailOTPCodeCoNotification($user , $code));
        return redirect()->back()->with('success', 'We have sent you an email with the OTP code');
    }

}
