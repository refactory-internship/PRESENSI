@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <form action="{{ route('web.admin.divisions.update', $division->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">Division Name</label>
                                        <input type="text" name="name" class="form-control" id="name" value="{{ $division->name }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Save" class="btn btn-primary">
                                        <a href="{{ route('web.admin.divisions.show', $division->id) }}" class="btn btn-dark">
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
