<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(){
        return view('/login');
    }

    public function procesLogin(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect('dashboard');
        }
        if (Auth::guard('dokters')->attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect('dashboard');
        }
        if (Auth::guard('operators')->attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect('dashboard');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request ){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}