@extends('admin.layouts.admin')

@section('title', 'Edit Hero - Admin CIO')
@section('page_title', 'Edit Hero Section')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form method="POST" action="{{ url('/cms/hero') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-section">
                    <div class="form-section-title">Informasi Hero</div>
                    <div class="form-section-divider"></div>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label">Badge Text</label>
                            <input type="text" name="badge_text" class="form-control" value="{{ old('badge_text', $hero->badge_text) }}" placeholder="Contoh: Internet Cepat & Stabil">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Judul</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $hero->title) }}" required>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Deskripsi hero section">{{ old('description', $hero->description) }}</textarea>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-section-title">Tombol</div>
                    <div class="form-section-divider"></div>
                    <div class="row g-4">
                        <div class="col-md-3">
                            <label class="form-label">Tombol Primer - Text</label>
                            <input type="text" name="btn_primary_text" class="form-control" value="{{ old('btn_primary_text', $hero->btn_primary_text) }}" placeholder="Lihat Paket">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tombol Primer - URL</label>
                            <input type="text" name="btn_primary_url" class="form-control" value="{{ old('btn_primary_url', $hero->btn_primary_url) }}" placeholder="/paket-internet">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tombol Sekunder - Text</label>
                            <input type="text" name="btn_secondary_text" class="form-control" value="{{ old('btn_secondary_text', $hero->btn_secondary_text) }}" placeholder="Hubungi Kami">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tombol Sekunder - URL</label>
                            <input type="text" name="btn_secondary_url" class="form-control" value="{{ old('btn_secondary_url', $hero->btn_secondary_url) }}" placeholder="/kontak">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-section-title">Gambar Hero</div>
                    <div class="form-section-divider"></div>
                    <label class="form-label">Upload Gambar</label>
                    <input type="file" name="hero_image" id="hero_image" class="form-control" accept="image/*">
                    @if($hero->hero_image)
                        <div class="mt-3">
                            <img src="{{ asset('storage/' . $hero->hero_image) }}" id="heroPreview" class="img-fluid rounded border" style="max-height: 200px; object-fit: cover;">
                        </div>
                    @else
                        <div class="mt-3">
                            <img src="#" id="heroPreview" class="img-fluid rounded border" style="max-height: 200px; object-fit: cover; display: none;">
                        </div>
                    @endif
                    <small class="text-muted mt-2 d-block">Format: JPG, PNG, WebP. Max 10MB.</small>
                </div>

                <div class="form-section">
                    <div class="form-section-title">Pengaturan Tampilan</div>
                    <div class="form-section-divider"></div>
                    <div class="form-check form-switch">
                        <input type="checkbox" name="is_active" class="form-check-input" id="isActive" value="1" {{ $hero->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="isActive">Tampilkan Hero Section di Halaman Utama</label>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top d-flex justify-content-end gap-2">
                    <a href="{{ url('/cms') }}" class="btn btn-outline-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-primary px-5 shadow-sm">
                        <i class="fa-solid fa-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
