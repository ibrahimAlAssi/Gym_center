<?php

use App\Src\Admin\Club\Controllers\ContactController;
use App\Src\Admin\Club\Controllers\DietController;
use App\Src\Admin\Club\Controllers\FoodController;
use App\Src\Admin\Club\Controllers\GymController;
use App\Src\Admin\Club\Controllers\OrderDietController;
use App\Src\Admin\Club\Controllers\WorkController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:admin')->group(function () {
    Route::apiResources([
        'gyms' => GymController::class,
        'contacts' => ContactController::class,
        // Start Food
        'foods' => FoodController::class,
    ]);
    Route::put('foods/update-image/{food}', [FoodController::class, 'updateImage'])->name('food.updateImage');
    Route::prefix('diets')
        ->name('diets.')
        ->controller(DietController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::post('', 'store')->name('store');
            Route::post('{diet}', 'update')->name('update');
            Route::delete('{diet}', 'destroy')->name('destroy');
            Route::prefix('orders')
                ->name('orders.')
                ->controller(OrderDietController::class)
                ->group(function () {
                    Route::get('', 'index')->name('index');
                    Route::post('', 'store')->name('store');
                    Route::post('{orderDiet}', 'update')->name('update');
                });
        });
    Route::prefix('works')
        ->name('works.')
        ->controller(WorkController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::post('', 'store')->name('store');
            Route::post('{work}', 'update')->name('update');
            Route::delete('{work}', 'destroy')->name('destroy');
        });
});
