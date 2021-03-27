@extends('layouts.app', ['pageTitle' => 'Clock-Out'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow p-4" style="border-radius: 20px">
                        <div class="card-body">
                            <h5>Time Today: {{ date('H:i', strtotime($currentDate)) }}</h5>
                            <h5>
                                @if(date('H:i:s', strtotime($currentDate)) < \Carbon\Carbon::parse(auth()->user()->time_setting->end_time)->subMinutes(15)->toTimeString())
                                    <span class="badge badge-warning">Early Clock-Out</span>
                                @endif
                            </h5>
                            <div class="mb-3">
                                <form action="{{ route('web.employee.attendances.submit-clock-out', $attendance->id) }}"
                                      method="POST" id="clockOutForm">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row mb-3">
                                        <label for="task_report" class="col-md-3 col-form-label">Task Report</label>
                                        <div class="col-md-9">
                                            <input type="text" name="task_report" id="task_report" class="form-control"
                                                   value="{{ $attendance->task_report }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="button" onclick="submitClockOut()">
                                            Clock-Out
                                        </button>
                                        <a href="{{ route('web.employee.attendances.show', $attendance->id) }}"
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
    @include('layouts.partials.modals.user.attendance.early-clock-out')
@endsection
@section('script')
    @include('layouts.partials.modals.user.attendance.early-script')
@endsection
