<div class="mb-3">
    @if(session()->has('danger'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session()->get('danger') }}
        </div>
    @elseif(session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session()->get('message') }}
        </div>
    @endif
</div>
