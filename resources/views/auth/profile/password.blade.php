@extends('layouts.app', ['pageTitle' => 'Your Profile'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row">
                @include('layouts.partials.message')
                <div class="col-md-6 mb-3">
                    <a href="{{ auth()->user()->hasRole('Admin') ? route('web.admin.home') : route('web.employee.home') }}" class="btn btn-dark">
                        <i class="bi bi-arrow-left-circle"></i>
                        Back
                    </a>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card shadow p-4">
                        <div class="card-body">
                            <div class="mb-2">
                                <div class="row">
                                    <strong>Name</strong>
                                </div>
                                <div class="row">
                                    <p>{{ $user->getFullNameAttribute() }}</p>
                                </div>
                            </div>

                            <div class="mb-2">
                                <div class="row">
                                    <strong>Email</strong>
                                </div>
                                <div class="row">
                                    <p>{{ $user->email }}</p>
                                </div>
                            </div>

                            <div class="mb-2">
                                <div class="row">
                                    <strong>Role</strong>
                                </div>
                                <div class="row">
                                    <p>{{ $user->role->name }}</p>
                                </div>
                            </div>

                            <div class="mb-2">
                                <div class="row">
                                    <strong>Division and Office</strong>
                                </div>
                                <div class="row">
                                    @if(!$user->division_office)
                                        <p class="text-value-sm text-danger text-uppercase">No Data</p>
                                    @else
                                        <p>{{ $user->division_office->division->name . ' on ' . $user->division_office->office->name }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card shadow p-4">
                        <nav>
                            <div class="nav nav-tabs" role="tablist">
                                <a class="nav-link" href="{{ route('web.profile') }}">Profile</a>
                                <a class="nav-link active" aria-current="page" href="{{ route('web.profile.password') }}">Password</a>
                            </div>
                        </nav>

                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" role="tabpanel">
                                    @include('auth.profile.forms.password')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
