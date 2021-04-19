@extends('layouts.app', ['pageTitle' => 'Add New Calendar'])
@section('content')
    <div class="container">
        <div class="fade-in">

            <div class="row justify-content-center">
                @include('layouts.partials.message')
                <div class="col-md-10">
                    <div class="card shadow">
                        <div class="card-header text-uppercase font-weight-bold small">
                            Existing Date
                        </div>
                        <div class="card-body row text-center">
                            <div class="col border-right">
                                <div class="text-value">From</div>
                                <div class="text-uppercase text-muted small">
                                    @if($first !== null)
                                        {{ date('F j, Y', strtotime($first->date)) }}
                                    @else
                                        No Data
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-value">To</div>
                                <div class="text-uppercase text-muted small">
                                    @if($last !== null)
                                        {{ date('F j, Y', strtotime($last->date)) }}
                                    @else
                                        No Data
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow p-4">
                        <div class="card-body">
                            @include('admin.calendar._form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
