<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\POSController;

use App\Http\Controllers\Web\ExpenseController;

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
    Route::get('/pos', [PosController::class, 'index'])->name('pos.index');
    Route::get('/pos/create', [PosController::class, 'create'])->name('pos.create');
    Route::get('/pos/search', [PosController::class, 'search'])->name('pos.search');
    Route::post('/pos/order', [PosController::class, 'store'])->name('pos.store');
    Route::get('/pos/invoice/{order}', [PosController::class, 'invoice'])->name('pos.invoice');
});



Route::prefix('expenses')->group(function () {
    Route::get('/', [ExpenseController::class, 'index'])->name('expenses.index');
    Route::get('/create', [ExpenseController::class, 'create'])->name('expenses.create');
    Route::post('/', [ExpenseController::class, 'store'])->name('expenses.store');
    Route::get('/{id}', [ExpenseController::class, 'show'])->name('expenses.show');
    Route::get('/{id}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit');
    Route::put('/{id}', [ExpenseController::class, 'update'])->name('expenses.update');
    Route::delete('/{id}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');
});
require __DIR__.'/auth.php';
