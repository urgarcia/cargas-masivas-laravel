<?php

use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UploadController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\AuthController;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth.api', 'log.authenticated.user'])->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('user', [MenuController::class,'getUserInfo']);
    Route::get('people', [PersonController::class, 'index']);
    Route::post('bulkLoad', [UploadController::class, 'store']);
});