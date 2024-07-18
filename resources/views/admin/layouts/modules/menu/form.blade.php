<div class="row">
    <div class="col-md-6 mb-3">
        <label for="name">Model Name</label><span class="text-danger">*</span>
        {{-- <input type="text" name="name" class="form-control" value="{{$menu->name ?? old('name')}}" placeholder="Enter Full Name"> --}}
        <input type="text" id="example-readonly" name="name" class="form-control" {{isset($menu) ? 'readonly=""' : ''}} value="{{$menu->name ?? old('name')}}">
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
        <div class="input-group">
            <span class="input-group-text"><i id="showIcon" class="fa fa-concierge-bell"></i></span>
            <button type="button" class="btn btn-primary" id="iconPicker" data-iconpicker-input="#icon"
                data-iconpicker-preview="#showIcon">Select
                Icon</button>
            <input type="hidden" name="icon" id="icon"
                value="{{ $menu->icon ?? (old('icon') ?? 'fa fa-concierge-bell') }}">
        </div>
    </div>
    <div class="row">
        <x-admin-master-add-edit-button :model="$menu ?? ''" name="menu"></x-add-edit-button>
    </div>
</div>


