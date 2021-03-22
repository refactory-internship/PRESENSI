@extends('layouts.app', ['pageTitle' => 'Employee List'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    @include('layouts.partials.message')
                    <div class="mb-3">
                        <a href="{{ route('web.admin.users.create') }}" class="btn btn-success rounded-pill">
                            <i class="bi bi-plus"></i>
                            Add New Employee
                        </a>
                    </div>
                    <div class="card shadow p-4" style="border-radius: 20px;">
                        <div class="card-body">
                            <table class="table table-hover" aria-label="office-table" id="dataTable">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Office</th>
                                    <th scope="col">Division</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Parent</th>
                                    <th scope="col">Action</th>
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

                                        @if($user->parent === null)
                                            <td>
                                                <span class="badge badge-danger">No Data</span>
                                            </td>
                                        @else
                                            <td>{{ $user->parent->first_name . ' ' . $user->parent->last_name }}</td>
                                        @endif

                                        <td>
                                            <a href="{{ route('web.admin.users.show', $user->id) }}" class="btn btn-sm btn-outline-dark">
                                                <i class="bi bi-eye-fill"></i>
                                                Check Details
                                            </a>
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
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable({
                columnDefs: [
                    {
                        orderable: false,
                        targets: [6]
                    }
                ],
                order: []
            });
        });
    </script>
@endsection
