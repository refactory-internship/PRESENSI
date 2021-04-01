@extends('layouts.app', ['pageTitle' => 'Attendance Details'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row">
                @include('layouts.partials.message')
                <div class="col-md-6 mb-3">
                    <a href="{{ route('web.employee.attendances.index') }}" class="btn btn-dark">
                        <i class="bi bi-arrow-left-circle"></i>
                        Back
                    </a>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <div class="card-group shadow" style="min-height: 25rem">
                        <div class="card col-md-5 p-4">
                            <div class="card-body">
                                <div class="mb-2">
                                    <div class="row">
                                        <strong>Date</strong>
                                    </div>
                                    <div class="row">
                                        <p>{{ date('l, F jS Y', strtotime($attendance->calendar->date)) }}</p>
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <div class="row">
                                        <strong>Clock-In Time</strong>
                                    </div>
                                    <div class="row">
                                        <p>{{ date('H:i', strtotime($attendance->clock_in_time)) }}</p>
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <div class="row">
                                        <strong>Clock-Out Time</strong>
                                    </div>
                                    <div class="row">
                                        @if(is_null($attendance->clock_out_time))
                                            <div class="text-value-sm text-danger">NOT CLOCKED OUT</div>
                                        @else
                                            <p>{{ date('H:i', strtotime($attendance->clock_out_time)) }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card pt-4">
                            <div class="card-body">
                                <div class="mb-2 pl-4">
                                    <div class="row">
                                        <strong>Task Plan</strong>
                                    </div>
                                    <div class="row">
                                        <p>{{ $attendance->task_plan }}</p>
                                    </div>
                                </div>

                                <div class="mb-2 pl-4">
                                    <div class="row">
                                        <strong>Task Report</strong>
                                    </div>
                                    <div class="row">
                                        @if($attendance->task_report === null)
                                            <div class="text-value-sm text-danger mb-3">NOT CLOCKED OUT</div>
                                        @else
                                            <p>{{ $attendance->task_report }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-2 pl-4">
                                    <div class="row">
                                        <strong>Attendance Note</strong>
                                    </div>
                                    <div class="row">
                                        <p>{{ $attendance->note }}</p>
                                    </div>
                                </div>

                                <div class="btn-group float-right">

                                </div>
                            </div>

                            <div class="card-footer">
                                <small class="text-muted">
                                    Submitted {{ $attendance->created_at->diffForHumans() }}
                                </small>

                                @if($attendance->approvalStatus === '2')
                                    <div class="text-value-sm text-success">
                                        This attendance has been approved
                                    </div>
                                @elseif($attendance->approvalStatus === '3')
                                    <div class="text-value-sm text-danger">
                                        This attendance has been rejected
                                    </div>
                                @else
                                    <div class="btn-group float-right">
                                        <a href="{{ route('web.employee.attendances.edit', $attendance->id) }}"
                                           class="btn btn-primary">
                                            <i class="bi bi-pencil-square"></i>
                                            Edit
                                        </a>
                                        <button type="button"
                                                class="btn btn-danger"
                                                id="deleteButton"
                                                data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop"
                                                data-bs-url="{{ route('web.employee.attendances.destroy', $attendance->id) }}">
                                            Delete
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="text-uppercase font-weight-bold small">Attendance Status</div>
                            @if($attendance->approvalStatus === null)
                                @if($attendance->isFinished === true)
                                    <div class="text-value-sm text-success">FINISHED</div>
                                @else
                                    <div class="text-value-sm text-warning">ON PROGRESS</div>
                                @endif
                            @elseif($attendance->approvalStatus === '1')
                                <div class="text-value-sm text-warning">NEEDS APPROVAL</div>
                            @elseif($attendance->approvalStatus === '2')
                                <div class="text-value-sm text-success">APPROVED</div>
                            @elseif($attendance->approvalStatus === '3')
                                <div class="text-value-sm text-danger">REJECTED</div>
                            @endif
                        </div>
                    </div>

                    <div class="card shadow">
                        <div class="card-body">
                            <div class="text-uppercase font-weight-bold small">Approver</div>
                            @if($attendance->user->parent)
                                <div class="text-value-sm">
                                    {{ $attendance->user->parent->getFullNameAttribute() }}
                                </div>
                            @else
                                <div class="text-value-sm text-info">SYSTEM</div>
                            @endif
                        </div>
                    </div>

                    <div class="card shadow">
                        <div class="card-body p-4 d-flex align-items-center">
                            <div class="text-uppercase font-weight-bold small">QR Code Attendance</div>
                            <div class="ms-auto">
                                @if($attendance->isQRCode === true)
                                    <svg class="c-icon c-icon-xl text-success">
                                        <use xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-check-circle"></use>
                                    </svg>
                                @else
                                    <svg class="c-icon c-icon-xl text-danger">
                                        <use xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-x-circle"></use>
                                    </svg>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($attendance->approvalStatus === '3')
                        <div class="card shadow" style="border-left: 3px solid red">
                            <div class="card-body">
                                <div class="text-uppercase font-weight-bold small">Reason of Rejection</div>
                                <div class="text-value-sm text-danger">
                                    {{ $attendance->rejectionNote }}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('user.attendance.modal.delete')
@endsection
@section('script')
    @include('layouts.partials.modals.script')
@endsection
