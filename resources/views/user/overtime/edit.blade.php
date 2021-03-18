@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-3">Edit Your Attendance {!! $attendance->isApproved === true
                                ? '<span class="badge badge-success">Approved</span>'
                                : '<span class="badge badge-danger">Not Approved</span>'!!}
                                {!! $attendance->isOvertime === true
                                ? '<span class="badge badge-warning">Overtime</span>'
                                : ''!!}

                            </h5>
                            <div class="mb-3">
                                <form action="{{ route('web.employee.overtimes.update', $attendance->id) }}"
                                      method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row mb-3">
                                        <label for="task_plan" class="col-form-label col-md-3">Task Plan</label>
                                        <div class="col-md-9">
                                            <input type="text" name="task_plan" id="task_plan" class="form-control"
                                                   value="{{ $attendance->task_plan }}">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="task_report" class="col-form-label col-md-3">Task Report</label>
                                        <div class="col-md-9">
                                            <input type="text" name="task_report" id="task_report" class="form-control"
                                                   value="{{ $attendance->task_report }}">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="overtime_duration" class="col-form-label col-md-3">Overtime
                                            Duration</label>
                                        <div class="col-md-9">
                                            <select name="overtime_duration" id="overtime_duration" class="form-select form-select-sm">
                                                <option value="1" {{ $attendance->overtimeDuration == 1 ? 'selected' : '' }}>
                                                    1 Hour
                                                </option>
                                                <option value="2" {{ $attendance->overtimeDuration == 2 ? 'selected' : '' }}>
                                                    2 Hour
                                                </option>
                                                <option value="3" {{ $attendance->overtimeDuration == 3 ? 'selected' : '' }}>
                                                    3 Hour
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-form-label col-md-3" for="note">Attendance Note</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" id="note" name="note"
                                                      style="resize: none">{{ $attendance->note }}</textarea>
                                            <small class="text-muted">Provide details about your overtime if seems necessary</small>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update Attendance</button>
                                        <a href="{{ route('web.employee.overtimes.show', $attendance->id) }}"
                                           class="btn btn-dark">
                                            Cancel
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
