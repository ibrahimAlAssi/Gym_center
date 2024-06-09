<?php

use App\Src\Admin\Plans\Controllers\PlanController;
use App\Src\Admin\Plans\Controllers\ServiceController;
use App\Src\Admin\Plans\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:admin')->group(function () {
    Route::prefix('services')
        ->name('services.')
        ->controller(ServiceController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::post('', 'store')->name('store');
            Route::post('{service}', 'update')->name('update');
            Route::delete('{service}', 'destroy')->name('destroy');
        });

    Route::prefix('plans')
        ->name('plans.')
        ->controller(PlanController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('{plan}', 'show')->name('show');
            Route::post('', 'store')->name('store');
            Route::post('{plan}', 'update')->name('update');
            Route::delete('{plan}', 'destroy')->name('destroy');
        });

    Route::prefix('subscriptions')
        ->name('subscriptions.')
        ->controller(SubscriptionController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('{subscription}', 'show')->name('show');
            Route::post('', 'store')->name('store');
            Route::post('{subscription}', 'update')->name('update');
            Route::delete('{subscription}', 'destroy')->name('destroy');
        });
});
