<?php

use App\Src\Coach\Operations\Controllers\OrderController;
use App\Src\Coach\Operations\Controllers\PaymentController;
use App\Src\Coach\Operations\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:coach')->group(function () {
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
