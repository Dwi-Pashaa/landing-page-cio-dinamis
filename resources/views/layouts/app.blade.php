<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <title>@yield('title', $seo->meta_title ?? 'PT CIO NETWORK NUSANTARA - Internet Fiber Optic Ultra Cepat & Tanpa FUP')</title>
   <meta name="keywords" content="@yield('meta_keywords', $seo->meta_keywords ?? 'isp, pt cio network nusantara, cio network nusantara, internet cepat, fiber optic, internet murah, internet unlimited, wifi rumah, wifi kantor')">
   <meta name="description" content="@yield('meta_description', $seo->meta_description ?? 'Selamat datang di PT CIO NETWORK NUSANTARA. Temukan layanan internet fiber optic cepat dan unlimited tanpa FUP untuk menunjang aktivitas Anda.')">

   @if(isset($seo))
       <meta property="og:title" content="{{ $seo->og_title ?? $seo->meta_title }}">
       <meta property="og:description" content="{{ $seo->og_description ?? $seo->meta_description }}">
       <meta property="og:type" content="website">
       <meta property="og:url" content="{{ url()->current() }}">
   @endif

   <link rel="stylesheet" type="text/css" href="{{ asset('pages/css/bootstrap.min.css') }}">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

   <link rel="stylesheet" type="text/css" href="{{ asset('pages/css/style.css') }}">
   <link rel="stylesheet" href="{{ asset('pages/css/responsive.css') }}">
   <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />

    <style>
        .navbar-brand {
            display: flex;
            align-items: center;
            padding: 0;
            margin-right: 1.5rem;
        }
        .navbar-brand .navbar-logo-img {
            height: 48px;
            width: auto;
            max-height: 52px;
            display: block;
            object-fit: contain;
            transition: transform 0.25s ease, opacity 0.25s ease;
        }
        .navbar-brand:hover .navbar-logo-img {
            transform: scale(1.03);
            opacity: 0.95;
        }
        @media (max-width: 991px) {
            .navbar-brand .navbar-logo-img {
                height: 38px;
            }
        }
        .footer-brand {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .footer-brand .footer-logo-img {
            height: 48px;
            width: auto;
            display: block;
            border-radius: 8px;
            background: #ffffff;
            padding: 4px 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
    </style>
    @yield('additional_css')
</head>

<body>
   <nav class="navbar navbar-expand-lg fixed-top modern-navbar">
      <div class="container">
         <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('img/logo_baru.png') }}" alt="PT CIO NETWORK NUSANTARA" class="navbar-logo-img">
         </a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon-custom">
               <span></span>
               <span></span>
               <span></span>
            </span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
               <li class="nav-item">
                  <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link {{ Request::is('tentang-kami') ? 'active' : '' }}" href="{{ url('/tentang-kami') }}">Tentang Kami</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link {{ Request::is('paket-internet') ? 'active' : '' }}" href="{{ url('/paket-internet') }}">Paket Internet</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link {{ Request::is('tutorial') ? 'active' : '' }}" href="{{ url('/tutorial') }}">Tutorial</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link {{ Request::is('kontak') ? 'active' : '' }}" href="{{ url('/kontak') }}">Kontak</a>
               </li>
            </ul>
            <div class="nav-cta">
               @php $waCta = \App\Models\SiteSetting::getValue('wa_cta', '6285324780031') @endphp
               <a href="https://wa.me/{{ $waCta }}" class="btn btn-gradient-glow nav-btn">Hubungi Kami</a>
            </div>
         </div>
      </div>
   </nav>

   @yield('content')

   <footer class="footer-section">
      <div class="container">
         <div class="row py-5">
            <div class="col-lg-4 mb-4 mb-lg-0">
               @php $companyName = \App\Models\SiteSetting::getValue('company_name', 'PT CIO NETWORK NUSANTARA') @endphp
               <h3 class="footer-brand">
                  <img src="{{ asset('img/logo_baru.png') }}" alt="PT CIO NETWORK NUSANTARA" class="footer-logo-img">
               </h3>
               <p class="footer-desc mt-3">{{ \App\Models\SiteSetting::getValue('footer_desc', 'Penyedia layanan internet berbasis serat optik generasi terbaru yang menghadirkan kecepatan tinggi, stabil, tanpa batas FUP, dan terjangkau.') }}</p>
               <div class="footer-social mt-4">
                  @php $fb = \App\Models\SiteSetting::getValue('fb_url', '#'); $ig = \App\Models\SiteSetting::getValue('ig_url', '#'); $tw = \App\Models\SiteSetting::getValue('tw_url', '#'); $li = \App\Models\SiteSetting::getValue('linkedin_url', '#') @endphp
                  <a href="{{ $fb }}"><i class="fa-brands fa-facebook-f"></i></a>
                  <a href="{{ $tw }}"><i class="fa-brands fa-twitter"></i></a>
                  <a href="{{ $ig }}"><i class="fa-brands fa-instagram"></i></a>
                  <a href="{{ $li }}"><i class="fa-brands fa-linkedin-in"></i></a>
               </div>
               @php $ownerName = \App\Models\SiteSetting::getValue('owner_name', '') @endphp
               @if($ownerName)
                   <p class="footer-desc mt-3" style="font-size: 13px; opacity: 0.8;"><i class="fa-solid fa-user" style="margin-right: 6px;"></i> Owner: <strong>{{ $ownerName }}</strong></p>
               @endif
            </div>
            <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
               <h4 class="footer-title">Tautan Pintar</h4>
               <ul class="footer-links">
                  <li><a href="{{ url('/') }}"><i class="fa-solid fa-chevron-right"></i> Home</a></li>
                  <li><a href="{{ url('/tentang-kami') }}"><i class="fa-solid fa-chevron-right"></i> Tentang Kami</a></li>
                  <li><a href="{{ url('/paket-internet') }}"><i class="fa-solid fa-chevron-right"></i> Paket Internet</a></li>
                  <li><a href="{{ url('/tutorial') }}"><i class="fa-solid fa-chevron-right"></i> Tutorial</a></li>
                  <li><a href="{{ url('/kontak') }}"><i class="fa-solid fa-chevron-right"></i> Kontak</a></li>
               </ul>
            </div>
            <div class="col-lg-3 col-md-4 mb-4 mb-md-0">
               <h4 class="footer-title">Jam Layanan</h4>
               <ul class="footer-hours">
                  <li><span>Customer Service:</span> {{ \App\Models\SiteSetting::getValue('jam_cs', '24 Jam Nonstop') }}</li>
                  <li><span>Technical Support:</span> {{ \App\Models\SiteSetting::getValue('jam_technical', '24 Jam Nonstop') }}</li>
                  <li><span>Kantor Operasional:</span> {{ \App\Models\SiteSetting::getValue('jam_kantor', 'Senin - Sabtu (08.00 - 17.00 WIB)') }}</li>
               </ul>
            </div>
            <div class="col-lg-3 col-md-4">
               <h4 class="footer-title">Hubungi Kami</h4>
               <ul class="footer-contact">
                  <li><i class="fa-solid fa-location-dot"></i> {{ \App\Models\SiteSetting::getValue('alamat', 'Jl. Bojong Jl. Toha Ramdan, Ciparay, Kec. Ciparay, Kabupaten Bandung, Jawa Barat 40381') }}</li>
                  <li><i class="fa-solid fa-phone"></i> {{ \App\Models\SiteSetting::getValue('wa_sales', '+62 853-2478-0031') }}</li>
                  <li><i class="fa-solid fa-envelope"></i> {{ \App\Models\SiteSetting::getValue('email_support', 'cs@cionetwork.id') }}</li>
               </ul>
            </div>
         </div>

         <hr class="footer-divider">

         <div class="row py-4 align-items-center">
            <div class="col-md-6 text-center text-md-left">
               <p class="copyright-text mb-0">{!! \App\Models\SiteSetting::getValue('copyright_text', '&copy; 2026 PT CIO NETWORK NUSANTARA. Semua Hak Dilindungi Undang-Undang.') !!}</p>
               @if($ownerName)
                   <p class="copyright-text mb-0" style="margin-top: 4px; opacity: 0.75;">Owner: {{ $ownerName }}</p>
               @endif
            </div>
            <div class="col-md-6 text-center text-md-right mt-3 mt-md-0">
               <p class="theme-author mb-0">Dibuat secara profesional dengan estetika modern.</p>
            </div>
         </div>
      </div>
   </footer>

   <div id="back-to-top" class="back-to-top-btn">
      <i class="fa-solid fa-arrow-up"></i>
   </div>

   <script src="{{ asset('pages/js/jquery.min.js') }}"></script>
   <script src="{{ asset('pages/js/popper.min.js') }}"></script>
   <script src="{{ asset('pages/js/bootstrap.bundle.min.js') }}"></script>
   <script src="{{ asset('pages/js/jquery-3.0.0.min.js') }}"></script>
   <script src="{{ asset('pages/js/jquery.validate.js') }}"></script>

   <script>
      $(document).ready(function () {
         $(window).on('scroll', function () {
            if ($(window).scrollTop() > 50) {
               $('.modern-navbar').addClass('navbar-scrolled');
            } else {
               $('.modern-navbar').removeClass('navbar-scrolled');
            }
            if ($(window).scrollTop() > 300) {
               $('#back-to-top').addClass('visible');
            } else {
               $('#back-to-top').removeClass('visible');
            }
         });

         $('#back-to-top').on('click', function () {
            $('html, body').animate({ scrollTop: 0 }, 800);
         });

         $('.navbar-toggler').on('click', function () {
            $(this).toggleClass('open');
         });
      });
   </script>

   @yield('additional_js')
</body>

</html>
