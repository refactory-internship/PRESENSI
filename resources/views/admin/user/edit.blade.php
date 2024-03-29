@extends('layouts.app', ['pageTitle' => 'Edit Employee'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow p-4">
                        <div class="card-body">
                            <form action="{{ route('web.admin.users.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
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
                                                   id="first_name" aria-label="first_name"
                                                   value="{{ $user->first_name }}">

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
                                                   aria-label="last_name" value="{{ $user->last_name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-md-3 col-form-label" for="role">Select Role</label>
                                    <div class="col-md-9">
                                        <select name="role" id="role" class="form-control"
                                                aria-label="role">
                                            @foreach($roles as $id => $name)
                                                <option
                                                    value="{{ $id }}" {{ $id === $user->role->id ? 'selected' : '' }}>{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-md-3 col-form-label" for="office">Select Office</label>
                                    <div class="col-md-9">
                                        <select name="office" id="office" class="form-control" aria-label="office">
                                            @foreach($offices as $office)
                                                <option
                                                    value="{{ $office->id }}" {{ $office->id == $user->division_office->office->id ? 'selected' : '' }}>{{ $office->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-md-3 col-form-label" for="division">Select Division</label>
                                    <div class="col-md-9">
                                        <select name="division" id="division" class="form-control" aria-label="division">
                                            @foreach($divisionOffice as $item)
                                                <option value="{{ $item->division->id }}" {{ $item->division->id == $user->division_office->division->id ? 'selected' : '' }}>{{ $item->division->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="shift" class="col-md-3 col-form-label">Select Shift</label>
                                    <div class="col-md-9">
                                        <select name="shift" id="shift" class="form-control" aria-label="shift">
                                            <option value="{{ $user->time_setting->id }}">{{ $user->time_setting->getShiftAttribute() }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-md-3 col-form-label" for="parent">Select Parent</label>
                                    <div class="col-md-9">
                                        <div class="mb-3">
                                            <select name="parent" id="parent" class="form-control"
                                                    aria-label="parent">
                                                @if($user->parent === null)
                                                    <option value="">No Parent</option>
                                                    @foreach($parent as $item)
                                                        <option value="{{ $item->id }}">{{ $item->getFullNameAttribute() }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="">No Parent</option>
                                                    @foreach($parent as $item)
                                                        <option value="{{ $item->id }}" {{ $user->parent->id === $item->id ? 'selected' : '' }}>{{ $item->getFullNameAttribute() }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="submit" value="Save" class="btn btn-primary">
                                    <a href="{{ route('web.admin.users.show', $user->id) }}" class="btn btn-dark">
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
