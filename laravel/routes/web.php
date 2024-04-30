<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\RekamMedisController;

Route::middleware(['guest'])->group(function () {
    Route::get('/', [SesiController::class, 'index'])->name('login');
    Route::post('/', [SesiController::class,'login']);
});

Route::get('/home', function(){
    return redirect('/index');
});

Route::get('/register', [RegisterController::class,'index'])->middleware('guest');
Route::post('/register', [RegisterController::class,'store']);

Route::middleware(['auth'])->group(function(){
    Route::get('/index/admin', [AuthController::class, 'admin'])->middleware('userAkses:admin');
    Route::get('/dashboard/tambah-dokter', [RegisterController::class,'registerdokter'])->middleware('userAkses:admin');
    Route::get('/index/dokter', [AuthController::class, 'dokter'])->middleware('userAkses:dokter');
    Route::get('/index/pasien', [AuthController::class, 'pasien'])->middleware('userAkses:pasien');
    Route::get('/logout', [SesiController::class, 'logout']);
});
