<?php

use App\Src\Player\Entities\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:player')->group(function () {
    Route::prefix('auth')
        ->name('auth.')
        ->controller(AuthController::class)
        ->group(function () {
            Route::post('login', 'login')->name('login')->withoutMiddleware('auth:player');
            Route::delete('logout', 'logout')->name('logout');
            Route::get('user', 'user')->name('user');
        });
});
