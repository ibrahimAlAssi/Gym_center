<?php

use Illuminate\Support\Facades\Route;
use App\Src\Player\Club\Controllers\DietController;
use App\Src\Player\Club\Controllers\FoodController;
use App\Src\Player\Club\Controllers\OrderDietController;

Route::middleware('auth:player')->group(function () {
    Route::prefix('diets')
        ->name('diets.')
        ->controller(DietController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::prefix('orders')
                ->name('orders.')
                ->controller(OrderDietController::class)
                ->group(function () {
                    Route::get('', 'index')->name('index');
                    Route::post('', 'store')->name('store');
                    Route::post('{orderDiet}', 'update')->name('update');
                });
        });
    //Start Food
    Route::prefix('foods')
        ->name('foods.')
        ->controller(FoodController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
        });
});
