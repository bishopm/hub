<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Westville Churches</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <!-- =======================================================
  * Template Name: ZenBlog
  * Template URL: https://bootstrapmade.com/zenblog-bootstrap-blog-template/
  * Updated: Aug 08 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <!-- Favicons -->
  <link href="{{ asset('hub/images/favicon.png') }}" rel="icon">
  <link href="{{ asset('hub/images/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('hub/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('hub/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('hub/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('hub/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@event-calendar/build/dist/event-calendar.min.css">
  <script src="https://cdn.jsdelivr.net/npm/@event-calendar/build/dist/event-calendar.min.js"></script>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  <link rel="stylesheet" href="{{ asset('hub/css/leaflet.css') }}">

  <!-- Main CSS File -->
  <link href="{{ asset('hub/css/main.css') }}" rel="stylesheet">
  <style>
    h4.ec-event-title {
      font-size: 11pt;
    }
  </style>
</head>
<body class="index-page">
  <header id="header" class="header d-flex align-items-center sticky-top" style="background-color: white;">
    <div class="container position-relative d-flex align-items-center justify-content-between">

      <a href="{{url('/')}}" class="logo d-flex align-items-center me-auto me-xl-0">
        <img src="{{ asset('hub/images/churches_header.png') }}" alt="">
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a class="text-black" href="{{url('/')}}">Home</a></li>
          <li><a class="text-black"  href="{{url('/churches')}}">Churches</a></li>
          <li><a class="text-black"  href="#">Projects</a></li>
          <li><a class="text-black"  href="#">Coming up</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none text-white bi bi-list"></i>
      </nav>

      <div class="header-social-links">
        <a href="{{setting('general.linkedin')}}" target="_blank" class="linkedin"><i class="text-white bi bi-linkedin"></i></a>
      </div>

    </div>
  </header>
  <main class="main">
    <div class="container mb-5">
      <div class="row mt-3"> 
        {{$slot}}
      </div>
    </div>
  </main>
  <footer id="footer" class="footer dark-background">
    <div class="container copyright text-center mt-4">
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by WestvilleChurches<br>based on a <a href="https://bootstrapmade.com/">BootstrapMade</a> template from <a href=“https://themewagon.com>ThemeWagon
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('hub/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('hub/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('hub/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('hub/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('hub/js/main.js') }}"></script>
</body>
</html>