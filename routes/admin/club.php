<?php

use App\Src\Admin\Club\Controllers\ContactController;
use App\Src\Admin\Club\Controllers\GymController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:admin')->group(function () {
    Route::apiResources([
        'gym' => GymController::class,
        'contact' => ContactController::class,
    ]);
});
