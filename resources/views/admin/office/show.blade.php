@extends('layouts.app', ['pageTitle' => 'Office Details'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow p-4" style="border-radius: 20px">
                        <div class="card-body">
                            <div class="form-group row mb-3">
                                <div class="col-md-3">
                                    <label for="name">Office Name</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="name" value="{{ $office->name }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    Office Divisions
                                </div>
                                <div class="col-md-9">
                                    @foreach($office->division as $division)
                                        <span class="badge badge-secondary">
                                            {{ $division->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    Office Location
                                </div>
                                <div class="col-md-9">
                                    <table class="table table-sm" aria-label="office location">
                                        <tr>
                                            <td>Province</td>
                                            <td>{{ $office->village->district->city->province->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>City</td>
                                            <td>{{ $office->village->district->city->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>District</td>
                                            <td>{{ $office->village->district->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Village</td>
                                            <td>{{ $office->village->name }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="address">Office Address</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="address" value="{{ $office->address }}" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('web.admin.offices.index') }}" class="btn btn-dark">
                                        <i class="bi bi-arrow-left-circle"></i>
                                        Back
                                    </a>
                                    <div class="btn-group float-right">
                                        <a href="{{ route('web.admin.offices.edit', $office->id) }}"
                                           class="btn btn-outline-dark">
                                            <i class="bi bi-pencil-square"></i>
                                            Edit
                                        </a>
                                        <button type="button" class="btn btn-outline-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop"
                                                data-bs-url="{{ route('web.admin.offices.destroy', $office->id) }}">
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
    @include('layouts.partials.modals.delete-office')
@endsection
@section('script')
    @include('layouts.partials.modals.script')
@endsection
