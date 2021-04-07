@extends('layouts.app', ['pageTitle' => 'Division Details'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow p-4">
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="name">Division Name</label>
                                <input type="text" id="name" class="form-control" value="{{ $division->name }}" disabled>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('web.admin.divisions.index') }}" class="btn btn-dark">
                                        <i class="bi bi-arrow-left-circle"></i>
                                        Back
                                    </a>
                                    <div class="btn-group float-right">
                                        <a href="{{ route('web.admin.divisions.edit', $division->id) }}"
                                           class="btn btn-outline-dark">
                                            <i class="bi bi-pencil-square"></i>
                                            Edit
                                        </a>
                                        <button type="button" class="btn btn-outline-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop"
                                                data-bs-url="{{ route('web.admin.divisions.destroy', $division->id) }}">
                                            Delete
                                            <i class="bi bi-x-circle"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.division.modal.delete-division')
@endsection
@section('script')
    @include('layouts.partials.modals.script')
@endsection
