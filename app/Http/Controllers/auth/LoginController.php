<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

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

     public function signIn(Request $request)
     {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required'
        ]);

        $user = User::where('email',$request->email)->first();

        if(! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.']
            ]);
        }

        $token = $user->createToken($request->device_name)->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
     }

     public function signOut(Request $request)
     {
         $user->tokens()->delete();
     }

}
