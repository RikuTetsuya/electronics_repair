@extends('layout_user.app')
@push('usercss')
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
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
@endpush
@section('usercontent')
    <main class="main">
        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <h1>Zap yo zaps at VolTech</h1>
                        <p>Voltech is the industry powered by IQ Corp. We have talented technician makin' yo gadgets great to go.</p>
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
                        <img src="{{ asset('userpage/assets/img/clients/client-1.png') }}" class="img-fluid" alt="">
                    </div><!-- End Client Item -->

                    <div class="col-xl-2 col-md-3 col-6 client-logo">
                        <img src="{{ asset('userpage/assets/img/clients/client-2.png') }}" class="img-fluid" alt="">
                    </div><!-- End Client Item -->

                    <div class="col-xl-2 col-md-3 col-6 client-logo">
                        <img src="{{ asset('userpage/assets/img/clients/client-3.png') }}" class="img-fluid" alt="">
                    </div><!-- End Client Item -->

                    <div class="col-xl-2 col-md-3 col-6 client-logo">
                        <img src="{{ asset('userpage/assets/img/clients/client-4.png') }}" class="img-fluid" alt="">
                    </div><!-- End Client Item -->

                    <div class="col-xl-2 col-md-3 col-6 client-logo">
                        <img src="{{ asset('userpage/assets/img/clients/client-5.png') }}" class="img-fluid" alt="">
                    </div><!-- End Client Item -->

                    <div class="col-xl-2 col-md-3 col-6 client-logo">
                        <img src="{{ asset('userpage/assets/img/clients/client-6.png') }}" class="img-fluid" alt="">
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
                        <a href="#" class="about-btn align-self-center align-self-xl-start"><span>About us</span> <i
                                class="bi bi-chevron-right"></i></a>
                    </div>

                    <div class="col-xl-7" data-aos="fade-up" data-aos-delay="200">
                        <div class="row gy-4">

                            <div class="col-md-6 icon-box position-relative">
                                <i class="bi bi-briefcase"></i>
                                <h4><a href="" class="stretched-link">Corporis voluptates sit</a></h4>
                                <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip</p>
                            </div><!-- Icon-Box -->

                            <div class="col-md-6 icon-box position-relative">
                                <i class="bi bi-gem"></i>
                                <h4><a href="" class="stretched-link">Ullamco laboris nisi</a></h4>
                                <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
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
                        <img src="{{ asset('userpage/assets/img/stats-img.svg') }}" alt="" class="img-fluid">
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
                                    <i class="bi bi-cpu" style="color: {{ sprintf('#%06X', mt_rand(0, 0xffffff)) }};"></i>
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
                <div class="container mt-5">
                    {{-- <h2 class="mb-4">Tambah Ulasan</h2> --}}
                    <form action="{{ url('customer/main/rating/store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <!-- Rating -->
                        <div class="rating">
                            <input type="radio" id="star-5" name="ratingValue" value="5" Buruk" required>
                            <label for="star-5">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path pathLength="360"
                                        d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z">
                                    </path>
                                </svg>
                            </label>
                            <input type="radio" id="star-4" name="ratingValue" value="4" >
                            <label for="star-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path pathLength="360"
                                        d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z">
                                    </path>
                                </svg>
                            </label>
                            <input type="radio" id="star-3" name="ratingValue" value="3">
                            <label for="star-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path pathLength="360"
                                        d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z">
                                    </path>
                                </svg>
                            </label>
                            <input type="radio" id="star-2" name="ratingValue" value="2" >
                            <label for="star-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path pathLength="360"
                                        d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z">
                                    </path>
                                </svg>
                            </label>
                            <input type="radio" id="star-1" name="ratingValue" value="1x">
                            <label for="star-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path pathLength="360"
                                        d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z">
                                    </path>
                                </svg>
                            </label>
                        </div>

                        <!-- Ulasan -->
                        <div class="form-group mb-3">
                            <textarea class="form-control" id="reviewText" name="reviewText" rows="4"
                                placeholder="Write or update your rating and review here" required></textarea>
                        </div>

                        <!-- Tombol Kirim -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>



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
                            laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est
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
                            Aperiam itaque sit optio et deleniti eos nihil quidem cumque. Voluptas dolorum accusantium sunt
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
                            Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante
                            in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum
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
                                    <input type="text" name="name" class="form-control" placeholder="Your Name"
                                        required="">
                                </div>

                                <div class="col-md-6 ">
                                    <input type="email" class="form-control" name="email" placeholder="Your Email"
                                        required="">
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

    {{-- modal review dan rating --}}
    <div class="modal fade" id="addRatingModal" tabindex="-1" role="dialog" aria-labelledby="addRatingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRatingModalLabel">Tambah Ulasan</h5>
                    <button type="button" class="btn-close" data--dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('customer/rating/store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <!-- Rating Stars -->
                        <div class="form-group text-center mb-3">
                            <label class="d-block">Rating</label>
                            <span class="rating-star" data-value="1">★</span>
                            <span class="rating-star" data-value="2">★</span>
                            <span class="rating-star" data-value="3">★</span>
                            <span class="rating-star" data-value="4">★</span>
                            <span class="rating-star" data-value="5">★</span>
                            <input type="hidden" id="ratingValue" name="ratingValue" value="0">
                        </div>

                        <!-- Ulasan -->
                        <div class="form-group">
                            <label for="reviewText">Ulasan Anda</label>
                            <textarea class="form-control" id="reviewText" name="reviewText" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('userscript')
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
@endpush
