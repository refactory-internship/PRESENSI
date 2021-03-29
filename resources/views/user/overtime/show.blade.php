@extends('layouts.app', ['pageTitle' => 'Your Overtime Details'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow p-4" style="border-radius: 20px">
                        <div class="card-body">
                            <div class="mb-3">
                                <table class="table table-sm table-borderless" aria-label="statuses"
                                       style="font-size: 14px;">
                                    <tr>
                                        <th scope="row" style="width: 20%;">Approval Status</th>
                                        <td>
                                            @if($overtime->approvalStatus === '1')
                                                <span class="badge badge-warning">NEEDS_APPROVAL</span>
                                            @elseif($overtime->approvalStatus === '2')
                                                <span class="badge badge-success">APPROVED</span>
                                            @elseif($overtime->approvalStatus === '3')
                                                <span class="badge badge-danger">REJECTED</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="width: 20%;">Approved By</th>
                                        <td>
                                            @if($overtime->approvedBy == 1)
                                                <span class="badge badge-info">PARENT</span>
                                            @else
                                                <span class="badge badge-info">SYSTEM</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="width: 20%;">Approver</th>
                                        <td>
                                            @if($overtime->user->parent)
                                                {{ $overtime->user->parent->getFullNameAttribute() . ', ' .
                                                   $overtime->user->parent->role->name . ' of ' .
                                                   $overtime->user->parent->division_office->division->name }}
                                            @else
                                                <span
                                                    class="badge badge-success">Automatically Approved By System</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="mb-3">
                                <div class="form-group mb-3">
                                    <label for="task_plan">Task Plan</label>
                                    <input type="text" class="form-control" id="task_plan"
                                           value="{{ $overtime->task_plan }}" disabled>
                                </div>

                                @if($overtime->task_report !== null)
                                    <div class="form-group mb-3">
                                        <label for="task_report">Task Report</label>
                                        <input type="text" class="form-control" id="task_report"
                                               value="{{ $overtime->task_report }}" disabled>
                                    </div>
                                @endif

                                <div class="form-group mb-4">
                                    <label for="date">Date</label>
                                    <input type="text" class="form-control" id="date"
                                           value="{{ date('l, F jS Y', strtotime($overtime->calendar->date)) }}"
                                           disabled>
                                </div>

                                <div class="form-group mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Start Time</span>
                                                </div>
                                                <input type="text" class="form-control" aria-label="clock_in_time"
                                                       value="{{ date('H:i', strtotime($overtime->start_time)) }}"
                                                       disabled>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Overtime Duration</span>
                                                </div>
                                                <input type="text" class="form-control" aria-label="overtime_duration"
                                                       value="{{ $overtime->duration . ' Hour' }}"
                                                       disabled>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">End Time</span>
                                                </div>
                                                <input type="text" class="form-control" aria-label="clock_out_time"
                                                       value="{{ date('H:i', strtotime($overtime->end_time)) }}"
                                                       disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="note">Overtime Note</label>
                                    <textarea class="form-control" id="note" name="note"
                                              style="resize: none" disabled>{{ $overtime->note }}</textarea>
                                </div>
                                <small class="text-muted">
                                    Submitted {{ $overtime->created_at->diffForHumans() }}
                                </small>
                            </div>

                            @if($overtime->rejectionNote !== null && $overtime->approvalStatus === '3')
                                <div class="card shadow-sm mt-3" style="border-left: 2px solid #e55353">
                                    <div class="card-body">
                                        <label for="rejectionNote">Reason of Rejection</label>
                                        <textarea name="rejectionNote" id="rejectionNote" style="resize: none;"
                                                  class="form-control"
                                                  disabled>{{ $overtime->rejectionNote }}</textarea>
                                    </div>
                                </div>
                            @endif

                            <a href="{{ route('web.employee.overtimes.index') }}" class="btn btn-dark">
                                <i class="bi bi-arrow-left-circle"></i>
                                Back
                            </a>

                            <div class="btn-group float-right">
                                @if($overtime->approvalStatus === '2')
                                    <button type="button" class="btn btn-primary" onclick="updateOvertimeProgress()">
                                        Update Overtime Progress
                                    </button>
                                @else
                                    <a href="{{ route('web.employee.overtimes.edit', $overtime->id) }}"
                                       class="btn btn-outline-dark">
                                        <i class="bi bi-pencil-square"></i>
                                        Edit
                                    </a>
                                @endif
                                <button type="button"
                                        class="btn btn-outline-danger"
                                        id="deleteButton"
                                        data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop"
                                        data-bs-url="{{ route('web.employee.overtimes.destroy', $overtime->id) }}">
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
    @include('user.overtime.modal.delete-overtime')
    @include('user.overtime.update-progress')
@endsection
@section('script')
    @include('layouts.partials.modals.script')
    <script>
        function updateOvertimeProgress() {
            $('#updateOvertimeProgress').modal('show');
        }
    </script>
@endsection
