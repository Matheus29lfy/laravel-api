<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::prefix('api')->group(function () {
    Route::apiResource('products', ProductController::class);
});

Route::get('/', function () {
    return view('welcome');
});
