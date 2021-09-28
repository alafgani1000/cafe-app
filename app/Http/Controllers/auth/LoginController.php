<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt
     * * @param $request
     */
     public function store(Request $request)
     {
        $crendetials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        
        if(Auth::attempt($crendetials)) {
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
     }

     public function index()
     {
         return view('auth.login');
     }

}
