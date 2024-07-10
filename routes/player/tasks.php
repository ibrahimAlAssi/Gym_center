<?php

use App\Src\Player\Tasks\Controllers\ScheduleController;
use App\Src\Player\Tasks\Controllers\TaskController;
use App\Src\Player\Tasks\Controllers\TypeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:player')->group(function () {
    Route::get('types', [TypeController::class, 'index'])->name('types.index');

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
