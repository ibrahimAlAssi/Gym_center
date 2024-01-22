<?php

use App\Src\Admin\Entities\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')
    ->name('auth.')
    ->controller(AuthController::class)
    ->group(function () {
        Route::post('login', 'login')->name('login');
        Route::delete('logout', 'logout')->name('logout')->middleware('auth:admin');
        Route::get('user', 'user')->name('user')->middleware('auth:admin');
    });
