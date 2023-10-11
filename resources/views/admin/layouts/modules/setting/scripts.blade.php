@isset($setting_grouped)
    @foreach ($setting_grouped as $group)
        @foreach ($group as $setting)
            @if ($setting->getRawOriginal('setting_type') == 4)
                <script>
                     ClassicEditor
                        .create( document.querySelector( "#{{ $setting->getRawOriginal('setting_name') }}" ), {
                        } )
                        .catch( error => {
                            console.error = error;
                        } );

                </script>
            @endif
        @endforeach
    @endforeach

@endisset

