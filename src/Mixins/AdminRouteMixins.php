<?php

namespace SujanSht\LaraAdmin\Mixins;

use SujanSht\LaraAdmin\Http\Controllers\admin\DashboardController;
use SujanSht\LaraAdmin\Http\Controllers\Admin\MenuController;
use SujanSht\LaraAdmin\Http\Controllers\Admin\PermissionController;
use SujanSht\LaraAdmin\Http\Controllers\Admin\RoleController;
use SujanSht\LaraAdmin\Http\Controllers\Admin\UserController;
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


