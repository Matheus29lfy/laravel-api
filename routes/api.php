<?php
// routes/api.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

 Route::apiResource('products', ProductController::class);
//  Route::get('/products', [ProductController::class, 'index']);
//  Route::post('/products', [ProductController::class, 'store']);
