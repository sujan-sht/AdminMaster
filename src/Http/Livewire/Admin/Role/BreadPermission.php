<?php

namespace SujanSht\LaraAdmin\Http\Livewire\Admin\Role;

use SujanSht\LaraAdmin\Models\Admin\Permission;
use Livewire\Component;

class BreadPermission extends Component
{
    public $permission;
    public $browse;
    public $read;
    public $edit;
    public $add;
    public $delete;


    public function mount(Permission $permission)
    {
        $this->permission = $permission;
        $this->browse = $permission->browse;
        $this->read = $permission->read;
        $this->edit = $permission->edit;
        $this->add = $permission->add;
        $this->delete = $permission->delete;
    }


    public function updatedBrowse()
    {
        $this->permission->update([
            'browse' => $this->browse,
        ]);

        $this->emit('bread_updated',$this->permission->model.' model browse flag updated');
    }

    public function updatedRead()
    {
        $this->permission->update([
            'read' => $this->read,
        ]);
        $this->emit('bread_updated', $this->permission->model.' model read flag updated');
    }

    public function updatedEdit()
    {
        $this->permission->update([
            'edit' => $this->edit,
        ]);
        $this->emit('bread_updated', $this->permission->model.' model edit flag updated');
    }

    public function updatedAdd()
    {
        $this->permission->update([
            'add' => $this->add,
        ]);
        $this->emit('bread_updated', $this->permission->model.' model add flag updated');
    }

    public function updatedDelete()
    {
        $this->permission->update([
            'delete' => $this->delete,
        ]);
        $this->emit('bread_updated', $this->permission->model.' model delete flag updated');
    }

    public function deletePermission()
    {
        $this->permission->delete();
        $this->permission = null;
        $this->emit('permission_deleted');
    }

    public function render()
    {
        return view('livewire.admin.role.bread-permission');
    }
}
