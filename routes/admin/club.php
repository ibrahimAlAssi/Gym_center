<?php

use App\Src\Admin\Club\Controllers\ContactController;
use App\Src\Admin\Club\Controllers\GymController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:admin')->group(function () {
    Route::apiResources([
        'gyms' => GymController::class,
        'contacts' => ContactController::class,
    ]);
});
