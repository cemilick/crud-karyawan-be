<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use Spatie\RouteDiscovery\Discovery\Discover;


Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');
});
Route::middleware('auth:api')->group(function () {
    Discover::controllers()->in(app_path('Http\Controllers\Api'));
});
