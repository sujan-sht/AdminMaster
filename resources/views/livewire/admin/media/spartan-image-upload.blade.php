<div>
    <div id="{{$divId}}" class="{{$divClass}}">
        @if ($model)
            @if ($multiple)
                @if ($model->$imageName->count()>0)
                    @foreach ($model->$imageName as $image)
                        <div class="{{$class}}">
                            <div class="img-upload-preview">
                                <img loading="lazy"  src="{{ $image->getUrl() }}" alt="{{$image->file_name}}" class="img-responsive" style="max-height:{{$height}};">
                                <input type="hidden" name="previous_photos[]" value="{{ $image->id }}">
                                <button type="button" class="btn btn-danger close-btn remove-files" ><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                    @endforeach
                @endif
            @else
                @if ($model->$imageName)
                <div class="{{$class}}">
                    <div class="img-upload-preview">
                        <img loading="lazy"  src="{{ $model->$imageName }}" alt="{{$model->getFirstMedia($imageName)->file_name}}" class="img-responsive" style="max-height:{{$height}};">
                        <input type="hidden" name="previous_photos[]" value="{{$model->getFirstMedia($imageName)->id}}">

                        <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                @endif
            @endif


        @endif
    </div>
    @push('livewire_third_party')
    <script type="text/javascript">
        $( document ).ready(function() {
            $("#{{$divId}}").spartanMultiImagePicker({
                fieldName:        '{{$imageName}}[]',
                maxCount:         {{$multiple ? $imageCount : 1}},
                rowHeight:        '{{$height}}',
                groupClassName:   '{{$class}}',
                maxFileSize:      '20000',
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

            $('.remove-files').on('click', function() {
                $(this).parents(".img-upload-preview").remove();
            });
        });

        </script>
    @endpush
</div>
