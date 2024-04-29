<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class SesiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('login');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],[
            'email'=> 'email wajib diisi',
            'password'=> 'password wajib diisi'
        ]);

        $infoLogin = [
            'email'=> $request->email,
            'password'=> $request->password,
        ];
        if(Auth::attempt($infoLogin)){
            if(Auth::user()->role == 'admin'){
                return redirect('admin/admin');
            }elseif(Auth::user()->role == 'dokter'){
                return redirect('/admin/dokter');
            }elseif(Auth::user()->role == 'pasien'){
                return redirect('admin/pasien');
            };
        }else{
            return redirect('')->withErrors('Username dan password yang dimasukkan tidak sesuai')->withInput();
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
