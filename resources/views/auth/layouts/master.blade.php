<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset(app('settings')->logo_path) }}" type="image/x-icon">
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

<body>
    @yield('content')
</body>
@include('auth.layouts.scripts')
@stack('js')

</html>
