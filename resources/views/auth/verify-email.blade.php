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

        .btn-primary,
        .btn-secondary {
            padding: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #063309 0%, #09520e 100%);
            border: none;
        }

        .btn-primary:hover {
            box-shadow: 0 5px 15px rgba(59, 130, 246, 0.4);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #6c757d;
            border: none;
        }
    </style>
@endpush

@section('title')
    Verify Email
@endsection

@section('content')
    <div class="container-fluid bg-main patterns-stardust h-100vh d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="auth-card">
                        <div class="auth-body">
                            <h3 class="text-navy fw-bold text-center mb-4">Verify Your Email</h3>

                            <div class="text-navy mb-4">
                                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                            </div>

                            @if (session('status') == 'verification-link-sent')
                                <div class="alert alert-success text-center">
                                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                                </div>
                            @endif

                            <div class="d-flex flex-column gap-3 mt-4">
                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    <button class="btn btn-primary w-100" type="submit">
                                        Resend Verification Email
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="btn btn-secondary w-100" type="submit">
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
