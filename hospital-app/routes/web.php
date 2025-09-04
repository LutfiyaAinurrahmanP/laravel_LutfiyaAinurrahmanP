<?php

use App\Http\Controllers\AuthController;
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
    Route::get('/rumah-sakit', function () {
        return '<h1>Halaman Rumah Sakit</h1><p>Akan dibuat nanti</p><a href="/dashboard">Kembali ke Dashboard</a>';
    })->name('rumah-sakit.index');
    Route::get('/pasien', function () {
        return '<h1>Halaman Pasien</h1><p>Akan dibuat nanti</p><a href="/dashboard">Kembali ke Dashboard</a>';
    })->name('pasien.index');
});
