@if(session()->has('danger'))
    <script>
        toastr.error('{{ \Illuminate\Support\Facades\Session::get('danger') }}')
    </script>
@elseif(session()->has('message'))
    <script>
        toastr.success('{{ \Illuminate\Support\Facades\Session::get('message') }}')
    </script>
@endif
