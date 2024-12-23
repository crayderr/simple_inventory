<?php

use Illuminate\Support\Facades\Route;

Route::get(
    'stores/{id}/inventory',
    [App\Http\Controllers\Api\Store\GetStoreInventoryController::class, '__invoke']
)->middleware('auth:sanctum');
