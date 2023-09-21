<div>
    @if ($permission)
        <div class="row justify-content-center align-items-center text-center">
            <div class="col-3">{{ucfirst($permission->model)}}</div>
            <div class="col-2">{{$permission->name ?? 'N/A'}}</div>
            <div class="col-1"><input type="checkbox" wire:model="browse" value="1" ></div>
            <div class="col-1"><input type="checkbox" wire:model="read" value="1" ></div>
            <div class="col-1"><input type="checkbox" wire:model="edit" value="1" ></div>
            <div class="col-1"><input type="checkbox" wire:model="add" value="1" ></div>
            <div class="col-1"><input type="checkbox" wire:model="delete" value="1" ></div>
            <div class="col-2"><button wire:click="deletePermission" class="btn btn-danger"><i class="fa fa-trash"></i> </button></div>
        </div>
        <hr>
    @endif

</div>
