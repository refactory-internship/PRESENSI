@extends('layouts.app', ['pageTitle' => 'Edit Your Attendance'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow p-4" style="border-radius: 20px">
                        <div class="card-body">
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
                                        <label class="col-form-label col-md-3" for="note">Attendance Note</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" id="note" name="note"
                                                      style="resize: none">{{ $attendance->note }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update Attendance</button>
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
@endsection
