@extends('layouts.app')

@section('title', $seo->meta_title ?? 'Tentang Kami - PT CIO NETWORK NUSANTARA')
@section('meta_keywords', $seo->meta_keywords ?? '')
@section('meta_description', $seo->meta_description ?? '')

@section('content')
      <section class="hero-section" style="min-height: auto; padding: 140px 0 60px 0;">
         <div class="hero-shapes">
            <div class="shape-glow glow-1" style="width: 250px; height: 250px;"></div>
         </div>
         <div class="container">
            <div class="row">
               <div class="col-lg-8 hero-content text-left">
                  <span class="badge badge-indigo mb-3">{{ $about->hero_badge ?? 'Profil Perusahaan' }}</span>
                  <h1 class="hero-title" style="font-size: 44px; margin-bottom: 15px;">{!! $about->hero_title ?? 'Tentang <span>PT CIO NETWORK NUSANTARA</span>' !!}</h1>
                  <p class="hero-desc">{{ $about->hero_description ?? 'Penyedia dan pengelola solusi jaringan internet terjangkau dengan pengalaman lebih dari 5 tahun. Mitra resmi ISP Andira Infomedia — beroperasi dengan legalitas yang jelas dan terpercaya.' }}</p>
               </div>
            </div>
         </div>
      </section>

      <section class="about-section layout_padding py-5">
         <div class="container">
            <div class="row align-items-center mb-5">
               <div class="col-lg-6 mb-4 mb-lg-0">
                  <h2 class="section-title mb-4">{{ $about->about_title ?? 'Siapa Kami?' }}</h2>
                  @if(!empty($about->about_lead))
                     <p class="lead" style="color: var(--text-title); font-weight: 600; margin-bottom: 20px;">{{ $about->about_lead }}</p>
                  @else
                     <p class="lead" style="color: var(--text-title); font-weight: 600; margin-bottom: 20px;">Cio Network adalah penyedia dan pengelola solusi jaringan internet terjangkau dengan pengalaman lebih dari 5 tahun.</p>
                  @endif
                  <p class="mb-4">{{ $about->about_description ?? 'Sebagai mitra resmi ISP Andira Infomedia, kami beroperasi dengan legalitas yang jelas dan terpercaya. Kami hadir untuk menyambungkan setiap rumah and bisnis dengan koneksi internet cepat, stabil, dan tanpa batas kuota — baik melalui layanan bulanan maupun sistem voucher yang fleksibel.' }}</p>
               </div>
               <div class="col-lg-6 text-center">
                  <div class="visual-wrapper" style="max-width: 480px;">
                     @if(!empty($about->about_image))
                        <img src="{{ asset('storage/' . $about->about_image) }}" alt="Infrastruktur Cio Network" class="img-fluid rounded-lg shadow-sm" style="border-radius: 16px;">
                     @else
                        <img src="{{ asset('pages/images/hosting-img.png') }}" alt="Infrastruktur Cio Network" class="img-fluid rounded-lg shadow-sm" style="border-radius: 16px;">
                     @endif
                  </div>
               </div>
            </div>

            <div class="row mt-5">
               <div class="col-md-6 mb-4">
                  <div class="glass-card p-4 h-100" style="border-left: 4px solid var(--accent-blue);">
                     <h3 class="feature-title" style="font-size: 22px;"><i class="fa-solid fa-eye text-primary mr-2"></i> {{ $about->visi_title ?? 'Visi Kami' }}</h3>
                     <p class="mb-0 mt-3">{{ $about->visi_text ?? 'Menjadi penyedia layanan internet kabel fiber optic terdepan di Indonesia yang dikenal karena keandalan jaringan, transparansi biaya, dan layanan pelanggan yang responsif demi mewujudkan masyarakat digital yang cerdas dan produktif.' }}</p>
                  </div>
               </div>
               <div class="col-md-6 mb-4">
                  <div class="glass-card p-4 h-100" style="border-left: 4px solid var(--accent-purple);">
                     <h3 class="feature-title" style="font-size: 22px;"><i class="fa-solid fa-bullseye text-indigo mr-2"></i> {{ $about->misi_title ?? 'Misi Kami' }}</h3>
                     <ul class="plan-features mt-3" style="margin-bottom: 0;">
                        @if(!empty($about->misi_items) && count($about->misi_items) > 0)
                           @foreach($about->misi_items as $misi)
                              <li class="mb-2" style="font-size: 14.5px;"><i class="fa-solid fa-circle-check text-indigo"></i> {{ $misi }}</li>
                           @endforeach
                        @else
                           <li class="mb-2" style="font-size: 14.5px;"><i class="fa-solid fa-circle-check text-indigo"></i> Memperluas jangkauan serat optik murni hingga ke pemukiman dan perkantoran.</li>
                           <li class="mb-2" style="font-size: 14.5px;"><i class="fa-solid fa-circle-check text-indigo"></i> Menjaga kestabilan koneksi dengan redundant server tingkat tinggi.</li>
                           <li class="mb-0" style="font-size: 14.5px;"><i class="fa-solid fa-circle-check text-indigo"></i> Menyediakan harga flat yang transparan dan bersahabat tanpa biaya tersembunyi.</li>
                        @endif
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </section>

      <section class="pricing-section layout_padding py-5">
         <div class="container">
            <div class="section-header text-center mb-5">
               <span class="badge badge-indigo mb-2">Nilai Tambah Kami</span>
               <h2 class="section-title">Kenapa Harus Cio Network?</h2>
            </div>

            <div class="row">
               @forelse($keunggulan as $item)
                   <div class="col-md-6 col-lg-3 mb-4">
                      <div class="feature-card glass-card">
                         <div class="feature-icon {{ $item->gradient_class ?? 'bg-gradient-blue' }}">
                            <i class="fa-solid {{ $item->icon_class ?? 'fa-star' }}"></i>
                         </div>
                         <h3 class="feature-title">{{ $item->judul }}</h3>
                         <p class="feature-desc">{{ $item->deskripsi }}</p>
                      </div>
                   </div>
               @empty
                   <div class="col-12 text-center text-muted py-4">
                       <p>Belum ada data keunggulan.</p>
                   </div>
               @endforelse
            </div>
         </div>
      </section>
@endsection
