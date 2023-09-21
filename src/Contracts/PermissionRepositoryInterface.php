<?php

namespace SujanSht\LaraAdmin\Contracts;

use SujanSht\LaraAdmin\Http\Requests\PermissionRequest;
use SujanSht\LaraAdmin\Models\Admin\Permission;

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
