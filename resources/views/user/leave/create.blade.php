@extends('layouts.app', ['pageTitle' => 'Submit New Leave'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow p-4">
                        <div class="card-body">
                            <form action="{{ route('web.employee.leaves.store') }}" method="POST">
                                @csrf
                                <div class="form-group row mb-3">
                                    <label for="start_date" class="col-form-label col-md-3">Start Date</label>
                                    <div class="col-md-9">
                                        <input type="date" class="form-control" name="start_date" id="start_date"
                                        min="{{ $today }}" max="{{ $last }}" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="end_date" class="col-form-label col-md-3">End Date</label>
                                    <div class="col-md-9">
                                        <input type="date" class="form-control" name="end_date" id="end_date"
                                        min="{{ $today }}" max="{{ $last }}" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="note" class="col-form-label col-md-3">Description</label>
                                    <div class="col-md-9">
                                        <textarea name="note" id="note" cols="30" rows="5"
                                                  class="form-control" style="resize: none" required></textarea>
                                    </div>
                                </div>

                                <div class="form-group float-right">
                                    <a href="{{ route('web.employee.leaves.index') }}" class="btn btn-dark">
                                        Cancel
                                    </a>
                                    <input type="submit" class="btn btn-primary" value="Submit Leave">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
