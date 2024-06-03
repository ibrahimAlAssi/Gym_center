<?php

use App\Src\Player\Tasks\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:player')->group(function () {
    Route::prefix('tasks')
        ->name('tasks.')
        ->controller(TaskController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
        });
});
