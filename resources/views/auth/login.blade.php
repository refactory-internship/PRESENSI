@extends('layouts.guest.app')
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    @include('layouts.partials.message')
                    <div class="card p-4 shadow">
                        <div class="card-body">
                            <h1>Login</h1>
                            <p class="text-muted">Sign In to your account</p>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="input-group mb-3">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" autocomplete="email" aria-label="email"
                                           placeholder="Email Address" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="input-group mb-3">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           name="password"
                                           autocomplete="current-password" aria-label="password" placeholder="Password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="input-group mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">Remember Me</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <button class="btn btn-block btn-primary" type="submit">Login</button>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <div class="col text-right">
                                            <a class="btn btn-block btn-link" href="{{ route('password.request') }}">
                                                Forgot Password?
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
