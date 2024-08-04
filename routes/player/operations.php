<?php

use App\Src\Player\Operations\Controllers\OrderController;
use App\Src\Player\Operations\Controllers\PaymentController;
use App\Src\Player\Operations\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:player')->group(function () {
    Route::get('my-wallet', [WalletController::class, 'index'])->name('wallet.index');

    Route::prefix('orders')
        ->name('orders.')
        ->controller(OrderController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::post('', 'store')->name('store');
        });
    Route::prefix('payments')
        ->name('payments.')
        ->controller(PaymentController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
        });
});
