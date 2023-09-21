<?php

namespace SujanSht\LaraAdmin\Providers;

use SujanSht\LaraAdmin\Models\Admin\Menu;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class SystemServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('admin.*', function ($view) {
            $menus = Menu::active()->position()->get();
            $view->with([
                'menus' => $menus,
            ]);
        });

    }
}
