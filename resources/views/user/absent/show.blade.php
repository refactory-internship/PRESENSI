@extends('layouts.app', ['pageTitle' => 'Absent Details'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row">
                @include('layouts.partials.message')
                <div class="col-md-6 mb-3">
                    <a href="{{ route('web.employee.absents.index') }}" class="btn btn-dark">
                        <i class="bi bi-arrow-left-circle"></i>
                        Back
                    </a>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow pt-4">
                        <div class="card-body">
                            <div class="mb-2 pl-4">
                                <div class="row">
                                    <strong>Date</strong>
                                </div>
                                <div class="row">
                                    <p>{{ date('l, F jS Y', strtotime($absent->date)) }}</p>
                                </div>
                            </div>

                            <div class="mb-2 pl-4">
                                <div class="row">
                                    <strong>Reason</strong>
                                </div>
                                <div class="row">
                                    <p>{{ $absent->reason }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="d-flex flex-row justify-content-between align-items-center">
                                <small class="text-muted">
                                    Submitted {{ $absent->created_at->diffForHumans() }}
                                </small>

                                <div class="btn-group float-right">
                                    <a href="{{ route('web.employee.absents.edit', $absent->id) }}" class="btn btn-primary">
                                        <i class="bi bi-pencil-square"></i>
                                        Edit
                                    </a>
                                    <button type="button"
                                            class="btn btn-danger"
                                            id="deleteButton"
                                            data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop"
                                            data-bs-url="{{ route('web.employee.absents.destroy', $absent->id) }}">
                                        Delete
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="text-uppercase font-weight-bold small">Absent Status</div>
                            @if($absent->approvalStatus === '1')
                                <div class="text-value-sm text-warning">NEEDS APPROVAL</div>
                            @elseif($absent->approvalStatus === '2')
                                <div class="text-value-sm text-success">APPROVED</div>
                            @elseif($absent->approvalStatus === '3')
                                <div class="text-value-sm text-danger">REJECTED</div>
                            @endif
                        </div>
                    </div>

                    <div class="card shadow">
                        <div class="card-body">
                            <div class="text-uppercase font-weight-bold small">Approver</div>
                            @if($absent->user->parent)
                                <div class="text-value-sm">
                                    {{ $absent->user->parent->getFullNameAttribute() }}
                                </div>
                            @else
                                <div class="text-value-sm text-info">SYSTEM</div>
                            @endif
                        </div>
                    </div>

                    @if($absent->approvalStatus === '3')
                        <div class="card shadow" style="border-left: 3px solid red">
                            <div class="card-body">
                                <div class="text-uppercase font-weight-bold small">Reason of Rejection</div>
                                <div class="text-value-sm text-danger">
                                    {{ $absent->rejectionNote }}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('user.absent.modal.delete')
@endsection
@section('script')
    @include('layouts.partials.modals.script')
@endsection
