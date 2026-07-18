@extends('layouts.app')

@section('title', $seo->meta_title ?? 'Kontak Kami - Cio Network Solution')
@section('meta_keywords', $seo->meta_keywords ?? '')
@section('meta_description', $seo->meta_description ?? '')

@section('content')
      @php
          $waSales = \App\Models\SiteSetting::getValue('wa_sales', '6285324780031');
          $email = \App\Models\SiteSetting::getValue('email_support', 'cs@cionetwork.id');
          $alamat = \App\Models\SiteSetting::getValue('alamat', 'Jl. Bojong Jl. Toha Ramdan, Ciparay, Kec. Ciparay, Kabupaten Bandung, Jawa Barat 40381');
          $mapsUrl = \App\Models\SiteSetting::getValue('maps_embed_url', 'https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3959.803055656377!2d107.719415!3d-7.03242!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zN8KwMDEnNTYuNyJTIDEwN8KwNDMnMDkuOSJF!5e0!3m2!1sid!2sid!4v1781016669328!5m2!1sid!2sid');
      @endphp

      <section class="hero-section" style="min-height: auto; padding: 140px 0 60px 0;">
         <div class="hero-shapes">
            <div class="shape-glow glow-2" style="width: 250px; height: 250px;"></div>
         </div>
         <div class="container">
            <div class="row">
               <div class="col-lg-8 hero-content text-left">
                  <span class="badge badge-indigo mb-3">Customer Support</span>
                  <h1 class="hero-title" style="font-size: 44px; margin-bottom: 15px;">Hubungi <span>Tim Kami</span></h1>
                  <p class="hero-desc">Ada pertanyaan seputar jangkauan wilayah, penawaran harga, atau butuh bantuan teknis? Hubungi kami langsung atau isi formulir di bawah.</p>
               </div>
            </div>
         </div>
      </section>

      <section class="about-section layout_padding py-5">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-lg-5 mb-5 mb-lg-0">
                  <div class="contact-info-wrapper">
                     <div class="info-box glass-card mb-4">
                        <div class="info-icon bg-gradient-blue"><i class="fa-solid fa-phone"></i></div>
                        <div class="info-text">
                           <h4>Telepon & WhatsApp Sales</h4>
                           <p><a href="https://wa.me/{{ $waSales }}" target="_blank">{{ $waSales }}</a></p>
                        </div>
                     </div>
                     <div class="info-box glass-card mb-4">
                        <div class="info-icon bg-gradient-purple"><i class="fa-solid fa-envelope"></i></div>
                        <div class="info-text">
                           <h4>Email Support</h4>
                           <p><a href="mailto:{{ $email }}">{{ $email }}</a></p>
                        </div>
                     </div>
                     <div class="info-box glass-card">
                        <div class="info-icon bg-gradient-pink"><i class="fa-solid fa-location-dot"></i></div>
                        <div class="info-text">
                           <h4>Alamat Kantor Pusat</h4>
                           <p>{{ $alamat }}</p>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-lg-7">
                  <div class="contact-form-wrapper glass-card">
                     <form id="contact-form" action="#" method="post">
                        <div class="row">
                           <div class="col-md-6 form-group">
                              <label for="firstname">Nama Depan</label>
                              <input type="text" id="firstname" name="firstname" class="form-control-custom" placeholder="Nama Anda" required>
                           </div>
                           <div class="col-md-6 form-group">
                              <label for="lastname">Nama Belakang</label>
                              <input type="text" id="lastname" name="lastname" class="form-control-custom" placeholder="Nama Belakang" required>
                           </div>
                        </div>
                        <div class="form-group mt-3">
                           <label for="email">Alamat Email</label>
                           <input type="email" id="email" name="email" class="form-control-custom" placeholder="nama@email.com" required>
                        </div>
                        <div class="form-group mt-3">
                           <label for="message">Pesan / Alamat Pemasangan</label>
                           <textarea id="message" name="message" class="form-control-custom text-area-custom" placeholder="Tuliskan pertanyaan Anda secara detail atau sertakan alamat lengkap rencana pemasangan Wi-Fi..." required></textarea>
                        </div>
                        <div class="form-group checkbox-custom mt-3">
                           <label class="checkbox-container">
                              Saya menyetujui syarat & ketentuan serta bersedia dihubungi oleh sales.
                              <input type="checkbox" id="agree" name="agree" required>
                              <span class="checkmark"></span>
                           </label>
                        </div>
                        <div class="mt-4">
                           <button type="submit" class="btn btn-gradient-glow w-100 py-3">Kirim Pesan Sekarang</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </section>

      <section class="pricing-section layout_padding py-5">
         <div class="container">
            <div class="section-header text-center mb-5">
               <span class="badge badge-indigo mb-2">Lokasi Kami</span>
               <h2 class="section-title">Google Maps Kantor Kami</h2>
            </div>
            <div class="row justify-content-center">
               <div class="col-12">
                  <div class="glass-card overflow-hidden" style="border-radius: 16px; height: 350px;">
                     <iframe src="{{ $mapsUrl }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                  </div>
               </div>
            </div>
         </div>
      </section>
@endsection

@section('additional_js')
   <script>
      $(document).ready(function () {
         $("#contact-form").validate({
            submitHandler: function(form) {
               alert("Pesan Anda telah berhasil terkirim ke tim Cio Network Solution!");
               form.reset();
            }
         });
      });
   </script>
@endsection
