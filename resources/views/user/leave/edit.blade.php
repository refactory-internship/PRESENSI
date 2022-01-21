@extends('layouts.app', ['pageTitle' => 'Edit Your Leave'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow p-4">
                        <div class="card-body">
                            <form action="{{ route('web.employee.leaves.update', $leave->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group row mb-3">
                                    <label for="start_date" class="col-form-label col-md-3">Start Date</label>
                                    <div class="col-md-9">
                                        <input type="date" class="form-control" name="start_date" id="start_date"
                                        min="{{ $today }}" max="{{ $last }}" value="{{ $leave->getFormattedStartDate() }}">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="end_date" class="col-form-label col-md-3">End Date</label>
                                    <div class="col-md-9">
                                        <input type="date" class="form-control" name="end_date" id="end_date"
                                        min="{{ $today }}" max="{{ $last }}" value="{{ $leave->getFormattedEndDate() }}">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="note" class="col-form-label col-md-3">Description</label>
                                    <div class="col-md-9">
                                        <textarea name="note" id="note" cols="30" rows="5"
                                                  class="form-control" style="resize: none">{{ $leave->note }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group float-right">
                                    <a href="{{ route('web.employee.leaves.index') }}" class="btn btn-dark">
                                        Cancel
                                    </a>
                                    <input type="submit" class="btn btn-primary" value="Update">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
