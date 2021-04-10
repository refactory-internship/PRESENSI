<form action="{{ route('web.profile.password-update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group row mb-3">
        <label for="current_password" class="col-form-label col-md-3">Current Password</label>
        <div class="col-md-9">
            <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                   name="current_password" id="current_password">

            @error('current_password')
            <div class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
        </div>
    </div>

    <div class="form-group row mb-3">
        <label for="password" class="col-form-label col-md-3">Password</label>
        <div class="col-md-9">
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                   id="password">

            @error('password')
            <div class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
        </div>
    </div>

    <div class="form-group row mb-3">
        <label for="password_confirmation" class="col-form-label col-md-3">Confirm Password</label>
        <div class="col-md-9">
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                   name="password_confirmation" id="password_confirmation">

            @error('password_confirmation')
            <div class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
        </div>
    </div>

    <div class="btn-group float-right">
        <input type="submit" class="btn btn-primary" value="Save Changes">
    </div>
</form>
