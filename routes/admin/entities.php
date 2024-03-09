<?php

use App\Src\Admin\Entities\Controllers\AdminController;
use App\Src\Admin\Entities\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:admin')->group(function () {
    Route::prefix('auth')
        ->name('auth.')
        ->controller(AuthController::class)
        ->group(function () {
            Route::post('login', 'login')->name('login')->withoutMiddleware('auth:admin');
            Route::delete('logout', 'logout')->name('logout');
            Route::get('user', 'user')->name('user');
        });
    Route::apiResource('admins', AdminController::class);
});
Route::get('/test', function () {
    return 'hi';
});
