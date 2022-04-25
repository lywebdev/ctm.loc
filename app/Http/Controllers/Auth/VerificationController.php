<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function notice(Request $request)
    {
        if ($request->user()->email_verified_at) {
            return redirect()->route('home')->with('alert', 'Ваша почта уже подтверждена');
        }

        return view('auth.verify');
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('home')->with('alert', 'Ваша почта уже подтверждена');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('resent', 'Ссылка для подтверждения email отправлена');
    }
}
