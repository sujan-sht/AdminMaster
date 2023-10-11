<?php

namespace SujanSht\AdminMaster\Contracts;

use SujanSht\AdminMaster\Http\Requests\PermissionRequest;
use SujanSht\AdminMaster\Models\Admin\Permission;

interface PermissionRepositoryInterface
{
    public function indexPermission();

    public function createPermission();

    public function storePermission(PermissionRequest $request);

    public function showPermission(Permission $permission);

    public function editPermission(Permission $permission);

    public function updatePermission(PermissionRequest $request, Permission $permission);

    public function destroyPermission(Permission $permission);
}
