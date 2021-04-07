@extends('layouts.app', ['pageTitle' => 'Edit Your Overtime'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow p-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <form action="{{ route('web.employee.overtimes.update', $overtime->id) }}"
                                      method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row mb-3">
                                        <label for="duration" class="col-form-label col-md-3">Overtime Duration</label>
                                        <div class="col-md-9">
                                            <select name="duration" id="duration" class="form-select form-select-sm">
                                                <option value="1" {{ $overtime->duration == 1 ? 'selected' : '' }}>
                                                    1 Hour
                                                </option>
                                                <option value="2" {{ $overtime->duration == 2 ? 'selected' : '' }}>
                                                    2 Hour
                                                </option>
                                                <option value="3" {{ $overtime->duration == 3 ? 'selected' : '' }}>
                                                    3 Hour
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="task_plan" class="col-form-label col-md-3">Task Plan</label>
                                        <div class="col-md-9">
                                            <input type="text" name="task_plan" id="task_plan" class="form-control"
                                                   value="{{ $overtime->task_plan }}">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label for="task_report" class="col-form-label col-md-3">Task Report</label>
                                        <div class="col-md-9">
                                            <input type="text" name="task_report" id="task_report" class="form-control"
                                                   value="{{ $overtime->task_report }}">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label class="col-form-label col-md-3" for="note">Overtime Note</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" id="note" name="note"
                                                      style="resize: none">{{ $overtime->note }}</textarea>
                                            <small class="text-muted">Provide details about your overtime if seems necessary</small>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-9">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="isFinished" value="1"
                                                       name="isFinished" {{ $overtime->isFinished === true ? 'checked' : '' }}>
                                                <label class="form-check-label ml-2" for="isFinished">
                                                    Overtime Finished
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group float-right">
                                        <a href="{{ route('web.employee.overtimes.show', $overtime->id) }}"
                                           class="btn btn-dark">
                                            Cancel
                                        </a>
                                        <button type="submit" class="btn btn-primary">Save</button>
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
