<?php

use App\Src\Player\Club\Controllers\CartController;
use App\Src\Player\Club\Controllers\DietController;
use App\Src\Player\Club\Controllers\OrderDietController;
use App\Src\Player\Club\Controllers\ProductController;
use App\Src\Player\Club\Controllers\WorkController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:player')->group(function () {
    Route::get('works', [WorkController::class, 'index'])->name('works.index');
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::prefix('diets')
        ->name('diets.')
        ->controller(DietController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::prefix('orders')
                ->name('orders.')
                ->controller(OrderDietController::class)
                ->group(function () {
                    Route::get('', 'index')->name('index');
                    Route::post('', 'store')->name('store');
                    Route::post('{orderDiet}', 'update')->name('update');
                });
        });
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
