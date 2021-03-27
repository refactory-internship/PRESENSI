@extends('layouts.app', ['pageTitle' => 'Add New Employee'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow p-4" style="border-radius: 20px">
                        <div class="card-body">
                            <form action="{{ route('web.admin.users.store') }}" method="POST">
                                @csrf
                                <div class="form-group row mb-3">
                                    <div class="col-md-3">
                                        Employee Name
                                    </div>
                                    <div class="col">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">First Name</span>
                                            </div>
                                            <input type="text" name="first_name"
                                                   class="form-control @error('first_name') is-invalid @enderror"
                                                   id="first_name" aria-label="first_name">

                                            @error('first_name')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Last Name</span>
                                            </div>
                                            <input type="text" name="last_name" class="form-control"
                                                   aria-label="last_name">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="email" class="col-md-3 col-form-label">Email</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input type="email" name="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   id="email">
                                            <span class="input-group-append">
                                                    <button class="btn btn-primary" type="button" onclick="getEmail()">Generate Email</button>
                                                </span>

                                            @error('email')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="password" class="col-md-3 col-form-label">Password</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input type="text" name="password"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   id="password">
                                            <span class="input-group-append">
                                                    <button class="btn btn-primary" type="button"
                                                            onclick="getPassword()">Generate Password</button>
                                                </span>

                                            @error('password')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-md-3 col-form-label" for="role">Select Role</label>
                                    <div class="col-md-9">
                                        <select name="role" id="role" class="form-control"
                                                aria-label="role">
                                            <option value="">Role</option>
                                            @foreach($roles as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-md-3 col-form-label" for="office">Select Office</label>
                                    <div class="col-md-9">
                                        <select name="office" id="office" class="form-control" aria-label="office">
                                            <option value="">Office</option>
                                            @foreach($offices as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-md-3 col-form-label" for="division">Select Division</label>
                                    <div class="col-md-9">
                                        <select name="division" id="division" class="form-control"
                                                aria-label="division">
                                            <option value="">Division</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="shift" class="col-md-3 col-form-label">Select Shift</label>
                                    <div class="col-md-9">
                                        <select name="shift" id="shift" class="form-control" aria-label="shift">
                                            <option value="">Shift</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-md-3 col-form-label" for="parent">Select Parent</label>
                                    <div class="col-md-9">
                                        <div class="mb-3">
                                            <select name="parent" id="parent" class="form-control"
                                                    aria-label="parent">
                                                <option value="">Parent</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card shadow-sm" style="border-left: 2px solid #321fdb">
                                    <div class="card-body">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input"
                                                   id="auto_approve" name="auto_approve">
                                            <label class="custom-control-label" for="auto_approve">Auto Approve
                                                Attendance</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Save" class="btn btn-primary">
                                    <a href="{{ route('web.admin.users.index') }}" class="btn btn-dark">
                                        Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('layouts.partials.employee-script')
@endsection
