@extends('layouts.app', ['pageTitle' => 'Edit Your Attendance'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow p-4">
                        <div class="card-body">
                            <h5 class="mb-3">{{ \Carbon\Carbon::parse($currentDate)->isoFormat('dddd, MMMM Do YYYY, kk:mm') }}</h5>
                            <h5>
                                @if(date('H:i:s', strtotime($currentDate)) < \Carbon\Carbon::parse(auth()->user()->time_setting->end_time)->subMinutes(15)->toTimeString())
                                    <span class="badge badge-warning">Early Clock-Out</span>
                                @endif
                            </h5>
                            <div class="mb-3">
                                <form action="{{ route('web.employee.attendances.update', $attendance->id) }}"
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

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label col-md-3" for="note">Attendance Note</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" id="note" name="note" cols="30" rows="5"
                                                      style="resize: none">{{ $attendance->note }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-9">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="isFinished" value="1"
                                                       name="isFinished" {{ $attendance->isFinished === true ? 'checked' : '' }}>
                                                <label class="form-check-label ml-2" for="isFinished">
                                                    Attendance Finished
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group float-right">
                                        <a href="{{ route('web.employee.attendances.show', $attendance->id) }}"
                                           class="btn btn-dark">
                                            Cancel
                                        </a>
                                        <button type="submit" class="btn btn-primary">Update Attendance</button>
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
