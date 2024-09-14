<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('home', function () {
    return view('welcome');
})->name('home');

Route::get('login', function () {
    return view('welcome');
})->name('login');

Route::get('register', function () {
    return view('welcome');
})->name('register');

Route::get('reset-password', function () {
        return view('welcome');
    })->name('reset-password');



    Route::get('reset-password-update', function () {
        $token = request()->query('token');
        $email = request()->query('email');
        return view('welcome', compact('email', 'token'));
    })->name('reset-password-update');



    
Route::middleware('auth')->group(function () {

    Route::get('logout', function () {
        return view('welcome');
    })->name('logout');


    Route::get('verify-email', function () {
        return view('welcome');
    })->name('verify-email');
});
