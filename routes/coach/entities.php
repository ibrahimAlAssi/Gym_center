<?php

use Illuminate\Support\Facades\Route;
use App\Src\Coach\Entities\Controllers\AuthController;
use App\Src\Coach\Entities\Controllers\CoachController;

Route::middleware('auth:coach')->group(function () {
    Route::prefix('auth')
        ->name('auth.')
        ->controller(AuthController::class)
        ->group(function () {
            Route::post('login', 'login')->name('login')->withoutMiddleware('auth:coach');
            Route::delete('logout', 'logout')->name('logout');
            Route::get('user', 'user')->name('user');
            Route::withoutMiddleware('auth:coach')->middleware('guest')->group(function () {
                Route::post('forget-password', 'forgetPassword')->name('forgetPassword');
                Route::post('reset-password', 'resetPassword')->name('resetPassword');
            });
        });

    // Start Coaches
    Route::prefix('coaches')
        ->name('coaches.')
        ->controller(CoachController::class)
        ->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('show', 'show')->name('show');
            Route::post('update', 'update')->name('update');
            Route::post('update-image', 'updateImage')->name('updateImage');
        });
});
