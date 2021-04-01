@extends('layouts.app', ['pageTitle' => 'Office List'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    @include('layouts.partials.message')
                    <div class="mb-3">
                        <a href="{{ route('web.admin.offices.create') }}" class="btn btn-success rounded-pill">
                            <i class="bi bi-plus"></i>
                            Add New Office
                        </a>
                    </div>
                    <div class="card shadow p-4" style="border-radius: 20px">
                        <div class="card-body">
                            <table class="table table-hover" aria-label="office-table" id="officeTable">

                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Address</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($offices as $office)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $office->name }}</td>
                                        <td>{{ $office->village->district->city->province->name }}</td>
                                        <td>{{ $office->address }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('web.admin.offices.show', $office->id) }}" class="btn btn-sm btn-outline-dark">
                                                <i class="bi bi-eye-fill"></i>
                                                Check Details
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $offices->links('vendor.pagination.bootstrap-4') }}
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
            $('#officeTable').DataTable({
                columnDefs: [
                    {
                        orderable: false,
                        targets: [4]
                    }
                ],
                order: []
            });
        });
    </script>
@endsection
