<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// MIDDLEWARE AUTH
Route::middleware('auth:api')->group(function() {
    Route::post('/sign-out',  [AuthController::class, 'signout']);
    Route::post('/refresh-token',  [AuthController::class, 'refreshToken']);
});

// MIDDLEWARE JWT REFRESH
Route::middleware('jwt.refresh')->group(function() {
    Route::post('/refresh-token',  [AuthController::class, 'refreshToken']);
});

// SIGNUP / REGISTER
Route::post('/sign-up', [AuthController::class, 'signup']);
Route::post('/sign-in', [AuthController::class, 'signin']);
