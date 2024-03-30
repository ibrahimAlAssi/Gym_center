<?php

use Illuminate\Support\Facades\Route;
use App\Src\Player\Entities\Controllers\AuthController;
use App\Src\Player\Entities\Controllers\CoachController;
use App\Src\Player\Entities\Controllers\FeedbackController;

Route::middleware('auth:player')->group(function () {
    Route::prefix('auth')
        ->name('auth.')
        ->controller(AuthController::class)
        ->group(function () {
            Route::post('login', 'login')->name('login')->withoutMiddleware('auth:player');
            Route::delete('logout', 'logout')->name('logout');
            Route::get('user', 'user')->name('user');
            Route::withoutMiddleware('auth:player')->middleware('guest')->group(function () {
                Route::post('forget-password', 'forgetPassword')->name('forgetPassword');
                Route::post('reset-password', 'resetPassword')->name('resetPassword');
            });
        });

    // Start Coaches
    Route::prefix('coaches')
        ->name('coaches.')
        ->controller(CoachController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('{coach}', 'show')->name('show');
        });

    // Start Feedbacks
    Route::resource('feedbacks', FeedbackController::class);
});
