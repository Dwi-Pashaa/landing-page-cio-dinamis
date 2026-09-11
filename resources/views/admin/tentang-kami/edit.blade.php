@extends('admin.layouts.admin')

@section('title', 'Edit Tentang Kami - Admin CIO')
@section('page_title', 'Edit Halaman Tentang Kami')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form method="POST" action="{{ url('/cms/tentang-kami') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- SECTION HERO / BANNER --}}
                <div class="form-section">
                    <div class="form-section-title">Hero Banner Tentang Kami</div>
                    <div class="form-section-divider"></div>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <label class="form-label">Badge Text</label>
                            <input type="text" name="hero_badge" class="form-control" value="{{ old('hero_badge', $about->hero_badge) }}" placeholder="Contoh: Profil Perusahaan">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Judul Hero <span class="text-danger">*</span></label>
                            <input type="text" name="hero_title" class="form-control" value="{{ old('hero_title', $about->hero_title) }}" placeholder="Contoh: Tentang <span>PT CIO NETWORK NUSANTARA</span>" required>
                            <small class="text-muted">Mendukung tag <code>&lt;span&gt;</code> untuk efek teks gradasi.</small>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="form-label">Deskripsi Singkat Hero</label>
                        <textarea name="hero_description" class="form-control" rows="3" placeholder="Deskripsi singkat di bawah judul hero">{{ old('hero_description', $about->hero_description) }}</textarea>
                    </div>
                </div>

                {{-- SECTION SIAPA KAMI --}}
                <div class="form-section">
                    <div class="form-section-title">Profil "Siapa Kami?"</div>
                    <div class="form-section-divider"></div>
                    <div class="row g-4">
                        <div class="col-md-12">
                            <label class="form-label">Judul Bagian <span class="text-danger">*</span></label>
                            <input type="text" name="about_title" class="form-control" value="{{ old('about_title', $about->about_title) }}" placeholder="Contoh: Siapa Kami?" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Paragraf Pembuka (Lead Text)</label>
                            <textarea name="about_lead" class="form-control" rows="2" placeholder="Teks pembuka tebal">{{ old('about_lead', $about->about_lead) }}</textarea>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Deskripsi Lengkap Profil</label>
                            <textarea name="about_description" class="form-control" rows="4" placeholder="Deskripsi profil perusahaan">{{ old('about_description', $about->about_description) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- SECTION GAMBAR INFRASTRUKTUR --}}
                <div class="form-section">
                    <div class="form-section-title">Gambar Profil / Infrastruktur</div>
                    <div class="form-section-divider"></div>
                    <label class="form-label">Upload Gambar Baru</label>
                    <input type="file" name="about_image" id="about_image" class="form-control" accept="image/*">
                    <small class="text-muted mt-2 d-block">Format yang didukung: JPG, PNG, WebP. Maksimal 10MB.</small>
                    
                    <div class="mt-3">
                        <label class="form-label text-muted" style="font-size: 12px;">Gambar Saat Ini / Preview:</label>
                        <div>
                            @if($about->about_image)
                                <img src="{{ asset('storage/' . $about->about_image) }}" id="aboutPreview" class="img-fluid rounded border shadow-sm" style="max-height: 220px; object-fit: cover;">
                            @else
                                <img src="{{ asset('pages/images/hosting-img.png') }}" id="aboutPreview" class="img-fluid rounded border shadow-sm" style="max-height: 220px; object-fit: cover;">
                            @endif
                        </div>
                    </div>
                </div>

                {{-- SECTION VISI & MISI --}}
                <div class="form-section">
                    <div class="form-section-title">Visi & Misi Perusahaan</div>
                    <div class="form-section-divider"></div>
                    
                    <div class="row g-4 mb-4">
                        <div class="col-md-4">
                            <label class="form-label">Judul Visi</label>
                            <input type="text" name="visi_title" class="form-control" value="{{ old('visi_title', $about->visi_title ?? 'Visi Kami') }}" placeholder="Visi Kami">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Teks Visi Perusahaan</label>
                            <textarea name="visi_text" class="form-control" rows="3" placeholder="Teks visi perusahaan...">{{ old('visi_text', $about->visi_text) }}</textarea>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-4">
                            <label class="form-label">Judul Misi</label>
                            <input type="text" name="misi_title" class="form-control" value="{{ old('misi_title', $about->misi_title ?? 'Misi Kami') }}" placeholder="Misi Kami">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Daftar Poin Misi Kami</label>
                            <div class="dynamic-fields">
                                <div id="misiList">
                                    @php
                                        $misiItems = old('misi_items', $about->misi_items ?? []);
                                        if (empty($misiItems)) {
                                            $misiItems = [''];
                                        }
                                    @endphp
                                    @foreach($misiItems as $misi)
                                        <div class="misi-item row g-2 mb-2">
                                            <div class="col-10">
                                                <input type="text" name="misi_items[]" class="form-control" value="{{ $misi }}" placeholder="Masukkan poin misi perusahaan...">
                                            </div>
                                            <div class="col-2">
                                                <button type="button" class="btn btn-outline-danger btn-remove-misi btn-sm w-100" style="height: 38px;">
                                                    <i class="fa-solid fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" id="btnAddMisi" class="btn btn-outline-primary btn-sm mt-2">
                                    <i class="fa-solid fa-plus me-1"></i> Tambah Poin Misi
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SECTION PENGATURAN TAMPILAN --}}
                <div class="form-section">
                    <div class="form-section-title">Pengaturan Tampilan</div>
                    <div class="form-section-divider"></div>
                    <div class="form-check form-switch">
                        <input type="checkbox" name="is_active" class="form-check-input" id="isActive" value="1" {{ $about->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="isActive">Tampilkan Halaman / Konten Tentang Kami</label>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Image preview
        const aboutImageInput = document.getElementById('about_image');
        const aboutPreview = document.getElementById('aboutPreview');
        if (aboutImageInput && aboutPreview) {
            aboutImageInput.addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        aboutPreview.src = event.target.result;
                        aboutPreview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Misi repeater
        const btnAddMisi = document.getElementById('btnAddMisi');
        const misiList = document.getElementById('misiList');

        if (btnAddMisi && misiList) {
            btnAddMisi.addEventListener('click', function () {
                const itemDiv = document.createElement('div');
                itemDiv.className = 'misi-item row g-2 mb-2';
                itemDiv.innerHTML = `
                    <div class="col-10">
                        <input type="text" name="misi_items[]" class="form-control" placeholder="Masukkan poin misi perusahaan...">
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-outline-danger btn-remove-misi btn-sm w-100" style="height: 38px;">
                            <i class="fa-solid fa-minus"></i>
                        </button>
                    </div>
                `;
                misiList.appendChild(itemDiv);
            });

            misiList.addEventListener('click', function (e) {
                const removeBtn = e.target.closest('.btn-remove-misi');
                if (removeBtn) {
                    const items = misiList.querySelectorAll('.misi-item');
                    if (items.length > 1) {
                        removeBtn.closest('.misi-item').remove();
                    } else {
                        // If only one, just clear the value
                        const input = removeBtn.closest('.misi-item').querySelector('input');
                        if (input) input.value = '';
                    }
                }
            });
        }
    });
</script>
@endpush
