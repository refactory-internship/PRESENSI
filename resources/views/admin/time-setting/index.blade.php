@extends('layouts.app', ['pageTitle' => 'Time Setting List'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    @include('layouts.partials.message')
                    <div class="mb-3">
                        <a href="{{ route('web.admin.time-settings.create') }}" class="btn btn-success">
                            <i class="bi bi-plus"></i>
                            Add New Time Setting
                        </a>
                    </div>
                    <div class="card shadow p-4">
                        <div class="card-body">
                            <table class="table table-hover" aria-label="time setting table" id="timeSettingTable">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Division</th>
                                    <th scope="col">Start Time</th>
                                    <th scope="col">End Time</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($times as $time)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $time->division->name }}</td>
                                        <td>{{ date('H:i', strtotime($time->start_time)) }}</td>
                                        <td>{{ date('H:i', strtotime($time->end_time)) }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('web.admin.time-settings.edit', $time->id) }}" class="btn btn-sm btn-outline-dark">
                                                <i class="bi bi-pencil-square"></i>
                                                Edit Schedule
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
            $('#timeSettingTable').DataTable({
                columnDefs: [
                    {
                        orderable: false,
                        targets: [4]
                    }
                ],
                order: []
            });
        });
    </script>
@endsection
