<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::post('/login', [AuthController::class, 'login']);
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

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