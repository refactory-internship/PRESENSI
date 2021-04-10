<form action="{{ route('web.profile.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group row mb-3">
        <label for="first_name" class="col-form-label col-md-3">First Name</label>
        <div class="col-md-9">
            <input type="text" class="form-control" name="first_name"
                   value="{{ $user->first_name }}" id="first_name">
        </div>
    </div>

    <div class="form-group row mb-3">
        <label for="last_name" class="col-form-label col-md-3">Last Name</label>
        <div class="col-md-9">
            <input type="text" class="form-control" name="last_name"
                   value="{{ $user->last_name }}" id="last_name">
        </div>
    </div>

    <div class="form-group row mb-3">
        <label for="email" class="col-form-label col-md-3">Email</label>
        <div class="col-md-9">
            <input type="email" class="form-control" name="email" id="email"
                   value="{{ $user->email }}">
        </div>
    </div>

    <div class="btn-group float-right">
        <input type="submit" class="btn btn-primary" value="Save Changes">
    </div>
</form>
