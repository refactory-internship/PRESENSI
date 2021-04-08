@extends('layouts.app', ['pageTitle' => 'Absent Details'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row">
                @include('layouts.partials.message')
                <div class="col-md-6 mb-3">
                    <a href="{{ route('web.employee.approve-absents.index') }}" class="btn btn-dark">
                        <i class="bi bi-arrow-left-circle"></i>
                        Back
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="card-group shadow">
                        <div class="card col-md-5 p-4">
                            <div class="card-body text-center">
                                <div class="mb-2">
                                    <div class="row">
                                        <strong>Employee Name</strong>
                                    </div>
                                    <div class="row">
                                        <p>{{ $absent->user->getFullNameAttribute() }}</p>
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <div class="row">
                                        <strong>Role</strong>
                                    </div>
                                    <div class="row">
                                        <p>{{ $absent->user->role->name }}</p>
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <div class="row">
                                        <strong>Division and Office</strong>
                                    </div>
                                    <div class="row">
                                        <p>{{ $absent->user->division_office->division->name . ' on ' . $absent->user->division_office->office->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card pt-4">
                            <div class="card-body">
                                <div class="mb-2 pl-4">
                                    <div class="row">
                                        <strong>Date of Absence</strong>
                                    </div>
                                    <div class="row">
                                        <p>{{ date('l, F jS Y', strtotime($absent->date)) }}</p>
                                    </div>
                                </div>

                                <div class="mb-2 pl-4">
                                    <div class="row">
                                        <strong>Reason of Absence</strong>
                                    </div>
                                    <div class="row">
                                        <p>{{ $absent->reason }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">
                                    Submitted {{ $absent->created_at->diffForHumans() }}
                                </small>

                                @if($absent->approvalStatus === '2' && $absent->user->isAutoApproved === false)
                                    <div class="text-value-sm text-success">
                                        This absent has been approved
                                    </div>
                                @elseif($absent->approvalStatus === '3' && $absent->user->isAutoApproved === false)
                                    <div class="text-value-sm text-danger">
                                        This absent has been rejected
                                    </div>
                                @else
                                    <div class="btn-group float-right">
                                        <a href="{{ route('web.employee.approve-absents.approve', $absent->id) }}"
                                           onclick="event.preventDefault(); document.getElementById('approve-absent').submit();"
                                           class="btn btn-success">
                                            <i class="bi bi-check-circle"></i>
                                            Approve
                                        </a>
                                        <button type="button"
                                                class="btn btn-danger"
                                                id="rejectButton"
                                                data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop"
                                                data-bs-url="{{ route('web.employee.approve-absents.reject', $absent->id) }}">
                                            Reject
                                            <i class="bi bi-x-circle"></i>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="text-uppercase font-weight-bold small">
                                Absent Status
                            </div>
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
    <form id="approve-absent" action="{{ route('web.employee.approve-absents.approve', $absent->id) }}" method="POST"
          class="d-none">
        @csrf
        @method('PUT')
    </form>
    @include('user.parent.approve-absent.modal.reject')
@endsection
@section('script')
    @include('layouts.partials.modals.script')
@endsection
