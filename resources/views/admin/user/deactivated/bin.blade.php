@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    @include('layouts.partials.message')
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover" aria-label="deactivated employees" id="dataTable">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Office</th>
                                    <th scope="col">Division</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Deleted</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $user->getFullNameAttribute() }}</td>

                                        @if($user->division_office === null)
                                            <td>
                                                <span class="badge badge-danger">No Data</span>
                                            </td>
                                        @else
                                            <td>{{ $user->division_office->office->name }}</td>
                                        @endif

                                        @if($user->division_office === null)
                                            <td>
                                                <span class="badge badge-danger">No Data</span>
                                            </td>
                                        @else
                                            <td>{{ $user->division_office->division->name }}</td>
                                        @endif

                                        <td>{{ $user->role->name }}</td>

                                        <td>{{ $user->deleted_at->diffForHumans() }}</td>

                                        <td class="text-center">
                                            <div class="btn-group">
                                                <form
                                                    action="{{ route('web.admin.deactivated-employees.restore', $user->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="btn btn-sm btn-outline-dark" type="submit">
                                                        <svg class="c-icon">
                                                            <use
                                                                xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-action-undo"></use>
                                                        </svg>
                                                    </button>
                                                </form>

                                                <button type="button" class="btn btn-sm btn-outline-dark"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#staticBackdrop"
                                                        data-bs-url="{{ route('web.admin.deactivated-employees.destroy', $user->id) }}">
                                                    <svg class="c-icon">
                                                        <use
                                                            xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-trash"></use>
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No Data</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.partials.modals.delete-employee')
@endsection
@section('script')
    @include('layouts.partials.modals.script')
@endsection
