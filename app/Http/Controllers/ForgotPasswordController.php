<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    function forgetPassword() {
        return view('auth.forgot');
    }

    function forgetPasswordPost(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('emails.forget-password', ['token' => $token], function($message) use ($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return view('auth.forgot')->with('success', 'We have send an email to reset your password');
    }

    function resetPassword($token) {
        return view('auth.reset', compact('token'));
    }

    function resetPasswordPost(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'cpassword' => 'required',
        ]);

        $updatePassword = DB::table('password_reset_tokens')
        ->where([
            'email' => $request->email,
            'token' => $request->token,
        ])->first();
        
        if (!$updatePassword) {
            return view('auth.reset')->with('error', 'Invalid token');
        }

        User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
    
        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();

        return view('login')->with('success', 'Password reset success');
    }
}
