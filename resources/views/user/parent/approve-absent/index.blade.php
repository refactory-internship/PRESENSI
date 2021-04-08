@extends('layouts.app', ['pageTitle' => 'Approve Absents'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    @include('layouts.partials.message')
                    <div class="card shadow p-4">
                        <div class="card-body">
                            <table class="table table-hover text-center" aria-label="approve-absent"
                                   id="approveAbsentTable">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Employee</th>
                                    <th scope="col">Reason</th>
                                    <th scope="col">Absent Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($absents as $absent)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ date('d F Y', strtotime($absent->date)) }}</td>
                                        <td>{{ $absent->user->getFullNameAttribute() }}</td>
                                        <td>{{ $absent->reason }}</td>

                                        @if($absent->approvalStatus === '1')
                                            <td>
                                                <span class="badge badge-warning">NEEDS_APPROVAL</span>
                                            </td>
                                        @elseif($absent->approvalStatus === '2')
                                            <td>
                                                <span class="badge badge-success">APPROVED</span>
                                            </td>
                                        @elseif($absent->approvalStatus === '3')
                                            <td>
                                                <span class="badge badge-danger">REJECTED</span>
                                            </td>
                                        @endif

                                        <td>
                                            <a href="{{ route('web.employee.approve-absents.show', $absent->id) }}"
                                               class="btn btn-sm btn-outline-dark">
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
            $('#approveAbsentTable').DataTable({
                columnDefs: [
                    {
                        orderable: false,
                        targets: [3, 5]
                    }
                ],
                order: []
            });
        });
    </script>
@endsection
