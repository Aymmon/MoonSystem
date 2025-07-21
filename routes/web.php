<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index']) ->middleware('auth') ->name('dashboard');

use App\Http\Controllers\AuthController;
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

use App\Http\Controllers\UserController;
Route::get('/user', [UserController::class, 'userList'])->name('user-list');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/users/{user}', [UserController::class, 'profile'])->name('user.profile');

Route::get('/profile', [UserController::class, 'profile'])->middleware('auth');

use App\Http\Controllers\ProductController;
Route::get('/product', [ProductController::class, 'productList'])->name('product.list');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
Route::put('/products/update/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/delete/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

use App\Http\Controllers\PosController;
Route::get('/pos', [PosController::class, 'posList'])->name('pos.list');
Route::post('/add-to-cart', [PosController::class, 'addToCart'])->name('pos.addToCart');
Route::post('/pos/update-cart', [PosController::class, 'updateCart'])->name('pos.updateCart');
Route::post('/remove-from-cart', [PosController::class, 'removeFromCart'])->name('pos.removeFromCart');
Route::post('/pos/checkout', [PosController::class, 'checkout'])->name('pos.checkout');

use App\Http\Controllers\OrderController;
Route::get('/order', [OrderController::class, 'orderList'])->name('order.list');
