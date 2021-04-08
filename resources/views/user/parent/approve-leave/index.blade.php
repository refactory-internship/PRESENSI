@extends('layouts.app', ['pageTitle' => 'Approve Leaves'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    @include('layouts.partials.message')
                    <div class="card shadow p-4">
                        <div class="card-body">
                            <table class="table table-hover text-center" aria-label="approve-leave"
                                   id="approveLeaveTable">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Employee</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Leave Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($leaves as $leave)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $leave->user->getFullNameAttribute() }}</td>
                                        <td>{{ date('d F Y', strtotime($leave->start_date)) }}</td>
                                        <td>{{ date('d F Y', strtotime($leave->end_date)) }}</td>
                                        <td>{{ $leave->note }}</td>

                                        @if($leave->approvalStatus === '1')
                                            <td>
                                                <span class="badge badge-warning">NEEDS_APPROVAL</span>
                                            </td>
                                        @elseif($leave->approvalStatus === '2')
                                            <td>
                                                <span class="badge badge-success">APPROVED</span>
                                            </td>
                                        @elseif($leave->approvalStatus === '3')
                                            <td>
                                                <span class="badge badge-danger">REJECTED</span>
                                            </td>
                                        @endif

                                        <td>
                                            <a href="{{ route('web.employee.approve-leaves.show', $leave->id) }}"
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
            $('#approveLeaveTable').DataTable({
                columnDefs: [
                    {
                        orderable: false,
                        targets: [4, 6]
                    }
                ],
                order: []
            });
        });
    </script>
@endsection
