<?php

use Illuminate\Support\Facades\Route;
use App\Src\Admin\Club\Controllers\GymController;
use App\Src\Admin\Club\Controllers\FoodController;
use App\Src\Admin\Club\Controllers\ContactController;

Route::middleware('auth:admin')->group(function () {
    Route::apiResources([
        'gyms' => GymController::class,
        'contacts' => ContactController::class,
        // Start Food
        'foods' => FoodController::class,
    ]);
    Route::put('foods/update-image/{food}', [FoodController::class, 'updateImage'])->name('food.updateImage');
});
