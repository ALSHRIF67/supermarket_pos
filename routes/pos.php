<?php
use App\Http\Controllers\POSController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/pos', [POSController::class, 'index'])->name('pos.index');
    Route::get('/pos/search', [POSController::class, 'search'])->name('pos.search');
    Route::post('/pos/order', [POSController::class, 'store'])->name('pos.store');
    Route::get('/pos/invoice/{order}', [POSController::class, 'invoice'])->name('pos.invoice');
});
