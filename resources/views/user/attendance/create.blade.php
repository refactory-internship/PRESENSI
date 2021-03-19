@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
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
