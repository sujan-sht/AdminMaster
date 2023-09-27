<?php

namespace SujanSht\LaraAdmin\Repositories;

use SujanSht\LaraAdmin\Models\Admin\Menu;
use SujanSht\LaraAdmin\Contracts\MenuRepositoryInterface;
use SujanSht\LaraAdmin\Http\Requests\MenuRequest;
use Illuminate\Support\Facades\Artisan;

class MenuRepository implements MenuRepositoryInterface
{
    // Menu Index
    public function indexMenu()
    {
        $menus = Menu::all();
        return compact('menus');
    }

    // Menu Create
    public function createMenu()
    {
        //
    }

    // Menu Store
    public function storeMenu(MenuRequest $request)
    {
        if($request->validated()){
            Artisan::call('make:crud ' .$request->name);
        }
    }

    // Menu Show
    public function showMenu(Menu $menu)
    {
        return compact('menu');
    }

    // Menu Edit
    public function editMenu(Menu $menu)
    {
        return compact('menu');
    }

    // Menu Update
    public function updateMenu(MenuRequest $request, Menu $menu)
    {

        $menu->update($request->validated());
    }

    // Menu Destroy
    public function destroyMenu(Menu $menu)
    {
        $menu->delete();
    }
}
