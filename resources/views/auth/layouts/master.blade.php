<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('assets/admin/img/logo/hive.png') }}" type="image/x-icon">
    {{-- <link rel="shortcut icon" href="{{ URL::asset($settings->website_favicon) }}" type="image/x-icon"> --}}
    <title>
        @hasSection('title')
            @yield('title')
        @else
            My Website
        @endif
    </title>
    @stack('pagestyles')
    @include('auth.layouts.styles')
</head>

<body class="bg-navy patterns-stardust">
    @yield('content')
</body>
@include('auth.layouts.scripts')
@stack('js')

</html>
