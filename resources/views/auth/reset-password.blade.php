@extends('auth.layouts.master')

@push('pagestyles')
    <style>
        .auth-card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .auth-body {
            padding: 2.5rem;
            background: white;
        }
        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 0.25rem rgba(59, 130, 246, 0.25);
        }
        .btn-login {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            border: none;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(59, 130, 246, 0.4);
        }
    </style>
@endpush

@section('title') Reset Password @endsection

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="auth-card">
                    <div class="auth-body">
                        <h3 class="text-navy fw-bold text-center mb-4">Reset your password</h3>

                        <form method="POST" action="{{ route('password.store') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold">Email address</label>
                                <input id="email" type="email" name="email"
                                       value="{{ old('email') }}"
                                       class="form-control form-control-lg @error('email') is-invalid @enderror"
                                       required autofocus autocomplete="username">

                                @error('email')
                                    <span class="invalid-feedback d-block mt-2">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold">New Password</label>
                                <input id="password" type="password" name="password"
                                       class="form-control form-control-lg @error('password') is-invalid @enderror"
                                       required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback d-block mt-2">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
                                <input id="password_confirmation" type="password" name="password_confirmation"
                                       class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror"
                                       required autocomplete="new-password">

                                @error('password_confirmation')
                                    <span class="invalid-feedback d-block mt-2">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary btn-login btn-lg">
                                    Reset Password
                                </button>
                            </div>

                            <div class="mt-4 text-center">
                                <a href="{{ route('login') }}" class="text-navy">Back to Login</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
