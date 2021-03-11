@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <form action="{{ route('web.admin.time-settings.store') }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="form-group row mb-3">
                                        <div class="col-md-3">
                                            <label for="division" class="col-form-label">Division</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select name="division" id="division" class="form-control">
                                                <option value="">Division</option>
                                                @foreach($divisions as $id => $name)
                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <div class="col-md-3">
                                            <label for="start_time" class="col-form-label">Start Time</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="time" class="form-control" id="start_time" name="start_time">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <div class="col-md-3">
                                            <label for="end_time" class="col-form-label">End Time</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="time" class="form-control" id="end_time" name="end_time">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Save" class="btn btn-primary">
                                        <a href="{{ route('web.admin.time-settings.index') }}" class="btn btn-dark">
                                            Cancel
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
