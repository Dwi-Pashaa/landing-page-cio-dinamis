@extends('layouts.app')

@section('title', $seo->meta_title ?? 'Paket Internet - PT CIO NETWORK NUSANTARA')
@section('meta_keywords', $seo->meta_keywords ?? '')
@section('meta_description', $seo->meta_description ?? '')

@section('additional_css')
   <style>
      body { background-color: var(--bg-primary) !important; color: var(--text-main) !important; }
      .custom-paket-wrapper { padding: 160px 0 60px 0; background: radial-gradient(circle at 90% 10%, rgba(37, 99, 235, 0.04) 0%, transparent 40%); }
      .paket-page-section { padding: 60px 0; background: #ffffff; }
      .paket-page-section-alt { padding: 80px 0; background-color: var(--bg-secondary) !important; border-top: 1px solid var(--border-card); }
      .custom-pricing-card { background: #ffffff !important; border: 1px solid rgba(148, 163, 184, 0.2) !important; border-radius: 20px !important; padding: 40px 30px !important; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04) !important; transition: all 0.3s ease-in-out !important; position: relative; overflow: hidden; width: 100%; display: flex; flex-direction: column; justify-content: space-between; text-align: left !important; }
      .custom-pricing-card:hover { border-color: var(--accent-blue) !important; box-shadow: 0 20px 40px rgba(37, 99, 235, 0.08) !important; transform: translateY(-5px); }
      .custom-pricing-card.featured-style { border-color: rgba(37, 99, 235, 0.4) !important; background: linear-gradient(180deg, rgba(37, 99, 235, 0.02) 0%, #ffffff 100%) !important; }
      .custom-pricing-card .badge-top { position: absolute; top: 20px; right: 25px; background: var(--gradient-primary); color: #ffffff; font-size: 11px; font-weight: 700; padding: 4px 12px; border-radius: 30px; text-transform: uppercase; }
      .card-title-head { font-size: 26px; font-weight: 800; color: #0f172a !important; margin-bottom: 4px; text-align: left !important; }
      .card-sub-head { color: #64748b !important; font-size: 14px; margin-bottom: 20px; text-align: left !important; }
      .price-box-layout { display: flex; align-items: baseline; margin-bottom: 15px; text-align: left !important; }
      .price-box-layout .currency-symbol { font-size: 22px; font-weight: 700; color: var(--accent-blue); margin-right: 4px; }
      .price-box-layout .amount-value { font-size: 46px; font-weight: 800; color: #0f172a; line-height: 1; }
      .price-box-layout .per-period { font-size: 15px; color: #64748b; margin-left: 6px; font-weight: 500; }
      .feature-list-clean { list-style: none !important; padding: 0 !important; margin: 25px 0 0 0 !important; text-align: left !important; }
      .feature-list-clean li { position: relative !important; padding-left: 30px !important; margin-bottom: 14px !important; font-size: 14.5px !important; line-height: 1.5 !important; color: #334155 !important; text-align: left !important; }
      .feature-list-clean li i { position: absolute !important; left: 0 !important; top: 3px !important; font-size: 16px !important; }
      .divider-line { border-top: 1px solid rgba(148, 163, 184, 0.15); margin: 25px 0 20px 0; }
      .comparison-clean-card { background: #ffffff; border: 1px solid rgba(148, 163, 184, 0.15); border-radius: 20px; padding: 35px 30px; height: 100%; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.02); text-align: left !important; }
      .box-info-wrapper { background: #f8fafc; border: 1px solid rgba(148, 163, 184, 0.1); border-radius: 12px; padding: 20px; margin-bottom: 20px; }
      .box-info-wrapper:last-child { margin-bottom: 0; }
      .indicator-title { font-weight: 700; font-size: 15px; margin-bottom: 12px; padding-left: 10px; text-align: left !important; }
      .indicator-title.pos { border-left: 3px solid #10b981; color: #0f172a; }
      .indicator-title.neg { border-left: 3px solid #ef4444; color: #0f172a; }
      .btn-holder-card { margin-top: 30px; width: 100%; }
      .voucher-duration-list { margin: 10px 0 15px; }
      .voucher-duration-item { font-size: 13px; color: #334155; margin-bottom: 6px; }
      .voucher-duration-item .status-unavailable { color: #94a3b8; font-style: italic; margin-left: 4px; font-size: 11px; }
   </style>
@endsection

@section('content')
   <div class="custom-paket-wrapper">
      <div class="container">
         <div class="row">
            <div class="col-lg-8 text-left">
               <span class="badge badge-indigo mb-3">Pilihan Terbaik Resmi</span>
               <h1 class="hero-title" style="font-size: 46px; margin-bottom: 15px; font-weight: 800; text-align: left;">Daftar <span>Paket Internet</span></h1>
               <p class="hero-desc" style="text-align: left;">Pilih kecepatan internet terbaik yang stabil tanpa batas kuota pemakaian untuk kebutuhan harian, hiburan keluarga, hingga bisnis Anda.</p>
            </div>
         </div>
      </div>
   </div>

   <section class="paket-page-section">
      <div class="container">
         <div class="text-center mb-5">
            <span class="badge badge-indigo mb-2">Kategori Paket Resmi</span>
            <h2 style="font-weight: 800; color: #0f172a; font-size: 32px; margin-top: 5px;">Pilih Jenis Paket Internet Anda</h2>
            <p style="color: #64748b; max-width: 600px; margin: 8px auto 0 auto;">Tersedia Paket Home Bulanan tanpa ribet dan Paket Voucher fleksibel per perangkat sesuai kebutuhan Anda.</p>
         </div>

         <div class="row justify-content-center align-items-stretch">
            @forelse($paketHome->merge($paketVoucher) as $paket)
                <div class="col-md-6 col-lg-5 mb-4 d-flex">
                   <div class="custom-pricing-card {{ $paket->is_rekomendasi ? 'featured-style' : '' }}">
                      @if($paket->is_rekomendasi)
                          <span class="badge-top">Terlaris</span>
                      @endif
                      <div>
                         <h3 class="card-title-head">{{ $paket->nama }}</h3>
                         <p class="card-sub-head">{{ $paket->sub_judul }}</p>

                         <div class="price-box-layout">
                            <span class="currency-symbol">Rp</span>
                            <span class="amount-value">{{ number_format($paket->harga, 0, ',', '.') }}</span>
                            <span class="per-period">{{ $paket->periode }}</span>
                         </div>

                         @if($paket->highlight_text)
                             <p class="mt-2 text-primary" style="font-weight: 700; font-size: 15px; margin-bottom: 2px; text-align: left;">{{ $paket->highlight_text }}</p>
                         @endif
                         @if($paket->sub_highlight)
                             <p style="color: #64748b; font-size: 13px; font-weight: 500; margin-bottom: 20px; text-align: left;">{{ $paket->sub_highlight }}</p>
                         @endif

                         @if($paket->fitur)
                             <ul class="feature-list-clean">
                                @foreach($paket->fitur as $fitur)
                                    <li><i class="fa-solid fa-circle-check text-primary"></i> {{ $fitur }}</li>
                                @endforeach
                             </ul>
                         @endif

                         @if($paket->keuntungan_tambahan)
                             <div class="divider-line"></div>
                             <p style="font-weight: 700; color: #0f172a; font-size: 14px; margin-bottom: 10px; text-align: left;">Keuntungan Tambahan:</p>
                             <ul class="feature-list-clean" style="margin-top: 0 !important;">
                                @foreach($paket->keuntungan_tambahan as $keuntungan)
                                    <li><i class="fa-solid fa-circle-check text-success"></i> {{ $keuntungan }}</li>
                                @endforeach
                             </ul>
                         @endif
                      </div>
                      <div class="btn-holder-card">
                         @php
                             $waNum = $paket->wa_number ?? '6285700180302';
                             $waMsg = $paket->wa_message ?? 'Halo PT CIO NETWORK NUSANTARA, saya tertarik dengan paket ini.';
                         @endphp
                         <a href="https://wa.me/{{ $waNum }}?text={{ urlencode($waMsg) }}" target="_blank"
                            class="{{ $paket->is_rekomendasi ? 'btn btn-gradient-glow w-100 py-3' : 'btn btn-outline-indigo w-100 py-3' }}"
                            style="{{ !$paket->is_rekomendasi ? 'border: 2px solid var(--accent-blue); color: var(--accent-blue); font-weight: 700; background: transparent; border-radius: 10px;' : '' }}">
                            HUBUNGI SEKARANG
                         </a>
                      </div>
                   </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">
                    <p>Belum ada paket tersedia.</p>
                </div>
            @endforelse
         </div>
      </div>
   </section>

   <section class="paket-page-section-alt">
      <div class="container">
         <div class="text-center mb-5">
            <span class="badge badge-indigo mb-2">Panduan Perbandingan</span>
            <h2 style="font-weight: 800; color: #0f172a; font-size: 32px; margin-top: 5px;">Kelebihan & Kekurangan<br>Wifi Voucher vs Bulanan</h2>
            <p style="color: #64748b; max-width: 600px; margin: 8px auto 0 auto;">Pelajari karakteristik detail masing-masing sistem layanan agar sesuai dengan kriteria pemakaian Anda.</p>
         </div>

         <div class="row align-items-stretch">
            <div class="col-md-6 mb-4 d-flex">
               <div class="comparison-clean-card">
                  <h3 class="indicator-title pos"><i class="fa-solid fa-circle-plus text-success mr-2"></i> Kelebihan Wifi Voucher (Perangkat)</h3>
                  <div class="box-info-wrapper"><span style="font-weight: 700; color: #0f172a; font-size: 14px; display: block; margin-bottom: 4px;">Sangat Fleksibel & Hemat</span><p style="color: #64748b; font-size: 13.5px; margin: 0;">Cocok untuk pemakai tunggal yang jarang di rumah, cukup beli saat butuh koneksi internet tanpa tagihan bulanan mengikat.</p></div>
                  <div class="box-info-wrapper"><span style="font-weight: 700; color: #0f172a; font-size: 14px; display: block; margin-bottom: 4px;">Instalasi Instan Tanpa Alat Tambahan</span><p style="color: #64748b; font-size: 13.5px; margin: 0;">Tidak perlu sewa/beli router modem rumahan. Cukup tangkap sinyal access point Cio terdekat dan login lewat browser.</p></div>
               </div>
            </div>
            <div class="col-md-6 mb-4 d-flex">
               <div class="comparison-clean-card">
                  <h3 class="indicator-title neg"><i class="fa-solid fa-circle-minus text-danger mr-2"></i> Kekurangan Wifi Voucher (Perangkat)</h3>
                  <div class="box-info-wrapper"><span style="font-weight: 700; color: #0f172a; font-size: 14px; display: block; margin-bottom: 4px;">Terikat Jangkauan Sinyal & Kuota Device</span><p style="color: #64748b; font-size: 13.5px; margin: 0;">Sinyal bergantung pada jarak ke tiang access point. Satu kode voucher juga hanya bisa digunakan untuk 1 gadget aktif saja.</p></div>
                  <div class="box-info-wrapper"><span style="font-weight: 700; color: #0f172a; font-size: 14px; display: block; margin-bottom: 4px;">Kecepatan Terbagi Saat Trafik Hotspot Padat</span><p style="color: #64748b; font-size: 13.5px; margin: 0;">Karena bersifat jaringan publik bersama, kecepatan bisa terpengaruh apabila terlalu banyak perangkat login di pemancar yang sama.</p></div>
               </div>
            </div>
            <div class="col-md-6 mb-4 d-flex">
               <div class="comparison-clean-card">
                  <h3 class="indicator-title pos"><i class="fa-solid fa-circle-plus text-success mr-2"></i> Kelebihan Wifi Bulanan (Rumah)</h3>
                  <div class="box-info-wrapper"><span style="font-weight: 700; color: #0f172a; font-size: 14px; display: block; margin-bottom: 4px;">Koneksi Stabil Khusus Satu Rumah</span><p style="color: #64748b; font-size: 13.5px; margin: 0;">Menggunakan kabel fiber murni langsung ke dalam rumah Anda. Bandwidth khusus tanpa tercampur jaringan publik.</p></div>
                  <div class="box-info-wrapper"><span style="font-weight: 700; color: #0f172a; font-size: 14px; display: block; margin-bottom: 4px;">Bebas Sharing Sepuasnya ke Banyak Device</span><p style="color: #64748b; font-size: 13.5px; margin: 0;">Bisa dihubungkan ke Smart TV, HP, Laptop, dan CCTV secara bersamaan tanpa perlu membeli voucher berkali-kali.</p></div>
               </div>
            </div>
            <div class="col-md-6 mb-4 d-flex">
               <div class="comparison-clean-card">
                  <h3 class="indicator-title neg"><i class="fa-solid fa-circle-minus text-danger mr-2"></i> Kekurangan Wifi Bulanan (Rumah)</h3>
                  <div class="box-info-wrapper"><span style="font-weight: 700; color: #0f172a; font-size: 14px; display: block; margin-bottom: 4px;">Ada Tagihan Rutin yang Mengikat</span><p style="color: #64748b; font-size: 13.5px; margin: 0;">Wajib membayar tarif berlangganan bulanan secara berkala (flat) terlepas dari jaringan tersebut sedang digunakan atau tidak.</p></div>
                  <div class="box-info-wrapper"><span style="font-weight: 700; color: #0f172a; font-size: 14px; display: block; margin-bottom: 4px;">Harus Berada di Jangkauan Kabel Fisik</span><p style="color: #64748b; font-size: 13.5px; margin: 0;">Pemasangan memerlukan penarikan kabel dari tiang distribusi terdekat (ODP) ke modem di lokasi rumah Anda.</p></div>
               </div>
            </div>
         </div>
      </div>
   </section>
@endsection
