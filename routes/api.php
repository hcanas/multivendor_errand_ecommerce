<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('verification_code', [\App\Http\Controllers\VerificationCodeController::class, 'store']);
