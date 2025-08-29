<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::apiResource('users', UserController::class);
// /api/users (GET, POST)
// /api/users/{id} (GET, PUT, DELETE)
