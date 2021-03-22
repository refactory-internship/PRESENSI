@extends('layouts.app', ['pageTitle' => 'Your Overtime Details'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
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
                                        <div class="col">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Overtime Duration</span>
                                                </div>
                                                <input type="text" class="form-control" aria-label="overtime_duration"
                                                       value="{{ $attendance->overtimeDuration . ' Hour' }}"
                                                       disabled>
                                            </div>
                                        </div>
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
                                        <th scope="row" style="width: 20%;">QR Code Attendance</th>
                                        <td>
                                            @if($attendance->isQRCode === true)
                                                <i class="text-success bi bi-check-circle"></i>
                                            @else
                                                <i class="text-danger bi bi-x-circle"></i>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="width: 20%;">Approved By</th>
                                        <td>
                                            @if($attendance->approvedBy == 1)
                                                <span class="badge badge-info">Parent</span>
                                            @else
                                                <span class="badge badge-info">System</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="width: 20%;">Approver</th>
                                        <td>
                                            @if($attendance->user->parent)
                                                {{ $attendance->user->parent->getFullNameAttribute() . ', ' .
                                                   $attendance->user->parent->role->name . ' of ' .
                                                   $attendance->user->parent->division_office->division->name }}
                                            @else
                                                <span
                                                    class="badge badge-success">Automatically Approved By System</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <a href="{{ route('web.employee.overtimes.index') }}" class="btn btn-dark">
                                <i class="bi bi-arrow-left-circle"></i>
                                Back
                            </a>
                            <div class="btn-group float-right">
                                <a href="{{ route('web.employee.overtimes.edit', $attendance->id) }}"
                                   class="btn btn-outline-dark {{ $attendance->isApproved === true ? 'disabled' : '' }}">
                                    <i class="bi bi-pencil-square"></i>
                                    Edit
                                </a>
                                <button type="button" class="btn btn-outline-danger {{ $attendance->isApproved === true ? 'disabled' : '' }}" id="deleteButton"
                                        data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop"
                                        data-bs-url="{{ route('web.employee.overtimes.destroy', $attendance->id) }}">
                                    Delete
                                    <i class="bi bi-x-circle"></i>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.partials.modals.user.attendance.delete')
@endsection
@section('script')
    @include('layouts.partials.modals.script')
@endsection
