<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\RumahSakitController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.post');

Route::middleware(Authenticate::class)->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('auth.dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::resource('rumah-sakit', RumahSakitController::class)->names('auth.rumah-sakit');

    Route::resource('pasien', PasienController::class)->names('auth.pasien');
    Route::get('/pasien-filter', [PasienController::class, 'filter'])->name('auth.pasien.filter');
});
