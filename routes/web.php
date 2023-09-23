<?php

use Illuminate\Support\Facades\Route;
use SujanSht\LaraAdmin\Http\Controllers\Admin\MenuController;
use SujanSht\LaraAdmin\Http\Controllers\Admin\RoleController;
use SujanSht\LaraAdmin\Http\Controllers\Admin\UserController;
use SujanSht\LaraAdmin\Http\Controllers\Auth\PasswordController;
use SujanSht\LaraAdmin\Http\Controllers\admin\DashboardController;
use SujanSht\LaraAdmin\Http\Controllers\Admin\PermissionController;
use SujanSht\LaraAdmin\Http\Controllers\Auth\VerifyEmailController;
use SujanSht\LaraAdmin\Http\Controllers\Auth\ConfirmablePasswordController;
use SujanSht\LaraAdmin\Http\Controllers\Auth\AuthenticatedSessionController;
use SujanSht\LaraAdmin\Http\Controllers\Auth\EmailVerificationPromptController;
use SujanSht\LaraAdmin\Http\Controllers\Auth\EmailVerificationNotificationController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the LaraAdminServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// require __DIR__.'/auth.php';

// Route::authRoutes();

// Route::prefix('admin')->group(function () {
    Route::get('dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
    Route::resource('roles',RoleController::class);
    Route::resource('users',UserController::class);
    Route::resource('permissions',PermissionController::class);
    Route::resource('menus',MenuController::class);

// });
Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
