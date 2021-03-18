@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    @include('layouts.partials.message')
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover text-center" aria-label="attendance-table" id="attendanceTable">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Overtime Duration</th>
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
                                        <td>
                                            <span class="badge badge-info">{{ $attendance->overtimeDuration . ' Hour' }}</span>
                                        </td>
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
                                            <a href="{{ route('web.employee.overtimes.show', $attendance->id) }}" class="btn btn-sm btn-outline-dark">
                                                Check Details
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <td colspan="7">No Data</td>
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
            $('#attendanceTable').DataTable({
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