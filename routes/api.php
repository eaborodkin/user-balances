<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

Route::middleware(['auth:sanctum'])->group(function ($router) {
    Route::get('/check-token', fn() => response()->json(true));

    Route::get('/user/balance', \App\Http\Controllers\API\User\BalanceController::class);
    Route::get('/user/balance/history', \App\Http\Controllers\API\User\HistoryController::class);
});
