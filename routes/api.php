<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UploadController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\AuthController;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth.api', 'log.authenticated.user'])->group(function () {
    Route::get('/user', function (Request $request) {
        return response()->json(['response' => "ok", "user" => $request], 200);
        return $request->user();
    });

    // Otras rutas protegidas...
});
Route::middleware('auth:api')->group(function () {
    Route::post('upload', [UploadController::class, 'store']);
    Route::get('persons', [PersonController::class, 'index']);
    Route::get('persons/{id}', [PersonController::class, 'show']);
});