<?php

use App\Src\Admin\Entities\Controllers\AdminController;
use App\Src\Admin\Entities\Controllers\AuthController;
use App\Src\Admin\Entities\Controllers\CoachController;
use App\Src\Admin\Entities\Controllers\FeedbackController;
use App\Src\Admin\Entities\Controllers\PlayerController;
use Illuminate\Support\Facades\Route;

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
    Route::put('coaches/update-image/{coach}', [CoachController::class, 'updateImage']);
    Route::apiResources([
        'admins' => AdminController::class,
        'coaches' => CoachController::class,
        'feedbacks' => FeedbackController::class,
    ]);
    // Notification
    // Route::post('admins/notifications-markAsRead', [AdminController::class, 'markAsReadAll']);
    // Route::post(
    //     'admins/notification-markAsRead/{notificationId?}',
    //     [AdminController::class, 'markAsReadNotification']
    // );

    Route::prefix('players')
        ->name('players.')
        ->controller(PlayerController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::post('', 'store')->name('store');
            Route::post('{player}', 'update')->name('update');
            Route::delete('{player}', 'destroy')->name('destroy');
        });
});
