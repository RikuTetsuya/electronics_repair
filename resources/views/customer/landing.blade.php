<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Index - Vesperr Bootstrap Template</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    {{-- Google Material Icon --}}
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=reviews" />
    {{-- bootstrap4 --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <!-- Favicons -->
    <link href="{{ asset('userpage/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('userpage/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('userpage/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('userpage/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('userpage/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('userpage/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('userpage/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('userpage/assets/css/main.css') }}" rel="stylesheet">

    <style>
        .rating {
            display: flex;
            flex-direction: row-reverse;
            gap: 0.3rem;
            --stroke: #666;
            --fill: #ffc73a;
        }

        .rating input {
            appearance: unset;
        }

        .rating label {
            cursor: pointer;
        }

        .rating svg {
            width: 2rem;
            height: 2rem;
            overflow: visible;
            fill: transparent;
            stroke: var(--stroke);
            stroke-linejoin: bevel;
            stroke-dasharray: 12;
            animation: idle 4s linear infinite;
            transition: stroke 0.2s, fill 0.5s;
        }

        @keyframes idle {
            from {
                stroke-dashoffset: 24;
            }
        }

        .rating label:hover svg {
            stroke: var(--fill);
        }

        .rating input:checked~label svg {
            transition: 0s;
            animation: idle 4s linear infinite, yippee 0.75s backwards;
            fill: var(--fill);
            stroke: var(--fill);
            stroke-opacity: 0;
            stroke-dasharray: 0;
            stroke-linejoin: miter;
            stroke-width: 8px;
        }

        @keyframes yippee {
            0% {
                transform: scale(1);
                fill: var(--fill);
                fill-opacity: 0;
                stroke-opacity: 1;
                stroke: var(--stroke);
                stroke-dasharray: 10;
                stroke-width: 1px;
                stroke-linejoin: bevel;
            }

            30% {
                transform: scale(0);
                fill: var(--fill);
                fill-opacity: 0;
                stroke-opacity: 1;
                stroke: var(--stroke);
                stroke-dasharray: 10;
                stroke-width: 1px;
                stroke-linejoin: bevel;
            }

            30.1% {
                stroke: var(--fill);
                stroke-dasharray: 0;
                stroke-linejoin: miter;
                stroke-width: 8px;
            }

            60% {
                transform: scale(1.2);
                fill: var(--fill);
            }


            .testimonial-wrap {
                background: #fff;
                border-radius: 10px;
                box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
                padding: 20px;
                text-align: center;
                margin: 10px;
            }

            .testimonial-item {
                padding: 15px;
            }

            .testimonial-img {
                width: 80px;
                height: 80px;
                border-radius: 50%;
                object-fit: cover;
                margin-bottom: 15px;
            }

            .stars i {
                color: #ffc107;
            }

        }
    </style>

    <!-- Swiper CSS (untuk slider layanan) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <!-- Owl Carousel CSS (untuk slider testimonials)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <style>
        .swiper {
            width: 100%;
            padding: 20px 0;
        }

        .swiper-slide {
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .features-item {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .features-item:hover {
            transform: translateY(-5px);
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #000;
        }
    </style>

    <!-- =======================================================
  * Template Name: Vesperr
  * Template URL: https://bootstrapmade.com/vesperr-free-bootstrap-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="index.html" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                {{-- <img src="userpage/assets/img/logo.png" alt=""> --}}
                <h1 class="sitename">VolTech, Inc.</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="/customer/main/#hero">Home<br></a></li>
                    <li><a href="{{ url('customer/order/#order') }}">Order</a></li>
                    <li><a href="/customer/main/#services">Services</a></li>
                    <li><a href="/customer/main/#testimonials">Testimonials</a></li>
                    {{-- <li><a href="/customer/main/#donation">Donate!us</a></li> --}}
                    <li><a href="/customer/main/#contact">Contact</a></li>
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdownMenuLink" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/fox.jpg' }}" width="40" height="40" class="rounded-circle">
                            <i class="bi bi-chevron-down toggle-dropdown ms-1"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right p-3" aria-labelledby="navbarDropdownMenuLink"
                            style="min-width: 300px;">
                            <div class="text-center">
                                <!-- Profile Picture -->
                                <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/fox.jpg' }}" width="100" height="100" class="rounded-circle mb-2">
                                <!-- User Name -->
                                <h5 class="mb-0">Login</h5>
                                <!-- User Email -->
                                <small class="text-muted">Register</small>
                            </div>
                            <hr>
                            <!-- Additional Options -->
                            <div>
                                <a class="btn btn-primary btn-sm w-100 mb-2 text-white"
                                    href="{{ url('customer/profile/') }}">Profile</a>
                                <a href="#" class="btn btn-danger btn-sm w-100 text-light" id="logout-button">Log
                                    Out</a>
                                <form id="logout-form" action="{{ url('logout') }}" method="GET"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </li> --}}
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="{{ url('/login') }}">Sign In</a>

        </div>
    </header>

    <main class="main">
        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <h1>Zap yo zaps at VolTech</h1>
                        <p>Voltech is the industry powered by IQ Corp. We have talented technician makin' yo gadgets
                            great to go.</p>
                        <div class="d-flex">
                            <a href="{{ url('customer/order') }}" class="btn-get-started">Order Now!</a>
                            <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8"
                                class="glightbox btn-watch-video d-flex align-items-center"></a>
                        </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 hero-img">
                        <img src="{{ asset('userpage/assets/img/hero-img.png') }}" class="img-fluid animated"
                            alt="">
                    </div>
                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- Clients Section -->
        <section id="clients" class="clients section light-background">

            <div class="container" data-aos="fade-up">

                <div class="row gy-4">

                    <div class="col-xl-2 col-md-3 col-6 client-logo">
                        <img src="{{ asset('userpage/assets/img/clients/client-1.png') }}" class="img-fluid"
                            alt="">
                    </div><!-- End Client Item -->

                    <div class="col-xl-2 col-md-3 col-6 client-logo">
                        <img src="{{ asset('userpage/assets/img/clients/client-2.png') }}" class="img-fluid"
                            alt="">
                    </div><!-- End Client Item -->

                    <div class="col-xl-2 col-md-3 col-6 client-logo">
                        <img src="{{ asset('userpage/assets/img/clients/client-3.png') }}" class="img-fluid"
                            alt="">
                    </div><!-- End Client Item -->

                    <div class="col-xl-2 col-md-3 col-6 client-logo">
                        <img src="{{ asset('userpage/assets/img/clients/client-4.png') }}" class="img-fluid"
                            alt="">
                    </div><!-- End Client Item -->

                    <div class="col-xl-2 col-md-3 col-6 client-logo">
                        <img src="{{ asset('userpage/assets/img/clients/client-5.png') }}" class="img-fluid"
                            alt="">
                    </div><!-- End Client Item -->

                    <div class="col-xl-2 col-md-3 col-6 client-logo">
                        <img src="{{ asset('userpage/assets/img/clients/client-6.png') }}" class="img-fluid"
                            alt="">
                    </div><!-- End Client Item -->

                </div>

            </div>

        </section><!-- /Clients Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>About Us</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-5">

                    <div class="content col-xl-5 d-flex flex-column" data-aos="fade-up" data-aos-delay="100">
                        <h3>Voluptatem dignissimos provident quasi</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit
                        </p>
                        <a href="#" class="about-btn align-self-center align-self-xl-start"><span>About
                                us</span> <i class="bi bi-chevron-right"></i></a>
                    </div>

                    <div class="col-xl-7" data-aos="fade-up" data-aos-delay="200">
                        <div class="row gy-4">

                            <div class="col-md-6 icon-box position-relative">
                                <i class="bi bi-briefcase"></i>
                                <h4><a href="" class="stretched-link">Corporis voluptates sit</a></h4>
                                <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip
                                </p>
                            </div><!-- Icon-Box -->

                            <div class="col-md-6 icon-box position-relative">
                                <i class="bi bi-gem"></i>
                                <h4><a href="" class="stretched-link">Ullamco laboris nisi</a></h4>
                                <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                                </p>
                            </div><!-- Icon-Box -->

                            <div class="col-md-6 icon-box position-relative">
                                <i class="bi bi-broadcast"></i>
                                <h4><a href="" class="stretched-link">Labore consequatur</a></h4>
                                <p>Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere</p>
                            </div><!-- Icon-Box -->

                            <div class="col-md-6 icon-box position-relative">
                                <i class="bi bi-easel"></i>
                                <h4><a href="" class="stretched-link">Beatae veritatis</a></h4>
                                <p>Expedita veritatis consequuntur nihil tempore laudantium vitae denat pacta</p>
                            </div><!-- Icon-Box -->

                        </div>
                    </div>

                </div>

            </div>

        </section><!-- /About Section -->

        <!-- Stats Section -->
        <section id="stats" class="stats section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4 align-items-center">

                    <div class="col-lg-5">
                        <img src="{{ asset('userpage/assets/img/stats-img.svg') }}" alt=""
                            class="img-fluid">
                    </div>

                    <div class="col-lg-7">

                        <div class="row gy-4">

                            <div class="col-lg-6">
                                <div class="stats-item d-flex">
                                    <i class="bi bi-emoji-smile flex-shrink-0"></i>
                                    <div>
                                        <span data-purecounter-start="0" data-purecounter-end="232"
                                            data-purecounter-duration="1" class="purecounter"></span>
                                        <p><strong>Happy Clients</strong> <span>consequuntur quae</span></p>
                                    </div>
                                </div>
                            </div><!-- End Stats Item -->

                            <div class="col-lg-6">
                                <div class="stats-item d-flex">
                                    <i class="bi bi-journal-richtext flex-shrink-0"></i>
                                    <div>
                                        <span data-purecounter-start="0" data-purecounter-end="521"
                                            data-purecounter-duration="1" class="purecounter"></span>
                                        <p><strong>Projects</strong> <span>adipisci atque cum quia aut</span></p>
                                    </div>
                                </div>
                            </div><!-- End Stats Item -->

                            <div class="col-lg-6">
                                <div class="stats-item d-flex">
                                    <i class="bi bi-headset flex-shrink-0"></i>
                                    <div>
                                        <span data-purecounter-start="0" data-purecounter-end="1453"
                                            data-purecounter-duration="1" class="purecounter"></span>
                                        <p><strong>Hours Of Support</strong> <span>aut commodi quaerat</span></p>
                                    </div>
                                </div>
                            </div><!-- End Stats Item -->

                            <div class="col-lg-6">
                                <div class="stats-item d-flex">
                                    <i class="bi bi-people flex-shrink-0"></i>
                                    <div>
                                        <span data-purecounter-start="0" data-purecounter-end="32"
                                            data-purecounter-duration="1" class="purecounter"></span>
                                        <p><strong>Hard Workers</strong> <span>rerum asperiores dolor</span></p>
                                    </div>
                                </div>
                            </div><!-- End Stats Item -->

                        </div>

                    </div>

                </div>

            </div>

        </section><!-- /Stats Section -->

        <!-- Features Section -->
        <section id="services" class="features section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Available Services</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div><!-- End Section Title -->

            <div class="container">
                <!-- Swiper Container -->
                <div class="swiper">
                    <div class="swiper-wrapper">
                        @foreach ($layanans as $val)
                            <div class="swiper-slide">
                                <div class="features-item">
                                    <i class="bi bi-cpu"
                                        style="color: {{ sprintf('#%06X', mt_rand(0, 0xffffff)) }};"></i>
                                    <h3><a href="#" class="stretched-link">{{ $val->nama_layanan }}</a></h3>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <br><br>
                    <!-- Swiper Pagination -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>

        </section><!-- /Features Section -->

        <!-- Testimonials Section -->
        <section id="testimonials" class="testimonials section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Reviews</h2>
                <p>What people said about us</p>
            </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="owl-carousel owl-testimonial">
                    @foreach ($ratings as $rating)
                        <div class="testimonial-wrap">
                            <div class="testimonial-item">
                                <img src="{{ $rating->image ? asset('storage/' . $rating->image) : 'https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/fox.jpg' }}"
                                    class="testimonial-img" alt="User Image">
                                <h3>{{ $rating->user_name }}</h3>
                                <h4>Customer</h4>
                                <div class="stars">
                                    @for ($i = 0; $i < $rating->rating; $i++)
                                        <i class="bi bi-star-fill"></i>
                                    @endfor
                                    @for ($i = $rating->rating; $i < 5; $i++)
                                        <i class="bi bi-star"></i>
                                    @endfor
                                </div>
                                <p>
                                    <i class="bi bi-quote"></i>
                                    {{ $rating->description }}
                                    <i class="bi bi-quote"></i>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </section><!-- /Testimonials Section -->

        <!-- Pricing Section -->
        {{-- <section id="donation" class="pricing section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Donation</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            <br>

        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="100">
                    <div class="pricing-item">
                        <h3></h3>
                        <h4><sup>Rp.</sup> 2000<span> .00</span></h4>
                        <br>
                        <a href="#" class="buy-btn">Donate Now</a>
                    </div>
                </div><!-- End Pricing Item -->

                <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="200">
                    <div class="pricing-item featured">
                        <h3></h3>
                        <h4><sup>Rp.</sup> 10.000<span> .00</span></h4>
                        <br>
                        <a href="#" class="buy-btn">Donate Now</a>
                    </div>
                </div><!-- End Pricing Item -->

                <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="300">
                    <div class="pricing-item">
                        <h3></h3>
                        <h4><sup>Rp.</sup> 20.000<span> .00</span></h4>
                        <br>
                        <a href="#" class="buy-btn">Donate Now</a>
                    </div>
                </div><!-- End Pricing Item -->

            </div>

        </div>

    </section> --}}
        <!-- /Pricing Section -->

        <!-- Faq Section -->
        <section id="faq" class="faq section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Frequently Asked Questions</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row faq-item" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-5 d-flex">
                        <i class="bi bi-question-circle"></i>
                        <h4>Non consectetur a erat nam at lectus urna duis?</h4>
                    </div>
                    <div class="col-lg-7">
                        <p>
                            Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non
                            curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
                        </p>
                    </div>
                </div><!-- End F.A.Q Item-->

                <div class="row faq-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-lg-5 d-flex">
                        <i class="bi bi-question-circle"></i>
                        <h4>Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque?</h4>
                    </div>
                    <div class="col-lg-7">
                        <p>
                            Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit
                            laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium.
                            Est
                            pellentesque elit ullamcorper dignissim.
                        </p>
                    </div>
                </div><!-- End F.A.Q Item-->

                <div class="row faq-item" data-aos="fade-up" data-aos-delay="300">
                    <div class="col-lg-5 d-flex">
                        <i class="bi bi-question-circle"></i>
                        <h4>Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi?</h4>
                    </div>
                    <div class="col-lg-7">
                        <p>
                            Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar
                            elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus
                            pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus.
                        </p>
                    </div>
                </div><!-- End F.A.Q Item-->

                <div class="row faq-item" data-aos="fade-up" data-aos-delay="400">
                    <div class="col-lg-5 d-flex">
                        <i class="bi bi-question-circle"></i>
                        <h4>Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla?</h4>
                    </div>
                    <div class="col-lg-7">
                        <p>
                            Aperiam itaque sit optio et deleniti eos nihil quidem cumque. Voluptas dolorum accusantium
                            sunt
                            sit enim. Provident consequuntur quam aut reiciendis qui rerum dolorem sit odio. Repellat
                            assumenda soluta sunt pariatur error doloribus fuga.
                        </p>
                    </div>
                </div><!-- End F.A.Q Item-->

                <div class="row faq-item" data-aos="fade-up" data-aos-delay="500">
                    <div class="col-lg-5 d-flex">
                        <i class="bi bi-question-circle"></i>
                        <h4>Tempus quam pellentesque nec nam aliquam sem et tortor consequat?</h4>
                    </div>
                    <div class="col-lg-7">
                        <p>
                            Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est
                            ante
                            in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing
                            bibendum
                            est. Purus gravida quis blandit turpis cursus in
                        </p>
                    </div>
                </div><!-- End F.A.Q Item-->

            </div>

        </section><!-- /Faq Section -->

        <!-- Contact Section -->
        <section id="contact" class="contact section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Contact</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div><!-- End Section Title -->

            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-5">
                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                            <i class="bi bi-geo-alt flex-shrink-0"></i>
                            <div>
                                <h3>Address</h3>
                                <p>A108 Adam Street, New York, NY 535022</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                            <i class="bi bi-telephone flex-shrink-0"></i>
                            <div>
                                <h3>Call Us</h3>
                                <p>+1 5589 55488 55</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                            <i class="bi bi-envelope flex-shrink-0"></i>
                            <div>
                                <h3>Email Us</h3>
                                <p>info@example.com</p>
                            </div>
                        </div><!-- End Info Item -->

                    </div>

                    <div class="col-lg-7">
                        <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up"
                            data-aos-delay="500">
                            <div class="row gy-4">

                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control"
                                        placeholder="Your Name" required="">
                                </div>

                                <div class="col-md-6 ">
                                    <input type="email" class="form-control" name="email"
                                        placeholder="Your Email" required="">
                                </div>

                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="subject" placeholder="Subject"
                                        required="">
                                </div>

                                <div class="col-md-12">
                                    <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                                </div>

                                <div class="col-md-12 text-center">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>

                                    <button type="submit">Send Message</button>
                                </div>

                            </div>
                        </form>
                    </div><!-- End Contact Form -->

                </div>

            </div>

        </section><!-- /Contact Section -->
    </main>

    <footer id="footer" class="footer">

        <div class="container">
            <div class="copyright text-center ">
                <p>© <span>Copyright</span> <strong class="px-1 sitename">Vesperr</strong> <span>All Rights
                        Reserved</span></p>
            </div>
            <div class="social-links d-flex justify-content-center">
                <a href=""><i class="bi bi-twitter-x"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    {{-- IonIcons --}}
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- Vendor JS Files -->
    <script src="{{ asset('userpage/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('userpage/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('userpage/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('userpage/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('userpage/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('userpage/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('userpage/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('userpage/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('userpage/assets/js/main.js') }}"></script>

    <!-- Select2 JS -->
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script> --}}


    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const swiper = new Swiper('.swiper', {
                loop: true, // Loop mode
                spaceBetween: 20, // Space between slides
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                autoplay: {
                    delay: 1000,
                    disableOnInteraction: false,
                },
                breakpoints: {
                    320: { // Small phones
                        slidesPerView: 1,
                        spaceBetween: 10,
                    },
                    480: { // Larger phones
                        slidesPerView: 1.5,
                        spaceBetween: 15,
                    },
                    768: { // Tablets
                        slidesPerView: 2,
                        spaceBetween: 20,
                    },
                    1024: { // Laptops and above
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                    1200: { // Large screens
                        slidesPerView: 4,
                        spaceBetween: 40,
                    },
                },
            });
        });
    </script>

    <!-- Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.owl-testimonial').owlCarousel({
                loop: true, // Aktifkan looping
                margin: 10, // Jarak antar item
                nav: true, // Navigasi (panah)
                dots: true, // Tampilkan pagination (bullets)
                autoplay: true, // Aktifkan autoplay
                autoplayTimeout: 2000, // Waktu antar slide (dalam milidetik)
                autoplayHoverPause: true, // Hentikan autoplay saat kursor di atas slider
                responsive: {
                    0: {
                        items: 1 // 1 item untuk layar kecil
                    },
                    768: {
                        items: 2 // 2 item untuk tablet
                    },
                    1024: {
                        items: 2 // 3 item untuk desktop
                    }
                }
            });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.rating-star');
            const ratingValueInput = document.getElementById('ratingValue');

            stars.forEach(star => {
                star.addEventListener('mouseover', function() {
                    highlightStars(star.getAttribute('data-value'));
                });

                star.addEventListener('mouseout', function() {
                    highlightStars(ratingValueInput.value); // Tetap sorot sesuai nilai yang dipilih
                });

                star.addEventListener('click', function() {
                    ratingValueInput.value = star.getAttribute('data-value');
                    highlightStars(ratingValueInput.value);
                });
            });

            function highlightStars(rating) {
                stars.forEach(star => {
                    star.classList.toggle('selected', star.getAttribute('data-value') <= rating);
                });
            }
        });
    </script>

    {{-- sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Sweet alert for delete confirmation
        $('.delete-confirm').click(function(e) {
            e.preventDefault(); // Mencegah form terkirim otomatis
            var form = $(this).closest('form'); // Mendapatkan form yang terkait dengan tombol delete
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Mengirim form setelah konfirmasi
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                }
            });
        });

        $('#addRatingModal').on('shown.bs.modal', function() {
            theme: 'default', // Pilihan tema default
        });
    </script>

</body>

</html>
