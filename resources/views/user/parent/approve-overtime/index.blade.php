@extends('layouts.app', ['pageTitle' => 'Approve Overtime'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    @include('layouts.partials.message')
                    <div class="card shadow p-4" style="border-radius: 20px">
                        <div class="card-body">
                            <table class="table table-hover text-center" aria-label="approve-overtime" id="approveOvertimeTable">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Employee</th>
                                    <th scope="col">Overtime Duration</th>
                                    <th scope="col">Start Time</th>
                                    <th scope="col">End Time</th>
                                    <th scope="col">Overtime Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($overtimes as $overtime)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ date('d F Y', strtotime($overtime->calendar->date)) }}</td>
                                        <td>{{ $overtime->user->getFullNameAttribute() }}</td>
                                        <td>
                                            <span class="badge badge-info">
                                                {{ $overtime->duration . ' Hours' }}
                                            </span>
                                        </td>
                                        <td>{{ date('H:i', strtotime($overtime->start_time)) }}</td>
                                        <td>{{ date('H:i', strtotime($overtime->end_time)) }}</td>

                                        @if($overtime->approvalStatus === '1')
                                            <td>
                                                <span class="badge badge-warning">NEEDS_APPROVAL</span>
                                            </td>
                                        @elseif($overtime->approvalStatus === '2')
                                            <td>
                                                <span class="badge badge-success">APPROVED</span>
                                            </td>
                                        @elseif($overtime->approvalStatus === '3')
                                            <td>
                                                <span class="badge badge-danger">REJECTED</span>
                                            </td>
                                        @endif

                                        <td>
                                            <a href="{{ route('web.employee.approve-overtimes.show', $overtime->id) }}" class="btn btn-outline-dark btn-sm">
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
            $('#approveOvertimeTable').DataTable({
                columnDefs: [
                    {
                        orderable: false,
                        targets: [7]
                    }
                ],
                order: []
            });
        });
    </script>
@endsection
