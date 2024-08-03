<?php

use App\Src\Coach\Tasks\Controllers\ScheduleController;
use App\Src\Coach\Tasks\Controllers\TaskController;
use App\Src\Coach\Tasks\Controllers\TypeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:coach')->group(function () {
    Route::get('types', [TypeController::class, 'index'])->name('types.index');
    Route::prefix('tasks')
        ->name('tasks.')
        ->controller(TaskController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/metadata', 'metadata')->name('metadata');
            Route::post('', 'store')->name('store');
            Route::post('{task}', 'update')->name('update');
            Route::delete('{task}', 'destroy')->name('destroy');
        });

    Route::prefix('schedules')
    ->name('schedules.')
    ->controller(ScheduleController::class)
    ->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('', 'store')->name('index');
        Route::post('{schedule}', 'update')->name('index');
    });
});
