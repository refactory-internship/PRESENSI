@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    @include('layouts.partials.message')
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover text-center" aria-label="approve-attendance" id="approveAttendanceTable">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">QR Code Attendance</th>
                                    <th scope="col">Overtime</th>
                                    <th scope="col">Clock In Time</th>
                                    <th scope="col">Clock Out Time</th>
                                    <th scope="col">Approval Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($attendances as $attendance)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ date('d F Y', strtotime($attendance->calendar->date)) }}</td>
                                        @if($attendance->isQRCode === true)
                                            <td>
                                                <svg class="c-icon text-success">
                                                    <use xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-check-alt"></use>
                                                </svg>
                                            </td>
                                        @else
                                            <td>
                                                <svg class="c-icon text-danger">
                                                    <use xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-x"></use>
                                                </svg>
                                            </td>
                                        @endif
                                        @if($attendance->isOvertime === true)
                                            <td>
                                                <span class="badge badge-warning">Yes</span>
                                            </td>
                                        @else
                                            <td>
                                                <span class="badge badge-secondary">No</span>
                                            </td>
                                        @endif
                                        <td>{{ date('H:i', strtotime($attendance->clock_in_time)) }}</td>
                                        <td>{{ date('H:i', strtotime($attendance->clock_out_time)) }}</td>
                                        @if($attendance->isApproved === true)
                                            <td>
                                                <span class="badge badge-success">Approved</span>
                                            </td>
                                        @else
                                            <td>
                                                <span class="badge badge-danger">Not Approved</span>
                                            </td>
                                        @endif
                                        <td>
                                            <a href="{{ route('web.employee.approve-attendances.show', $attendance->id) }}" class="btn btn-sm btn-outline-dark">
                                                Check Details
                                            </a>
                                        </td>
                                    </tr>
                                @empty
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
            $('#approveAttendanceTable').DataTable({
                columnDefs: [
                    {
                        orderable: false,
                        targets: [0, 6]
                    }
                ],
                order: []
            });
        });
    </script>
@endsection
