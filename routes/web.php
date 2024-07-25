<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('auth\login');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('otp', [LoginController::class, 'showOTPForm'])->name('otp.form');
Route::post('otp', [LoginController::class, 'verifyOTP'])->name('otp.verify');

Route::get('dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');