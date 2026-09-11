@extends('layouts.app')

@section('title', $seo->meta_title ?? 'PT CIO NETWORK NUSANTARA - Internet Fiber Optic Ultra Cepat & Tanpa FUP')
@section('meta_keywords', $seo->meta_keywords ?? '')
@section('meta_description', $seo->meta_description ?? '')

@section('content')
   <section id="home" class="hero-section">
      <div class="hero-shapes">
         <div class="shape-glow glow-1"></div>
         <div class="shape-glow glow-2"></div>
      </div>
      <div class="container">
         <div class="row align-items-center">
            <div class="col-lg-6 hero-content">
               @if($hero)
                   <span class="badge badge-indigo animate-pulse mb-3">{{ $hero->badge_text }}</span>
                   <h1 class="hero-title">{!! $hero->title !!}</h1>
                   <p class="hero-desc">{{ $hero->description }}</p>
                   <div class="hero-buttons">
                       @if($hero->btn_primary_text)
                           <a href="{{ $hero->btn_primary_url }}" class="btn btn-gradient-glow btn-lg mr-3">{{ $hero->btn_primary_text }}</a>
                       @endif
                       @if($hero->btn_secondary_text)
                           <a href="{{ $hero->btn_secondary_url }}" class="btn btn-outline-light btn-lg">{{ $hero->btn_secondary_text }}</a>
                       @endif
                   </div>
               @else
                   <span class="badge badge-indigo animate-pulse mb-3">Internet Fiber Optic Tercepat</span>
                   <h1 class="hero-title">Koneksi Ultra Cepat <br>Tanpa Batas <span>Untuk Anda</span></h1>
                   <p class="hero-desc">Rasakan kestabilan internet 24/7 tanpa FUP (Fair Usage Policy) dari PT CIO NETWORK NUSANTARA.</p>
                   <div class="hero-buttons">
                       <a href="{{ url('/paket-internet') }}" class="btn btn-gradient-glow btn-lg mr-3">Pilih Paket Internet</a>
                       <a href="{{ url('/tentang-kami') }}" class="btn btn-outline-light btn-lg">Tentang Kami</a>
                   </div>
               @endif
            </div>
            <div class="col-lg-6 hero-visual text-center mt-5 mt-lg-0">
               <div class="visual-wrapper">
                  <div class="glowing-ring"></div>
                  @if($hero && $hero->hero_image)
                      <img src="{{ asset('storage/' . $hero->hero_image) }}" alt="PT CIO NETWORK NUSANTARA" class="img-fluid floating-animation">
                  @else
                      <img src="{{ asset('pages/images/banner-img.png') }}" alt="PT CIO NETWORK NUSANTARA" class="img-fluid floating-animation">
                  @endif
               </div>
            </div>
         </div>
      </div>
   </section>

   <section class="about-section layout_padding">
      <div class="container">
         <div class="section-header text-center mb-5">
            <span class="badge badge-indigo mb-2">Tentang Kami</span>
            <h2 class="section-title">Solusi Internet Fiber Optic Terbaik</h2>
            <p class="section-subtitle mx-auto">PT CIO NETWORK NUSANTARA berkomitmen menghadirkan koneksi simetris berkecepatan tinggi yang flat dan tanpa batasan kuota.</p>
         </div>
         <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
               <h3 class="feature-title mb-3" style="font-size: 24px;">Siapa PT CIO NETWORK NUSANTARA?</h3>
               <p class="mb-4">Kami adalah penyedia dan pengelola solusi jaringan internet terjangkau dengan pengalaman lebih dari 5 tahun. Sebagai mitra resmi ISP Andira Infomedia, kami beroperasi dengan legalitas yang jelas — hadir menyambungkan setiap rumah dan bisnis dengan koneksi cepat, stabil, dan tanpa batas kuota.</p>

               <div class="row mt-4">
                   <div class="col-sm-6 mb-3"><div class="d-flex align-items-center"><i class="fa-solid fa-circle-check text-primary mr-2" style="font-size: 18px;"></i><span style="font-weight: 600; color: var(--text-title);">Unggah & Unduh Simetris</span></div></div>
                   <div class="col-sm-6 mb-3"><div class="d-flex align-items-center"><i class="fa-solid fa-circle-check text-primary mr-2" style="font-size: 18px;"></i><span style="font-weight: 600; color: var(--text-title);">True Unlimited (No FUP)</span></div></div>
                   <div class="col-sm-6 mb-3"><div class="d-flex align-items-center"><i class="fa-solid fa-circle-check text-primary mr-2" style="font-size: 18px;"></i><span style="font-weight: 600; color: var(--text-title);">Koneksi Redundan Stabil</span></div></div>
                   <div class="col-sm-6 mb-3"><div class="d-flex align-items-center"><i class="fa-solid fa-circle-check text-primary mr-2" style="font-size: 18px;"></i><span style="font-weight: 600; color: var(--text-title);">Bantuan Teknis 24 Jam</span></div></div>
               </div>
               <div class="mt-4">
                   <a href="{{ url('/tentang-kami') }}" class="btn btn-outline-indigo">Selengkapnya Tentang Kami</a>
               </div>
            </div>
            <div class="col-lg-6 text-center">
               <div class="visual-wrapper" style="max-width: 480px;">
                   <img src="{{ asset('pages/images/hosting-img.png') }}" alt="Infrastruktur Cio Network"
                      class="img-fluid rounded-lg shadow-sm" style="border-radius: 16px;">
               </div>
            </div>
         </div>
      </div>
   </section>

   <section class="pricing-section py-5 home-paket-section">
      <div class="container">
         <div class="section-header text-center mb-5">
            <span class="badge badge-indigo mb-2">Paket Pilihan</span>
            <h2 class="section-title">Pilih Jenis Paket Internet Anda</h2>
            <p class="section-subtitle mx-auto">Tersedia Paket Home Bulanan tanpa ribet dan Paket Voucher fleksibel per perangkat sesuai kebutuhan Anda.</p>
         </div>

         <div class="row home-grid-container">
            @forelse($featuredPaket as $paket)
                <div class="col-md-6 col-lg-5 mb-4 d-flex">
                   <div class="home-card-paket {{ $paket->is_rekomendasi ? 'featured-style' : '' }}">
                      @if($paket->is_rekomendasi)
                          <span class="badge-rekomendasi">Rekomendasi</span>
                      @endif
                      <div>
                         <h3>{{ $paket->nama }}</h3>
                         <p class="sub-plan">{{ $paket->sub_judul }}</p>

                         <div class="home-price-box">
                            <span class="currency">Rp</span>
                            <span class="amount">{{ number_format($paket->harga, 0, ',', '.') }}</span>
                            <span class="period">{{ $paket->periode }}</span>
                         </div>

                         @if($paket->highlight_text)
                             <p class="mt-2 text-primary highlight-text">{{ $paket->highlight_text }}</p>
                         @endif
                         @if($paket->sub_highlight)
                             <p class="sub-highlight">{{ $paket->sub_highlight }}</p>
                         @endif

                         @if($paket->fitur)
                             <ul class="home-list-fitur">
                                @foreach($paket->fitur as $fitur)
                                    <li><i class="fa-solid fa-circle-check text-primary"></i> {{ $fitur }}</li>
                                @endforeach
                             </ul>
                         @endif

                         @if($paket->keuntungan_tambahan)
                             <div class="divider"></div>
                             <p class="title-tambahan">Keuntungan Tambahan:</p>
                             <ul class="home-list-fitur">
                                @foreach($paket->keuntungan_tambahan as $keuntungan)
                                    <li><i class="fa-solid fa-circle-check text-success"></i> {{ $keuntungan }}</li>
                                @endforeach
                             </ul>
                         @endif
                      </div>
                      <div class="action-wrapper">
                         @php
                             $waNum = $paket->wa_number ?? '6285700180302';
                             $waMsg = $paket->wa_message ?? 'Halo PT CIO NETWORK NUSANTARA, saya tertarik dengan paket ini.';
                         @endphp
                         <a href="https://wa.me/{{ $waNum }}?text={{ urlencode($waMsg) }}" target="_blank" class="btn btn-gradient-glow w-100 py-3">HUBUNGI SEKARANG</a>
                      </div>
                   </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">
                    <p>Belum ada paket tersedia.</p>
                    <a href="{{ url('/paket-internet') }}" class="btn btn-gradient-glow">Lihat Semua Paket</a>
                </div>
            @endforelse
         </div>
      </div>
   </section>

   <section class="about-section layout_padding">
      <div class="container">
         <div class="section-header text-center mb-5">
            <span class="badge badge-indigo mb-2">Tutorial & Bantuan</span>
            <h2 class="section-title">Tips Mengoptimalkan Jaringan Anda</h2>
            <p class="section-subtitle mx-auto">Kumpulan artikel singkat untuk memandu Anda merawat router Wi-Fi secara mandiri.</p>
         </div>
         <div class="row">
            @forelse($featuredTutorial as $tutorial)
                <div class="col-md-4 mb-4 d-flex">
                   <div class="tutorial-card glass-card flex-fill">
                      <div class="tutorial-image {{ $tutorial->gradient_class ?? 'bg-gradient-pink-orange' }}">
                         <i class="fa-solid {{ $tutorial->icon_class ?? 'fa-play' }}"></i>
                      </div>
                      <div class="tutorial-content">
                         <span class="tutorial-category">{{ $tutorial->kategori }}</span>
                         <h3 class="tutorial-title">{{ $tutorial->judul }}</h3>
                         <p class="tutorial-text">{{ Str::limit($tutorial->deskripsi, 100) }}</p>
                         <a href="{{ url('/tutorial') }}" class="tutorial-link">Lihat Tutorial <i class="fa-solid fa-arrow-right"></i></a>
                      </div>
                   </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">
                    <p>Belum ada tutorial tersedia.</p>
                </div>
            @endforelse
         </div>

         <div class="text-center mt-4">
            <a href="{{ url('/tutorial') }}" class="btn btn-outline-indigo px-5">Lihat Semua Tutorial</a>
         </div>
      </div>
   </section>

   <section class="pricing-section layout_padding">
      <div class="container">
         <div class="section-header text-center mb-5">
            <span class="badge badge-indigo mb-2">Kontak Kami</span>
            <h2 class="section-title">Siap Terhubung dengan Tim Cio?</h2>
            <p class="section-subtitle mx-auto">Hubungi saluran komunikasi resmi kami untuk menanyakan jangkauan area atau bantuan pendaftaran.</p>
         </div>

         <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
               @php
                   $waSales = \App\Models\SiteSetting::getValue('wa_sales', '6285324780031');
                   $email = \App\Models\SiteSetting::getValue('email_support', 'cs@cionetwork.id');
                   $alamat = \App\Models\SiteSetting::getValue('alamat', 'Jl. Bojong Jl. Toha Ramdan, Ciparay, Kec. Ciparay, Kabupaten Bandung, Jawa Barat 40381');
               @endphp
               <div class="info-box glass-card mb-3">
                   <div class="info-icon bg-gradient-blue"><i class="fa-solid fa-phone"></i></div>
                   <div class="info-text">
                       <h4>WhatsApp Sales</h4>
                       <p><a href="https://wa.me/{{ $waSales }}" target="_blank">{{ $waSales }}</a></p>
                   </div>
               </div>
               <div class="info-box glass-card mb-3">
                   <div class="info-icon bg-gradient-purple"><i class="fa-solid fa-envelope"></i></div>
                   <div class="info-text">
                       <h4>Email Support</h4>
                       <p><a href="mailto:{{ $email }}">{{ $email }}</a></p>
                   </div>
               </div>
               <div class="info-box glass-card">
                   <div class="info-icon bg-gradient-pink"><i class="fa-solid fa-location-dot"></i></div>
                   <div class="info-text">
                       <h4>Alamat Kantor</h4>
                       <p>{{ $alamat }}</p>
                   </div>
               </div>
            </div>
            <div class="col-lg-6 text-center text-lg-left">
               <h3 class="feature-title mb-3" style="font-size: 24px;">Hubungi Kami Sekarang</h3>
               <p class="mb-4">Kami siap menjawab segala pertanyaan Anda perihal layanan internet murni fiber optic dari PT CIO NETWORK NUSANTARA. Dapatkan promo instalasi gratis khusus hari ini!</p>
               <a href="{{ url('/kontak') }}" class="btn btn-gradient-glow px-5 py-3">Buka Formulir Kontak Pelanggan</a>
            </div>
         </div>
      </div>
   </section>
@endsection
