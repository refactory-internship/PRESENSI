@extends('layouts.app', ['pageTitle' => 'Edit Your Overtime'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow p-4" style="border-radius: 20px">
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
                                        <label class="col-form-label col-md-3" for="note">Overtime Note</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" id="note" name="note"
                                                      style="resize: none">{{ $overtime->note }}</textarea>
                                            <small class="text-muted">Provide details about your overtime if seems necessary</small>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update Overtime</button>
                                        <a href="{{ route('web.employee.overtimes.show', $overtime->id) }}"
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
