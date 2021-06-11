@extends('layouts.app', ['pageTitle' => 'Admin Dashboard'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row">
                <div class="col">
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
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <div class="text-value-lg">
                        Today's Attendance Overview
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="text-value-lg text-primary">
                                Attendance Today
                            </div>
                            <div class="text-muted font-weight-bold small">
                                {{ $attendanceCount }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="text-value-lg text-info">
                                Overtime Today
                            </div>
                            <div class="text-muted font-weight-bold small">
                                {{ $overtimeCount }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="text-value-lg text-warning">
                                Absent Today
                            </div>
                            <div class="text-muted font-weight-bold small">
                                {{ $absentCount }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="text-value-lg text-danger">
                                Leave Today
                            </div>
                            <div class="text-muted font-weight-bold small">
                                {{ $leaveDurationCounter }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
