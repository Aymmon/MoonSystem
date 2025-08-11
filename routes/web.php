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
Route::get('/product/add', [ProductController::class, 'productAdd'])->name('product.add');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
Route::put('/products/update/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/delete/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/products/{id}/reduce-inventory/{qty}', [ProductController::class, 'reduceInventory']);

use App\Http\Controllers\ProductSizeController;
Route::post('/product-sizes', [ProductSizeController::class, 'store'])->name('product-sizes.store');
Route::put('/product-sizes/{id}', [ProductSizeController::class, 'update'])->name('product-sizes.update');
Route::delete('/product-sizes/{id}', [ProductSizeController::class, 'destroy'])->name('product-sizes.destroy');

use App\Http\Controllers\PosController;
Route::get('/pos', [PosController::class, 'posList'])->name('pos.list');
Route::post('/add-to-cart', [PosController::class, 'addToCart'])->name('pos.addToCart');
Route::post('/pos/update-cart', [PosController::class, 'updateCart'])->name('pos.updateCart');
Route::post('/remove-from-cart', [PosController::class, 'removeFromCart'])->name('pos.removeFromCart');
Route::post('/pos/checkout', [PosController::class, 'checkout'])->name('pos.checkout');
Route::get('/pos/cart-partial', [PosController::class, 'cartPartial'])->name('pos.cartPartial');

use App\Http\Controllers\TransactionsController;
Route::get('/transactions', [TransactionsController::class, 'transactionsList'])->name('transactions.list');
Route::get('/transactions/{id}', [TransactionsController::class, 'show'])->name('transactions.show');
Route::put('/transactions/{id}/cancel', [TransactionsController::class, 'cancel'])->name('transactions.cancel');

use App\Exports\TransactionsExport;
use Maatwebsite\Excel\Facades\Excel;
Route::get('/export-transactions', function () {
    return Excel::download(new TransactionsExport, 'transactions.xlsx');
})->name('export.transactions');

use App\Http\Controllers\CategoryController;
Route::get('/categories/list', [CategoryController::class, 'categoryList'])->name('categories.list');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

use App\Http\Controllers\UomController;
Route::get('/uoms', [UomController::class, 'index'])->name('uoms.index');
Route::get('/uoms/{id}', [UomController::class, 'show'])->name('uoms.show');
Route::post('/uoms', [UomController::class, 'store'])->name('uoms.store');
Route::put('/uoms/{id}', [UomController::class, 'update'])->name('uoms.update');
Route::delete('/uoms/{id}', [UomController::class, 'destroy'])->name('uoms.destroy');


use App\Http\Controllers\InventoryItemController;
// Inventory List
Route::get('/inventory', [InventoryItemController::class, 'index'])->name('inventory.index');
// Create Form
Route::get('/inventory/create', [InventoryItemController::class, 'create'])->name('inventory.create');
// Store Ingredient
Route::post('/inventory', [InventoryItemController::class, 'store'])->name('inventory.store');
// Edit Form
Route::get('/inventory/{inventory}/edit', [InventoryItemController::class, 'edit'])->name('inventory.edit');
// Update Ingredient
Route::put('/inventory/{inventory}', [InventoryItemController::class, 'update'])->name('inventory.update');
// Delete Ingredient
Route::delete('/inventory/{inventory}', [InventoryItemController::class, 'destroy'])->name('inventory.destroy');
