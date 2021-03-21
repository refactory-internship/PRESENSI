@extends('layouts.guest.app')
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card p-4 shadow">
                        <div class="card-body">
                            <h1>Forgot your password?</h1>
                            <p>Send us your email address</p>
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="input-group mb-3">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" autocomplete="email" aria-label="email"
                                           placeholder="Email Address">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class="btn btn-block btn-primary">
                                            Send Password Reset Request
                                        </button>
                                    </div>
                                    <div class="col">
                                        <a href="{{ route('login') }}" class="btn btn-block btn-link">
                                            Changed your mind? Let's sign in!
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
