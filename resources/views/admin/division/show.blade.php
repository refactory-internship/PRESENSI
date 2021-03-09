@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-3">Division Details</h5>
                            <div class="form-group mb-3">
                                <label for="name">Division Name</label>
                                <input type="text" id="name" class="form-control" value="{{ $division->name }}" disabled>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('web.divisions.index') }}" class="btn btn-dark">
                                        <svg class="c-icon">
                                            <use xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-arrow-left"></use>
                                        </svg>
                                        Back
                                    </a>
                                    <div class="btn-group float-right">
                                        <a href="{{ route('web.divisions.edit', $division->id) }}"
                                           class="btn btn-outline-dark">
                                            Edit
                                            <svg class="c-icon">
                                                <use xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-pencil"></use>
                                            </svg>
                                        </a>
                                        <button type="button" class="btn btn-outline-dark"
                                                data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop"
                                                data-bs-url="{{ route('web.divisions.destroy', $division->id) }}">
                                            Delete
                                            <svg class="c-icon">
                                                <use xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-trash"></use>
                                            </svg>
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
    @include('layouts.partials.modals.delete-division')
@endsection
@section('script')
    @include('layouts.partials.modals.script')
@endsection
