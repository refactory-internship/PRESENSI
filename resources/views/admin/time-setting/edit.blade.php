@extends('layouts.app', ['pageTitle' => 'Edit Time Setting'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <form action="{{ route('web.admin.time-settings.update', $timeSetting->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card shadow p-4" style="border-radius: 20px">
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="form-group row mb-3">
                                        <div class="col-md-3">
                                            <label for="division" class="col-form-label">Division</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select name="division" id="division" class="form-control">
                                                @foreach($divisions as $division)
                                                    <option value="{{ $division->id }}" {{ $timeSetting->division_id == $division->id ? 'selected' : '' }}>{{ $division->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <div class="col-md-3">
                                            Schedule
                                        </div>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Start Time</span>
                                                </div>
                                                <input class="form-control" id="start_time" type="time" name="start_time"
                                                       aria-label="start_time" value="{{ $timeSetting->start_time }}">

                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">End Time</span>
                                                </div>
                                                <input class="form-control" id="end_time" type="time" name="end_time"
                                                       aria-label="end_time" value="{{ $timeSetting->end_time }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Save" class="btn btn-primary">
                                        <a href="{{ route('web.admin.time-settings.index') }}" class="btn btn-dark">
                                            Cancel
                                        </a>
                                        <button type="button" class="btn btn-danger float-right"
                                                data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop"
                                                data-bs-url="{{ route('web.admin.time-settings.destroy', $timeSetting->id) }}">
                                            Delete
                                            <i class="bi bi-x-circle"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('admin.time-setting.modal.delete-time-setting')
@endsection
@section('script')
    @include('layouts.partials.modals.script')
@endsection
