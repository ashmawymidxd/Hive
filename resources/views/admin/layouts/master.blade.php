<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset(app('settings')->logo_path) }}" type="image/x-icon">
    <title> @yield('title', app('settings')->hotel_name) </title>
    @include('admin/layouts/head')

</head>

<body style="background-color: {{ app('preferences')->ui_theme_color }}">

    {{-- loaders --}}
    @switch(app('preferences')->default_loader)
        @case('elegant_spinner')
            @include('admin/layouts/loaders/ElegantSpinner')
        @break

        @case('modern_dot_pulse')
            @include('admin/layouts/loaders/ModernDotPulse')
        @break

        @case('simple_bar')
            @include('admin/layouts/loaders/SimpleBar')
        @break

        @default
    @endswitch
    
    <!-- Sidebar -->
    @include('admin/layouts/sidebar')

    <!-- Header -->
    @include('admin/layouts/header')

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    @include('admin/layouts/scripts')

</body>

</html>
