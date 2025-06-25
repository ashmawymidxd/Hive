@extends('auth.layouts.master')

@push('pagestyles')
    <style>
        .auth-card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .auth-header {
            background: linear-gradient(135deg, #063309 0%, #0a570f 100%);
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
            background: linear-gradient(135deg, #063309 0%, #09520e 100%);
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
    Login
@endsection

@section('content')
    <div class="container-fluid bg-main patterns-stardust d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center align-items-center min-vh-100 py-5">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="auth-card">
                        <div class="auth-header">
                            <h2 class="fw-bold mb-0">Welcome Back</h2>
                            <p class="mb-0">Please login to your account</p>
                        </div>

                        <div class="auth-body">
                            <div class="logo-circle p-1 border-end border-secondary">
                                <img class="rounded-circle" src="{{ asset(app('settings')->logo_path) }}"
                                    alt="Logo">
                            </div>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <!-- Email Input -->
                                <div class="mb-4">
                                    <label for="email" class="form-label fw-semibold">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <input id="email" type="email"
                                            class="form-control form-control-lg @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required autocomplete="email"
                                            autofocus placeholder="Enter your email">
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback d-block mt-1" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Password Input -->
                                <div class="mb-4">
                                    <label for="password" class="form-label fw-semibold">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                        <input id="password" type="password"
                                            class="form-control form-control-lg @error('password') is-invalid @enderror"
                                            name="password" required autocomplete="current-password"
                                            placeholder="Enter your password">
                                        <button class="btn btn-outline-secondary toggle-password" type="button">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback d-block mt-1" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Remember Me & Forgot Password -->
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">Remember Me</label>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="text-decoration-none text-warning">
                                            Forgot Password?
                                        </a>
                                    @endif
                                </div>

                                <!-- Submit Button -->
                                <div class="d-grid mb-2">
                                    <button type="submit" class="btn btn-primary btn-login btn-lg">
                                        <i class="fas fa-sign-in-alt me-2"></i> Login
                                    </button>
                                </div>

                            </form>
                            <!-- OR Divider -->
                            <div class="text-center mt-2 d-flex align-items-center justify-content-center">
                                <span class="border-bottom p-1 w-50"></span><span class="p-2">or</span> <span
                                    class="border-bottom p-1 w-50"></span>
                            </div>

                            <!-- Social Login Buttons -->
                            <div class="d-flex gap-3">
                                <a href="{{ route('auth.google') }}"
                                    class="form-control">
                                    <img src="https://img.icons8.com/color/16/000000/google-logo.png"
                                        alt="Google Logo" class="me-1">
                                    <small class=""> Continue with Google</small>
                                </a>

                                <a href=""
                                    class="form-control">
                                     <img src="https://img.icons8.com/color/16/000000/facebook-new.png"
                                        alt="Facebook Logo" class="me-1">
                                     <small class=""> Continue with Facebook</small>
                                </a>
                            </div>
                            <!-- Register Link -->
                            <div class="auth-footer">
                                Don't have an account?
                                <a href="{{ route('register') }}" class="text-decoration-none fw-semibold text-warning">Sign
                                    Up</a>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            // Toggle password visibility
            document.querySelectorAll('.toggle-password').forEach(function(button) {
                button.addEventListener('click', function() {
                    const input = this.closest('.input-group').querySelector('input');
                    const icon = this.querySelector('i');

                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        input.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            });
        </script>
    @endpush
@endsection
