@extends('layouts.guest.app')
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card p-4 shadow" style="border-radius: 20px;">
                        <div class="card-body">
                            <h5 class="text-center mb-3">Remaining Time:</h5>
                            <div class="visible-print text-center mb-3">
                                {{ $qr_code }}
                            </div>
                            <div class="text-center">
                                <a class="btn btn-danger" href="{{ route('web.admin.QRCode.create') }}" onclick="window.close()">
                                    Stop QR Code
                                    <i class="bi bi-x-circle"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
