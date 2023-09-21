<?php

namespace SujanSht\LaraAdmin\Http\Controllers\Admin;

use SujanSht\LaraAdmin\Contracts\MenuRepositoryInterface;
use SujanSht\LaraAdmin\Http\Controllers\Controller;
use SujanSht\LaraAdmin\Http\Requests\MenuRequest;
use SujanSht\LaraAdmin\Models\Admin\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected $menuRepositoryInterface;

    public function __construct(MenuRepositoryInterface $menuRepositoryInterface)
    {
        $this->menuRepositoryInterface = $menuRepositoryInterface;
        $this->authorizeResource(Menu::class,'menu');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.menu.index',$this->menuRepositoryInterface->indexMenu());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuRequest $request)
    {
        $this->menuRepositoryInterface->storeMenu($request);
        return redirect(adminRedirectRoute('menus'))->with('message','Successfully Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        return view('admin.menu.show',$this->menuRepositoryInterface->showMenu($menu));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        return view('admin.menu.edit',$this->menuRepositoryInterface->editMenu($menu));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuRequest $request, Menu $menu)
    {

        $this->menuRepositoryInterface->updateMenu($request, $menu);
        return redirect(adminRedirectRoute('menus'))->with('info','Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $this->menuRepositoryInterface->destroyMenu($menu);
        return redirect(adminRedirectRoute('menus'))->with('error','Deleted Successfully');
    }
}
