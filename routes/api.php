<?php

use Illuminate\Support\Facades\Route;

Route::post('verification_code/{type}', [\App\Http\Controllers\VerificationCodeController::class, 'store'])
    ->where('type', '(email|password)');

Route::post('users', [\App\Http\Controllers\UserController::class, 'store']);

Route::apiResource('password_reset', \App\Http\Controllers\PasswordResetController::class)
    ->only('store');
