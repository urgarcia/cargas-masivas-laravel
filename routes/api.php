<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UploadController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\AuthController;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::middleware('auth:api')->group(function () {
    Route::post('upload', [UploadController::class, 'store']);
    Route::get('persons', [PersonController::class, 'index']);
    Route::get('persons/{id}', [PersonController::class, 'show']);
});