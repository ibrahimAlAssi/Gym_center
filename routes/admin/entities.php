<?php

use Illuminate\Support\Facades\Route;
use App\Src\Admin\Entities\Controllers\AuthController;
use App\Src\Admin\Entities\Controllers\AdminController;
use App\Src\Admin\Entities\Controllers\CoachController;
use App\Src\Admin\Entities\Controllers\FeedbackController;

Route::middleware('auth:admin')->group(function () {
    Route::prefix('auth')
        ->name('auth.')
        ->controller(AuthController::class)
        ->group(function () {
            Route::post('login', 'login')->name('login')->withoutMiddleware('auth:admin');
            Route::delete('logout', 'logout')->name('logout');
            Route::get('user', 'user')->name('user');
            Route::withoutMiddleware('auth:admin')->middleware('guest')->group(function () {
                Route::post('forget-password', 'forgetPassword')->name('forgetPassword');
                Route::post('reset-password', 'resetPassword')->name('resetPassword');
            });
        });
    Route::apiResource('admins', AdminController::class);
    // Start Coaches
    Route::apiResource('coaches', CoachController::class);
    Route::put('coaches/update-image/{coach}', [CoachController::class, 'updateImage']);
    // Start Feedbacks
    Route::resource('feedbacks', FeedbackController::class);
});
