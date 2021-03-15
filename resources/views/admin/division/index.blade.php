@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    @include('layouts.partials.message')
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover" aria-label="division-table">
                                <caption style="caption-side: top;">
                                    <a href="{{ route('web.admin.divisions.create') }}" class="btn btn-outline-success">
                                        <svg class="c-icon">
                                            <use xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-plus"></use>
                                        </svg>
                                        Add New Division
                                    </a>
                                </caption>
                                <thead>
                                <tr>
                                    <th scope="col" style="width: 10%">#</th>
                                    <th scope="col" style="width: 65%">Name</th>
                                    <th scope="col" class="text-center" style="width: 25%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($divisions as $division)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $division->name }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('web.admin.divisions.show', $division->id) }}"
                                               class="btn btn-sm btn-outline-dark">
                                                Check Details
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No Data</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            {{ $divisions->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
