 <!-- Vendor js -->
 <script src="{{asset('lara-admin/assets/js/vendor.min.js')}}"></script>

 <script src="{{asset('lara-admin/assets/vendor/highlightjs/highlight.pack.min.js')}}"></script>
 <script src="{{asset('lara-admin/assets/js/hyper-syntax.js')}}"></script>

<script src="{{asset('lara-admin/assets/js/spartan/spartan-multi-image-picker-min.js')}}"></script>


 <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.1/dist/cdn.min.js"></script>

 <script src="{{asset('lara-admin/assets/vendor/jquery-toast-plugin/jquery.toast.min.js')}}"></script>
 <!--  Select2 Plugin Js -->
 <script src="{{asset('lara-admin/assets/vendor/select2/js/select2.min.js')}}"></script>

 <script src="{{asset('lara-admin/assets/vendor/datatables.net/js/jquery.dataTables.min.js')}}"></script>
 <script src="{{asset('lara-admin/assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>

<!-- Datatable Init js -->
<script src="{{asset('lara-admin/assets/js/pages/demo.datatable-init.js')}}"></script>
 <!-- Daterangepicker js -->
 {{-- <script src="{{asset('lara-admin/assets/vendor/daterangepicker/moment.min.js')}}"></script> --}}
 {{-- <script src="{{asset('lara-admin/assets/vendor/daterangepicker/daterangepicker.js')}}"></script> --}}

 <!-- Apex Charts js -->
 {{-- <script src="{{asset('lara-admin/assets/vendor/apexcharts/apexcharts.min.js')}}"></script> --}}

 <!-- Vector Map js -->
 <script src="{{asset('lara-admin/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
 <script src="{{asset('lara-admin/assets/vendor/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js')}}"></script>

 <script src="{{asset('lara-admin/assets/js/pages/demo.remixicons.js')}}"></script>


 <!-- Dashboard App js -->
 <script src="{{asset('lara-admin/assets/js/pages/demo.dashboard.js')}}"></script>



 <!-- App js -->
 <script src="{{asset('lara-admin/assets/js/app.min.js')}}"></script>




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
<script type="text/javascript">
    $(function(){
        $("#multi_image_picker").spartanMultiImagePicker({
            fieldName     : 'image',
            maxCount      : 1,
            rowHeight     : '200px',
            groupClassName: 'col-4',
            maxFileSize   : 2500,
            dropFileLabel : "Drop Here",
            onAddRow      : function(index){
                console.log(index);
                console.log('add new row');
            },
            onRenderedPreview : function(index){
                console.log(index);
                console.log('preview rendered');
            },
            onRemoveRow : function(index){
                console.log(index);
            },
            onExtensionErr : function(index, file){
                console.log(index, file,  'extension err');
                alert('Please only input png or jpg type file')
            },
            onSizeErr : function(index, file){
                console.log(index, file,  'file size too big');
                alert('File size too big');
            }
        });
    });
</script>
 @livewireScripts
 @stack('livewire_third_party')
