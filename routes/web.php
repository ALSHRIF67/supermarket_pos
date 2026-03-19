<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\POSController;


Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class)->except(['show']);
Route::resource('suppliers', SupplierController::class)->except(['show']);

// Optional: additional route for low stock filter
Route::get('products/low-stock', [ProductController::class, 'lowStock'])->name('products.low-stock');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/pos', [POSController::class, 'index'])->name('pos.index');
    Route::get('/pos/search', [POSController::class, 'search'])->name('pos.search');
    Route::post('/pos/order', [POSController::class, 'store'])->name('pos.store');
    Route::get('/pos/invoice/{order}', [POSController::class, 'invoice'])->name('pos.invoice');
});
require __DIR__.'/auth.php';
