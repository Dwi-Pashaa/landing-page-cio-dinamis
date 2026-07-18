@extends('admin.layouts.admin')

@section('title', 'Tambah Paket - Admin CIO')
@section('page_title', 'Tambah Paket Internet')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form method="POST" action="{{ url('/cms/paket') }}">
                @csrf

                <div class="form-section">
                    <div class="form-section-title">Informasi Dasar</div>
                    <div class="form-section-divider"></div>
                    <div class="row g-4">
                    <div class="col-md-4">
                        <label class="form-label">Tipe</label>
                        <select name="tipe" class="form-select" required>
                            <option value="home">Home (Bulanan)</option>
                            <option value="voucher">Voucher</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Nama Paket</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Sub Judul</label>
                        <input type="text" name="sub_judul" class="form-control" placeholder="Cocok untuk...">
                    </div>
                </div>
                <div class="row g-4 mt-2">
                    <div class="col-md-4">
                        <label class="form-label">Harga (Rp)</label>
                        <input type="number" name="harga" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Periode</label>
                        <input type="text" name="periode" class="form-control" placeholder="/bulan" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="urutan" class="form-control" value="0">
                    </div>
                </div>
                </div>

                <div class="form-section">
                    <div class="form-section-title">Teks Highlight</div>
                    <div class="form-section-divider"></div>
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">Highlight Text</label>
                        <input type="text" name="highlight_text" class="form-control" placeholder="Up To 15Mbps Hanya 100.000">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Sub Highlight</label>
                        <input type="text" name="sub_highlight" class="form-control" placeholder="Kecepatan Streaming Hingga...">
                    </div>
                </div>
                </div>

                <div class="form-section">
                    <div class="form-section-title">Fitur Utama</div>
                    <div class="form-section-divider"></div>
                    <div class="dynamic-fields">
                        <div class="fitur-list">
                            <div class="fitur-item row g-2 mb-2">
                                <div class="col-10">
                                    <input type="text" name="fitur[]" class="form-control" placeholder="Masukkan fitur">
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-outline-danger btn-remove-fitur btn-sm">
                                        <i class="fa-solid fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm btn-add-fitur mt-2">
                            <i class="fa-solid fa-plus me-1"></i> Tambah Fitur
                        </button>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-section-title">Keuntungan Tambahan</div>
                    <div class="form-section-divider"></div>
                    <div class="dynamic-fields">
                        <div class="fitur-list">
                            <div class="fitur-item row g-2 mb-2">
                                <div class="col-10">
                                    <input type="text" name="keuntungan_tambahan[]" class="form-control" placeholder="Masukkan keuntungan">
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-outline-danger btn-remove-fitur btn-sm">
                                        <i class="fa-solid fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm btn-add-fitur mt-2">
                            <i class="fa-solid fa-plus me-1"></i> Tambah Keuntungan
                        </button>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-section-title">WhatsApp</div>
                    <div class="form-section-divider"></div>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label">Nomor WA (tanpa +)</label>
                            <input type="text" name="wa_number" class="form-control" placeholder="628123456789">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Pesan WA</label>
                            <textarea name="wa_message" class="form-control" rows="3" placeholder="Pesan pre-fill untuk WA"></textarea>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-section-title">Pengaturan</div>
                    <div class="form-section-divider"></div>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="form-check form-switch">
                                <input type="checkbox" name="is_rekomendasi" class="form-check-input" id="isRekomendasi" value="1">
                                <label class="form-check-label" for="isRekomendasi">Tampilkan Badge Rekomendasi</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check form-switch">
                                <input type="checkbox" name="is_featured" class="form-check-input" id="isFeatured" value="1" checked>
                                <label class="form-check-label" for="isFeatured">Tampil di Halaman Home</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check form-switch">
                                <input type="checkbox" name="is_active" class="form-check-input" id="isActive" value="1" checked>
                                <label class="form-check-label" for="isActive">Aktif</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-5 pt-3 border-top d-flex justify-content-end gap-2">
                    <a href="{{ url('/cms/paket') }}" class="btn btn-outline-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-primary px-4 shadow-sm">
                        <i class="fa-solid fa-save me-1"></i> Simpan Paket
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
