@extends('layouts.app', ['pageTitle' => 'Role List'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="mb-3">
                        @include('layouts.partials.message')
                        <a href="{{ route('web.admin.roles.create') }}" class="btn btn-success shadow">
                            <i class="bi bi-plus"></i>
                            Add New Role
                        </a>
                    </div>
                    <div class="row">
                        @foreach($roles as $role)
                            <div class="col-md-3">
                                <div class="card shadow">
                                    <div class="card-body d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="text-value">{{ $role->name }}</div>
                                        </div>
                                        <div class="btn-group">
                                            <button class="btn dropdown-toggle p-0" type="button" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false"></button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item"
                                                   href="{{ route('web.admin.roles.edit', $role->id) }}">Edit</a>
                                                <button type="button" class="dropdown-item"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#staticBackdrop"
                                                        data-bs-url="{{ route('web.admin.roles.destroy', $role->id) }}">
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <i class="cil-people"></i>
                                        {{ count($role->user) }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.partials.modals.delete-role')
@endsection
@section('script')
    @include('layouts.partials.modals.script')
@endsection
