<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/login', [AuthController::class,'procesLogin']);
Route::get('/dashboard/tambah-dokter', [DokterController::class, 'showDokterRegistrationForm'])->name('register.dokter.form');
Route::post('/dashboard/tambah-dokter', [DokterController::class, 'store'])->name('register.dokter.submit');
Route::get('/register', [UserController::class, 'index'])->name('register');
Route::post('/register', [UserController::class, 'store'])->name('register');
Route::get('/logout',[AuthController::class,'logout']);

Route::middleware(['userAkses'])->group(function(){
    Route::get('/', function(){
        return view('dashboard.index');
    })->middleware('auth:dokters,web,operators');

    Route::get('/dashboard/data-dokter', [DokterController::class, 'dataDokter'])->name('dashboard.data-dokter');
    Route::get('/dashboard/data-pasien', [UserController::class, 'dataPasien'])->name('dashboard.data-pasien');
    Route::get('/dashboard/tambah-rekam-medis',[RekamMedisController::class,'index']);
    Route::post('/dashboard/tambah-rekam-medis',[RekamMedisController::class,'store']);
    Route::get('/',[RekamMedisController::class,'showRekamMedis']);

});