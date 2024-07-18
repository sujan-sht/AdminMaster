<?php

use Illuminate\Support\Facades\Route;
use SujanSht\AdminMaster\Http\Controllers\Auth\VerifyEmailController;
use SujanSht\AdminMaster\Http\Controllers\Auth\ConfirmablePasswordController;
use SujanSht\AdminMaster\Http\Controllers\Auth\AuthenticatedSessionController;
use SujanSht\AdminMaster\Http\Controllers\Auth\EmailVerificationPromptController;
use SujanSht\AdminMaster\Http\Controllers\Auth\EmailVerificationNotificationController;
use SujanSht\AdminMaster\Http\Controllers\Admin\MenuController;
use SujanSht\AdminMaster\Http\Controllers\Admin\RoleController;
use SujanSht\AdminMaster\Http\Controllers\Admin\UserController;
use SujanSht\AdminMaster\Http\Controllers\Auth\PasswordController;
use SujanSht\AdminMaster\Http\Controllers\Admin\DashboardController;
use SujanSht\AdminMaster\Http\Controllers\Admin\PermissionController;
use SujanSht\AdminMaster\Http\Controllers\Admin\SettingController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the AdminMasterServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Auth routes
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


// System Routes
Route::get('dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
Route::resource('roles',RoleController::class);
Route::resource('users',UserController::class);
Route::resource('permissions',PermissionController::class);
Route::resource('menus',MenuController::class);
Route::resource('settings',SettingController::class);

Route::post('setting-store', [SettingController::class, 'setting_store'])->name('setting_store');



