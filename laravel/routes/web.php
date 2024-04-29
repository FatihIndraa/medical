<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\AdminController;

Route::middleware(['guest'])->group(function () {
    Route::get('/', [SesiController::class, 'index'])->name('login');
    Route::post('/', [SesiController::class,'login']);
});

Route::get('/home', function(){
    return redirect('/admin');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/admin/admin', [AdminController::class, 'admin'])->middleware('userAkses:admin');
    Route::get('/admin/dokter', [AdminController::class, 'dokter'])->middleware('userAkses:dokter');
    Route::get('/admin/pasien', [AdminController::class, 'pasien'])->middleware('userAkses:pasien');
    Route::get('/logout', [SesiController::class, 'logout']);
});


