<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\AuthController;
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

use App\Http\Controllers\UserController;
Route::get('/user', [UserController::class, 'userList'])->name('user-list');
Route::post('/register', [UserController::class, 'register']);
Route::get('/profile', [UserController::class, 'profile'])->middleware('auth');

Route::get('/dashboard', function () { return view('dashboard'); })->middleware('auth')->name('dashboard');

