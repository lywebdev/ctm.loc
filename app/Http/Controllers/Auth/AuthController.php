<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
