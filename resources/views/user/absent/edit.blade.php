@extends('layouts.app', ['pageTitle' => 'Edit Your Absent'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow p-4">
                        <div class="card-body">
                            <form action="{{ route('web.employee.absents.update', $absent->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group row mb-3">
                                    <label for="date" class="col-form-label col-md-3">Date of Absence</label>
                                    <div class="col-md-9">
                                        <input type="date" class="form-control" name="date" id="date"
                                        min="{{ $today }}" max="{{ $last }}" value="{{ $absent->getFormattedDate() }}">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="reason" class="col-form-label col-md-3">Reason of Absence</label>
                                    <div class="col-md-9">
                                        <textarea name="reason" id="reason" cols="30" rows="5"
                                                  class="form-control" style="resize: none">{{ $absent->reason }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group float-right">
                                    <a href="{{ route('web.employee.absents.index') }}" class="btn btn-dark">
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
