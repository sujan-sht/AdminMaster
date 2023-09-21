<div class="row">
    <div class="col-md-6 mb-3">
        <label for="name">Model Name</label><span class="text-danger">*</span>
        <input type="text" name="name" class="form-control" value="{{$menu->name ?? old('name')}}" placeholder="Enter Full Name">
        @error('name')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="position">Position</label><span class="text-danger">*</span>
        <input type="number" name="position" min="0" class="form-control" value="{{$menu->position ?? old('position')}}">
        @error('position')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    {{-- <div class="col-md-6 mb-3">
        <label for="icon">Menu Icon</label>
        <button  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#icon">Choose Icon</button>

       @error('icon')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div> --}}
    <div class="row">
        <x-add-edit-button :model="$menu ?? ''" name="menu"></x-add-edit-button>
    </div>
</div>
<div id="icon" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Choose Icon</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12" id="icons"></div> <!-- end col-->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Select</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

