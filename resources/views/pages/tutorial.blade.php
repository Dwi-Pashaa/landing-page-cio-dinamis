@extends('layouts.app')

@section('title', $seo->meta_title ?? 'Tutorial & Bantuan - PT CIO NETWORK NUSANTARA')
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
                  <span class="badge badge-indigo mb-3">Pusat Bantuan Mandiri</span>
                  <h1 class="hero-title" style="font-size: 44px; margin-bottom: 15px;">List <span>Tutorial & Tips</span></h1>
                  <p class="hero-desc">Kumpulan panduan praktis bagi Anda untuk mengoptimalkan pengaturan Wi-Fi, mengukur kecepatan, dan mendiagnosis masalah koneksi secara mandiri.</p>
               </div>
            </div>
         </div>
      </section>

      <section class="about-section layout_padding py-5">
         <div class="container">
            <div class="row">
               @forelse($tutorials as $tutorial)
                   <div class="col-md-6 col-lg-4 mb-4 d-flex">
                      <div class="tutorial-card glass-card flex-fill">
                         <a href="{{ url('/tutorial/' . $tutorial->slug) }}" class="text-decoration-none">
                            @if($tutorial->thumbnail)
                                <div class="tutorial-image" style="background: none; overflow: hidden;">
                                    <img src="{{ asset('storage/' . $tutorial->thumbnail) }}" alt="{{ $tutorial->judul }}"
                                         style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            @else
                                <div class="tutorial-image {{ $tutorial->gradient_class ?? 'bg-gradient-pink-orange' }}">
                                    <i class="fa-solid {{ $tutorial->icon_class ?? 'fa-newspaper' }}"></i>
                                </div>
                            @endif
                         </a>
                         <div class="tutorial-content">
                            <span class="tutorial-category">{{ $tutorial->kategori }}</span>
                            <h3 class="tutorial-title">
                                <a href="{{ url('/tutorial/' . $tutorial->slug) }}" class="text-decoration-none">
                                    {{ $tutorial->judul }}
                                </a>
                            </h3>
                            <p class="tutorial-text">{{ $tutorial->deskripsi }}</p>
                            @if($tutorial->tags->count())
                                <div class="mb-2">
                                    @foreach($tutorial->tags as $tag)
                                        <span class="badge badge-indigo me-1" style="font-size: 11px; padding: 3px 8px;">#{{ $tag->name }}</span>
                                    @endforeach
                                </div>
                            @endif
                            <a href="{{ url('/tutorial/' . $tutorial->slug) }}" class="tutorial-link">
                                Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                            </a>
                         </div>
                      </div>
                   </div>
               @empty
                   <div class="col-12 text-center text-muted py-5">
                       <p>Belum ada tutorial tersedia.</p>
                   </div>
               @endforelse
            </div>

            @if($tutorials->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $tutorials->links() }}
                </div>
            @endif
         </div>
      </section>
@endsection
