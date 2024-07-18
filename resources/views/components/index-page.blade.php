<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{$name}}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{$name}}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="text-xl-end">
                        <a href="{{adminCreateRoute($route)}}" class="btn btn-success ">Add {{$name}}</a>
                    </div>
                </div>
                <div class="card-body">
                    {{ $content ?? '' }}
                </div>
            </div>
        </div>
    </div>
</div>
