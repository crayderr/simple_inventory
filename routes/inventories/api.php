<?php

use Illuminate\Support\Facades\Route;

Route::post(
    '/inventory/transfer',
    [App\Http\Controllers\Api\Inventory\InventoryMovementController::class, '__invoke']);