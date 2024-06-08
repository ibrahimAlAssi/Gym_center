<?php

use App\Src\Player\Plans\Controllers\PlanController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:player')->group(function () {
    Route::prefix('plans')
        ->name('plans.')
        ->controller(PlanController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('{plan}', 'show')->name('show');
        });
});
