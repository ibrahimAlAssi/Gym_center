<?php

use App\Src\Player\Club\Controllers\DietController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:player')->group(function () {
    Route::prefix('diets')
        ->name('diets.')
        ->controller(DietController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
        });
});
