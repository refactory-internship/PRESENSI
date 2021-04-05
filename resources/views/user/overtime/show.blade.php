@extends('layouts.app', ['pageTitle' => 'Your Overtime Details'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <a href="{{ route('web.employee.overtimes.index') }}" class="btn btn-dark">
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
                                            <div class="text-value-sm text-warning mb-3">
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

                                <div class="btn-group float-right">
                                    <a href="{{ route('web.employee.overtimes.edit', $overtime->id) }}"
                                       class="btn btn-primary">
                                        <i class="bi bi-pencil-square"></i>
                                        Update Overtime
                                    </a>
                                    <button type="button"
                                            class="btn btn-danger"
                                            id="deleteButton"
                                            data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop"
                                            data-bs-url="{{ route('web.employee.overtimes.destroy', $overtime->id) }}">
                                        Delete
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="text-uppercase font-weight-bold small">Overtime Status</div>
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

                    <div class="card shadow">
                        <div class="card-body">
                            <div class="text-uppercase font-weight-bold small">Approver</div>
                            @if($overtime->user->parent)
                                <div class="text-value-sm">
                                    {{ $overtime->user->parent->getFullNameAttribute() }}
                                </div>
                            @else
                                <div class="text-value-sm text-info">SYSTEM</div>
                            @endif
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
            </div>
        </div>
    </div>
    @include('user.overtime.modal.delete-overtime')
@endsection
@section('script')
    @include('layouts.partials.modals.script')
    <script>
        function updateOvertimeProgress() {
            $('#updateOvertimeProgress').modal('show');
        }
    </script>
@endsection
