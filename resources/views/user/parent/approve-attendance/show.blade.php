@extends('layouts.app', ['pageTitle' => 'Attendance Details'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">

                    <div class="card shadow p-4" style="border-radius: 20px">
                        <div class="card-body">
                            <table class="table table-sm table-borderless" aria-label="employee"
                                   style="font-size: 14px;">
                                <tr>
                                    <th scope="row" style="width: 20%;">Employee Name</th>
                                    <td>{{ $attendance->user->getFullNameAttribute() }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" style="width: 20%;">Role</th>
                                    <td>{{ $attendance->user->role->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" style="width: 20%;">Office and Division</th>
                                    <td>
                                        {{ $attendance->user->division_office->division->name . ' on ' . $attendance->user->division_office->office->name }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="card shadow p-4" style="border-radius: 20px">
                        <div class="card-body">
                            <div class="mb-3">
                                <h5>
                                    {!! $attendance->isApproved === true
                                    ? '<span class="badge badge-success">Approved</span>'
                                    : '<span class="badge badge-danger">Not Approved</span>'!!}
                                    {!! $attendance->isOvertime === true
                                    ? '<span class="badge badge-warning">Overtime</span>'
                                    : ''!!}
                                </h5>
                                <small>{{ $attendance->created_at->diffForHumans() }}</small>
                            </div>

                            <div class="mb-3">
                                <div class="form-group mb-3">
                                    <label for="task_plan">Task Plan</label>
                                    <input type="text" class="form-control" id="task_plan"
                                           value="{{ $attendance->task_plan }}" disabled>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="task_report">Task Report</label>
                                    <input type="text" class="form-control" id="task_report"
                                           value="{{ $attendance->task_report }}" disabled>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="date">Date</label>
                                    <input type="text" class="form-control" id="date"
                                           value="{{ date('l, F jS Y', strtotime($attendance->calendar->date)) }}"
                                           disabled>
                                </div>

                                <div class="form-group mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Clock-In Time</span>
                                                </div>
                                                <input type="text" class="form-control" aria-label="clock_in_time"
                                                       value="{{ date('H:i', strtotime($attendance->clock_in_time)) }}"
                                                       disabled>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Clock-Out Time</span>
                                                </div>
                                                <input type="text" class="form-control" aria-label="clock_out_time"
                                                       value="{{ date('H:i', strtotime($attendance->clock_out_time)) }}"
                                                       disabled>
                                            </div>
                                        </div>

                                        @if($attendance->isOvertime === true)
                                            <div class="col">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Overtime Duration</span>
                                                    </div>
                                                    <input type="text" class="form-control"
                                                           aria-label="overtime_duration"
                                                           value="{{ $attendance->overtimeDuration . ' Hour' }}"
                                                           disabled>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="note">Attendance Note</label>
                                    <textarea class="form-control" id="note" name="note"
                                              style="resize: none" disabled>{{ $attendance->note }}</textarea>
                                </div>
                            </div>

                            <div class="mb-4">
                                <table class="table table-sm table-borderless" aria-label="statuses"
                                       style="font-size: 14px;">
                                    <tr>
                                        <th scope="row" style="width: 20%;">Attendance Status</th>
                                        <td>
                                            @if($attendance->status == 1)
                                                <span class="badge badge-info">Present</span>
                                            @elseif($attendance->status == 2)
                                                <span class="badge badge-warning">Absent</span>
                                            @elseif($attendance->status == 3)
                                                <span class="badge badge-info">Leave</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="width: 20%;">QR Code Attendance</th>
                                        <td>
                                            @if($attendance->isQRCode === true)
                                                <svg class="c-icon text-success">
                                                    <use
                                                        xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-check-alt"></use>
                                                </svg>
                                            @else
                                                <svg class="c-icon text-danger">
                                                    <use
                                                        xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-x"></use>
                                                </svg>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <a href="{{ route('web.employee.approve-attendances.index') }}" class="btn btn-dark">
                                <svg class="c-icon">
                                    <use xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-arrow-left"></use>
                                </svg>
                                Back
                            </a>

                            <div class="float-right">
                                <a href="{{ route('web.employee.approve-attendances.approve', $attendance->id) }}"
                                   onclick="event.preventDefault(); document.getElementById('approve-attendance').submit();"
                                   class="btn btn-outline-success {{ $attendance->isApproved === true ? 'disabled' : '' }}">
                                    <svg class="c-icon">
                                        <use xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-check-alt"></use>
                                    </svg>
                                    Approve Attendance
                                </a>
                                <a href="{{ route('web.employee.approve-attendances.reject', $attendance->id) }}"
                                   onclick="event.preventDefault(); document.getElementById('reject-attendance').submit();"
                                   class="btn btn-outline-danger {{ $attendance->isApproved === true ? 'disabled' : '' }}">
                                    Reject Attendance
                                    <svg class="c-icon">
                                        <use xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-x"></use>
                                    </svg>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form id="approve-attendance" action="{{ route('web.employee.approve-attendances.approve', $attendance->id) }}"
          method="POST" class="d-none">
        @csrf
        @method('PUT')
    </form>
    <form id="reject-attendance" action="{{ route('web.employee.approve-attendances.reject', $attendance->id) }}"
          method="POST" class="d-none">
        @csrf
        @method('PUT')
    </form>
@endsection
