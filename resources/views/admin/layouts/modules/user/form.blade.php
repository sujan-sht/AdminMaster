<div class="row">
    <div class="col-md-6 mb-3">
        <label for="name">Name</label><span class="text-danger">*</span>
        <input type="text" name="name" class="form-control" value="{{$user->name ?? old('name')}}" placeholder="Enter Name">
        @error('name')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="email">Email</label><span class="text-danger">*</span>
        <input type="text" name="email" class="form-control" value="{{$user->email ?? old('email')}}" placeholder="Enter Email Address">
        @error('email')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="password">Password</label><span class="text-danger">*</span>
        <input type="password" name="password" class="form-control" placeholder="Enter Password">
        @error('password')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="confirm_password">Confirm Password</label><span class="text-danger">*</span>
        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
        @error('confirm_password')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="role">Role</label>

        <select name="role[]" class="select2 form-control select2-multiple" data-toggle="select2" multiple="multiple" data-placeholder="Select Role ...">
            @if ($roles->count()>0)
                @foreach ($roles as $role)
                    @if ($role->name != 'Super Admin')
                        <option value="{{$role->id}}" {{isset($user) ? ((in_array($role->id,$user->roles->pluck('id')->toArray())) ? 'selected' : '') : ''}}>{{$role->name}}</option>
                    @endif
                @endforeach
            @endif
        </select>
        @error('role')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="col-md-6 mb-3">

        <label for="image">Image</label>

        {{-- <input type="file" name="image" id="image" class="form-control"> --}}
        <div id="multi_image_picker" class="row"></div>

    </div>

    <div class="row">
        <x-add-edit-button :model="$user ?? ''" name="user"></x-add-edit-button>
    </div>
</div>
