<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('password_reset', [\App\Http\Controllers\Auth\PasswordResetController::class, 'store']);
    Route::post('tokens', [\App\Http\Controllers\Auth\TokenController::class, 'store']);
    Route::get('user', [\App\Http\Controllers\Auth\UserController::class, 'show'])->middleware('auth:sanctum');
});

Route::post('verification_code/{type}', [\App\Http\Controllers\VerificationCodeController::class, 'store'])
    ->where('type', '(email|password)');

Route::post('users', [\App\Http\Controllers\UserController::class, 'store']);
Route::apiResource('users', \App\Http\Controllers\UserController::class)
    ->only('show')
    ->middleware('auth:sanctum');

Route::prefix('users/{id}')->group(function () {
    Route::apiResource('activities', \App\Http\Controllers\User\ActivityController::class)->middleware('auth:sanctum');
});
