<?php

declare(strict_types=1);

use App\Http\Controllers\API\User\BalanceController;
use App\Http\Controllers\API\User\HistoryController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/user/balance', BalanceController::class)->name('user.balance');
    Route::get('/user/balance/history', HistoryController::class)->name('user.balance.history');
});
