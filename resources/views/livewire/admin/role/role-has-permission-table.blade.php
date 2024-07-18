<div>
    <!-- Standard modal -->
    <div>
        <div class="d-flex justify-content-between mb-3">
            <h4>All Permisions for {{$role->name}}</h4>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#module-permission">Create Module Permission</button>
        </div>
        <div style="overflow-x:auto">
            <div class="row text-center" style="font-weight:bold;">
                <div class="col-3">Module</div>
                <div class="col-2">Name</div>
                <div class="col-1">Browse</div>
                <div class="col-1">Read</div>
                <div class="col-1">Edit</div>
                <div class="col-1">Add</div>
                <div class="col-1">Delete</div>
                <div class="col-2">Action</div>
            </div>
            <hr>
            @if (!is_null($permissions))
                @foreach ($permissions as $permission)
                    @livewire('admin.role.bread-permission', ['permission' => $permission], key('permission' . $permission->id))
                @endforeach
            @endif
        </div>
    </div>
    <div wire:ignore id="module-permission" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="module-permissionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="module-permissionLabel">Create Permission</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form wire:submit.prevent="makeModulePermission" method="POST">
                    <div class="modal-body">
                        <label for="module">Select Module for making BREAD permissions</label>
                        <select wire:model="model_name" class="form-control select2" data-toggle="select2" id="select2-dropdown" >
                            <option>Select Module...</option>
                            @if (!is_null($remaining_modules))
                                @foreach ($remaining_modules as $module)
                                    <option value="{{ $module }}">{{ $module }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Make Permission</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    @push('livewire_third_party')
        <script>
            $('#select2-dropdown').on('change', function (e) {
                var data = $('#select2-dropdown').select2("val");
                @this.set('model_name', data);
            });
            Livewire.on('make_module_success',function(message){
                $('#module-permission').modal('hide');
                $.toast({
                    text: message,
                    icon: 'success',
                    loader: true,        // Change it to false to disable loader
                    loaderBg: '#4BB543', // To change the background
                    position: 'top-right'
                });
            });

            Livewire.on('bread_updated',function(message){
                $.toast({
                    text: message,
                    icon: 'info',
                    loader: true,        // Change it to false to disable loader
                    loaderBg: '#17a2b8', // To change the background
                    position: 'top-right'
                });
            });

            Livewire.on('permission_deleted',function(message){
                $.toast({
                    text: 'Module Permission deleted Successfully',
                    icon: 'error',
                    loader: true,        // Change it to false to disable loader
                    loaderBg: '#DC3545', // To change the background
                    position: 'top-right'
                });
            });

        </script>
    @endpush
</div>
