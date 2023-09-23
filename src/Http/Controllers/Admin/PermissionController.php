<?php

namespace SujanSht\LaraAdmin\Http\Controllers\Admin;

use SujanSht\LaraAdmin\Contracts\PermissionRepositoryInterface;
use SujanSht\LaraAdmin\Http\Controllers\Controller;
use SujanSht\LaraAdmin\Http\Requests\PermissionRequest;
use SujanSht\LaraAdmin\Models\Admin\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $permissionRepositoryInterface;

    public function __construct(PermissionRepositoryInterface $permissionRepositoryInterface)
    {
        $this->permissionRepositoryInterface = $permissionRepositoryInterface;
        $this->authorizeResource(Permission::class,'permission');

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('lara-admin::admin.permission.index',$this->permissionRepositoryInterface->indexPermission());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lara-admin::admin.permission.create',$this->permissionRepositoryInterface->createPermission());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $request)
    {
        $this->permissionRepositoryInterface->storePermission($request);
        return redirect(adminRedirectRoute('permissions'))->with('message','Successfully Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        return view('lara-admin::admin.permission.show',$this->permissionRepositoryInterface->showPermission($permission));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('lara-admin::admin.permission.edit',$this->permissionRepositoryInterface->editPermission($permission));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionRequest $request, Permission $permission)
    {

        $this->permissionRepositoryInterface->updatePermission($request, $permission);
        return redirect(adminRedirectRoute('permissions'))->with('info','Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $this->permissionRepositoryInterface->destroyPermission($permission);
        return redirect(adminRedirectRoute('permissions'))->with('error','Deleted Successfully');
    }
}
