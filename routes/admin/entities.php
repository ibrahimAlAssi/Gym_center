<?php

use Illuminate\Support\Facades\Route;
use App\Src\Admin\Entities\Controllers\AuthController;
use App\Src\Admin\Entities\Controllers\AdminController;


Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');

Route::middleware('auth:admin')->group(function () {
    Route::prefix('auth')
        ->name('auth.')
        ->controller(AuthController::class)
        ->group(function () {
            Route::delete('logout', 'logout')->name('logout');
            Route::get('user', 'user')->name('user');
        });

    Route::apiResource('admins', AdminController::class)
        // ->middleware('super-admin')
    ;
});
