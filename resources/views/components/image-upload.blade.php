<div>
    <div id="{{$id}}" class="{{$class}}">
        <div class="{{$class}}">
            @if ($model)
                <div class="img-upload-preview">
                    <img loading="lazy"  src="{{ $model->$imageName }}" alt="" class="img-responsive" style="max-height:{{$height}};">
                    {{-- <input type="hidden" name="previous_photos[]" value="{{ $photo }}"> --}}
                    <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                </div>
            @endif

        </div>
    </div>
    @section('scripts')
    <script type="text/javascript">
        $( document ).ready(function() {
            $("#{{$id}}").spartanMultiImagePicker({
                fieldName:        '{{$imageName}}',
                maxCount:         {{$multiple ? $imageCount : 1}},
                rowHeight:        '{{$height}}',
                groupClassName:   '{{$class}}',
                maxFileSize:      '',
                allowedExt:'png|jpg|jpeg|gif',
                dropFileLabel : "Drop Here",
                onExtensionErr : function(index, file){
                    console.log(index, file,  'extension err');
                    alert('Please only input png or jpg type file')
                },
                onSizeErr : function(index, file){
                    console.log(index, file,  'file size too big');
                    alert('File size too big');
                }
            });

            $('.remove-files').on('click', function(){
                $(this).parents(".img-upload-preview").remove();
            });
        });

        </script>
    @endsection
</div>
