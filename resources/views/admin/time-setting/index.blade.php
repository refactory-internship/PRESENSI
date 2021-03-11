@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    @include('layouts.partials.message')
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover" aria-label="time setting table">
                                <caption style="caption-side: top;">
                                    <a href="{{ route('web.admin.time-settings.create') }}" class="btn btn-success">
                                        <svg class="c-icon">
                                            <use xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-plus"></use>
                                        </svg>
                                        Add New Time Setting
                                    </a>
                                </caption>
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
                                @forelse($times as $time)
                                    <tr>
                                        <th scope="row">{{ $time->id }}</th>
                                        <td>{{ $time->division->name }}</td>
                                        <td>{{ date('H:i', strtotime($time->start_time)) }}</td>
                                        <td>{{ date('H:i', strtotime($time->end_time)) }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('web.admin.time-settings.show', $time->id) }}"
                                               class="btn btn-sm btn-outline-dark">
                                                Check Details
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No Data</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            {{ $times->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
