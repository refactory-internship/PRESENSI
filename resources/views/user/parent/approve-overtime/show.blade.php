@extends('layouts.app', ['pageTitle' => 'Overtime Details'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row">
                @include('layouts.partials.message')
                <div class="col-md-6 mb-3">
                    <a href="{{ route('web.employee.approve-overtimes.index') }}" class="btn btn-dark">
                        <i class="bi bi-arrow-left-circle"></i>
                        Back
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow p-4">
                        <div class="card-body text-center">
                            <div class="mb-2">
                                <div class="row">
                                    <strong>Employee Name</strong>
                                </div>
                                <div class="row">
                                    <p>{{ $overtime->user->getFullNameAttribute() }}</p>
                                </div>
                            </div>

                            <div class="mb-2">
                                <div class="row">
                                    <strong>Role</strong>
                                </div>
                                <div class="row">
                                    <p>{{ $overtime->user->role->name }}</p>
                                </div>
                            </div>

                            <div class="mb-2">
                                <div class="row">
                                    <strong>Office and Division</strong>
                                </div>
                                <div class="row">
                                    <p>{{ $overtime->user->division_office->division->name . ' on ' . $overtime->user->division_office->office->name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($overtime->approvalStatus === '3')
                        <div class="card shadow" style="border-left: 3px solid red">
                            <div class="card-body">
                                <div class="text-uppercase font-weight-bold small">Reason of Rejection</div>
                                <div class="text-value-sm text-danger">
                                    {{ $overtime->rejectionNote }}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-md-8">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <div class="col">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="text-uppercase font-weight-bold small">
                                        Overtime Status
                                    </div>
                                    @if($overtime->approvalStatus === null)
                                        @if($overtime->isFinished === true)
                                            <div class="text-value-sm text-success">FINISHED</div>
                                        @else
                                            <div class="text-value-sm text-warning">ON PROGRESS</div>
                                        @endif
                                    @elseif($overtime->approvalStatus === '1')
                                        <div class="text-value-sm text-warning">NEEDS APPROVAL</div>
                                    @elseif($overtime->approvalStatus === '2')
                                        <div class="text-value-sm text-success">APPROVED</div>
                                    @elseif($overtime->approvalStatus === '3')
                                        <div class="text-value-sm text-danger">REJECTED</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="text-uppercase font-weight-bold small">
                                        Approver
                                    </div>
                                    @if($overtime->user->parent)
                                        <div class="text-value-sm">
                                            {{ $overtime->user->parent->getFullNameAttribute() }}
                                        </div>
                                    @else
                                        <div class="text-value-sm text-info">SYSTEM</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow">
                                <div class="card-body p-4 d-flex align-items-center">
                                    <div class="text-uppercase font-weight-bold small">
                                        QR Code Attendance
                                    </div>
                                    <div class="ms-auto">
                                        @if($overtime->isQRCode === true)
                                            <svg class="c-icon c-icon-xl text-success">
                                                <use
                                                    xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-check-circle"></use>
                                            </svg>
                                        @else
                                            <svg class="c-icon c-icon-xl text-danger">
                                                <use
                                                    xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-x-circle"></use>
                                            </svg>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="card-group shadow">
                                <div class="card col-md-5 p-4">
                                    <div class="card-body">
                                        <div class="mb-2">
                                            <div class="row">
                                                <strong>Date</strong>
                                            </div>
                                            <div class="row">
                                                <p>{{ date('l, F jS Y', strtotime($overtime->calendar->date)) }}</p>
                                            </div>
                                        </div>

                                        <div class="mb-2">
                                            <div class="row">
                                                <strong>Start Time</strong>
                                            </div>
                                            <div class="row">
                                                <p>{{ date('H:i', strtotime($overtime->start_time)) }}</p>
                                            </div>
                                        </div>

                                        <div class="mb-2">
                                            <div class="row">
                                                <strong>Overtime Duration</strong>
                                            </div>
                                            <div class="row">
                                                <div class="text-value mb-3">
                                                    {{ $overtime->duration . ' Hour' }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-2">
                                            <div class="row">
                                                <strong>End Time</strong>
                                            </div>
                                            <div class="row">
                                                <p>{{ date('H:i', strtotime($overtime->end_time)) }}</p>
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
                                                <p>{{ $overtime->task_plan }}</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 pl-4">
                                            <div class="row">
                                                <strong>Task Report</strong>
                                            </div>
                                            <div class="row">
                                                @if($overtime->task_report === null)
                                                    <div class="text-value-sm text-danger mb-3">
                                                        NO REPORT
                                                    </div>
                                                @else
                                                    <p>{{ $overtime->task_report }}</p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="mb-2 pl-4">
                                            <div class="row">
                                                <strong>Overtime Note</strong>
                                            </div>
                                            <div class="row">
                                                <p>{{ $overtime->note }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <small class="text-muted">
                                            Submitted {{ $overtime->created_at->diffForHumans() }}
                                        </small>

                                        @if($overtime->approvalStatus === '2')
                                            <div class="text-value-sm text-success">
                                                This overtime has been approved
                                            </div>
                                        @elseif($overtime->approvalStatus === '3')
                                            <div class="text-value-sm text-danger">
                                                This overtime has been rejected
                                            </div>
                                        @else
                                            <div class="btn-group float-right">
                                                <a href="{{ route('web.employee.approve-overtimes.approve', $overtime->id) }}"
                                                   onclick="event.preventDefault(); document.getElementById('approve-overtime').submit();"
                                                   class="btn btn-success">
                                                    <i class="bi bi-check-circle"></i>
                                                    Approve
                                                </a>
                                                <button type="button"
                                                        class="btn btn-danger"
                                                        id="rejectButton"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#staticBackdrop"
                                                        data-bs-url="{{ route('web.employee.approve-overtimes.reject', $overtime->id) }}">
                                                    Reject
                                                    <i class="bi bi-x-circle"></i>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form id="approve-overtime" action="{{ route('web.employee.approve-overtimes.approve', $overtime->id) }}"
          method="POST"
          class="d-none">
        @csrf
        @method('PUT')
    </form>
    @include('user.parent.approve-overtime.modal.reject')
@endsection
@section('script')
    @include('layouts.partials.modals.script')
@endsection
