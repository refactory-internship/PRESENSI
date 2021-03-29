@extends('layouts.app', ['pageTitle' => 'Your Attendances'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    @include('layouts.partials.message')
                    <div class="mb-3">
                        <a href="{{ route('web.employee.attendances.create') }}" class="btn btn-success rounded-pill">
                            <i class="bi bi-plus"></i>
                            Add New Attendance
                        </a>
                    </div>
                    <div class="card shadow p-4" style="border-radius: 20px">
                        <div class="card-body">
                            <table class="table table-hover text-center" aria-label="attendance-table"
                                   id="attendanceTable">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Clock-In Time</th>
                                    <th scope="col">Clock-Out Time</th>
                                    <th scope="col">Attendance Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($attendances as $attendance)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ date('d F Y', strtotime($attendance->calendar->date)) }}</td>
                                        <td>{{ date('H:i', strtotime($attendance->clock_in_time)) }}</td>

                                        @if(is_null($attendance->clock_out_time))
                                            <td>
                                                <span class="badge badge-secondary">NOT_CLOCKED_OUT</span>
                                            </td>
                                        @else
                                            <td>{{ date('H:i', strtotime($attendance->clock_out_time)) }}</td>
                                        @endif

                                        @if($attendance->approvalStatus === '1')
                                            <td>
                                                <span class="badge badge-warning">NEEDS_APPROVAL</span>
                                            </td>
                                        @elseif($attendance->approvalStatus === '2')
                                            <td>
                                                <span class="badge badge-secondary">CLOCK_OUT_ALLOWED</span>
                                            </td>
                                        @elseif($attendance->approvalStatus === '3')
                                            <td>
                                                <span class="badge badge-success">APPROVED</span>
                                            </td>
                                        @elseif($attendance->approvalStatus === '4')
                                            <td>
                                                <span class="badge badge-danger">REJECTED</span>
                                            </td>
                                        @endif

                                        <td>
                                            <a href="{{ route('web.employee.attendances.show', $attendance->id) }}"
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
            $('#attendanceTable').DataTable({
                columnDefs: [
                    {
                        orderable: false,
                        targets: [5]
                    }
                ],
                order: []
            });
        });
    </script>
@endsection
