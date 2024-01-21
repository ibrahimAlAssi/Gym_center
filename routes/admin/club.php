<?php

use App\Src\Admin\Club\Controllers\GymController;
use App\Src\Admin\Club\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:admin')->group(function () {
    Route::apiResources([
        'gym' => GymController::class,
        'contact' => ContactController::class,
    ]);
});
