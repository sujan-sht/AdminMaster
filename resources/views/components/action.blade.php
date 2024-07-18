<div>
    @if ($show)
    <a href="{{adminShowRoute($route,$model->id)}}" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i></a>
    @endif

    <a href="{{adminEditRoute($route,$model->id)}}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>

    <button class="btn btn-danger btn-sm" type="button" data-bs-toggle="modal"
    data-original-title="Delete" data-bs-target="#delete-{{ $model->id }}"><i class="fas fa-trash"></i></button>


    <!-- Modal -->
    <div class="modal fade" id="delete-{{ $model->id }}" tabindex="-1" role="dialog"
        aria-labelledby="delete-{{ $model->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {{-- @if ($deleteCondition)
                <div class="modal-header bg-secondary">
                    <h5 class="modal-title" id="exampleModalLabel">This item cannot be deleted !</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        This item cannot be deleted yet, since it may have dependencies on other
                        module
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-air-danger" data-dismiss="modal">Close</button>
                </div>

                @else --}}
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Item !</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="admin-form" action="{{ adminDeleteRoute($route, $model->id) }}" method="POST"
                    serverMethod="DELETE">
                    @method('DELETE')
                    @csrf
                    <div class="modal-body">
                        Are you sure you want to delete this item?
                        <br>

                    </div>
                    <div class="modal-footer">
                        <button class="close btn grey btn-danger btn-air-danger" type="button" data-bs-dismiss="modal"
                            aria-label="Close">Close </button>

                        <button type="submit" class="btn btn-danger btn-air-danger">Yes Delete It !</button>
                    </div>
                </form>
                {{-- @endif --}}
            </div>
        </div>
    </div>
</div>
