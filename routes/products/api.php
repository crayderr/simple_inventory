<?php

use Illuminate\Support\Facades\Route;

Route::get(
    'products',
    [App\Http\Controllers\Api\Product\GetProductsController::class, '__invoke']
)->middleware('auth:sanctum');

Route::get(
    'products/{id}',
    [App\Http\Controllers\Api\Product\GetProductDetailController::class, '__invoke']
)->middleware('auth:sanctum');

Route::post(
    'products',
    [App\Http\Controllers\Api\Product\CreateProductController::class, '__invoke']
)->middleware('auth:sanctum');

Route::put(
    'products/{id}',
    [App\Http\Controllers\Api\Product\UpdateProductController::class, '__invoke']
)->middleware('auth:sanctum');

Route::delete(
    'products/{id}',
    [App\Http\Controllers\Api\Product\DeleteProductController::class, '__invoke']
)->middleware('auth:sanctum');