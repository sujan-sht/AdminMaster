<?php

namespace SujanSht\AdminMaster\Mixins;

use SujanSht\AdminMaster\Http\Controllers\admin\DashboardController;
use SujanSht\AdminMaster\Http\Controllers\Admin\MenuController;
use SujanSht\AdminMaster\Http\Controllers\Admin\PermissionController;
use SujanSht\AdminMaster\Http\Controllers\Admin\RoleController;
use SujanSht\AdminMaster\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

class AdminRouteMixins
{
    //Admin Routes
    public function admin()
    {
        return function (){


            Route::get('dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
            Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
                Route::resource('roles',RoleController::class);
                Route::resource('users',UserController::class);
                Route::resource('permissions',PermissionController::class);
                Route::resource('menus',MenuController::class);

            });
        };
    }
}


