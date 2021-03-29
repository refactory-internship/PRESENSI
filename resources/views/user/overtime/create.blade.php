@extends('layouts.app', ['pageTitle' => 'Submit New Overtime'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow p-4" style="border-radius: 20px">
                        <div class="card-body">
                            <h5 class="mb-3">{{ \Carbon\Carbon::parse($currentDate)->isoFormat('dddd, MMMM Do YYYY, kk:mm') }}</h5>
                            @if($date->status === '1')
                                @if(\Carbon\Carbon::parse($currentDate)->toTimeString() >= auth()->user()->time_setting->start_time &&
                                    \Carbon\Carbon::parse($currentDate)->toTimeString() <= auth()->user()->time_setting->end_time)
                                    <p>
                                        We're sorry, you cannot create an overtime during working hour
                                    </p>
                                    <a href="{{ route('web.employee.attendances.index') }}" class="btn btn-primary">
                                        Go to your attendance
                                    </a>
                                    <a href="{{ route('web.employee.overtimes.index') }}" class="btn btn-dark">
                                        Cancel
                                    </a>
                                @elseif(\Carbon\Carbon::parse($currentDate)->toTimeString() >
                                        \Carbon\Carbon::parse(auth()->user()->time_setting->end_time)->toTimeString())
                                    @include('user.overtime._form')
                                @endif
                            @else
                                @include('user.overtime._form')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
