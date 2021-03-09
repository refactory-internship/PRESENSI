@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    @include('layouts.partials.message')
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-5">
                                <table class="table table-sm" aria-label="calendar-table">
                                    <caption style="caption-side: top;">Existing Date</caption>
                                    <tr>
                                        <th scope="col" style="width: 15%">From</th>
                                        @if($first !== null)
                                            <td class="text-center">{{ date('F j, Y', strtotime($first->date)) }}</td>
                                        @else
                                            <td class="text-center">No Data</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <th scope="col" style="width: 15%">To</th>
                                        @if($last !== null)
                                            <td class="text-center">{{ date('F j, Y', strtotime($last->date)) }}</td>
                                        @else
                                            <td class="text-center">No Data</td>
                                        @endif
                                    </tr>
                                </table>
                            </div>

                            <div class="mb-3">
                                <form action="{{ route('web.calendars.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group row mb-3">
                                        <label for="first_range" class="col-md-2 col-form-label">First Date Range</label>
                                        <div class="col-md-10">
                                            <input type="date" class="form-control" name="first_range" id="first_range">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="last_range" class="col-md-2 col-form-label">Last Date Range</label>
                                        <div class="col-md-10">
                                            <input type="date" class="form-control" name="last_range" id="last_range">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Add New Calendar" class="btn btn-primary">
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
