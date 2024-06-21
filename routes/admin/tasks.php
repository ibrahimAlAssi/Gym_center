<?php

use App\Src\Admin\Tasks\Controllers\TaskController;
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
});