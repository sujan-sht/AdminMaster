<?php

use SujanSht\LaraAdmin\Http\Controllers\Auth\AuthenticatedSessionController;
use SujanSht\LaraAdmin\Http\Controllers\Auth\ConfirmablePasswordController;
use SujanSht\LaraAdmin\Http\Controllers\Auth\EmailVerificationNotificationController;
use SujanSht\LaraAdmin\Http\Controllers\Auth\EmailVerificationPromptController;
use SujanSht\LaraAdmin\Http\Controllers\Auth\NewPasswordController;
use SujanSht\LaraAdmin\Http\Controllers\Auth\PasswordController;
use SujanSht\LaraAdmin\Http\Controllers\Auth\PasswordResetLinkController;
use SujanSht\LaraAdmin\Http\Controllers\Auth\RegisteredUserController;
use SujanSht\LaraAdmin\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

