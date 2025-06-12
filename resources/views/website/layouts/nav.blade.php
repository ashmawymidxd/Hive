<div class="h-100vh"
    style="background:linear-gradient(
            to bottom,
            hsla(49, 96%, 10%, 0.5),
            hsla(49, 96%, 10%, 0.5)
        ), url({{ asset('assets/website/img/hero.jpg') }})">

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-0" id="mainNavbar">
        <div class="container-fluid">
            <a class="navbar-brand main-font fs-2" href="#">Spada fters</a>
            {{-- select lang section --}}
            <div class="mx-2">
                <i class="fa fa-globe text-white me-1"></i>
                <span class="fw-bold text-white">EN</span>
            </div>

            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarNav">
                <i class="fa-solid fa-ellipsis"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto second-font">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('home')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Rooms & Suites</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Amenities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Dining</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Special Offers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Contact</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-2 text-white me-2">
                    <i class="fa fa-phone-volume text-white"></i> <span>+ C8 1655 23.4567</span>
                </div>

                <div class="me-2">
                    @if (!auth('web')->check())
                        <a href="{{ route('login') }}"
                            class="btn btn-rounded bg-main text-white border border-white">Login</a>
                    @else
                        <button class="btn btn-rounded bg-main text-white border border-white">Book Now</button>
                    @endif
                </div>

                {{-- profile --}}
                <div class="dropdown">
                    <button class="btn btn-rounded bg-main text-white border border-white dropdown-toggle"
                        type="button" id="dropdownMenuButton1" data-mdb-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user"></i>
                    </button>

                    <ul class="dropdown-menu bg-main-light p-3 border border-white mt-3"
                        aria-labelledby="dropdownMenuButton1">
                        <div class="bg-white">
                            <li><a class="dropdown-item" href="#">
                                    <i class=" fa fa-user text-main me-2"></i>
                                    Profile</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item" type="submit">
                                        <i class="fa fa-sign-out text-main me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>
