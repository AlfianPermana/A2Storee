@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="w-100 d-flex justify-content-center align-items-center">

            <div class="p-5 bg-white border rounded-4 col-12 col-md-6">
                <h2 class="mb-1 fw-bold">Login</h2>
                <p class="mb-4">Silahkan login untuk melanjutkan.</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3 row">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3 row">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3 row">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>

                    <div class="mb-0 row">
                        <button type="submit" class="btn btn-dark">
                            {{ __('Login') }}
                        </button>
                        <span class="mt-2 text-center">Belum punya akun?
                            <a href="{{ route('register') }}">Register</a>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
