<?php

use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\Http\Controllers\AuthorizationController;
use Laravel\Passport\Http\Controllers\ClientController;
use Laravel\Passport\Http\Controllers\PersonalAccessTokenController;
use Laravel\Passport\Http\Controllers\ScopeController;
use Laravel\Passport\Http\Controllers\TransientTokenController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'oauth'], function () {
    Route::post('token', [AccessTokenController::class, 'issueToken']);
    Route::get('authorize', [AuthorizationController::class, 'authorize']);
    Route::post('token/refresh', [TransientTokenController::class, 'refresh']);
    Route::post('clients', [ClientController::class, 'store']);
    Route::get('clients', [ClientController::class, 'forUser']);
    Route::delete('clients/{client_id}', [ClientController::class, 'destroy']);
    Route::post('scopes', [ScopeController::class, 'all']);
    Route::post('personal-access-tokens', [PersonalAccessTokenController::class, 'store']);
    Route::get('personal-access-tokens', [PersonalAccessTokenController::class, 'forUser']);
    Route::delete('personal-access-tokens/{token_id}', [PersonalAccessTokenController::class, 'destroy']);
});
