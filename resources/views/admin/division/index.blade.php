@extends('layouts.app', ['pageTitle' => 'Division List'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    @include('layouts.partials.message')
                    <div class="mb-3">
                        <a href="{{ route('web.admin.divisions.create') }}" class="btn btn-success">
                            <i class="bi bi-plus"></i>
                            Add New Division
                        </a>
                    </div>
                    <div class="card shadow p-4">
                        <div class="card-body">
                            <table class="table table-hover" aria-label="division-table" id="divisionTable">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col" class="text-center" style="width: 25%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($divisions as $division)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $division->name }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('web.admin.divisions.show', $division->id) }}" class="btn btn-sm btn-outline-dark">
                                                <i class="bi bi-eye-fill"></i>
                                                Check Details
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
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
            $('#divisionTable').DataTable({
                columnDefs: [
                    {
                        orderable: false,
                        targets: [2]
                    }
                ],
                order: []
            });
        });
    </script>
@endsection
