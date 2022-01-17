@extends('layouts.app', ['pageTitle' => 'Attendance Details'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row g-0">
                @include('layouts.partials.message')
                <div class="col-md-6 mb-3">
                    <a href="{{ route('web.employee.attendances.index') }}" class="btn btn-dark">
                        <i class="bi bi-arrow-left-circle"></i>
                        Back
                    </a>
                </div>
            </div>
            <div class="row g-0 justify-content-center">
                <div class="col-md-9">
                    <div class="card-group shadow" style="min-height: 25rem">
                        <div class="card col-md-5 p-4">
                            <div class="card-body">
                                <div class="mb-2">
                                    <strong>Date</strong>
                                    <p>{{ date('l, F jS Y', strtotime($attendance->calendar->date)) }}</p>
                                </div>

                                <div class="mb-2">
                                    <div class="d-flex flex-row justify-content-between">
                                        <strong>Clock-In Time</strong>
                                        @if ($attendance->clock_in_time > \Carbon\Carbon::parse(auth()->user()->time_setting->start_time)->addMinutes(15)->toTimeString())
                                            <span class="badge badge-warning font-weight-bold py-1" style="font-size: 12px;">
                                                Late Attendance
                                            </span>
                                        @endif
                                    </div>
                                    <p>{{ date('H:i', strtotime($attendance->clock_in_time)) }}</p>
                                </div>

                                <div class="mb-2">
                                    <strong>Clock-Out Time</strong>
                                    @if(is_null($attendance->clock_out_time))
                                        <div class="text-value-sm text-danger">NOT CLOCKED OUT</div>
                                    @else
                                        <p>{{ date('H:i', strtotime($attendance->clock_out_time)) }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="card pt-4">
                            <div class="card-body">
                                <div class="mb-2 pl-4">
                                    <strong>Task Plan</strong>
                                    <ol>
                                        @foreach($tasks as $task)
                                            <li>{{ $task }}</li>
                                        @endforeach
                                    </ol>
                                </div>

                                <div class="mb-2 pl-4">
                                    <strong>Task Report</strong>
                                    @if($attendance->task_report === null)
                                        <div class="text-value-sm text-danger mb-3">NOT CLOCKED OUT</div>
                                    @else
                                        <p>{{ $attendance->task_report }}</p>
                                    @endif
                                </div>

                                <div class="mb-2 pl-4">
                                    <strong>Attendance Note</strong>
                                    <p>{{ $attendance->note }}</p>
                                </div>
                            </div>

                            <div class="card-footer">
                                @if ($attendance->isFinished !== true)
                                    @if($attendance->approvalStatus === '2')
                                        <small class="text-value-sm text-success">
                                            This attendance has been approved
                                        </small>
                                    @elseif($attendance->approvalStatus === '3')
                                        <small class="text-value-sm text-danger">
                                            This attendance has been rejected
                                        </small>
                                    @else
                                        <small class="text-value-sm text-muted">
                                            Submitted {{ $attendance->created_at->diffForHumans() }}
                                        </small>
                                    @endif

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
                                @else
                                    <small class="text-value-sm text-muted">
                                        This attendance is finished
                                    </small>
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
                            @elseif($attendance->user->isAutoApproved === true)
                                <div class="text-value-sm text-info">SYSTEM</div>
                            @else
                                <div class="text-value-sm text-secondary">NO DATA</div>
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
