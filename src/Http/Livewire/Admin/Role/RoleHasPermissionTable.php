<?php

namespace SujanSht\LaraAdmin\Http\Livewire\Admin\Role;

use SujanSht\LaraAdmin\Models\Admin\Permission;
use SujanSht\LaraAdmin\Models\Admin\Role;
use Livewire\Component;

class RoleHasPermissionTable extends Component
{
    public $role;
    public $modules;
    public $permissions;
    public $role_models;
    public $remaining_modules;
    public $model_name;

    public function mount(Role $role)
    {
        $this->setRolePermission($role);
    }


    public function makeModulePermission()
    {
        Permission::create([
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'role_id' => $this->role->id,
            'model' => $this->model_name,
        ]);
        $this->permissions = Permission::where('role_id', $this->role->id)->get();
        $this->emit('make_module_success',$this->model_name . ' Module Permission added Successfully');

    }
    public function render()
    {
        return view('livewire.admin.role.role-has-permission-table');
    }

    private function setRolePermission(Role $role)
    {
        $this->role = $role;
        $this->permissions = $role->permissions;
        $this->modules = getAllModelNames(app_path('Models'));
        $this->role_models = $role->permissions->pluck('model')->toArray();
        $this->remaining_modules = array_diff($this->modules, $this->role_models ?? []);
    }
}
