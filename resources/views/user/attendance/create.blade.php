@extends('layouts.app', ['pageTitle' => 'Create New Attendance'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow p-4">
                        <div class="card-body">
                            <h5 class="mb-3">{{ \Carbon\Carbon::parse($currentDate)->isoFormat('dddd, MMMM Do YYYY, kk:mm') }}</h5>

                            <h5 class="mb-3">
                                @if($date->status == 1)
                                    @if(date('H:i:s', strtotime($currentDate)) > \Carbon\Carbon::parse(auth()->user()->time_setting->start_time)->addMinutes(15)->toTimeString()  &&
                                    date('H:i:s', strtotime($currentDate)) <= auth()->user()->time_setting->end_time)
                                        <span class="badge badge-warning">Late Attendance</span>
                                    @elseif(date('H:i:s', strtotime($currentDate)) < \Carbon\Carbon::parse(auth()->user()->time_setting->start_time)->addMinutes(15)->toTimeString()  ||
                                        date('H:i:s', strtotime($currentDate)) > auth()->user()->time_setting->end_time)
                                        <span class="badge badge-warning">Not In Working Hour</span>
                                    @endif
                                @elseif($date->status == 2)
                                    <span class="badge badge-warning">WEEK END</span>
                                @elseif($date->status == 3)
                                    <span class="badge badge-warning">{{ $date->description }}</span>
                                @endif
                            </h5>

                            <form action="{{ route('web.employee.attendances.store') }}" method="POST" id="attendanceForm">
                                @csrf
                                <div id="dyna_form">

                                </div>

                                <div class="form-group row mb-3">
                                    <label class="col-form-label col-md-3" for="note">Attendance Note</label>
                                    <div class="col-md-8">
                                        <textarea class="form-control" id="note" name="note" style="resize: none" cols="30" rows="5"></textarea>
                                        <small class="text-muted">
                                            If you're <strong>clocking-in late</strong> or planning to <strong>clock-out earlier</strong> than your work schedule, please make sure to inform us
                                        </small>
                                    </div>
                                </div>

                                <div class="form-group float-right mr-5 pr-4">
                                    <a href="{{ route('web.employee.attendances.index') }}" class="btn btn-dark">
                                        Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        Submit Attendance
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            var count = 1;

            function dynamic_field(count) {

                html = '<div class="form-group row mb-3" id="dyna_field">';
                html += '<label for="task_plan" class="col-form-label col-md-3">Task Plan</label>';
                html += '<div class="col-md-8">' + '<input type="text" name="task_plan[]" id="task_plan" class="form-control">' + '</div>';

                if (count > 1) {
                    html += '<div class="col-md-1">' +
                        '<button type="button" name="remove" id="remove" class="btn btn-danger">' +
                        '<i class="bi bi-x-circle"></i>' +
                        '</button>' +
                        '</div>' +
                        '</div>';

                    $('#dyna_form').append(html);
                } else {
                    html += '<div class="col-md-1">' +
                        '<button type="button" name="add" id="add" class="btn btn-success">' +
                        '<i class="bi bi-plus-circle"></i>' +
                        '</button>' +
                        '</div>' +
                        '</div>';

                    $('#dyna_form').html(html);
                }
            }

            $(document).on('click', '#add', function () {
                count++;
                dynamic_field(count);
            });

            $(document).on('click', '#remove', function () {
                count--;
                $(this).closest("#dyna_field").remove();
            });

            dynamic_field(count);
        });
    </script>
@endsection
