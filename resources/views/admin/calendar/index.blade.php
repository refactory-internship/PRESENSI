@extends('layouts.app', ['pageTitle' => 'Manage Calendar'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    @include('layouts.partials.message')
                    <div class="mb-3">
                        <a href="{{ route('web.admin.calendars.create') }}" class="btn btn-success">
                            <i class="bi bi-plus"></i>
                            Add New Calendar
                        </a>
                    </div>

                    <div class="card shadow p-4">
                        <div class="card-body">
                            <form action="{{ route('web.admin.calendars.search') }}" method="GET">
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label for="month" class="text-uppercase font-weight-bold small">
                                            Select Month
                                        </label>
                                        <select class="form-control" id="month" name="month">
                                            <option selected>Select Month</option>
                                            @foreach($months as $month => $month_name)
                                                <option value="{{ $month }}">{{ $month_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="year" class="text-uppercase font-weight-bold small">
                                            Select Year
                                        </label>
                                        <select class="form-control" id="year" name="year">
                                            <option selected>Select Year</option>
                                            @foreach($years as $id => $year)
                                                <option value="{{ $id }}">{{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 align-self-end">
                                        <input type="submit" class="btn btn-primary" value="Filter">
                                    </div>
                                </div>
                            </form>

                            <div class="row">
                                <div class="col">
                                    @include('admin.calendar.accordion')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.calendar.modal.edit')
@endsection
@section('script')
    @include('admin.calendar.modal.script')
@endsection
