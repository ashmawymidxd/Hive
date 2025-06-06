<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('assets/admin/img/logo/hive.png')}}" type="image/x-icon">
    <title> @yield('title','Hiv')</title>
    @include('admin/layouts/head')

</head>

<body class="bg-light">
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
