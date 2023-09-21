<div class="row">
    <div class="col-md-5 mb-3">
        <label for="name">Name</label><span class="text-danger">*</span>
        <input type="text" name="name" class="form-control" value="{{$permission->name ?? old('name')}}" placeholder="Enter Permission Name">
        @error('name')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="col-md-5 mb-3">
        <label for="role">Role</label><span class="text-danger">*</span>
        <select name="role_id" class="select2 form-control" data-toggle="select2" data-placeholder="Select Role ...">
            <option selected disabled>Select Role...</option>
            @if ($roles->count()>0)
                @foreach ($roles as $role)
                    <option value="{{$role->id}}" {{isset($permission) ? ($permission->role_id==$role->id ? 'selected' : '') : ''}}>{{$role->name}}</option>
                @endforeach
            @endif
        </select>
        @error('role')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="col-md-2 mb-3">
        <label for="can">Can/ Cannot</label>
        <br>
        <input type="checkbox" name="can" value="1" {{isset($permission) ? ($permission->can==1 ? 'checked' : '') : ''}}>
    </div>
    <div class="row">
        <x-add-edit-button :model="$model ?? ''" name="permission"></x-add-edit-button>
    </div>
</div>

