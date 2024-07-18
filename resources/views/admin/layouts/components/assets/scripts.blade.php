
 <!-- Vendor js -->
 <script src="{{asset('admin-master/assets/js/vendor.min.js')}}"></script>

 {{-- <script src="{{asset('admin-master/assets/vendor/highlightjs/highlight.pack.min.js')}}"></script> --}}
 {{-- <script src="{{asset('admin-master/assets/js/hyper-syntax.js')}}"></script> --}}

 <script src="{{asset('admin-master/assets/vendor/daterangepicker/moment.min.js')}}"></script>
<script src="{{asset('admin-master/assets/vendor/daterangepicker/daterangepicker.js')}}"></script>

<script src="{{asset('admin-master/assets/js/spartan/spartan-multi-image-picker-min.js')}}"></script>

<script src="{{ asset('admin-master/assets/js/ckeditor/ckeditor.js') }}"></script>


 <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.1/dist/cdn.min.js"></script>

 <script src="{{asset('admin-master/assets/vendor/jquery-toast-plugin/jquery.toast.min.js')}}"></script>
 <!--  Select2 Plugin Js -->
 <script src="{{asset('admin-master/assets/vendor/select2/js/select2.min.js')}}"></script>

<!-- Apex Charts js -->
<script src="{{asset('admin-master/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>

<script src="{{asset('admin-master/assets/dist/iconpicker-1.5.0.js')}}"></script>

 <!-- Vector Map js -->
 <script src="{{asset('admin-master/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
 <script src="{{asset('admin-master/assets/vendor/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js')}}"></script>

 <script src="{{asset('admin-master/assets/js/pages/demo.remixicons.js')}}"></script>


 <!-- Dashboard App js -->
 <script src="{{asset('admin-master/assets/js/pages/demo.dashboard.js')}}"></script>



 <!-- App js -->
 <script src="{{asset('admin-master/assets/js/app.min.js')}}"></script>


 @yield('scripts')


 <script>
    @if(Session::has('message'))
    $.toast({
        text: "{{ session('message') }}",
        icon: 'success',
        loader: true,        // Change it to false to disable loader
        loaderBg: '#4BB543', // To change the background
        position: 'top-right'
    })

    @endif

    @if(Session::has('error'))
    $.toast({
        text: "{{ session('error') }}",
        icon: 'error',
        loader: true,        // Change it to false to disable loader
        loaderBg: '#DC3545', // To change the background
        position: 'top-right'
    })
    @endif

    @if(Session::has('info'))
    $.toast({
        text: "{{ session('info') }}",
        icon: 'info',
        loader: true,        // Change it to false to disable loader
        loaderBg: '#17a2b8', // To change the background
        position: 'top-right'
    })
    @endif

    @if(Session::has('warning'))
    $.toast({
        text: "{{ session('warning') }}",
        icon: 'warning',
        loader: true,        // Change it to false to disable loader
        loaderBg: '#ffc107', // To change the background
        position: 'top-right'
    })
    @endif

</script>

<script>
    // Font Selector
    IconPicker.Init({
        jsonUrl: "{{ asset('admin-master/assets/dist/iconpicker-1.5.0.json') }}",
        searchPlaceholder: 'Search Icon',
        showAllButton: 'Show All',
        cancelButton: 'Cancel',
        noResultsFound: 'No results found.',
        borderRadius: '20px',
    });

    IconPicker.Run('#iconPicker');
</script>
<script>
    ClassicEditor
	.create( document.querySelector( '#ckeditor' ), {
	} )
	.catch( error => {
		console.error = error;
	} );
</script>

 @livewireScripts
<script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>

 @stack('livewire_third_party')
