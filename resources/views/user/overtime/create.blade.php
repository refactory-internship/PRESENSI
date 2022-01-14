@extends('layouts.app', ['pageTitle' => 'Submit New Overtime'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow p-4">
                        <div class="card-body">
                            <h5 class="mb-3">{{ \Carbon\Carbon::parse($currentDate)->isoFormat('dddd, MMMM Do YYYY, kk:mm') }}</h5>
                            <h5 class="mb-3">
                                @if($date->status === '1')
                                    @if(date('H:i:s', strtotime($currentDate)) >= auth()->user()->time_setting->start_time &&
                                        date('H:i:s', strtotime($currentDate)) <= auth()->user()->time_setting->end_time)
                                        <span class="badge badge-warning">Working Hour</span>
                                    @endif
                                @endif
                            </h5>
                            <form action="{{ route('web.employee.overtimes.store') }}" method="POST">
                                @csrf
                                <div class="form-group row mb-3">
                                    <label for="overtime_duration" class="col-form-label col-md-3">Overtime
                                        Duration</label>
                                    <div class="col-md-9">
                                        <select name="duration" id="overtime_duration"
                                                class="form-select form-select-sm">
                                            <option value="1">1 Hour</option>
                                            <option value="2">2 Hour</option>
                                            <option value="3">3 Hour</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="task_plan" class="col-form-label col-md-3">Task Plan</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="task_plan" id="task_plan" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="note" class="col-form-label col-md-3">Overtime Note</label>
                                    <div class="col-md-9">
                                    <textarea class="form-control" name="note" id="note" cols="30" rows="5"
                                              style="resize: none;"></textarea>
                                        <small class="text-muted">Provide more information about your overtime if
                                            necessary</small>
                                    </div>
                                </div>
                                <div class="form-group float-right">
                                    <a href="{{ route('web.employee.overtimes.index') }}" class="btn btn-dark">
                                        Cancel
                                    </a>
                                    <input type="submit" class="btn btn-primary" value="Submit Overtime">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
