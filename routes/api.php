<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

Route::post('/orders', [OrderController::class, 'store']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/low-stock', [ProductController::class, 'lowStock']);
Route::get('/customers/{email}/orders', [OrderController::class, 'history']);
Route::get('/customers/by-email/{email}', [OrderController::class, 'customerByEmail']);
?>