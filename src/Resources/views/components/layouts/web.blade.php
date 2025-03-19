<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" user-scalable="no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{setting('general.site_name')}} - {{$pageName}}</title>
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
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=EB+Garamond:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('hub/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('hub/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('hub/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('hub/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  <link rel="stylesheet" href="{{ asset('hub/css/leaflet.css') }}">

  <!-- Main CSS File -->
  <link href="{{ asset('hub/css/main.css') }}" rel="stylesheet">
</head>
<body class="index-page">
  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

      <a href="{{url('/')}}" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="{{ asset('hub/images/logo.png') }}" alt=""> -->
        <h4 class="sitename">{{setting('general.site_name')}}</h4>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{url('/about')}}">About</a></li>
          <li><a href="groups.html">Groups</a></li>
          <li><a href="groups.html">Projects</a></li>
          <li class="dropdown"><a href="#"><span>Categories</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="category.html">Category 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">Deep Dropdown 1</a></li>
                  <li><a href="#">Deep Dropdown 2</a></li>
                  <li><a href="#">Deep Dropdown 3</a></li>
                  <li><a href="#">Deep Dropdown 4</a></li>
                  <li><a href="#">Deep Dropdown 5</a></li>
                </ul>
              </li>
              <li><a href="category.html">Category 2</a></li>
              <li><a href="category.html">Category 3</a></li>
              <li><a href="category.html">Category 4</a></li>
            </ul>
          </li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <div class="header-social-links">
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
      </div>

    </div>
  </header>
  <main class="main">
    {{$slot}}
  </main>
  <footer id="footer" class="footer dark-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">{{setting('general.site_name')}}</span>
          </a>
          <div class="footer-contact pt-3">
            {{setting('general.physical_address')}}
            <p class="mt-3"><strong>Phone:</strong> <span>{{setting('general.phone')}}</span></p>
            <p><strong>Email:</strong> <span>{{setting('general.email')}}</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-8 col-md-6 footer-links">
          <div id="mapid" style="height:250px;"></div>
          <script>
              var coords;
              coords = [{{setting('general.map_location')['lat']}},{{setting('general.map_location')['lng']}}];
              var mymap = L.map('mapid').setView(L.latLng(coords), 15);
              L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
              attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
              maxZoom: 18,
              id: 'mapbox/streets-v11',
              tileSize: 512,
              zoomOffset: -1,
              accessToken: '{{setting('general.mapbox_token')}}'
              }).addTo(mymap);
              var marker = L.marker(L.latLng(coords)).addTo(mymap);
          </script>
        </div>
      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by {{setting('general.site_name')}}<br>based on a <a href="https://bootstrapmade.com/">BootstrapMade</a> template from <a href=“https://themewagon.com>ThemeWagon
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