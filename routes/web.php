<?php
 
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('login', function () {
    return view('welcome');
})->name('login');

Route::get('register', function () {
    return view('welcome');
})->name('register'); 


Route::get('logout', function () {
    return view('welcome');
})->name('logout');
 
// Route::prefix('auth')->group(function() {
//     Route::post('login', [AuthController::class, 'login'])->name('auth.login');
//     Route::post('register', [AuthController::class, 'register'])->name('auth.register');
//     Route::post('email-verify', [AuthController::class, 'emailVerify'])->name('auth.email-verify');
//     Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('auth.reset-password');
// });


