<?php

use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/admin', function () {
    return 'test';
});
