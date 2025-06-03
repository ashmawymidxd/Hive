@extends('auth.layouts.master')

@push('pagestyles')
    <style>
        .auth-card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .auth-header {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .auth-body {
            padding: 2.5rem;
            background: white;
        }

        .logo-circle {
            width: 100px;
            height: 100px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: -70px auto 20px;
            overflow: hidden;
        }

        .logo-circle img {
            width: 100%;
            height: 100%;

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

        .auth-footer {
            text-align: center;
            padding-top: 1.5rem;
            border-top: 1px solid #eee;
            margin-top: 1.5rem;
            font-size: 0.9rem;
        }

        .input-group-text {
            background-color: #f8f9fa;
        }

        .input-group-text i {
            width: 16px;
            text-align: center;
        }
    </style>
@endpush

@section('title')
    Register
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100 py-5">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="auth-card mb-5">
                    <div class="auth-header">
                        <h2 class="fw-bold mb-0">Create Account</h2>
                        <p class="mb-0">Join us by creating your account</p>
                    </div>

                    <div class="auth-body">
                        <div class="logo-circle p-2">
                            <!-- Replace with your logo -->
                            <img class="rounded-circle" src="{{ asset('assets/admin/img/logo/hive.png') }}" alt="Logo">
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-4">
                                <label for="name" class="form-label fw-semibold">Name</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input id="name" type="text"
                                        class="form-control form-control-lg @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                        placeholder="Enter your name">
                                </div>
                                @error('name')
                                    <span class="invalid-feedback d-block mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input id="email" type="email"
                                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email"
                                        placeholder="Enter your email">
                                </div>
                                @error('email')
                                    <span class="invalid-feedback d-block mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input id="password" type="password"
                                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="new-password"
                                        placeholder="Enter your password">
                                </div>
                                @error('password')
                                    <span class="invalid-feedback d-block mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input id="password_confirmation" type="password" class="form-control form-control-lg"
                                        name="password_confirmation" required autocomplete="new-password"
                                        placeholder="Confirm your password">
                                </div>
                            </div>


                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-login btn-lg">
                                    <i class="fas fa-user-plus me-2"></i> Register
                                </button>
                            </div>
                        </form>
                        <!-- OR Divider -->
                        <div class="text-center my-3 d-flex align-items-center justify-content-center">
                            <span class="border-bottom p-1 w-50"></span><span class="p-2">or</span> <span
                                class="border-bottom p-1 w-50"></span>
                        </div>

                        <!-- Social Login Buttons -->
                        <div class="d-flex  gap-3">
                            <a href="{{ route('social.login', ['provider' => 'google']) }}"
                                class="btn btn-outline-danger d-flex align-items-center justify-content-center gap-2">
                                <i class="fab fa-google"></i> Continue with Google
                            </a>

                            <a href="{{ route('social.login', ['provider' => 'facebook']) }}"
                                class="btn btn-outline-primary d-flex align-items-center justify-content-center gap-2">
                                <i class="fab fa-facebook-f"></i> Continue with Facebook
                            </a>
                        </div>
                        <div class="auth-footer">
                            Already have an account?
                            <a href="{{ route('login') }}" class="text-decoration-none fw-semibold text-primary">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
