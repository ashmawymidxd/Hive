@extends('admin.layouts.master')
@push('css')
    <style>
        .error-page {
            text-align: center;
            padding: 40px 0;
        }

        .error-page .headline {
            font-size: 100px;
            line-height: 1;
        }

        .error-content {
            margin-top: 30px;
        }

        .error-content h3 {
            font-size: 24px;
        }
    </style>
@endpush
@section('content')
    <section>
        <div class="content-header" data-aos="fade-right" data-aos-duration="200">
            <h3 class="text-dark fw-bold">Access Denied</h3>
            <p class="text-secondary">
                {{ $message }}
            </p>
        </div>

        <div class="content" data-aos="fade-up" data-aos-duration="400">
            <div class="card border shadow-0 error-page">
                <div class="text-center">
                    <img src="{{ asset(app('settings')->logo_path) }}" alt="" width="200" data-aos="zoom-in" data-aos-duration="600">
                </div>
                <h2 class="headline text-danger">403</h2>

                <div class="error-content">
                    <h3><i class="fas fa-exclamation-triangle text-danger"></i> Access Forbidden</h3>

                    <p>
                        You don't have permission to access this page.
                        @if (auth('admin')->check())
                            Please contact your administrator if you believe this is an error.
                        @else
                            You may need to <a href="{{ route('admin.login') }}">login</a> first.
                        @endif
                    </p>

                    <a href="{{ url()->previous() }}" class="btn btn-primary shadow-0 mt-3">
                        <i class="fas fa-arrow-left"></i> Go Back
                    </a>
                </div>
            </div>
            <div class="card p-3 border shadow-sm mt-4" data-aos="fade-up" data-aos-duration="600">
                <h6 class="mb-3">Your Current Permissions</h6>
                <div class="d-flex flex-wrap gap-2">
                    @foreach (json_decode(auth('admin')->user()->role->permissions ?? '[]') as $permission)
                        <span class="badge badge-primary rounded-pill px-3 py-2">
                            <i class="fas fa-check-circle me-1"></i> {{ $permission }}
                        </span>
                    @endforeach

                    @if (empty(json_decode(auth('admin')->user()->role->permissions ?? '[]')))
                        <div class="text-muted">No permissions assigned</div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        AOS.init();
    </script>
@endpush
