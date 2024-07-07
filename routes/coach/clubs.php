<?php

use App\Src\Coach\Club\Controllers\CartController;
use App\Src\Coach\Club\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:coach')->group(function () {
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::prefix('carts')
        ->name('carts.')
        ->controller(CartController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::post('', 'store')->name('store');
            Route::post('/{cart}', 'update')->name('update');
            Route::delete('/{cart}', 'destroy')->name('destroy');
        });
});
