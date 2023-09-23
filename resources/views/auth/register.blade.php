@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="w-100 d-flex flex-column justify-content-center align-items-center">

            <div class="p-5 bg-white border rounded-4 col-12 col-md-6">
                <h2 class="mb-1 fw-bold">Register</h2>
                <p class="mb-4">Silahkan register untuk melanjutkan.</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3 row">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3 row">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3 row">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3 row">
                        <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password">
                    </div>

                    <div class="mb-0 row">
                        <button type="submit" class="btn btn-dark">
                            {{ __('Register') }}
                        </button>
                        <span class="mt-2 text-center">Sudah punya akun?
                            <a href="{{ route('login') }}">Login</a>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
