<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SendEmailVerificationNotificationController;
use App\Http\Controllers\Auth\SendPasswordResetLinkController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::post('v1/register', [AuthController::class, 'register'])
    ->name('register');

Route::post('v1/login', [AuthController::class, 'login'])
    ->name('login');

Route::post('v1/refresh', [AuthController::class, 'refresh'])
    ->name('refresh');

Route::post('v1/forgot-password', SendPasswordResetLinkController::class)
    ->name('password.email');

Route::post('v1/reset-password', ResetPasswordController::class)
    ->name('password.update');

Route::middleware('auth:api')->group(function () {
    Route::post('v1/email/verification-notification', SendEmailVerificationNotificationController::class)
        ->middleware(['throttle:6,1'])
        ->name('verification.send');

    Route::get('v1/verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('v1/logout', [AuthController::class, 'logout'])
        ->name('logout');
});
