@extends('layouts.app', ['pageTitle' => 'Employee Details'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow p-4" style="border-radius: 20px">
                        <div class="card-body">
                            <h5 class="mb-3">Employee Details</h5>
                            <div class="mb-3">
                                <table class="table table-sm" aria-label="employee detail">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <td>{{ $user->getFullNameAttribute() }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="col">Email</th>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="col">Role</th>
                                        <td>{{ $user->role->name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="col">Office and Division</th>
                                        @if($user->division_office === null)
                                            <td>
                                                <span class="badge badge-danger">No Data</span>
                                            </td>
                                        @else
                                        <td>{{ $user->division_office->division->name . ' on ' . $user->division_office->office->name }}</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <th scope="col">Working Shift</th>
                                        @if($user->time_setting === null)
                                            <td>
                                                <span class="badge badge-danger">No Data</span>
                                            </td>
                                        @else
                                        <td>{{ $user->time_setting->getShiftAttribute() }}</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <th scope="col">Parent</th>
                                        @if($user->parent === null)
                                            <td>
                                                <span class="badge badge-danger">No Parent</span>
                                            </td>
                                        @else
                                            <td>{{ $user->parent->getFullNameAttribute() }}</td>

                                        @endif
                                    </tr>
                                    <tr>
                                        <th scope="col">Attendance Status</th>
                                        <td>
                                            @if($user->isAutoApproved === true)
                                                <span class="badge badge-success">Automatically Approved</span>
                                            @else
                                                <span class="badge badge-danger">Not Automatically Approved</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="col">Registered since</th>
                                        <td>{{ $user->created_at->diffForHumans() }}</td>
                                    </tr>
                                </table>
                            </div>
                            <a href="{{ route('web.admin.users.index') }}" class="btn btn-dark">
                                <i class="bi bi-arrow-left-circle"></i>
                                Back
                            </a>
                            <div class="btn-group float-right">
                                <a href="{{ route('web.admin.users.edit', $user->id) }}" class="btn btn-outline-dark">
                                    <i class="bi bi-pencil-square"></i>
                                    Edit
                                </a>
                                <button type="button" class="btn btn-outline-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop"
                                        data-bs-url="{{ route('web.admin.users.destroy', $user->id) }}">
                                    Deactivate
                                    <i class="bi bi-x-circle"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.partials.modals.deactivate-employee')
@endsection
@section('script')
    @include('layouts.partials.modals.script')
@endsection
