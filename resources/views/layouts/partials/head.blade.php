<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>

{{--JQuery--}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

{{--Bootstrap Icon--}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

{{--Datatable Style--}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css">

{{--Bootstrap 5 CDN--}}
<link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

{{--coreui local styles--}}
<link rel="stylesheet" href="{{ asset('coreui/dist/css/coreui.min.css') }}">
{{--coreui Icons CDN--}}
<link rel="stylesheet" href="{{ asset('coreui/icons/css/all.min.css') }}">

<!-- Styles -->
{{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

{{--Select2 CDN--}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{--toastr CDN--}}
{{--styling--}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
      integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
      crossorigin="anonymous"/>
{{--javascript--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous"></script>

{{--custom toastr style--}}
<style>
    #toast-container > .toast {
        background-image: none !important;
    }
</style>

{{--custom toastr script--}}
<script>
    toastr.options = {
        "progressBar": true,
        "positionClass": "toast-top-center",
    }
</script>
