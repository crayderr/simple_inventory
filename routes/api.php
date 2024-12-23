<?php

use Illuminate\Support\Facades\Route;

Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

include 'products/api.php';
include 'stores/api.php';
include 'inventories/api.php';