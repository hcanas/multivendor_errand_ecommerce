<?php

use Illuminate\Support\Facades\Route;

Route::post('verification_code/{type}', [\App\Http\Controllers\VerificationCodeController::class, 'store'])
    ->where('type', '(email|password)');

Route::post('users', [\App\Http\Controllers\UserController::class, 'store']);

Route::prefix('auth')->group(function () {
    Route::post('password_reset', [\App\Http\Controllers\Auth\PasswordResetController::class, 'store']);
    Route::post('tokens', [\App\Http\Controllers\Auth\TokenController::class, 'store']);
    Route::get('user', [\App\Http\Controllers\Auth\UserController::class, 'show'])->middleware('auth:sanctum');
});
