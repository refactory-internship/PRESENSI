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
                                @if(date('H:i:s', strtotime($currentDate)) >= auth()->user()->time_setting->start_time &&
                                    date('H:i:s', strtotime($currentDate)) <= auth()->user()->time_setting->end_time)
                                    @include('user.overtime.button', ['dateStatus' => 'Working Hour'])
                                @elseif(date('H:i:s', strtotime($currentDate)) < auth()->user()->time_setting->start_time ||
                                        date('H:i:s', strtotime($currentDate)) > auth()->user()->time_setting->end_time)
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
