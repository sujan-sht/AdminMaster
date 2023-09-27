<div class="row">
    <div class="col-md-6 mb-3">
        <label for="name">Model Name</label><span class="text-danger">*</span>
        <input type="text" name="name" class="form-control" value="{{$menu->name ?? old('name')}}" placeholder="Enter Full Name">
        @error('name')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>


    <div class="col-md-6 mb-3">
        <label>Active</label>
            <br>
            <input type="hidden" name="active" value="0">
            <input type="checkbox" name="active" id="switch1" data-switch="bool" value="1" {{ isset($menu->active) ? ($menu->active ? 'checked' : '') : 'checked' }}/>

            <label for="switch1" data-on-label="On" data-off-label="Off"></label>
    </div>

    <div class="col-md-6 mb-3">
        <label for="icon">Menu Icon</label>
        <input type="text" name="icon" class="form-control" placeholder="Select icon" data-fa-browser value="{{$menu->icon ?? old('icon')}}"/>
       @error('icon')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="row">
        <x-lara-admin-add-edit-button :model="$menu ?? ''" name="menu"></x-add-edit-button>
    </div>
</div>


