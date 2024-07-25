<?php

use App\Src\Player\Operations\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:player')->group(function () {
    Route::prefix('orders')
        ->name('orders.')
        ->controller(OrderController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::post('', 'store')->name('store');
        });
});
