<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::firstOrCreate(
            ['email' => 'admin@cionetwork.id'],
            [
                'name' => 'Admin CIO',
                'username' => 'admin',
                'password' => Hash::make('admin123'),
            ]
        );

        // Site Settings
        $settings = [
            ['key' => 'company_name', 'value' => 'PT CIO NETWORK NUSANTARA', 'group' => 'navbar', 'label' => 'Nama Perusahaan'],
            ['key' => 'wa_cta', 'value' => '6285324780031', 'group' => 'navbar', 'label' => 'Nomor WA Navbar'],
            ['key' => 'footer_desc', 'value' => 'Penyedia layanan internet berbasis serat optik generasi terbaru yang menghadirkan kecepatan tinggi, stabil, tanpa batas FUP, dan terjangkau.', 'group' => 'footer', 'label' => 'Deskripsi Footer'],
            ['key' => 'copyright_text', 'value' => '&copy; 2026 PT CIO NETWORK NUSANTARA. Semua Hak Dilindungi Undang-Undang.', 'group' => 'footer', 'label' => 'Teks Copyright'],
            ['key' => 'fb_url', 'value' => '#', 'group' => 'social_media', 'label' => 'URL Facebook'],
            ['key' => 'ig_url', 'value' => '#', 'group' => 'social_media', 'label' => 'URL Instagram'],
            ['key' => 'tw_url', 'value' => '#', 'group' => 'social_media', 'label' => 'URL Twitter'],
            ['key' => 'linkedin_url', 'value' => '#', 'group' => 'social_media', 'label' => 'URL LinkedIn'],
            ['key' => 'jam_cs', 'value' => '24 Jam Nonstop', 'group' => 'jam_layanan', 'label' => 'Customer Service'],
            ['key' => 'jam_technical', 'value' => '24 Jam Nonstop', 'group' => 'jam_layanan', 'label' => 'Technical Support'],
            ['key' => 'jam_kantor', 'value' => 'Senin - Sabtu (08.00 - 17.00 WIB)', 'group' => 'jam_layanan', 'label' => 'Kantor Operasional'],
            ['key' => 'wa_sales', 'value' => '6285324780031', 'group' => 'contact_info', 'label' => 'Nomor WA Sales'],
            ['key' => 'email_support', 'value' => 'cs@cionetwork.id', 'group' => 'contact_info', 'label' => 'Email Support'],
            ['key' => 'alamat', 'value' => 'Jl. Bojong Jl. Toha Ramdan, Ciparay, Kec. Ciparay, Kabupaten Bandung, Jawa Barat 40381', 'group' => 'contact_info', 'label' => 'Alamat Kantor'],
            ['key' => 'maps_embed_url', 'value' => 'https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3959.803055656377!2d107.719415!3d-7.03242!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zN8KwMDEnNTYuNyJTIDEwN8KwNDMnMDkuOSJF!5e0!3m2!1sid!2sid!4v1781016669328!5m2!1sid!2sid', 'group' => 'contact_info', 'label' => 'Google Maps Embed URL'],
            ['key' => 'owner_name', 'value' => 'Yoga Ogawa Rhobiyana', 'group' => 'footer', 'label' => 'Nama Owner'],
        ];
        DB::table('site_settings')->insert($settings);

        // Hero Section
        DB::table('hero_sections')->insert([
            'badge_text' => 'Internet Fiber Optic Tercepat',
            'title' => 'Koneksi Ultra Cepat <br>Tanpa Batas <span>Untuk Anda</span>',
            'description' => 'Rasakan kestabilan internet 24/7 tanpa FUP (Fair Usage Policy) dari PT CIO NETWORK NUSANTARA. Hadir dengan infrastruktur 100% serat optik untuk mendukung WFH, belajar online, streaming HD, hingga kebutuhan bisnis Anda.',
            'btn_primary_text' => 'Pilih Paket Internet',
            'btn_primary_url' => '/paket-internet',
            'btn_secondary_text' => 'Tentang Kami',
            'btn_secondary_url' => '/tentang-kami',
            'hero_image' => null,
            'is_active' => true,
        ]);

        // Paket Internet
        $pakets = [
            [
                'created_at' => now(),
                'updated_at' => now(),
                'tipe' => 'home',
                'nama' => 'PAKET HOME',
                'sub_judul' => 'Solusi internet rumah andalan keluarga.',
                'harga' => 100000,
                'periode' => '/bulan',
                'highlight_text' => 'Up To 15Mbps Hanya 100.000',
                'sub_highlight' => 'Kecepatan Streaming Hingga 15Mb/detik',
                'fitur' => json_encode([
                    'Rekomendasi Kualitas Streaming di 720 HD Hingga max 1080 Full HD',
                    '(Youtube, Tiktok, Instagram, Facebook, Netflix, Live streaming) Minim Loading/Minim Lag/Minim Buffering',
                    'Kecepatan Unduh/Unggah Hingga 1.87 Mb/detik',
                    'Ideal pemakaian 1 - 3 Perangkat',
                ]),
                'keuntungan_tambahan' => json_encode([
                    'Alat dipinjamkan selama berlangganan',
                    'Pakai dulu, baru bayar bulan depan',
                    'Gratis Biaya Pemasangan',
                ]),
                'wa_number' => '6285700180302',
                'wa_message' => 'Halo Cio Network Solution, saya tertarik dengan Paket Home Up To 15Mbps Hanya 100.000.',
                'is_featured' => true,
                'is_rekomendasi' => true,
                'urutan' => 1,
                'is_active' => true,
            ],
            [
                'created_at' => now(),
                'updated_at' => now(),
                'tipe' => 'home',
                'nama' => 'PAKET HOME',
                'sub_judul' => 'Solusi internet rumah andalan keluarga.',
                'harga' => 150000,
                'periode' => '/bulan',
                'highlight_text' => 'Up To 30Mbps Hanya 150.000',
                'sub_highlight' => 'Kecepatan Streaming Hingga 30Mb/detik',
                'fitur' => json_encode([
                    'Rekomendasi Kualitas Streaming di 720 HD Hingga max 1080 Full HD',
                    '(Youtube, Tiktok, Instagram, Facebook, Netflix, Live streaming) Minim Loading/Minim Lag/Minim Buffering',
                    'Kecepatan Unduh/Unggah Hingga 3.75 Mb/detik',
                    'Ideal pemakaian 1 - 6 Perangkat',
                ]),
                'keuntungan_tambahan' => json_encode([
                    'Alat dipinjamkan selama berlangganan',
                    'Pakai dulu, baru bayar bulan depan',
                    'Gratis Biaya Pemasangan',
                ]),
                'wa_number' => '6285700180302',
                'wa_message' => 'Halo Cio Network Solution, saya tertarik dengan Paket Home Up To 30Mbps Hanya 150.000.',
                'is_featured' => true,
                'is_rekomendasi' => false,
                'urutan' => 2,
                'is_active' => true,
            ],
            [
                'created_at' => now(),
                'updated_at' => now(),
                'tipe' => 'voucher',
                'nama' => 'PAKET VOUCHER',
                'sub_judul' => 'Sistem voucher fleksibel, hemat & praktis.',
                'harga' => 4000,
                'periode' => '/24 jam',
                'highlight_text' => '1 Voucher 1 Perangkat Up to 20 Mbps',
                'sub_highlight' => 'Kecepatan Streaming Hingga 20 Mb/detik',
                'fitur' => json_encode([
                    'Harga terjangkau, untuk pilihan masa aktif berkala silakan buka menu lengkap Paket Internet',
                    'Tanpa biaya instalasi pemasangan, tinggal beli voucher fisik/online ke agen terdekat',
                    'Rekomendasi Kualitas Streaming di 720 HD Hingga max 1080 Full HD',
                    '(Youtube, Tiktok, Instagram, Facebook, Netflix, Live streaming) Akses Lancar & Bebas Hambatan',
                ]),
                'keuntungan_tambahan' => json_encode([
                    'Jaringan stabil berbasis serat optik murni',
                    'Sistem beli mandiri tanpa ikatan kontrak',
                    'Bebas batas pemakaian wajar (True Unlimited)',
                ]),
                'wa_number' => '6285700180302',
                'wa_message' => 'Halo Cio Network Solution, saya tertarik dengan Paket Voucher Up to 20 Mbps.',
                'is_featured' => true,
                'is_rekomendasi' => false,
                'urutan' => 3,
                'is_active' => true,
            ],
        ];
        DB::table('paket_internets')->insert($pakets);

        // Tags
        $tagNames = ['Jaringan', 'WiFi', 'Tips & Trik', 'Pembayaran', 'Voucher', 'Pengenalan'];
        $tagIds = [];
        foreach ($tagNames as $name) {
            $tagIds[$name] = DB::table('tags')->insertGetId([
                'name' => $name,
                'slug' => \Illuminate\Support\Str::slug($name),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Tutorials
        $tutorials = [
            [
                'kategori' => 'Pengenalan',
                'icon_class' => 'fa-play',
                'gradient_class' => 'bg-gradient-pink-orange',
                'judul' => 'Cara Cek Kecepatan Internet',
                'slug' => 'cara-cek-kecepatan-internet',
                'deskripsi' => 'Panduan lengkap cara mengecek kecepatan internet Cio Network Solution menggunakan berbagai platform pengukuran.',
                'konten' => '<h2>Mengapa Perlu Cek Kecepatan Internet?</h2><p>Mengetahui kecepatan internet Anda secara berkala sangat penting untuk memastikan Anda mendapatkan layanan sesuai dengan paket yang Anda bayar. Dengan melakukan pengecekan rutin, Anda dapat memantau kualitas koneksi, mendeteksi potensi masalah sejak dini, dan mengoptimalkan pengalaman browsing, streaming, gaming, serta video call Anda.</p><p>Panduan ini akan membahas <strong>4 metode mudah</strong> untuk mengecek kecepatan internet Cio Network Solution beserta cara membaca hasilnya.</p><hr><h2>Apa Saja yang Diukur dalam Speed Test?</h2><p>Sebelum memulai, pahami dulu empat metrik utama yang biasanya muncul dalam hasil speed test:</p><table><thead><tr><th>Metrik</th><th>Penjelasan</th><th>Satuan</th></tr></thead><tbody><tr><td><strong>Download Speed</strong></td><td>Kecepatan menerima data dari internet ke perangkat Anda. Mempengaruhi streaming, browsing, dan download file.</td><td>Mbps (Megabit per detik)</td></tr><tr><td><strong>Upload Speed</strong></td><td>Kecepatan mengirim data dari perangkat Anda ke internet. Mempengaruhi video call, upload foto/video, dan gaming.</td><td>Mbps (Megabit per detik)</td></tr><tr><td><strong>Ping (Latency)</strong></td><td>Waktu respons koneksi dalam milidetik. Semakin rendah, semakin responsif koneksi Anda.</td><td>ms (milidetik)</td></tr><tr><td><strong>Jitter</strong></td><td>Variasi latency dari waktu ke waktu. Semakin stabil (rendah), semakin baik untuk gaming dan video call.</td><td>ms (milidetik)</td></tr></tbody></table><blockquote><p>Catatan: Cio Network Solution menyediakan kecepatan <strong>simetris (1:1)</strong> untuk paket Home, artinya kecepatan upload sama dengan download. Pastikan hasil speed test Anda mendekati angka paket yang Anda gunakan.</p></blockquote><hr><h2>Metode 1: Speedtest by Ookla (Paling Akurat)</h2><p>Speedtest by Ookla adalah platform pengukuran kecepatan internet yang paling banyak digunakan dan diakui secara global. Berikut langkah-langkahnya:</p><h3>Melalui Website (PC/Laptop)</h3><ol><li>Buka browser (Chrome, Firefox, Edge, atau lainnya)</li><li>Kunjungi <strong>speedtest.net</strong></li><li>Klik tombol <strong>"Go"</strong> (berwarna putih di tengah layar)</li><li>Tunggu proses pengukuran selesai (biasanya 30-60 detik)</li><li>Lihat hasil: Ping, Download Speed, dan Upload Speed</li></ol><h3>Melalui Aplikasi Smartphone (Android/iOS)</h3><ol><li>Buka Google Play Store (Android) atau App Store (iOS)</li><li>Cari aplikasi <strong>"Speedtest by Ookla"</strong></li><li>Download dan instal aplikasi tersebut</li><li>Buka aplikasi dan ketuk tombol <strong>"Go"</strong></li><li>Hasil akan muncul setelah pengukuran selesai</li></ol><hr><h2>Metode 2: Fast.com oleh Netflix (Paling Sederhana)</h2><p>Fast.com adalah tool pengukuran kecepatan dari Netflix yang sangat mudah digunakan. Keunggulannya adalah pengukuran langsung dimulai tanpa perlu menekan tombol apa pun.</p><ol><li>Buka browser di perangkat Anda</li><li>Kunjungi <strong>fast.com</strong></li><li>Kecepatan unduh akan langsung terukur secara otomatis dalam hitungan detik</li><li>Klik tombol <strong>"Show more info"</strong> untuk melihat kecepatan upload dan latency</li></ol><p>Fast.com sangat cocok untuk pengecekan cepat ketika Anda ingin memastikan kecepatan streaming video berjalan lancar.</p><hr><h2>Metode 3: Google Speed Test (Tanpa Buka Situs Lain)</h2><p>Google menyediakan fitur speed test langsung di halaman pencarian. Metode ini sangat praktis karena tidak perlu membuka situs terpisah.</p><ol><li>Buka Google Search di browser Anda</li><li>Ketik <strong>"speed test"</strong> atau <strong>"internet speed test"</strong></li><li>Google akan menampilkan widget speed test di bagian atas hasil pencarian</li><li>Klik tombol <strong>"Run Speed Test"</strong></li><li>Tunggu proses selesai dan lihat hasilnya</li></ol><hr><h2>Metode 4: nPerf (Pengukuran Lengkap)</h2><p>nPerf adalah alternatif speed test yang juga mengukur kualitas koneksi untuk browsing, streaming video, dan koneksi VoIP.</p><ol><li>Kunjungi <strong>nperf.com/id</strong></li><li>Klik tombol <strong>"Mulai tes"</strong> (Start test)</li><li>Tes akan mengukur download, upload, latency, browsing quality, streaming quality, dan VoIP quality</li><li>Hasil ditampilkan dalam bentuk grafik dan skor</li></ol><hr><h2>Tips Mendapatkan Hasil yang Akurat</h2><p>Agar hasil speed test benar-benar mencerminkan kualitas koneksi internet Anda, ikuti tips berikut:</p><ul><li><strong>Gunakan kabel LAN</strong> jika memungkinkan. Koneksi WiFi bisa terpengaruh oleh jarak dan hambatan fisik. Untuk hasil paling akurat, colokkan kabel LAN langsung ke laptop/PC.</li><li><strong>Tutup aplikasi berat</strong> yang menggunakan internet seperti streaming video (YouTube, Netflix), download file, game online, atau video call sebelum melakukan tes.</li><li><strong>Hentikan update background</strong> seperti Windows Update, antivirus update, atau backup cloud.</li><li><strong>Lakukan beberapa kali pengujian</strong> di waktu yang berbeda (pagi, siang, malam) untuk mendapatkan gambaran rata-rata kecepatan internet Anda.</li><li><strong>Gunakan server lokal</strong> — sebagian besar speed test otomatis memilih server terdekat. Pastikan server yang dipilih berada di Indonesia untuk hasil yang relevan.</li><li><strong>Restart router</strong> sebelum tes jika koneksi terasa lambat, untuk menyegarkan koneksi.</li></ul><blockquote><p><strong>Tips Penting:</strong> Jika hasil speed test menunjukkan angka yang jauh di bawah paket Anda secara konsisten (misal: paket 15 Mbps tetapi hasil tes hanya 3-5 Mbps), coba hubungi customer service Cio Network Solution untuk mendapatkan bantuan teknis lebih lanjut.</p></blockquote><hr><h2>Cara Membaca Hasil Speed Test</h2><p>Berikut panduan sederhana untuk menilai hasil speed test Anda:</p><table><thead><tr><th>Kegiatan</th><th>Minimal Kecepatan yang Dibutuhkan</th></tr></thead><tbody><tr><td>Browsing & Email</td><td>1-5 Mbps</td></tr><tr><td>Streaming Musik (Spotify, Apple Music)</td><td>2-5 Mbps</td></tr><tr><td>Streaming Video HD (720p)</td><td>5-10 Mbps</td></tr><tr><td>Streaming Video Full HD (1080p)</td><td>10-15 Mbps</td></tr><tr><td>Streaming Video 4K</td><td>25+ Mbps</td></tr><tr><td>Video Call (Zoom, Meet, Teams)</td><td>3-8 Mbps</td></tr><tr><td>Gaming Online</td><td>10-20 Mbps (ping rendah lebih penting)</td></tr><tr><td>Streaming + Gaming + Browsing (Bersamaan)</td><td>30+ Mbps</td></tr></tbody></table><p>Dengan paket Cio Network Solution, Anda bisa melakukan semua aktivitas di atas secara bersamaan dalam satu rumah tanpa lag atau buffering.</p>',
                'penulis' => 'Tim Cio Network',
                'thumbnail' => null,
                'video_path' => null,
                'video_url' => null,
                'dilihat' => 245,
                'is_featured' => true,
                'urutan' => 1,
                'is_active' => true,
            ],
            [
                'kategori' => 'Pengenalan',
                'icon_class' => 'fa-building',
                'gradient_class' => 'bg-gradient-blue',
                'judul' => 'Mengenal Jaringan Fiber Optic',
                'slug' => 'mengenal-jaringan-fiber-optic',
                'deskripsi' => 'Apa itu fiber optic? Bagaimana cara kerjanya? Simak penjelasan lengkap tentang teknologi internet serat optik.',
                'konten' => '<h2>Apa Itu Fiber Optic?</h2><p>Fiber optik (serat optik) adalah teknologi transmisi data yang menggunakan kabel serat kaca atau plastik ultra-tipis untuk mentransmisikan data dalam bentuk pulsa cahaya. Berbeda dengan kabel tembaga tradisional yang menggunakan sinyal listrik, fiber optik menawarkan kecepatan jauh lebih tinggi, latensi lebih rendah, dan kestabilan yang tidak terpengaruh oleh interferensi elektromagnetik.</p><p>Cio Network Solution dengan bangga menggunakan <strong>100% infrastruktur fiber optik</strong> untuk memastikan setiap pelanggan mendapatkan pengalaman internet terbaik. Artikel ini akan membahas secara mendalam tentang teknologi fiber optik dan mengapa teknologi ini menjadi standar masa depan.</p><hr><h2>Bagaimana Cara Kerja Fiber Optic?</h2><p>Prinsip kerja fiber optik cukup menarik. Data dikirim dalam bentuk sinar cahaya yang merambat melalui inti serat kaca. Cahaya ini dipantulkan terus-menerus di dinding serat melalui proses yang disebut <strong>pemantulan internal total (total internal reflection)</strong>, sehingga cahaya dapat merambat sangat jauh tanpa kehilangan kekuatan sinyal.</p><h3>Komponen Utama Kabel Fiber Optik</h3><ol><li><strong>Core (Inti)</strong> — Bagian tengah kabel tempat cahaya merambat. Terbuat dari kaca silika murni dengan diameter sangat kecil (8-62.5 mikron).</li><li><strong>Cladding (Selubung)</strong> — Lapisan yang membungkus core, berfungsi memantulkan cahaya kembali ke inti agar tetap merambat lurus.</li><li><strong>Buffer Coating</strong> — Lapisan pelindung yang menjaga core dan cladding dari kerusakan fisik dan kelembaban.</li><li><strong>Strength Members</strong> — Serat penguat (biasanya Kevlar atau aramid) yang memberikan kekuatan tarik pada kabel.</li><li><strong>Outer Jacket</strong> — Lapisan terluar yang melindungi seluruh komponen dari kondisi lingkungan.</li></ol><hr><h2>Jenis-Jenis Fiber Optic</h2><table><thead><tr><th>Jenis</th><th>Karakteristik</th><th>Jarak Tempuh</th><th>Penggunaan</th></tr></thead><tbody><tr><td><strong>Single-mode (SMF)</strong></td><td>Core sangat kecil (~8-10 mikron), satu jalur cahaya, laser inframerah</td><td>Hingga 100+ km</td><td>Jaringan backbone, ISP, koneksi jarak jauh</td></tr><tr><td><strong>Multi-mode (MMF)</strong></td><td>Core lebih besar (~50-62.5 mikron), banyak jalur cahaya, LED biasa</td><td>Hingga 2 km</td><td>Jaringan lokal, kampus, gedung perkantoran</td></tr></tbody></table><p>Cio Network Solution menggunakan <strong>kabel single-mode fiber optik</strong> untuk infrastruktur utama dan distribusi ke pelanggan, memastikan kualitas sinyal terbaik hingga ke rumah Anda.</p><hr><h2>Fiber Optic vs Kabel Tembaga (Coaxial)</h2><p>Berikut perbandingan lengkap antara fiber optik dan kabel tembaga tradisional:</p><table><thead><tr><th>Aspek</th><th>Fiber Optic</th><th>Kabel Tembaga</th></tr></thead><tbody><tr><td>Media Transmisi</td><td>Cahaya (foton)</td><td>Sinyal listrik (elektron)</td></tr><tr><td>Kecepatan Maksimal</td><td>Hingga 100+ Gbps</td><td>Maksimal ~1 Gbps</td></tr><tr><td>Jarak Tanpa Booster</td><td>40-100+ km</td><td>~100 meter</td></tr><tr><td>Interferensi Elektromagnetik</td><td>Tidak terpengaruh</td><td>Sangat terpengaruh</td></tr><tr><td>Ketahanan Terhadap Cuaca</td><td>Sangat baik</td><td>Rentan korosi dan petir</td></tr><tr><td>Bandwidth</td><td>Sangat lebar (hingga TBps di masa depan)</td><td>Terbatas</td></tr><tr><td>Keamanan Data</td><td>Sulit disadap (tidak memancarkan sinyal elektromagnetik)</td><td>Mudah disadap</td></tr><tr><td>Biaya Infrastruktur</td><td>Lebih mahal di awal</td><td>Lebih murah</td></tr></tbody></table><blockquote><p><strong>Kesimpulan:</strong> Fiber optik unggul di hampir semua aspek kecuali biaya infrastruktur awal. Namun untuk jangka panjang, fiber optik jauh lebih ekonomis karena perawatan minimal, umur pakai panjang (25+ tahun), dan kapasitas yang bisa diupgrade tanpa mengganti kabel.</p></blockquote><hr><h2>Mengapa Cio Network Solution Menggunakan 100% Fiber Optic?</h2><p>Ada beberapa alasan kuat mengapa Cio Network Solution berinvestasi penuh pada infrastruktur fiber optik:</p><ul><li><strong>Kecepatan Simetris (1:1)</strong> — Kecepatan upload sama dengan download, berbeda dengan ISP lain yang membatasi upload. Ini penting untuk video call, upload konten, streaming, dan backup cloud.</li><li><strong>Tanpa FUP (Fair Usage Policy)</strong> — Infrastruktur fiber optik Cio memungkinkan kami memberikan layanan true unlimited tanpa pemotongan kecepatan, karena kapasitas bandwidth yang sangat besar.</li><li><strong>Stabilitas 24/7</strong> — Fiber optik tidak terpengaruh cuaca buruk, petir, atau interferensi dari perangkat elektronik lain, sehingga koneksi tetap stabil kapan pun.</li><li><strong>Future-ready</strong> — Infrastruktur fiber optik yang sudah terpasang dapat dengan mudah diupgrade kecepatannya tanpa perlu mengganti kabel, cukup dengan mengganti perangkat di ujung jaringan.</li><li><strong>Jangkauan Luas</strong> — Fiber optik dapat menjangkau area yang jauh dari pusat kota dengan kualitas yang tetap terjaga.</li></ul><hr><h2>Proses Instalasi Fiber Optic di Rumah Anda</h2><p>Berikut tahapan yang akan dilakukan teknisi Cio Network Solution saat memasang internet fiber optik di rumah Anda:</p><ol><li><strong>Survei Lokasi</strong> — Teknisi akan datang ke lokasi untuk menilai titik terbaik pemasangan kabel fiber dari tiang distribusi ke rumah Anda.</li><li><strong>Penarikan Kabel</strong> — Kabel fiber optik ditarik dari jaringan distribusi utama ke rumah Anda. Tim kami akan memastikan pemasangan rapi dan aman, tidak mengganggu estetika rumah.</li><li><strong>Pemasangan ONT (Optical Network Terminal)</strong> — ONT adalah perangkat yang mengubah sinyal cahaya dari kabel fiber menjadi sinyal listrik yang bisa digunakan oleh router WiFi Anda. ONT dipasang di dinding dalam rumah.</li><li><strong>Pemasangan Router WiFi</strong> — Router akan dipasang dan dikonfigurasi untuk menyebarkan koneksi internet ke seluruh rumah Anda via WiFi dan kabel LAN.</li><li><strong>Pengujian Koneksi</strong> — Teknisi akan menguji kecepatan dan stabilitas koneksi di beberapa titik di rumah Anda untuk memastikan semuanya berfungsi optimal.</li><li><strong>Penjelasan Penggunaan</strong> — Teknisi akan menjelaskan cara penggunaan dasar, termasuk cara login voucher, cara cek kecepatan, dan cara menghubungi customer service jika ada masalah.</li></ol><blockquote><p><strong>Catatan:</strong> Biaya instalasi untuk paket Home Cio Network Solution adalah <strong>GRATIS</strong> untuk area yang sudah terjangkau jaringan fiber optik kami.</p></blockquote><hr><h2>Pertanyaan Umum Seputar Fiber Optic</h2><h3>Apakah kabel fiber optik mudah putus?</h3><p>Tidak. Kabel fiber optik modern dirancang dengan lapisan pelindung yang kuat, termasuk serat Kevlar dan jaket luar yang tahan terhadap tarikan dan tekanan ringan. Pemasangan yang benar oleh teknisi profesional memastikan kabel aman dari kerusakan.</p><h3>Apakah fiber optik berbahaya?</h3><p>Tidak. Sinar laser yang digunakan dalam fiber optik memiliki daya sangat rendah dan tidak berbahaya. Kabel fiber optik juga tidak menghantarkan listrik, sehingga aman dari risiko korsleting atau sengatan listrik.</p><h3>Apakah internet fiber optik lebih mahal?</h3><p>Untuk biaya berlangganan bulanan, fiber optik justru lebih terjangkau jika dibandingkan dengan kualitas dan kecepatan yang didapatkan. Cio Network Solution menawarkan paket Home mulai dari Rp100.000/bulan untuk kecepatan up to 15 Mbps.</p>',
                'penulis' => 'Tim Cio Network',
                'thumbnail' => null,
                'video_path' => null,
                'video_url' => null,
                'dilihat' => 189,
                'is_featured' => false,
                'urutan' => 2,
                'is_active' => true,
            ],
            [
                'kategori' => 'Tips',
                'icon_class' => 'fa-scale-balanced',
                'gradient_class' => 'bg-gradient-orange',
                'judul' => 'Perbedaan WiFi Voucher & Bulanan',
                'slug' => 'perbedaan-wifi-voucher-dan-bulanan',
                'deskripsi' => 'Penjelasan lengkap perbedaan sistem voucher dan bulanan agar Anda bisa memilih paket yang paling sesuai kebutuhan.',
                'konten' => '<h2>Dua Jenis Layanan, Satu Kualitas Fiber Optic</h2><p>Cio Network Solution menyediakan dua jenis layanan utama: <strong>Paket Home (Bulanan)</strong> dan <strong>Paket Voucher (Harian/Mingguan)</strong>. Masing-masing dirancang untuk kebutuhan yang berbeda, tetapi keduanya menggunakan infrastruktur fiber optik yang sama dengan kualitas terbaik. Artikel ini akan membantu Anda menentukan pilihan yang paling tepat.</p><hr><h2>Perbandingan Lengkap Paket Home vs Paket Voucher</h2><table><thead><tr><th>Aspek</th><th>Paket Home (Bulanan)</th><th>Paket Voucher</th></tr></thead><tbody><tr><td><strong>Sistem Pembayaran</strong></td><td>Bayar per bulan (tagihan rutin)</td><td>Beli voucher sesuai kebutuhan</td></tr><tr><td><strong>Komitmen</strong></td><td>Berlangganan terus menerus</td><td>Tanpa ikatan, beli saat perlu</td></tr><tr><td><strong>Biaya Awal</strong></td><td>Gratis instalasi + alat pinjaman</td><td>Tanpa instalasi, tanpa alat</td></tr><tr><td><strong>Perangkat</strong></td><td>ONT + Router WiFi dipinjamkan</td><td>Perangkat milik sendiri</td></tr><tr><td><strong>Jumlah Perangkat</strong></td><td>Tak terbatas (via router)</td><td>1 voucher = 1 perangkat</td></tr><tr><td><strong>Kecepatan</strong></td><td>Up to 15-30 Mbps (simetris)</td><td>Up to 20 Mbps</td></tr><tr><td><strong>FUP (Fair Usage Policy)</strong></td><td>Tanpa FUP — true unlimited</td><td>Sesuai masa aktif voucher</td></tr><tr><td><strong>Koneksi Prioritas</strong></td><td>Prioritas lebih tinggi</td><td>Standar</td></tr><tr><td><strong>Durasi</strong></td><td>Bulanan (berkelanjutan)</td><td>24 jam / mingguan / bulanan</td></tr><tr><td><strong>Biaya Bulanan</strong></td><td>Mulai Rp100.000</td><td>Mulai Rp4.000/24 jam</td></tr></tbody></table><hr><h2>Paket Home (Bulanan) — Solusi Internet Rumah Ideal</h2><p>Paket Home Cio Network Solution adalah pilihan terbaik jika Anda membutuhkan koneksi internet tetap yang stabil, cepat, dan tanpa batas untuk seluruh anggota keluarga.</p><h3>Keunggulan Paket Home</h3><ul><li><strong>Koneksi Stabil & Prioritas</strong> — Sebagai pelanggan bulanan, koneksi Anda mendapatkan prioritas lebih tinggi dalam jaringan Cio, memastikan stabilitas 24/7 tanpa fluktuasi berarti.</li><li><strong>Tanpa FUP (True Unlimited)</strong> — Tidak ada batas pemakaian wajar. Download sepuasnya, streaming 4K, main game online — semuanya tidak akan memperlambat koneksi Anda.</li><li><strong>Gratis Perangkat</strong> — ONT dan router WiFi dipinjamkan secara gratis selama Anda berlangganan. Tidak perlu beli perangkat mahal.</li><li><strong>Gratis Pemasangan</strong> — Teknisi kami akan datang ke rumah Anda dan memasang semuanya tanpa biaya tambahan untuk area yang sudah terjangkau.</li><li><strong>Pakai Dulu, Bayar Nanti</strong> — Nikmati layanan di bulan pertama, baru bayar di bulan kedua. Tidak perlu bayar di muka.</li><li><strong>Multi-Perangkat</strong> — Koneksi bisa digunakan di puluhan perangkat sekaligus (HP, laptop, TV, PS, kamera CCTV, dll) tanpa perlu login satu per satu.</li></ul><h3>Kekurangan Paket Home</h3><ul><li>Memerlukan komitmen berlangganan (tidak bisa berhenti kapan saja tanpa pemberitahuan)</li><li>Proses instalasi membutuhkan waktu 1-2 hari kerja setelah pendaftaran</li></ul><hr><h2>Paket Voucher — Fleksibel & Praktis</h2><p>Paket Voucher cocok bagi Anda yang membutuhkan internet secara fleksibel, sementara, atau untuk perangkat tertentu saja.</p><h3>Keunggulan Paket Voucher</h3><ul><li><strong>Fleksibel</strong> — Beli voucher saat Anda butuh, tanpa komitmen berlangganan. Cocok untuk penggunaan harian, mingguan, atau bulanan sesuai kebutuhan.</li><li><strong>Tanpa Biaya Awal</strong> — Tidak perlu instalasi, tidak perlu alat tambahan. Cukup pastikan perangkat Anda bisa menangkap sinyal WiFi Cio Network Solution.</li><li><strong>Beli di Mana Saja</strong> — Voucher fisik tersedia di agen dan counter terdekat. Voucher digital juga bisa dibeli secara online.</li><li><strong>Mudah Digunakan</strong> — Cukup masukkan kode voucher di halaman login, koneksi langsung aktif. Proses hanya memakan waktu 1-2 menit.</li><li><strong>Ideal untuk Tamu atau Kontrakan</strong> — Jika Anda memiliki tamu yang membutuhkan internet, atau tinggal di kos/kontrakan sementara, voucher adalah solusi yang paling hemat.</li></ul><h3>Kekurangan Paket Voucher</h3><ul><li>1 voucher hanya untuk 1 perangkat. Untuk menggunakan di banyak perangkat, Anda perlu membeli voucher terpisah.</li><li>Koneksi tidak mendapat prioritas seperti pelanggan bulanan.</li><li>Harus login ulang setiap kali masa voucher habis atau saat berganti perangkat.</li><li>Jika daya voucher habis di tengah malam, Anda harus membeli yang baru untuk melanjutkan koneksi.</li></ul><hr><h2>Analisis Biaya: Mana yang Lebih Hemat?</h2><p>Mari kita hitung perbandingan biaya untuk penggunaan 30 hari:</p><table><thead><tr><th>Skenario</th><th>Paket Home (Rp100.000/bln)</th><th>Voucher 24 Jam (Rp4.000 x 30)</th></tr></thead><tbody><tr><td>Biaya 30 Hari</td><td><strong>Rp100.000</strong></td><td><strong>Rp120.000</strong></td></tr><tr><td>Jumlah Perangkat</td><td>Tak terbatas</td><td>1 perangkat saja</td></tr><tr><td>Kecepatan</td><td>Up to 15 Mbps simetris</td><td>Up to 20 Mbps</td></tr><tr><td>Perangkat Tambahan</td><td>Gratis ONT + Router</td><td>Harus beli sendiri</td></tr><tr><td>Total Perkiraan</td><td><strong>Rp100.000</strong></td><td><strong>Rp120.000+</strong></td></tr></tbody></table><p>Untuk penggunaan 24 jam nonstop selama sebulan penuh, <strong>Paket Home jelas lebih hemat</strong> apalagi dengan tambahan perangkat gratis dan koneksi multi-perangkat.</p><p>Namun jika Anda hanya online 2-3 jam sehari, voucher mungkin lebih ekonomis. Misalnya jika Anda hanya butuh internet 2 jam sehari selama 30 hari, dengan asumsi 1 voucher 24 jam habis dalam 6 hari pemakaian ringan, Anda hanya perlu sekitar 5 voucher per bulan = Rp20.000.</p><blockquote><p><strong>Tips:</strong> Hitung dulu rata-rata pemakaian internet harian Anda. Jika lebih dari 4 jam sehari atau digunakan oleh lebih dari 2 perangkat, Paket Home adalah pilihan paling ekonomis.</p></blockquote><hr><h2>Rekomendasi Berdasarkan Kebutuhan</h2><h3>Pilih Paket Home (Bulanan) jika:</h3><ul><li>Anda membutuhkan internet untuk seluruh keluarga (3+ orang)</li><li>Ada banyak perangkat yang perlu terhubung (HP, laptop, TV, CCTV, dll)</li><li>Anda sering streaming, gaming, atau WFH (Work From Home)</li><li>Anda menginginkan koneksi paling stabil tanpa gangguan</li><li>Anda tinggal tetap di rumah/kontrakan jangka panjang</li></ul><h3>Pilih Paket Voucher jika:</h3><ul><li>Anda hanya butuh internet untuk 1 perangkat saja</li><li>Anda tinggal di kos/kontrakan sementara atau sering bepergian</li><li>Anda ingin fleksibilitas tanpa komitmen berlangganan</li><li>Anda hanya butuh internet untuk penggunaan ringan (browsing, chat, sosial media)</li><li>Anda ingin memberikan akses internet untuk tamu sementara</li></ul><hr><h2>Bisakah Menggabungkan Keduanya?</h2><p>Tentu! Banyak pelanggan Cio Network Solution yang menggunakan <strong>Paket Home untuk kebutuhan utama</strong> di rumah (keluarga menggunakan WiFi di HP dan laptop masing-masing) dan <strong>Voucher untuk kebutuhan tambahan</strong> seperti memberikan akses ke tamu atau perangkat terpisah di kamar kos.</p><p>Kombinasi ini memberikan fleksibilitas maksimal dengan biaya yang tetap efisien.</p>',
                'penulis' => 'Tim Cio Network',
                'thumbnail' => null,
                'video_path' => null,
                'video_url' => null,
                'dilihat' => 312,
                'is_featured' => true,
                'urutan' => 3,
                'is_active' => true,
            ],
            [
                'kategori' => 'Voucher & Akun',
                'icon_class' => 'fa-ticket',
                'gradient_class' => 'bg-gradient-blue-purple',
                'judul' => 'Cara Memasukkan Kode Voucher',
                'slug' => 'cara-memasukkan-kode-voucher',
                'deskripsi' => 'Panduan langkah demi langkah cara memasukkan kode voucher internet Cio Network Solution agar koneksi Anda langsung aktif.',
                'konten' => '<h2>Panduan Lengkap Aktivasi Voucher Cio Network Solution</h2><p>Voucher internet Cio Network Solution adalah cara termudah dan tercepat untuk menikmati internet fiber optik tanpa harus berlangganan bulanan. Dalam panduan ini, kami akan menjelaskan langkah demi langkah cara mengaktifkan voucher Anda, baik melalui HP, laptop, maupun perangkat lainnya. Prosesnya hanya memakan waktu kurang dari 2 menit!</p><hr><h2>Sebelum Memulai</h2><p>Pastikan Anda sudah mempersiapkan hal-hal berikut:</p><ul><li><strong>Kode voucher</strong> — Terdiri dari kombinasi huruf dan angka yang tercetak di kartu voucher fisik atau dikirimkan secara digital melalui WhatsApp/email.</li><li><strong>Perangkat yang akan digunakan</strong> — Smartphone, laptop, tablet, atau perangkat lain yang memiliki WiFi.</li><li><strong>Sinyal WiFi Cio Network</strong> — Pastikan perangkat Anda berada dalam jangkauan jaringan WiFi Cio Network Solution.</li></ul><blockquote><p><strong>Penting:</strong> 1 kode voucher hanya berlaku untuk 1 perangkat. Jika ingin menggunakan di perangkat lain, Anda perlu membeli voucher terpisah.</p></blockquote><hr><h2>Langkah 1: Hubungkan Perangkat ke WiFi Cio Network</h2><ol><li>Buka pengaturan WiFi di perangkat Anda (smartphone, laptop, atau tablet)</li><li>Cari dan pilih jaringan WiFi dengan nama/SSID yang mengandung <strong>"Cio Network"</strong> atau <strong>"CIO-WIFI"</strong> (nama jaringan bisa berbeda tergantung lokasi)</li><li>Hubungkan ke jaringan tersebut. Biasanya tidak perlu password untuk terhubung.</li></ol><hr><h2>Langkah 2: Akses Halaman Login Voucher</h2><p>Ada dua cara untuk membuka halaman login voucher:</p><h3>Cara A: Otomatis (Redirect)</h3><p>Setelah terhubung ke WiFi Cio Network, buka browser apa pun (Chrome, Safari, Opera, Firefox). Halaman login voucher akan muncul secara otomatis. Jika tidak muncul dalam 5-10 detik, coba buka situs web apa pun (contoh: google.com) untuk memicu redirect.</p><h3>Cara B: Manual</h3><p>Jika halaman login tidak muncul secara otomatis, buka alamat berikut di browser Anda: <strong>cionetwork.id/login</strong> atau ketika alamat IP <strong>10.10.10.1</strong> di address bar browser.</p><hr><h2>Langkah 3: Masukkan Kode Voucher</h2><p>Pada halaman login, Anda akan melihat form dengan kolom untuk memasukkan kode voucher. Ikuti petunjuk berikut:</p><ol><li>Ketik kode voucher Anda dengan <strong>teliti</strong>. Perhatikan huruf kapital (huruf besar/kecil biasanya tidak masalah, tetapi lebih baik diketik sesuai yang tercetak).</li><li>Perhatikan angka yang mirip huruf, misalnya: angka 0 (nol) dengan huruf O, angka 1 (satu) dengan huruf I atau l — pastikan Anda memasukkan dengan benar.</li><li>Setelah yakin kode sudah benar, klik tombol <strong>"Aktifkan"</strong> atau <strong>"Login"</strong>.</li></ol><hr><h2>Langkah 4: Koneksi Aktif!</h2><p>Setelah berhasil, Anda akan diarahkan ke halaman sukses yang menampilkan:</p><ul><li>Nama pengguna (username) yang terdaftar</li><li>Masa aktif voucher (tanggal dan jam berakhir)</li><li>Informasi sisa kuota (jika ada)</li><li>Sisa waktu pemakaian (untuk voucher dengan batas waktu)</li></ul><p>Koneksi internet Anda sekarang sudah aktif dan siap digunakan! Anda bisa browsing, streaming, video call, dan melakukan aktivitas online lainnya.</p><blockquote><p><strong>Catatan:</strong> Anda tidak perlu login ulang selama perangkat tetap terhubung ke WiFi Cio Network dan voucher belum habis masa berlakunya.</p></blockquote><hr><h2>Petunjuk Khusus untuk Berbagai Perangkat</h2><h3>Smartphone Android</h3><p>Setelah terhubung ke WiFi Cio, buka browser Chrome. Jika muncul notifikasi "Sign in to WiFi network", ketuk notifikasi tersebut untuk langsung membuka halaman login.</p><h3>iPhone / iPad (iOS)</h3><p>Setelah terhubung ke WiFi Cio, biasanya halaman login akan muncul otomatis sebagai pop-up. Jika tidak, buka Safari dan kunjungi situs apa pun untuk memicu halaman login.</p><h3>Laptop Windows 10/11</h3><p>Setelah terhubung ke WiFi, buka browser. Windows biasanya menampilkan notifikasi "Open browser to continue internet access", klik notifikasi tersebut.</p><h3>Laptop MacBook</h3><p>Sama seperti perangkat lain, buka Safari atau browser lain setelah terhubung ke WiFi. Halaman login akan muncul saat Anda mencoba mengakses situs web.</p><hr><h2>Troubleshooting: Jika Mengalami Masalah</h2><table><thead><tr><th>Masalah</th><th>Solusi</th></tr></thead><tbody><tr><td>Halaman login tidak muncul</td><td>Buka manual di <strong>cionetwork.id/login</strong> atau <strong>10.10.10.1</strong></td></tr><tr><td>Voucher tidak valid / error</td><td>Periksa kembali penulisan kode voucher. Pastikan tidak ada spasi di awal/akhir. Coba ketik ulang perlahan.</td></tr><tr><td>Sudah login tapi tidak ada internet</td><td>Putuskan sambungan WiFi lalu hubungkan kembali. Restart WiFi perangkat Anda. Jika masih bermasalah, hubungi customer service.</td></tr><tr><td>Voucher sudah pernah dipakai</td><td>Voucher hanya bisa digunakan sekali untuk 1 perangkat. Beli voucher baru jika diperlukan.</td></tr><tr><td>Lupa password WiFi Cio</td><td>Jaringan WiFi Cio Network bersifat terbuka (open network), tidak perlu password untuk terhubung.</td></tr></tbody></table><hr><h2>Cara Cek Sisa Masa Aktif Voucher</h2><p>Untuk mengecek berapa lama lagi voucher Anda masih aktif, ikuti langkah berikut:</p><ol><li>Buka browser Anda</li><li>Kunjungi <strong>cionetwork.id/status</strong></li><li>Halaman akan menampilkan sisa waktu pemakaian voucher Anda</li></ol><blockquote><p><strong>Tips:</strong> Catat atau screenshot halaman sukses aktivasi agar Anda tahu persis kapan voucher akan berakhir. Beli voucher baru sebelum masa aktif habis agar koneksi tidak terputus.</p></blockquote><hr><h2>Tips Penting</h2><ul><li><strong>Simpan bukti pembelian voucher</strong> — Foto kartu voucher atau simpan bukti transfer jika membeli secara digital. Ini penting jika terjadi masalah dan perlu verifikasi pembelian oleh customer service.</li><li><strong>Jangan bagikan kode voucher Anda</strong> — Kode voucher bersifat sekali pakai. Jika Anda memberikannya ke orang lain, kode tersebut akan terpakai di perangkat mereka dan tidak bisa digunakan lagi di perangkat Anda.</li><li><strong>Voucher tidak bisa dikembalikan</strong> — Setelah kode voucher diaktivasi, tidak ada pengembalian dana atau transfer ke perangkat lain. Pastikan Anda menggunakan voucher di perangkat yang benar.</li><li><strong>Hubungi customer service</strong> jika mengalami kendala — WhatsApp ke nomor resmi Cio Network Solution yang tertera di website kami.</li></ul>',
                'penulis' => 'Tim Cio Network',
                'thumbnail' => null,
                'video_path' => null,
                'video_url' => null,
                'dilihat' => 567,
                'is_featured' => true,
                'urutan' => 4,
                'is_active' => true,
            ],
            [
                'kategori' => 'Pembayaran',
                'icon_class' => 'fa-credit-card',
                'gradient_class' => 'bg-gradient-purple-pink',
                'judul' => 'Cara Bayar WiFi Bulanan',
                'slug' => 'cara-bayar-wifi-bulanan',
                'deskripsi' => 'Cara mudah melakukan pembayaran tagihan internet bulanan Cio Network Solution agar layanan Anda tidak terputus.',
                'konten' => '<h2>Panduan Lengkap Pembayaran Tagihan Bulanan</h2><p>Membayar tagihan internet bulanan Cio Network Solution sangatlah mudah. Kami menyediakan beberapa metode pembayaran untuk memudahkan Anda, sehingga Anda bisa memilih cara yang paling nyaman. Artikel ini akan membahas setiap metode secara detail, termasuk langkah-langkah dan tips penting.</p><hr><h2>Metode 1: Transfer Bank (Paling Praktis)</h2><p>Pembayaran melalui transfer bank adalah metode yang paling banyak digunakan oleh pelanggan Cio Network Solution. Anda bisa transfer kapan saja dan di mana saja melalui mobile banking, internet banking, atau ATM.</p><h3>Langkah-langkah Transfer Bank</h3><ol><li>Cek tagihan bulanan Anda. Nominal tagihan beserta nomor rekening tujuan tertera di kartu tagihan atau dikirimkan melalui WhatsApp oleh admin kami.</li><li>Lakukan transfer sesuai nominal tagihan ke rekening berikut: <ul><li><strong>Bank BCA:</strong> 1234567890 a.n. CIO Network Solution</li><li><strong>Bank BRI:</strong> 0987654321 a.n. CIO Network Solution</li><li><strong>Bank Mandiri:</strong> 1122334455 a.n. CIO Network Solution</li></ul>(Nomor rekening dapat berubah — pastikan Anda menggunakan nomor rekening terbaru yang tertera di tagihan Anda.)</li><li>Simpan bukti transfer (screenshot atau foto struk ATM).</li><li>Kirim bukti transfer ke WhatsApp customer service Cio Network Solution di <strong>6285324780031</strong> dengan menyertakan: <ul><li>Nama lengkap pelanggan</li><li>Alamat / kode pelanggan (jika ada)</li><li>Bulan pembayaran (contoh: "Pembayaran bulan Juli 2026")</li></ul></li><li>Admin akan memproses konfirmasi pembayaran dalam 1x24 jam. Anda akan menerima notifikasi bahwa pembayaran telah diterima dan tagihan Anda lunas.</li></ol><blockquote><p><strong>Tips:</strong> Lakukan transfer dan konfirmasi di hari yang sama untuk mempercepat proses. Hindari transfer di malam hari (setelah jam 21.00) karena konfirmasi baru akan diproses di hari kerja berikutnya.</p></blockquote><hr><h2>Metode 2: Pembayaran Langsung ke Kantor</h2><p>Anda juga bisa datang langsung ke kantor Cio Network Solution untuk membayar tagihan secara tunai. Metode ini cocok bagi Anda yang tinggal di sekitar Ciparay dan ingin bertemu langsung dengan tim kami.</p><h3>Informasi Kantor</h3><ul><li><strong>Alamat:</strong> Jl. Bojong Jl. Toha Ramdan, Ciparay, Kec. Ciparay, Kabupaten Bandung, Jawa Barat 40381</li><li><strong>Jam Operasional:</strong> Senin - Sabtu, 08.00 - 17.00 WIB</li><li><strong>Catatan:</strong> Kantor tutup pada hari Minggu dan hari libur nasional</li></ul><h3>Langkah-langkah</h3><ol><li>Datang ke kantor Cio Network Solution pada jam operasional</li><li>Sampaikan kepada petugas bahwa Anda ingin membayar tagihan internet bulanan</li><li>Sebutkan nama lengkap dan alamat untuk verifikasi data pelanggan</li><li>Lakukan pembayaran secara tunai</li><li>Petugas akan memberikan struk/kwitansi sebagai bukti pembayaran</li><li>Pembayaran akan langsung diproses dan dicatat di sistem</li></ol><hr><h2>Metode 3: Melalui Agen Resmi Terdekat</h2><p>Kami bekerja sama dengan agen-agen resmi Cio Network Solution yang tersebar di berbagai lokasi di wilayah Ciparay dan sekitarnya. Anda bisa membayar tagihan melalui agen terdekat tanpa harus datang ke kantor pusat.</p><h3>Cara Menemukan Agen Terdekat</h3><ol><li>Hubungi customer service via WhatsApp untuk menanyakan lokasi agen terdekat dari tempat tinggal Anda</li><li>Atau tanyakan kepada tetangga/kerabat yang juga pelanggan Cio Network Solution — biasanya mereka tahu di mana agen terdekat berada</li><li>Datang ke agen tersebut dan lakukan pembayaran seperti biasa</li></ol><blockquote><p><strong>Catatan:</strong> Beberapa agen mungkin mengenakan biaya administrasi kecil. Pastikan Anda menanyakan hal ini sebelum melakukan pembayaran.</p></blockquote><hr><h2>Metode 4: Pembayaran via E-Wallet (Khusus Tertentu)</h2><p>Untuk pelanggan tertentu, Cio Network Solution juga menyediakan opsi pembayaran melalui e-wallet seperti <strong>GoPay, OVO, Dana, atau LinkAja</strong>. Metode ini memerlukan koordinasi dengan admin terlebih dahulu.</p><ol><li>Hubungi customer service via WhatsApp</li><li>Minta nomor tujuan pembayaran e-wallet yang valid</li><li>Lakukan pembayaran sesuai nominal tagihan</li><li>Kirim screenshot bukti pembayaran ke nomor yang sama</li><li>Admin akan mengonfirmasi dan mencatat pembayaran Anda</li></ol><hr><h2>Tanggal Jatuh Tempo & Denda Keterlambatan</h2><p>Memahami jadwal pembayaran penting agar layanan internet Anda tidak terputus.</p><table><thead><tr><th>Item</th><th>Detail</th></tr></thead><tbody><tr><td><strong>Tanggal Tagihan</strong></td><td>Setiap tanggal 1-5 setiap bulan</td></tr><tr><td><strong>Tanggal Jatuh Tempo</strong></td><td>Tanggal 10 setiap bulan</td></tr><tr><td><strong>Periode Grace Period</strong></td><td>Tanggal 11-15 (layanan masih aktif dengan pengingat)</td></tr><tr><td><strong>Pemutusan Sementara</strong></td><td>Mulai tanggal 16 jika belum dibayar</td></tr><tr><td><strong>Biaya Pasang Ulang</strong></td><td>Jika pemutusan sudah terjadi, ada biaya aktivasi ulang</td></tr></tbody></table><blockquote><p><strong>Sangat Penting:</strong> Lakukan pembayaran <strong>sebelum tanggal 10</strong> setiap bulan untuk menghindari risiko pemutusan layanan. Pemutusan layanan karena keterlambatan pembayaran memerlukan proses aktivasi ulang yang bisa memakan waktu 1x24 jam.</p></blockquote><hr><h2>Cara Cek Tagihan & Riwayat Pembayaran</h2><p>Anda bisa mengecek tagihan bulanan dan riwayat pembayaran melalui beberapa cara:</p><ol><li><strong>WhatsApp</strong> — Hubungi customer service dan minta informasi tagihan terbaru</li><li><strong>Datang Langsung</strong> — Cek tagihan di kantor atau agen resmi Cio Network Solution</li><li><strong>Pengingat Otomatis</strong> — Admin akan mengirimkan pengingat tagihan via WhatsApp beberapa hari sebelum jatuh tempo. Pastikan nomor WhatsApp Anda aktif dan tidak memblokir nomor admin.</li></ol><hr><h2>Tips Bayar Tepat Waktu</h2><ul><li><strong>Catat tanggal jatuh tempo</strong> di kalender HP Anda dengan pengingat 3 hari sebelumnya</li><li><strong>Bayar di awal bulan</strong> — Setelah menerima tagihan (tanggal 1-5), segera lakukan pembayaran agar tidak lupa</li><li><strong>Gunakan mobile banking</strong> untuk kemudahan transfer kapan saja tanpa harus keluar rumah</li><li><strong>Simpan nomor admin</strong> di kontak HP agar mudah mencari nomor customer service saat akan konfirmasi pembayaran</li><li><strong>Konfirmasi setelah transfer</strong> — Jangan lupa kirim bukti transfer ke admin, karena tanpa konfirmasi pembayaran Anda tidak akan tercatat meskipun sudah transfer</li></ul><blockquote><p>Dengan memahami metode pembayaran dan jadwal tagihan, Anda bisa menikmati layanan internet Cio Network Solution tanpa khawatir terputus. Jika ada pertanyaan lebih lanjut, jangan ragu menghubungi customer service kami.</p></blockquote>',
                'penulis' => 'Tim Cio Network',
                'thumbnail' => null,
                'video_path' => null,
                'video_url' => null,
                'dilihat' => 423,
                'is_featured' => true,
                'urutan' => 5,
                'is_active' => true,
            ],
            [
                'kategori' => 'Tips',
                'icon_class' => 'fa-wifi',
                'gradient_class' => 'bg-gradient-teal',
                'judul' => 'Tips Memperkuat Sinyal WiFi di Rumah',
                'slug' => 'tips-memperkuat-sinyal-wifi-di-rumah',
                'deskripsi' => 'Beberapa tips sederhana untuk meningkatkan kualitas sinyal WiFi di rumah agar koneksi lebih stabil.',
                'konten' => '<h2>Panduan Lengkap Optimalisasi Sinyal WiFi di Rumah</h2><p>Sinyal WiFi yang lemah atau tidak stabil bisa sangat mengganggu — streaming buffering, video call putus-putus, loading website lambat, hingga game online yang lag. Namun sebelum Anda menghubungi customer service, ada beberapa hal sederhana yang bisa Anda lakukan sendiri untuk meningkatkan kualitas sinyal WiFi di rumah. Artikel ini akan membahas 10 tips praktis yang sudah terbukti efektif.</p><hr><h2>1. Posisikan Router di Tempat yang Tepat</h2><p>Penempatan router adalah faktor <strong>paling penting</strong> yang memengaruhi kualitas sinyal WiFi. Sinyal WiFi menyebar dari router ke segala arah, jadi lokasi router menentukan seberapa baik seluruh rumah Anda tercover.</p><h3>Aturan Penempatan Router yang Ideal:</h3><ul><li><strong>Tengah rumah</strong> — Tempatkan router di area sentral rumah Anda agar sinyal menyebar merata ke semua ruangan. Jika router diletakkan di ujung rumah, ruangan di sisi yang berlawanan akan mendapat sinyal lemah.</li><li><strong>Tempat terbuka</strong> — Letakkan router di atas meja atau rak, bukan di dalam lemari, di balik tirai, atau di sudut ruangan yang tertutup. Semakin sedikit hambatan, semakin baik sinyalnya.</li><li><strong>Posisi tinggi</strong> — Sinyal WiFi cenderung menyebar lebih baik dari ketinggian. Letakkan router di rak tinggi atau tempel di dinding jika memungkinkan. Jangan letakkan di lantai.</li><li><strong>Jauh dari dinding tebal</strong> — Dinding beton, bata, dan struktur logam sangat menyerap sinyal WiFi. Usahakan router tidak terhalang oleh dinding tebal, terutama ke arah ruangan yang sering digunakan.</li><li><strong>Jauh dari kaca dan cermin besar</strong> — Permukaan kaca dan cermin dapat memantulkan sinyal WiFi, menyebabkan gangguan dan penurunan kualitas.</li></ul><blockquote><p><strong>Ilustrasi:</strong> Bayangkan router seperti lampu. Semakin tinggi dan terbuka posisinya, semakin luas dan terang cahayanya. Jika lampu diletakkan di dalam lemari tertutup, cahaya tidak akan keluar.</p></blockquote><hr><h2>2. Jauhkan dari Sumber Interferensi</h2><p>Sinyal WiFi menggunakan frekuensi radio 2.4 GHz dan 5 GHz. Sayangnya, frekuensi 2.4 GHz sangat rentan terhadap interferensi dari perangkat elektronik lain. Berikut perangkat yang paling sering menyebabkan interferensi:</p><table><thead><tr><th>Perangkat</th><th>Jenis Gangguan</th><th>Solusi</th></tr></thead><tbody><tr><td>Microwave</td><td>Mengeluarkan radiasi 2.4 GHz saat menyala</td><td>Jangan letakkan router di dapur. Matikan microwave saat butuh koneksi stabil.</td></tr><tr><td>Speaker Bluetooth</td><td>Menggunakan frekuensi 2.4 GHz</td><td>Jauhkan dari router. Gunakan speaker 5 GHz jika tersedia.</td></tr><tr><td>Telepon Nirkabel (DECT)</td><td>Frekuensi tumpang tindih</td><td>Jauhkan dari router atau gunakan telepon kabel.</td></tr><tr><td>Baby Monitor</td><td>Frekuensi 2.4 GHz</td><td>Pilih baby monitor 900 MHz atau 5 GHz.</td></tr><tr><td>Monitor Bayi</td><td>Sama seperti baby monitor</td><td>Jaga jarak dengan router.</td></tr><tr><td>Lampu Neon/LED tertentu</td><td>Menghasilkan noise elektromagnetik</td><td>Jauhkan router dari lampu.</td></tr><tr><td>Kabel listrik yang tidak terlindungi</td><td>Menciptakan medan elektromagnetik</td><td>Jauhkan router dari kabel listrik yang melilit.</td></tr></tbody></table><hr><h2>3. Gunakan Frekuensi 5 GHz (Jika Perangkat Mendukung)</h2><p>Router WiFi Cio Network Solution mendukung dual-band (2.4 GHz dan 5 GHz). Masing-masing punya kelebihan dan kekurangan:</p><table><thead><tr><th>Aspek</th><th>2.4 GHz</th><th>5 GHz</th></tr></thead><tbody><tr><td>Jangkauan</td><td>Lebih jauh, tembus dinding</td><td>Lebih pendek, mudah terhalang</td></tr><tr><td>Kecepatan</td><td>Maksimal ~300-600 Mbps</td><td>Maksimal ~1.300-2.400 Mbps</td></tr><tr><td>Interferensi</td><td>Sangat rentan (banyak perangkat)</td><td>Minim (lebih sedikit perangkat)</td></tr><tr><td>Cocok untuk</td><td>Browsing, social media, perangkat IoT</td><td>Streaming 4K, gaming, video call, download besar</td></tr></tbody></table><p><strong>Tips:</strong> Gunakan jaringan 5 GHz untuk perangkat yang dekat dengan router dan membutuhkan kecepatan tinggi (laptop, smart TV, PS5). Gunakan 2.4 GHz untuk perangkat yang jauh dari router atau untuk perangkat IoT seperti kamera CCTV dan smart lamp.</p><hr><h2>4. Update Firmware Router</h2><p>Firmware adalah sistem operasi di dalam router Anda. Sama seperti HP atau laptop, firmware router perlu diupdate secara berkala untuk mendapatkan perbaikan bug, peningkatan performa, dan tambalan keamanan.</p><h3>Cara Update Firmware:</h3><ol><li>Buka browser dan akses halaman administrasi router (biasanya <strong>192.168.1.1</strong> atau <strong>192.168.0.1</strong>)</li><li>Masukkan username dan password admin router (biasanya tertulis di stiker bawah router)</li><li>Cari menu <strong>"Administration"</strong>, <strong>"Firmware Update"</strong>, atau <strong>"System Tools"</strong></li><li>Pilih opsi <strong>"Check for Updates"</strong> atau <strong>"Upgrade"</strong></li><li>Jika ada update, ikuti petunjuk di layar untuk menginstalnya. Jangan matikan router selama proses update.</li></ol><blockquote><p><strong>Catatan:</strong> Jika Anda tidak yakin cara melakukannya, tim support Cio Network Solution siap membantu. Hubungi kami melalui WhatsApp dan kami akan pandu langkah demi langkah.</p></blockquote><hr><h2>5. Gunakan Kabel LAN untuk Perangkat Tetap</h2><p>Untuk perangkat yang tidak banyak bergerak — seperti PC gaming, smart TV, atau konsol game — menggunakan kabel LAN (Ethernet) adalah solusi terbaik untuk koneksi paling stabil dan cepat. Kabel LAN memberikan koneksi langsung tanpa hambatan sinyal, interferensi, atau penurunan kecepatan akibat jarak.</p><h3>Keunggulan Kabel LAN dibanding WiFi:</h3><ul><li><strong>Latensi lebih rendah</strong> — Ping lebih stabil, sangat penting untuk gaming online dan video call</li><li><strong>Kecepatan konsisten</strong> — Tidak terpengaruh jarak atau hambatan fisik</li><li><strong>Tanpa interferensi</strong> — Tidak terganggu perangkat elektronik lain di rumah</li><li><strong>Keamanan lebih baik</strong> — Lebih sulit diintersepsi dibanding sinyal WiFi yang menyebar</li></ul><hr><h2>6. Restart Router Secara Berkala</h2><p>Ini adalah tips paling sederhana namun sering dilupakan. Router sebenarnya adalah komputer kecil yang bisa mengalami penumpukan cache, kehabisan memori, atau koneksi yang "lelah" jika dinyalakan terus menerus dalam waktu lama.</p><h3>Rekomendasi:</h3><ul><li><strong>Restart router setiap 2-3 hari sekali</strong> — Cukup cabut kabel power, tunggu 30 detik, lalu colokkan kembali</li><li><strong>Biasakan restart di pagi hari</strong> sebelum mulai beraktivitas online agar koneksi segar</li><li><strong>Jadwalkan restart otomatis</strong> — Beberapa router modern memiliki fitur jadwal restart otomatis di menu pengaturan. Setel agar router restart setiap pukul 03.00 dini hari secara otomatis.</li></ul><p>Setelah restart, Anda biasanya akan merasakan peningkatan kecepatan dan stabilitas koneksi.</p><hr><h2>7. Ganti Channel WiFi</h2><p>Di area perumahan yang padat, banyak tetangga yang menggunakan WiFi, dan mereka mungkin menggunakan channel yang sama dengan Anda. Ini menyebabkan "kemacetan" sinyal karena semua router berebut frekuensi yang sama.</p><h3>Cara Ganti Channel WiFi:</h3><ol><li>Akses halaman administrasi router (192.168.1.1)</li><li>Cari menu <strong>"Wireless Settings"</strong> atau <strong>"WiFi Settings"</strong></li><li>Cari opsi <strong>"Channel"</strong> (biasanya set ke "Auto")</li><li>Untuk 2.4 GHz, pilih channel <strong>1, 6, atau 11</strong> (ketiga channel ini tidak saling tumpang tindih)</li><li>Untuk 5 GHz, pilih channel yang tidak terlalu padat (bisa coba channel 36, 40, 44, atau 48)</li><li>Simpan pengaturan dan restart router</li></ol><p>Jika tidak yakin channel mana yang paling sepi, Anda bisa menggunakan aplikasi seperti <strong>WiFi Analyzer</strong> (Android) untuk melihat channel mana yang paling sedikit digunakan di sekitar rumah Anda.</p><hr><h2>8. Gunakan WiFi Extender atau Mesh System</h2><p>Jika rumah Anda besar (2 lantai atau lebih) atau memiliki banyak ruangan dengan dinding tebal, satu router mungkin tidak cukup untuk menjangkau seluruh area. Solusinya adalah menambahkan perluasan sinyal:</p><table><thead><tr><th>Perangkat</th><th>Cara Kerja</th><th>Kelebihan</th><th>Kekurangan</th></tr></thead><tbody><tr><td><strong>WiFi Extender/Repeater</strong></td><td>Menerima sinyal dari router utama lalu memancarkannya kembali</td><td>Harga terjangkau, mudah dipasang</td><td>Kecepatan bisa turun setengah, karena harus menerima dan memancarkan ulang</td></tr><tr><td><strong>Powerline Adapter</strong></td><td>Mengirim sinyal melalui kabel listrik rumah</td><td>Stabil, tidak terpengaruh tembok</td><td>Membutuhkan stopkontak, kualitas tergantung instalasi listrik rumah</td></tr><tr><td><strong>Mesh WiFi System</strong></td><td>Beberapa unit yang saling terhubung membentuk satu jaringan seamless</td><td>Jangkauan luas, sinyal stabil, roaming otomatis</td><td>Harga lebih mahal</td></tr></tbody></table><p>Jika Anda sering mengalami sinyal lemah di kamar tidur lantai 2, coba gunakan extender atau mesh system. Cio Network Solution juga menyediakan layanan konsultasi gratis untuk rekomendasi solusi perluasan WiFi — hubungi kami untuk info lebih lanjut.</p><hr><h2>9. Atur Kualitas Layanan (QoS)</h2><p>Quality of Service (QoS) adalah fitur di router yang memungkinkan Anda memberikan prioritas bandwidth ke perangkat atau aplikasi tertentu. Misalnya, Anda bisa mengatur agar PC gaming atau smart TV mendapatkan prioritas lebih tinggi dibanding HP tamu yang hanya browsing.</p><h3>Cara Mengatur QoS:</h3><ol><li>Akses halaman administrasi router</li><li>Cari menu <strong>"QoS"</strong>, <strong>"Bandwidth Control"</strong>, atau <strong>"Traffic Management"</strong></li><li>Aktifkan fitur QoS</li><li>Tambahkan aturan prioritas — misalnya beri prioritas tertinggi ke MAC address perangkat PC gaming atau smart TV</li><li>Simpan pengaturan</li></ol><p>Dengan QoS, aktivitas penting Anda tetap lancar meskipun ada perangkat lain yang melakukan download besar atau streaming.</p><hr><h2>10. Amankan Jaringan WiFi Anda</h2><p>Jaringan WiFi yang tidak aman bisa digunakan oleh tetangga atau orang lain tanpa sepengetahuan Anda. Akibatnya, bandwidth Anda terbagi, koneksi melambat, dan data pribadi Anda berisiko.</p><h3>Cara Mengamankan WiFi:</h3><ul><li><strong>Ganti password WiFi default</strong> — Jangan gunakan password bawaan pabrik. Buat password yang kuat (minimal 8 karakter, kombinasi huruf besar, huruf kecil, angka, dan simbol).</li><li><strong>Aktifkan enkripsi WPA2 atau WPA3</strong> — Pastikan pengaturan keamanan WiFi Anda menggunakan WPA2 (atau WPA3 jika router mendukung). Jangan gunakan WEP karena sudah tidak aman.</li><li><strong>Nonaktifkan WPS</strong> — WPS (WiFi Protected Setup) memudahkan koneksi tapi juga memudahkan peretas masuk. Matikan fitur ini di pengaturan router.</li><li><strong>Sembunyikan SSID (opsional)</strong> — Anda bisa menyembunyikan nama jaringan WiFi agar tidak terlihat oleh perangkat lain. Hanya perangkat yang sudah tahu nama jaringan yang bisa terhubung.</li><li><strong>Cek perangkat yang terhubung</strong> — Di halaman administrasi router, cek daftar perangkat yang terhubung ke jaringan Anda. Jika ada perangkat asing, blokir atau ganti password WiFi Anda.</li></ul><hr><h2>Kapan Harus Menghubungi Customer Service?</h2><p>Jika Anda sudah mencoba semua tips di atas tetapi koneksi masih lambat atau tidak stabil, mungkin ada masalah teknis dari sisi jaringan yang perlu ditangani oleh tim teknis Cio Network Solution. Hubungi kami jika:</p><ul><li>Kecepatan internet <strong>jauh di bawah</strong> paket yang Anda bayar (misal: paket 15 Mbps konsisten di bawah 5 Mbps)</li><li>Koneksi <strong>sering putus-putus</strong> (intermittent) meskipun sudah restart router</li><li>Tidak ada sinyal WiFi sama sekali dari perangkat Cio Network Solution</li><li>Indikator <strong>ONT (Optical Network Terminal)</strong> berwarna merah atau tidak menyala normal</li><li>Seluruh rumah mengalami masalah yang sama (bukan hanya perangkat tertentu)</li></ul><blockquote><p>Hubungi customer service Cio Network Solution melalui WhatsApp di <strong>6285324780031</strong>. Tim teknis kami siap membantu 24 jam nonstop.</p></blockquote>',
                'penulis' => 'Tim Cio Network',
                'thumbnail' => null,
                'video_path' => null,
                'video_url' => null,
                'dilihat' => 678,
                'is_featured' => false,
                'urutan' => 6,
                'is_active' => true,
            ],
        ];
        $tutorials = array_map(fn($t) => array_merge($t, ['created_at' => now(), 'updated_at' => now()]), $tutorials);
        DB::table('tutorials')->insert($tutorials);

        // Attach tags to tutorials
        $insertedTutorials = DB::table('tutorials')->whereIn('slug', array_column($tutorials, 'slug'))->get();
        $tagLinks = [
            'cara-cek-kecepatan-internet' => ['Jaringan', 'Tips & Trik'],
            'mengenal-jaringan-fiber-optic' => ['Jaringan', 'Pengenalan'],
            'perbedaan-wifi-voucher-dan-bulanan' => ['Tips & Trik', 'Voucher'],
            'cara-memasukkan-kode-voucher' => ['Voucher', 'Tips & Trik'],
            'cara-bayar-wifi-bulanan' => ['Pembayaran', 'Tips & Trik'],
            'tips-memperkuat-sinyal-wifi-di-rumah' => ['WiFi', 'Tips & Trik', 'Jaringan'],
        ];
        foreach ($insertedTutorials as $tutorial) {
            if (isset($tagLinks[$tutorial->slug])) {
                foreach ($tagLinks[$tutorial->slug] as $tagName) {
                    if (isset($tagIds[$tagName])) {
                        DB::table('tutorial_tag')->insert([
                            'tutorial_id' => $tutorial->id,
                            'tag_id' => $tagIds[$tagName],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }

        // Keunggulan
        $keunggulan = [
            [
                'icon_class' => 'fa-gauge-high',
                'gradient_class' => 'bg-gradient-blue',
                'judul' => 'Kecepatan Simetris',
                'deskripsi' => 'Unggah dan unduh data sama cepatnya (Symmetric 1:1), sangat pas untuk upload video dan video call tanpa lag.',
                'urutan' => 1,
            ],
            [
                'icon_class' => 'fa-infinity',
                'gradient_class' => 'bg-gradient-purple',
                'judul' => 'Tanpa Batas FUP',
                'deskripsi' => 'Bebas kuota sepuasnya! Kecepatan internet Anda akan tetap stabil 100% sepanjang bulan tanpa batas penurunan speed.',
                'urutan' => 2,
            ],
            [
                'icon_class' => 'fa-shield-halved',
                'gradient_class' => 'bg-gradient-pink',
                'judul' => 'Uptime SLA 99.9%',
                'deskripsi' => 'Dilengkapi dengan redundansi jaringan ganda untuk menjamin koneksi internet Anda tetap menyala dalam kondisi apa pun.',
                'urutan' => 3,
            ],
            [
                'icon_class' => 'fa-headset',
                'gradient_class' => 'bg-gradient-orange',
                'judul' => 'Layanan Mandiri 24/7',
                'deskripsi' => 'Tim teknis professional kami selalu bersiaga penuh membantu memantau dan menyelesaikan kendala jaringan Anda kapan saja.',
                'urutan' => 4,
            ],
        ];
        DB::table('keunggulan')->insert($keunggulan);

        // SEO Settings
        $seo = [
            [
                'page_key' => 'home',
                'page_label' => 'Beranda',
                'meta_title' => 'PT CIO NETWORK NUSANTARA - Internet Fiber Optic Ultra Cepat & Tanpa FUP',
                'meta_description' => 'Selamat datang di PT CIO NETWORK NUSANTARA. Temukan layanan internet fiber optic cepat dan unlimited tanpa FUP untuk menunjang aktivitas Anda.',
                'meta_keywords' => 'isp, pt cio network nusantara, internet cepat, fiber optic, internet murah, internet unlimited, wifi rumah, wifi kantor',
                'og_title' => 'PT CIO NETWORK NUSANTARA - Internet Fiber Optic Ultra Cepat',
                'og_description' => 'Temukan layanan internet fiber optic cepat dan unlimited tanpa FUP.',
            ],
            [
                'page_key' => 'tentang-kami',
                'page_label' => 'Tentang Kami',
                'meta_title' => 'Tentang Kami - PT CIO NETWORK NUSANTARA',
                'meta_description' => 'Kenali PT CIO NETWORK NUSANTARA, mitra resmi ISP Andira Infomedia dengan pengalaman lebih dari 5 tahun.',
                'meta_keywords' => 'tentang cio network, profil perusahaan, isp bandung, internet fiber optic',
                'og_title' => 'Tentang PT CIO NETWORK NUSANTARA',
                'og_description' => 'Mitra resmi ISP Andira Infomedia dengan pengalaman lebih dari 5 tahun.',
            ],
            [
                'page_key' => 'paket-internet',
                'page_label' => 'Paket Internet',
                'meta_title' => 'Paket Internet - PT CIO NETWORK NUSANTARA',
                'meta_description' => 'Pilih paket internet fiber optic terbaik dari PT CIO NETWORK NUSANTARA. Tersedia paket home bulanan dan voucher fleksibel.',
                'meta_keywords' => 'paket internet, wifi bulanan, wifi voucher, internet murah, paket wifi rumah',
                'og_title' => 'Paket Internet PT CIO NETWORK NUSANTARA',
                'og_description' => 'Pilih paket internet fiber optic terbaik untuk kebutuhan Anda.',
            ],
            [
                'page_key' => 'tutorial',
                'page_label' => 'Tutorial',
                'meta_title' => 'Tutorial & Bantuan - PT CIO NETWORK NUSANTARA',
                'meta_description' => 'Kumpulan tutorial dan panduan praktis menggunakan layanan internet PT CIO NETWORK NUSANTARA.',
                'meta_keywords' => 'tutorial internet, panduan wifi, cara bayar wifi, voucher internet',
                'og_title' => 'Tutorial PT CIO NETWORK NUSANTARA',
                'og_description' => 'Panduan praktis mengoptimalkan jaringan internet Anda.',
            ],
            [
                'page_key' => 'kontak',
                'page_label' => 'Kontak',
                'meta_title' => 'Kontak Kami - PT CIO NETWORK NUSANTARA',
                'meta_description' => 'Hubungi tim PT CIO NETWORK NUSANTARA untuk pertanyaan, pendaftaran, atau bantuan teknis.',
                'meta_keywords' => 'kontak isp, internet, daftar wifi, hubungi cio network',
                'og_title' => 'Kontak PT CIO NETWORK NUSANTARA',
                'og_description' => 'Hubungi tim kami untuk pertanyaan atau pendaftaran.',
            ],
        ];
        DB::table('seo_settings')->insert($seo);

        $this->call(RolePermissionSeeder::class);
    }
}
