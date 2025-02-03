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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=reviews" />
  {{-- bootstrap4 --}}
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

  <!-- Favicons -->
  <link href="{{ asset('userpage/assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('userpage/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('userpage/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('userpage/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('userpage/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('userpage/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('userpage/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('userpage/assets/css/main.css') }}" rel="stylesheet">
  @stack('usercss')
  
  <!-- =======================================================
  * Template Name: Vesperr
  * Template URL: https://bootstrapmade.com/vesperr-free-bootstrap-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">
    <!-- Preloader -->
  <div id="preloader"></div>

  @include('layout_user.header')

  
  @yield('usercontent')

  @include('layout_user.footer')

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  
  {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
  {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script> --}}

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
  @stack('userscript')
</body>

</html>