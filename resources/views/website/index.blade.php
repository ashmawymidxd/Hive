@extends('website.layouts.app')

@section('title')
    Hive
@endsection

@push('css')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-9 col-lg-5 bg-main patterns-gplay p-3 border-r" data-aos="fade-right" data-aos-delay="100">
                <div class="p-1 p-lg-4">
                    <div class="room-slider">
                        <div class="slide-img">
                            <img src="{{ asset('assets/website//img/1 (1).png') }}">
                        </div>
                        <div class="slide-img">
                            <img src="{{ asset('assets/website//img/1 (2).png') }}">
                        </div>
                        <div class="slide-img">
                            <img src="{{ asset('assets/website//img/1 (2).png') }}">
                        </div>
                    </div>

                    <div class="controls-sections p-2 btn-rounded border">
                        <button class="nav-sliding-btn" id="prev"><i class="fas fa-chevron-left"></i></button>
                        <div class="pagination" id="pagination">
                            <div class="pagination-dot-circle active-circle"></div>
                            <div class="pagination-dot-circle"></div>
                            <div class="pagination-dot-circle"></div>
                        </div>
                        <button class="nav-sliding-btn" id="next"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-1"></div>
            <div class="col-md-12 col-lg-6 d-flex align-items-center" data-aos="fade-right" data-aos-delay="200">
                <div class="info border-left-second p-4">
                    <h3 class="text-main bold">Prime Location</h3>
                    <p class="text-second">
                        Located in the heart of the city, DreamyStays offers <br>
                        easy access to major attractions, business centers, and shopping districts.
                        <br> <br>
                        123 Luxury Lane, Downtown, City, 10001 <br>
                        Just 15 minutes from the international airport and 5 minutes from the central business district.
                    </p>
                    <button class="btn btn-warning bg-main shadow-0 btn-rounded px-5">Get Directions</button>
                </div>
            </div>

        </div>
        <div class="row mt-5 bg-white p-3 p-lg-5">
            <h1 class="text-center main-font text-main fa-70">
                Our Rooms & Suites
            </h1>
            <p class="text-center second-font text-second mt-4 fa-30">
                Discover the perfect accommodation tailored to your needs, <br>from cozy rooms to
                spacious suites, all designed with your comfort in mind.
            </p>
            <div class="row mt-5">
                <div class="col-lg-4 col-md-6">
                    <div class="card border-1 hover mt-2">
                        <img src="{{ asset('assets/website//img/1 (1).png') }}" class="card-img-top room-img"
                            alt="Room Image">
                        <div class="card-body">
                            <h5 class="card-title d-flex justify-content-between">
                                <span class="text-main second-font bold">Deluxe King Room</span>
                                <span class="fw-bold text-third">$149 <small class="text-main">/ night</small></span>
                            </h5>
                            <p class="text-muted mb-3">Spacious room with king-sized bed and city view.</p>
                            <div class="d-flex justify-content-between features mb-3">
                                <div><i class="fa-solid fa-bed text-third"></i><small> King</small></div>
                                <div><i class="fa-solid fa-user text-third"></i><small> Up to 1 guests</small></div>
                                <div><i class="fa-solid fa-maximize text-third"></i><small> 250 sqft</small></div>
                            </div>
                            <div class="d-flex justify-content-between gap-3">
                                <button class="btn btn-warning bg-main shadow-0 btn-rounded px-5 w-75">See More</button>
                                <button class="btn btn-outline-warning btn-rounded px-1 w-25">More <i
                                        class="bg-warning sm-hide text-white p-2 rounded-circle fa-solid fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card border-1 hover mt-2">
                        <img src="{{ asset('assets/website//img/1 (2).png') }}" class="card-img-top room-img"
                            alt="Room Image">
                        <div class="card-body">
                            <h5 class="card-title d-flex justify-content-between">
                                <span class="text-main second-font bold">Single King Room</span>
                                <span class="fw-bold text-third">$149 <small class="text-main">/ night</small></span>
                            </h5>
                            <p class="text-muted mb-3">Spacious room with king-sized bed and city view.</p>
                            <div class="d-flex justify-content-between features mb-3">
                                <div><i class="fa-solid fa-bed text-third"></i><small> King</small></div>
                                <div><i class="fa-solid fa-user text-third"></i><small> Up to 1 guests</small></div>
                                <div><i class="fa-solid fa-maximize text-third"></i><small> 250 sqft</small></div>
                            </div>
                            <div class="d-flex justify-content-between gap-3">
                                <button class="btn btn-warning bg-main shadow-0 btn-rounded px-5 w-75">See More</button>
                                <button class="btn btn-outline-warning btn-rounded px-1 w-25">More <i
                                        class="bg-warning sm-hide text-white p-2 rounded-circle fa-solid fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card border-1 hover mt-2">
                        <img src="{{ asset('assets/website//img/1 (3).png') }}" class="card-img-top room-img"
                            alt="Room Image">
                        <div class="card-body">
                            <h5 class="card-title d-flex justify-content-between">
                                <span class="text-main second-font bold">Full Deluxe King Room</span>
                                <span class="fw-bold text-third">$149 <small class="text-main">/ night</small></span>
                            </h5>
                            <p class="text-muted mb-3">Spacious room with king-sized bed and city view.</p>
                            <div class="d-flex justify-content-between features mb-3">
                                <div><i class="fa-solid fa-bed text-third"></i><small> King</small></div>
                                <div><i class="fa-solid fa-user text-third"></i><small> Up to 1 guests</small></div>
                                <div><i class="fa-solid fa-maximize text-third"></i><small> 250 sqft</small></div>
                            </div>
                            <div class="d-flex justify-content-between gap-3">
                                <button class="btn btn-warning bg-main shadow-0 btn-rounded px-5 w-75">See More</button>
                                <button class="btn btn-outline-warning btn-rounded px-1 w-25">More <i
                                        class="bg-warning sm-hide text-white p-2 rounded-circle fa-solid fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-5 d-flex align-items-center justify-content-center">
                    <a
                        class="btn btn-outline-light border btn-rounded px-1 w-25 d-flex align-items-center bold justify-content-between text-main">
                        <span></span> <span>View
                            More Rooms</span> <i
                            class="bg-warning text-white p-2 rounded-circle fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row p-3 p-lg-5">
            <h1 class="text-center main-font text-main fa-70">
                Hotel Amenities
            </h1>
            <p class="text-center second-font text-second mt-4 fa-30">
                Enhance your stay with our premium facilities and services <br>
                designed for your comfort and convenience.
            </p>

            <div class="row mt-5">

                <!-- Wi-Fi Card -->
                <div class="col-md-6 col-lg-3 my-4">
                    <div class="flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front card border-left-main hover ">
                                <span class="badge badge-danger rounded-circle p-4 mb-3 bg-third-light">
                                    <i class="fa fa-wifi fa-3x text-main"></i>
                                </span>
                                <h3 class="text-center third-font text-main bold">Free Wi-Fi</h3>
                                <p class="text-center second-font text-second">Stay connected with high-speed internet
                                    throughout the property.</p>
                            </div>
                            <div class="flip-card-back">
                                <i class="fa fa-wifi amenity-icon"></i>
                                <h3 class="card-title third-font text-main">Free Wi-Fi</h3>
                                <p class="card-desc">Enjoy our ultra-fast 100MBps fiber connection available in all
                                    rooms and common areas. Perfect for streaming, video calls, and remote work.</p>
                                <ul class="text-left text-main">
                                    <li>Unlimited bandwidth</li>
                                    <li>24/7 technical support</li>
                                    <li>Secure private network</li>
                                </ul>
                                <button class="btn btn-warning bg-main btn-rounded shadow-0 px-3">Book Now</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Luxury Spa Card -->
                <div class="col-md-6 col-lg-3 my-4">
                    <div class="flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front card border-left-main hover ">
                                <span class="badge badge-danger rounded-circle p-4 mb-3 bg-third-light">
                                    <i class="fa fa-spa fa-3x text-main"></i>
                                </span>
                                <h3 class="text-center third-font text-main">Luxury Spa</h3>
                                <p class="text-center second-font text-second">Rejuvenate with our range of spa
                                    treatments and therapies.</p>
                            </div>
                            <div class="flip-card-back">
                                <i class="fa fa-spa amenity-icon"></i>
                                <h3 class="card-title third-font text-main">Luxury Spa</h3>
                                <p class="card-desc">Indulge in our award-winning spa services with certified therapists
                                    and premium organic products.</p>
                                <ul class="text-left text-main">
                                    <li>Massage therapies from $80</li>
                                    <li>Facials and body treatments</li>
                                    <li>Private couple suites available</li>
                                </ul>
                                <button class="btn btn-warning bg-main btn-rounded shadow-0 px-3">Book Treatment</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Swimming Pool Card -->
                <div class="col-md-6 col-lg-3 my-4">
                    <div class="flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front card border-left-main hover ">
                                <span class="badge badge-danger rounded-circle p-4 mb-3 bg-third-light">
                                    <i class="fa fa-water fa-3x text-main"></i>
                                </span>
                                <h3 class="text-center third-font text-main bold">Swimming Pool</h3>
                                <p class="text-center second-font text-second">Relax and unwind in our outdoor swimming
                                    pool.</p>
                            </div>
                            <div class="flip-card-back">
                                <i class="fa fa-water amenity-icon"></i>
                                <h3 class="card-title third-font text-main">Swimming Pool</h3>
                                <p class="card-desc">Our temperature-controlled infinity pool offers stunning views and
                                    premium amenities.</p>
                                <ul class="text-left text-main">
                                    <li>Open 6AM-10PM daily</li>
                                    <li>Poolside service available</li>
                                    <li>Children's section available</li>
                                </ul>
                                <button class="btn btn-warning bg-main btn-rounded shadow-0 px-3">Reserve Cabana</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fine Dining Card -->
                <div class="col-md-6 col-lg-3 my-4">
                    <div class="flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front card border-left-main hover ">
                                <span class="badge badge-danger rounded-circle p-4 mb-3 bg-third-light">
                                    <i class="fa fa-utensils fa-3x text-main"></i>
                                </span>
                                <h3 class="text-center third-font text-main bold">Fine Dining</h3>
                                <p class="text-center second-font text-second">Savor exquisite dishes crafted by our
                                    world-class chefs.</p>
                            </div>
                            <div class="flip-card-back">
                                <i class="fa fa-utensils amenity-icon"></i>
                                <h3 class="card-title third-font text-main">Fine Dining</h3>
                                <p class="card-desc">Experience Michelin-star quality cuisine with locally-sourced
                                    ingredients and an extensive wine selection.</p>
                                <ul class="text-left text-main">
                                    <li>Breakfast buffet: $25</li>
                                    <li>Reservations recommended</li>
                                    <li>Private dining available</li>
                                </ul>
                                <button class="btn btn-warning bg-main btn-rounded shadow-0 px-3">Make Reservation</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5 d-flex align-items-center justify-content-center">
                    <a
                        class="btn btn-outline-light border btn-rounded px-1 w-25 d-flex align-items-center bold justify-content-between text-main">
                        <span></span> <span>View
                            all Amenities</span> <i
                            class="bg-warning text-white p-2 rounded-circle fa-solid fa-arrow-right"></i></a>
                </div>

            </div>
        </div>
        <div class="row mt-5 bg-white p-3 p-lg-5">
            <h1 class="text-center main-font text-main fa-70">
                Guest Experiences
            </h1>
            <p class="text-center second-font text-second mt-4 fa-30">
                Hear what our guests have to say about their stay at DreamyStays.
            </p>
            <div class="row mt-5">
                <div class="col-md-6 col-lg-4 mt-2">
                    <div class="card border-left-third hover hover-border-left-main p-3 p-lg-5">
                        <h3 class="text-main bold">Sarah Johnson</h3>
                        <p class="text-second">New York, USA</p>
                        <div class="starts">
                            <i class="fa fa-star fa-2xl text-warning"></i>
                            <i class="fa fa-star fa-2xl text-warning"></i>
                            <i class="fa fa-star fa-2xl text-warning"></i>
                            <i class="fa fa-star fa-2xl text-warning"></i>
                            <i class="fa fa-star fa-2xl text-secondary"></i>
                        </div>
                        <p class="text-second mt-3">
                            "One of the best hotel experiences
                            I've ever had. The staff was
                            incredibly attentive and the
                            amenities were top-notch."
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mt-2">
                    <div class="card border-left-third hover hover-border-left-main p-3 p-lg-5">
                        <h3 class="text-main bold">Sarah Johnson</h3>
                        <p class="text-second">New York, USA</p>
                        <div class="starts">
                            <i class="fa fa-star fa-2xl text-warning"></i>
                            <i class="fa fa-star fa-2xl text-warning"></i>
                            <i class="fa fa-star fa-2xl text-warning"></i>
                            <i class="fa fa-star fa-2xl text-warning"></i>
                            <i class="fa fa-star fa-2xl text-secondary"></i>
                        </div>
                        <p class="text-second mt-3">
                            "One of the best hotel experiences
                            I've ever had. The staff was
                            incredibly attentive and the
                            amenities were top-notch."
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mt-2">
                    <div class="card border-left-third hover hover-border-left-main p-3 p-lg-5">
                        <h3 class="text-main bold">Sarah Johnson</h3>
                        <p class="text-second">New York, USA</p>
                        <div class="starts">
                            <i class="fa fa-star fa-2xl text-warning"></i>
                            <i class="fa fa-star fa-2xl text-warning"></i>
                            <i class="fa fa-star fa-2xl text-warning"></i>
                            <i class="fa fa-star fa-2xl text-warning"></i>
                            <i class="fa fa-star fa-2xl text-secondary"></i>
                        </div>
                        <p class="text-second mt-3">
                            "One of the best hotel experiences
                            I've ever had. The staff was
                            incredibly attentive and the
                            amenities were top-notch."
                        </p>
                    </div>
                </div>

            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12 col-lg-6 d-flex align-items-center">
                <div class="info border-right-second p-4">
                    <h3 class="text-main bold">Prime Location</h3>
                    <p class="text-second">
                        Located in the heart of the city, DreamyStays offers <br>
                        easy access to major attractions, business centers, and shopping districts.
                        <br> <br>
                        123 Luxury Lane, Downtown, City, 10001 <br>
                        Just 15 minutes from the international airport and 5 minutes from the central business district.
                    </p>
                    <button class="btn btn-warning bg-main shadow-0 btn-rounded px-5">Get Directions</button>
                </div>
            </div>
            <div class="col-md-12 col-lg-1"></div>
            <div class="col-md-12 col-lg-5 bg-main patterns-stardust p-3 border-l">
                <div class="p-5">
                    <div class="slider-container">
                        <div class="slider">
                            <div class="slide active shadow">
                                <img src="{{ asset('assets/website//img/1 (1).png') }}" alt="Image 1">
                            </div>
                            <div class="slide shadow">
                                <img src="{{ asset('assets/website//img/1 (3).png') }}" alt="Image 2">
                            </div>
                            <div class="slide shadow">
                                <img src="{{ asset('assets/website//img/1 (2).png') }}" alt="Image 3">
                            </div>
                            <div class="slide shadow">
                                <img src="{{ asset('assets/website//img/1 (1).png') }}" alt="Image 4">
                            </div>
                        </div>

                        <div class="controls p-2 btn-rounded">
                            <button class="nav-btn" id="prevBtn"><i class="fas fa-chevron-left"></i></button>
                            <div class="pagination" id="pagination">
                                <div class="pagination-dot active"></div>
                                <div class="pagination-dot"></div>
                                <div class="pagination-dot"></div>
                                <div class="pagination-dot"></div>
                            </div>
                            <button class="nav-btn" id="nextBtn"><i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.querySelector('.slider');
            const slides = document.querySelectorAll('.slide');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const paginationDots = document.querySelectorAll('.pagination-dot');
            let currentIndex = 0;
            const totalSlides = slides.length;
            let autoSlideInterval;

            // Function to update slider position
            function updateSlider(index) {
                currentIndex = index;

                // Update slides transformations
                slides.forEach((slide, i) => {
                    const slideIndex = (i - currentIndex + totalSlides) % totalSlides;

                    switch (slideIndex) {
                        case 0: // Top slide
                            slide.style.transform = 'translateX(100px)';
                            slide.style.zIndex = '4';
                            slide.style.opacity = '1';
                            break;
                        case 1:
                            slide.style.transform = 'translateX(75px) translateY(25px) scale(0.95)';
                            slide.style.zIndex = '3';
                            slide.style.opacity = '0.9';
                            break;
                        case 2:
                            slide.style.transform = 'translateX(50px) translateY(45px) scale(0.9)';
                            slide.style.zIndex = '2';
                            slide.style.opacity = '0.8';
                            break;
                        case 3: // Bottom slide
                            slide.style.transform = 'translateX(25px) translateY(65px) scale(0.85)';
                            slide.style.zIndex = '1';
                            slide.style.opacity = '0.7';
                            break;
                    }
                });

                // Update pagination dots
                paginationDots.forEach((dot, i) => {
                    dot.classList.toggle('active', i === currentIndex);
                });
            }

            // Next slide function
            function nextSlide() {
                const newIndex = (currentIndex + 1) % totalSlides;
                updateSlider(newIndex);
            }

            // Previous slide function
            function prevSlide() {
                const newIndex = (currentIndex - 1 + totalSlides) % totalSlides;
                updateSlider(newIndex);
            }

            // Event listeners for buttons
            nextBtn.addEventListener('click', nextSlide);
            prevBtn.addEventListener('click', prevSlide);

            // Pagination dots click events
            paginationDots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    updateSlider(index);
                    resetAutoSlide();
                });
            });

            // Auto slide every 1 minute (60000ms)
            function startAutoSlide() {
                autoSlideInterval = setInterval(nextSlide, 5000);
            }

            function resetAutoSlide() {
                clearInterval(autoSlideInterval);
                startAutoSlide();
            }

            // Initialize auto slide
            startAutoSlide();

            // Pause auto slide on hover
            slider.addEventListener('mouseenter', () => {
                clearInterval(autoSlideInterval);
            });

            slider.addEventListener('mouseleave', () => {
                startAutoSlide();
            });
        });
    </script>

    <script>
        // JavaScript for the Image Slider
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.slide-img');
            const prevBtn = document.getElementById('prev');
            const nextBtn = document.getElementById('next');
            const dots = document.querySelectorAll('.pagination-dot-circle');
            let currentSlide = 0;
            const totalSlides = slides.length;

            // Initialize slider
            function initSlider() {
                slides[currentSlide].classList.add('active');
                dots[currentSlide].classList.add('active-circle');
            }

            // Show specific slide
            function showSlide(index) {
                // Reset all slides and dots
                slides.forEach(slide => slide.classList.remove('active'));
                dots.forEach(dot => dot.classList.remove('active-circle'));

                // Handle wrap-around for infinite loop
                if (index >= totalSlides) {
                    currentSlide = 0;
                } else if (index < 0) {
                    currentSlide = totalSlides - 1;
                } else {
                    currentSlide = index;
                }

                // Show current slide and dot
                slides[currentSlide].classList.add('active');
                dots[currentSlide].classList.add('active-circle');
            }

            // Next slide
            function nextSlide() {
                showSlide(currentSlide + 1);
            }

            // Previous slide
            function prevSlide() {
                showSlide(currentSlide - 1);
            }

            // Event listeners
            nextBtn.addEventListener('click', nextSlide);
            prevBtn.addEventListener('click', prevSlide);

            // Dot navigation
            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    showSlide(index);
                });
            });

            // Keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (e.key === 'ArrowRight') {
                    nextSlide();
                } else if (e.key === 'ArrowLeft') {
                    prevSlide();
                }
            });

            // Auto-slide (optional)
            // setInterval(nextSlide, 5000); // Uncomment for auto-sliding every 5 seconds

            // Initialize the slider
            initSlider();
        });
    </script>

    <script>
        AOS.init();
    </script>
@endpush
