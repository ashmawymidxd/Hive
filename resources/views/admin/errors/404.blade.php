@extends('admin.layouts.master')
@push('css')
    <style>
        /* Error pages */
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
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .error-content h3 {
            font-size: 24px;
        }

        .search-form {
            max-width: 400px;
            margin: 0 auto;
        }
    </style>
@endpush

@section('content')
    <section>
        <div class="content-header">
            <h3 class="text-dark fw-bold">Page Not Found</h3>
            <p class="text-secondary">Oops! Page not found.</p>
        </div>

        <div class="content card border shadow-0" data-aos="fade-up">
            <div class="error-page">
                <img src="{{ asset('assets/admin/img/logo/hive.png') }}" alt="" width="200" data-aos="zoom-in" data-aos-duration="600">
                <h2 class="headline text-warning">404</h2>

                <div class="error-content">
                    <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>

                    <p>
                        We couldn't find the page you were looking for.
                        Meanwhile, you may <a href="{{ route('admin') }}">return to dashboard</a>
                        or try using the search form.
                    </p>

                    <div class="mt-4">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary mr-2">
                            <i class="fas fa-arrow-left"></i> Go Back
                        </a>
                        <a href="{{ route('admin') }}" class="btn btn-primary shadow-0">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('js')
    <script>
        AOS.init()
    </script>
@endpush
