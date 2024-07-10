<?php

use App\Src\Admin\Tasks\Controllers\TaskController;
use App\Src\Admin\Tasks\Controllers\TypeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:admin')->group(function () {
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
    Route::prefix('types')
        ->name('types.')
        ->controller(TypeController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::post('', 'store')->name('store');
            Route::post('{type}', 'update')->name('update');
            Route::delete('{type}', 'destroy')->name('destroy');
        });
});
