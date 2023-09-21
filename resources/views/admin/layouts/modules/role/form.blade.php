<div class="row">
    <div class="col-md-12 mb-3">
        <label for="name">Name</label><span class="text-danger">*</span>
        <input type="text" name="name" class="form-control" value="{{$role->name ?? old('name')}}" placeholder="Enter Full Name">
        @error('name')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="col-md-12 mb-3">
        <label for="description">Description</label>
       <textarea name="description" class="form-control" rows="4">{{$role->description ?? old('description')}}</textarea>
       @error('description')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="row">
        <x-add-edit-button :model="$role ?? ''" name="role"></x-add-edit-button>
    </div>
</div>
