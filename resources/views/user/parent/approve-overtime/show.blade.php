@extends('layouts.app', ['pageTitle' => 'Overtime Details'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    @include('layouts.partials.message')
                    <div class="card shadow p-4" style="border-radius: 20px">
                        <div class="card-body">
                            <table class="table table-sm table-borderless" aria-label="employee"
                                   style="font-size: 14px">
                                <tr>
                                    <th scope="row" style="width: 20%;">Employee Name</th>
                                    <td>{{ $overtime->user->getFullNameAttribute() }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" style="width: 20%;">Role</th>
                                    <td>{{ $overtime->user->role->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" style="width: 20%;">Office and Division</th>
                                    <td>
                                        {{ $overtime->user->division_office->division->name . ' on ' . $overtime->user->division_office->office->name }}
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
                                        <th scope="row" style="width: 20%;">Overtime Status</th>
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
                                </table>

                                <div class="mb-3">
                                    <div class="form-group mb-3">
                                        <label for="task_plan">Task Plan</label>
                                        <input type="text" class="form-control" id="task_plan"
                                               value="{{ $overtime->task_plan }}" disabled>
                                    </div>

                                    @if($overtime->task_report !== null)
                                        <div class="form-group mb-3">
                                            <label for="task_report">Task Report</label>
                                            <input type="text" class="form-control" id="task_report" disabled
                                                   value="{{ $overtime->task_report }}">
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
                                                    <input type="text" class="form-control" aria-label="start_time"
                                                           disabled
                                                           value="{{ date('H:i', strtotime($overtime->start_time)) }}">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Duration</span>
                                                    </div>
                                                    <input type="text" class="form-control" aria-label="duration"
                                                           disabled
                                                           value="{{ $overtime->duration . ' Hours' }}">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">End Time</span>
                                                    </div>
                                                    <input type="text" class="form-control" aria-label="end_time"
                                                           disabled
                                                           value="{{ date('H:i', strtotime($overtime->end_time)) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="note">Overtime Note</label>
                                        <textarea id="note" cols="30" rows="5" disabled class="form-control"
                                                  style="resize: none;">{{ $overtime->note }}</textarea>
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

                                <a href="{{ route('web.employee.approve-overtimes.index') }}" class="btn btn-dark">
                                    <i class="bi bi-arrow-left-circle"></i>
                                    Back
                                </a>

                                <div class="float-right">
                                    @if($overtime->approvalStatus === '1')
                                        <a href="{{ route('web.employee.approve-overtimes.approve', $overtime->id) }}"
                                           onclick="event.preventDefault(); document.getElementById('approve-overtime').submit();"
                                           class="btn btn-outline-success">
                                            <i class="bi bi-check-circle"></i>
                                            Approve
                                        </a>
                                        <button type="button"
                                                class="btn btn-outline-danger"
                                                id="rejectButton"
                                                data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop"
                                                data-bs-url="{{ route('web.employee.approve-overtimes.reject', $overtime->id) }}">
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
