@extends('layouts.app', ['pageTitle' => 'Attendance Details'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    @include('layouts.partials.message')
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
                                <table class="table table-sm table-borderless" aria-label="statuses"
                                       style="font-size: 14px;">
                                    <tr>
                                        <th scope="row" style="width: 20%;">Attendance Status</th>
                                        <td>
                                            @if($attendance->approvalStatus === '1')
                                                <span class="badge badge-warning">NEEDS_APPROVAL</span>
                                            @elseif($attendance->approvalStatus === '2')
                                                <span class="badge badge-secondary">CLOCK_OUT_ALLOWED</span>
                                            @elseif($attendance->approvalStatus === '3')
                                                <span class="badge badge-success">APPROVED</span>
                                            @elseif($attendance->approvalStatus === '4')
                                                <span class="badge badge-danger">REJECTED</span>
                                            @endif
                                        </td>
                                    </tr>
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
                                </table>
                            </div>

                            <div class="mb-3">
                                <div class="form-group mb-3">
                                    <label for="task_plan">Task Plan</label>
                                    <input type="text" class="form-control" id="task_plan"
                                           value="{{ $attendance->task_plan }}" disabled>
                                </div>

                                @if($attendance->approvalStatus !== '1' || $attendance->task_report !== null)
                                    <div class="form-group mb-3">
                                        <label for="task_report">Task Report</label>
                                        <input type="text" class="form-control" id="task_report"
                                               value="{{ $attendance->task_report === null ? 'NOT_CLOCKED_OUT' : $attendance->task_report}}"
                                               disabled>
                                    </div>
                                @endif

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

                                        @if($attendance->approvalStatus !== '1' || $attendance->clock_out_time !== null)
                                            <div class="col">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Clock-Out Time</span>
                                                    </div>
                                                    <input type="text" class="form-control" aria-label="clock_out_time"
                                                           value="{{ $attendance->clock_out_time === null ? 'NOT_CLOCKED_OUT' : date('H:i', strtotime($attendance->clock_out_time)) }}"
                                                           disabled>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label for="note">Attendance Note</label>
                                            <textarea class="form-control" id="note" name="note"
                                                      style="resize: none" cols="30" rows="5"
                                                      disabled>{{ $attendance->note }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <small>Submitted {{ $attendance->created_at->diffForHumans() }}</small>
                            </div>

                            @if($attendance->rejectionNote !== null && $attendance->approvalStatus === '4')
                                <div class="card shadow-sm mt-3" style="border-left: 2px solid #e55353">
                                    <div class="card-body">
                                        <label for="rejectionNote">Reason of Rejection</label>
                                        <textarea name="rejectionNote" id="rejectionNote" style="resize: none;"
                                                  class="form-control"
                                                  disabled>{{ $attendance->rejectionNote }}</textarea>
                                    </div>
                                </div>
                            @endif

                            <a href="{{ route('web.employee.approve-attendances.index') }}" class="btn btn-dark">
                                <i class="bi bi-arrow-left-circle"></i>
                                Back
                            </a>

                            <div class="float-right">
                                @if($attendance->approvalStatus === '1')
                                    @if($attendance->clock_out_time !== null)
                                        <a href="{{ route('web.employee.approve-attendances.approve', $attendance->id) }}"
                                           onclick="event.preventDefault(); document.getElementById('approve-attendance').submit();"
                                           class="btn btn-outline-success">
                                            <i class="bi bi-check-circle"></i>
                                            Approve
                                        </a>
                                    @else
                                        <a href="{{ route('web.employee.approve-attendances.approve', $attendance->id) }}"
                                           onclick="event.preventDefault(); document.getElementById('approve-attendance').submit();"
                                           class="btn btn-primary">
                                            <i class="bi bi-check-circle"></i>
                                            Allow Clock-out
                                        </a>
                                    @endif
                                    <button type="button"
                                            class="btn btn-outline-danger"
                                            id="rejectButton"
                                            data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop"
                                            data-bs-url="{{ route('web.employee.approve-attendances.reject', $attendance->id) }}">
                                        Reject
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                @endif
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
    @include('layouts.partials.modals.user.attendance.reject')
@endsection
@section('script')
    @include('layouts.partials.modals.script')
@endsection
