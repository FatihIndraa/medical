<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pasien; // Added Pasien model
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route; // Added Route facade

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("register",[
            'title' => 'login',
            'active'=>'register'
        ]);
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
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5',
            'kelamin' => 'required' // Menambahkan validasi untuk jenis kelamin
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $kelamin = $validatedData['kelamin']; // Menyimpan jenis kelamin ke dalam variabel terpisah
        unset($validatedData['kelamin']); // Menghapus jenis kelamin dari array $validatedData

        $user = User::create($validatedData);

        // Simpan jenis kelamin ke dalam tabel pasien
        $pasiens = new Pasien();
        $pasiens->kelamin = $kelamin;
        $pasiens->user_id = $user->id; // Asumsi terdapat relasi antara user dan pasien
        $pasiens->save();

        return redirect('/')->with('success', 'Registration Successful!! Please Login');
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

Route::get('/register', [RegisterController::class,'index'])->middleware('guest');
Route::post('/register', [RegisterController::class,'store']);