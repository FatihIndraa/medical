<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\RekamMedisController;

Route::middleware(['guest'])->group(function () {
    Route::get('/', [SesiController::class, 'index'])->name('login');
    Route::post('/', [SesiController::class,'login']);
});

Route::get('/home', function(){
    return redirect('/index');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/index', [AdminController::class, 'index']);
    Route::post('/index', [AdminController::class, 'store']); // Added this line for POST method
    Route::get('/index/admin', [AdminController::class, 'admin'])->middleware('userAkses:admin');
    Route::get('/index/dokter', [AdminController::class, 'dokter'])->middleware('userAkses:dokter');
    Route::get('/index/pasien', [AdminController::class, 'pasien'])->middleware('userAkses:pasien');
    Route::get('/logout', [SesiController::class, 'logout']);
});

// Route::get('/dashboard/tambah-pasien', [PasienController::class, 'create'])->name('tambah-pasien.create')->middleware('userAkses:admin');
// Route::post('/dashboard/tambah-pasien', [PasienController::class, 'store'])->name('tambah-pasien.store')->middleware('userAkses:admin');

Route::get('/dashboard/rekam-medis', [RekamMedisController::class, 'create'])->name('rekam-medis.create')->middleware('userAkses:admin');

