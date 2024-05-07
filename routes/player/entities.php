<?php

use App\Src\Player\Entities\Controllers\AuthController;
use App\Src\Player\Entities\Controllers\ChatController;
use App\Src\Player\Entities\Controllers\CoachController;
use App\Src\Player\Entities\Controllers\FeedbackController;
use App\Src\Player\Entities\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

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
    // Start Chat
    Route::prefix('chats')
        ->name('chats.')
        ->controller(ChatController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::delete('{chat}', 'destroy')->name('destroy');
        });

    //Start Messages
    Route::prefix('chat/{chat}/messages')
        ->name('messages.')
        ->controller(MessageController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::post('', 'store')->name('store');
            Route::post('/{message}', 'update')->name('update');
            Route::delete('/{message}', 'destroy')->name('destroy');
        });

    // Start Feedbacks
    Route::resource('feedbacks', FeedbackController::class);
});
