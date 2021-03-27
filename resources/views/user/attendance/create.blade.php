@extends('layouts.app', ['pageTitle' => 'Create New Attendance'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow p-4" style="border-radius: 20px;">
                        <div class="card-body">
                            <h5>Time Today: {{ date('H:i', strtotime($currentDate)) }}</h5>
                            <h5>
                                @if(date('H:i:s', strtotime($currentDate)) >= \Carbon\Carbon::parse(auth()->user()->time_setting->start_time)->addMinutes(15)->toTimeString()  &&
                                    date('H:i:s', strtotime($currentDate)) <= auth()->user()->time_setting->end_time)
                                    <span class="badge badge-warning">Late Attendance</span>
                                @endif
                            </h5>
                            @if($date->status === '1')
                                @if(date('H:i:s', strtotime($currentDate)) >= auth()->user()->time_setting->start_time &&
                                    date('H:i:s', strtotime($currentDate)) <= auth()->user()->time_setting->end_time)
                                    @include('user.attendance._form')
                                @elseif(date('H:i:s', strtotime($currentDate)) < auth()->user()->time_setting->start_time)
                                    <fieldset>
                                        <legend>Shift Not Started Yet</legend>
                                    </fieldset>
                                @elseif(date('H:i:s', strtotime($currentDate)) > auth()->user()->time_setting->end_time)
                                    @include('user.attendance.button', ['dateStatus' => 'Working Shift Ends'])
                                @endif
                            @elseif($date->status === '2')
                                @include('user.attendance.button', ['dateStatus' => 'Week End'])
                            @elseif($date->status === '3')
                                @include('user.attendance.button', ['dateStatus' => 'Holiday'])
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.partials.modals.user.attendance.option')
    @include('layouts.partials.modals.user.attendance.overtime')
@endsection
@section('script')
    @include('layouts.partials.modals.user.attendance.script')
@endsection
