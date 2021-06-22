@extends('layouts.app', ['pageTitle' => 'Employee Dashboard'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="text-value-lg">
                                Ongoing Task
                            </div>
                            <div>
                                @if(!$attendance || !$tasks || $attendance->isFinished === true)
                                    <span class="badge badge-warning">
                                        No Ongoing Task
                                    </span>
                                @else
                                    @foreach($tasks as $task)
                                        <div>
                                            {{ $task }}
                                        </div>
                                    @endforeach

                                    @if($attendance->status === '1')
                                        <small class="text-warning">
                                            ON PROGRESS
                                        </small>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="text-value-lg">
                                {{ date('l', strtotime($currentDate)) }}
                            </div>
                            <div>
                                {{ date('H:i', strtotime($currentDate)) }}
                            </div>
                            @if($date->status === '1')
                                <small class="text-info">
                                    WORKING DAY
                                </small>
                            @elseif($date->status === '2')
                                <small class="text-warning">
                                    WEEK END
                                </small>
                            @elseif($date->status === '3')
                                <small class="text-warning">
                                    HOLIDAY
                                </small>
                            @endif
                            @if(date('H:i:s', strtotime($currentDate)) >= \Carbon\Carbon::parse(auth()->user()->time_setting->start_time)->addMinutes(15)->toTimeString()  &&
                                    date('H:i:s', strtotime($currentDate)) <= auth()->user()->time_setting->end_time ||date('H:i:s', strtotime($currentDate)) > auth()->user()->time_setting->end_time)
                                <span class="badge badge-warning">Late Attendance</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <div class="text-value-lg">
                        Your attendance this month
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="text-value-lg text-primary">Attendance</div>
                            <div class="text-muted font-weight-bold small">{{ $attendanceCount }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="text-value-lg text-info">Overtime</div>
                            <div class="text-muted font-weight-bold small">{{ $overtimeCount }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="text-value-lg text-warning">Absent</div>
                            <div class="text-muted font-weight-bold small">{{ $absentCount }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="text-value-lg text-danger">Leave</div>
                            <div class="text-muted font-weight-bold small">{{ $leaveDurationCounter }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
