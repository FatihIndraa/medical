<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display the login form.
     */
    public function login()
    {
        return view('login');
    }

    public function index(){
        return view('home');
    }
    /**
     * Process the login request.
     */
    public function procesLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('home');
        }

        if (Auth::guard('dokters')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('home');
        }

        if (Auth::guard('operators')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    /**
     * Logout the user.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
