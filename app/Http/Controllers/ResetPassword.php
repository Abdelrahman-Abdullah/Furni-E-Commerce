<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgetPasswordRequest;
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
    public function getOtp(ForgetPasswordRequest $request)
    {
        $user =  User::select('name','id')->where('email', $request->validated())->firstOrFail();
        // generate Code
        $code = Str::random(6);
        // save in session
        $request->session()->put('otp', $code);
        $request->session()->put('email', $request->email);
        // Send Email To User
        Notification::send($user, new SendEmailOTPCodeCoNotification($user , $code));
        return redirect()->route('users.reset-password')->with('success', 'We have sent you an email with the OTP code');
    }
    public function resetPassword()
    {
        return view('Front.users.reset-password');
    }
    public function updatePassword(ResetPasswordRequest $request)
    {
        if ($request->session()->get('otp') == $request->code) {
                User::where('email', $request->session()->get('email'))
                    ->update(['password' => bcrypt($request->password)]);
                $request->session()->forget(['otp', 'email']);
            return redirect()->route('users.login')->with('success', 'Password has been reset successfully');
        }
        return redirect()->back()->withErrors(['code' => 'Invalid OTP Code']);
    }

}
