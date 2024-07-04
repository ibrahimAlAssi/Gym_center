<?php

use Illuminate\Support\Facades\Route;
use App\Src\Player\Tasks\Controllers\TaskController;
use App\Src\Player\Tasks\Controllers\ScheduleController;

Route::middleware('auth:player')->group(function () {
    Route::prefix('tasks')
        ->name('tasks.')
        ->controller(TaskController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
        });

    Route::prefix('schedules')
        ->name('schedules.')
        ->controller(ScheduleController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::post('update-task-status', 'updateTaskStatus');
        });
});
