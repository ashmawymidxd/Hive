<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title', 'Hive')
    </title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Vladimir+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Aclonica&display=swap" rel="stylesheet">
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />
    <!-- aos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <!-- custom style -->
    <link rel="stylesheet" href="{{ asset('assets/website/css/main.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/admin/img/logo/hive.png') }}" type="image/x-icon">
    @stack('css')
</head>

<body>
    @include('website.layouts.nav')
    @yield('content')
</body>
<!-- Bootstrap MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
<!-- AOS JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
{{-- nav color scrole --}}
<script>
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('mainNavbar');
        const scrolledToBottom = window.innerHeight + window.scrollY >= document.body.offsetHeight;

        if (scrolledToBottom) {
            navbar.classList.add('bg-main', 'shadow');
            navbar.classList.remove('bg-transparent');
        } else if (window.scrollY > 50) {
            navbar.classList.add('bg-main', 'shadow');
            navbar.classList.remove('bg-transparent');
        } else {
            navbar.classList.remove('bg-main', 'shadow');
            navbar.classList.add('bg-transparent');
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
        const currentUrl = window.location.href;
        navLinks.forEach(link => {
            if (link.href === currentUrl) {
                link.closest('.nav-item').classList.add('active-link');
            }
        });
    });
</script>
@stack('js')


</html>
