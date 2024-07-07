<?php

use App\Src\Coach\Club\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:coach')->group(function () {
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
});
