@extends('admin.layouts.admin')

@section('title', 'Tambah Tutorial - Admin CIO')
@section('page_title', 'Tambah Tutorial')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet">
<link href="{{ asset('admin/js/ckeditor-video/video.css') }}" rel="stylesheet">
<style>
    .ck-editor__editable { min-height: 350px; }
    .thumbnail-preview { max-width: 200px; max-height: 120px; object-fit: cover; border-radius: 8px; margin-top: 8px; display: none; }
    .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__rendered .select2-selection__choice {
        font-size: 13px;
        padding: 2px 8px;
        background: #EFF6FF;
        border-color: #BFDBFE;
        color: #1E40AF;
    }
    .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__rendered .select2-selection__choice__remove {
        color: #1E40AF;
    }
</style>
@endpush

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form method="POST" action="{{ url('/cms/tutorial') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-section">
                    <div class="form-section-title">Informasi Dasar</div>
                    <div class="form-section-divider"></div>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label">Judul</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kategori</label>
                            <input type="text" name="kategori" class="form-control" placeholder="Pengenalan, Voucher & Akun, Konfigurasi" required>
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="form-label">Deskripsi (Singkat)</label>
                        <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="row g-4 mt-2">
                        <div class="col-md-8">
                            <label class="form-label">Penulis</label>
                            <input type="text" name="penulis" class="form-control" value="{{ session('admin_name') }}" readonly>
                            <small class="text-muted">Nama penulis otomatis dari user yang login.</small>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Urutan</label>
                            <input type="number" name="urutan" class="form-control" value="0">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-section-title">Thumbnail</div>
                    <div class="form-section-divider"></div>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label">Upload Thumbnail (jpeg, png, jpg, webp, max 2MB)</label>
                            <input type="file" name="thumbnail" class="form-control" accept="image/jpeg,image/png,image/jpg,image/webp" id="thumbnailInput">
                            <img class="thumbnail-preview" id="thumbnailPreview" alt="Preview">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-section-title">Konten</div>
                    <div class="form-section-divider"></div>
                    <textarea name="konten" id="editor" rows="10"></textarea>
                </div>

                <div class="form-section">
                    <div class="form-section-title">Tags</div>
                    <div class="form-section-divider"></div>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <select name="tags[]" class="form-select tags-select" multiple>
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">Ketik untuk mencari tag atau klik untuk memilih.</small>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-section-title">Pengaturan</div>
                    <div class="form-section-divider"></div>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input type="checkbox" name="is_featured" class="form-check-input" id="isFeatured" value="1" checked>
                                <label class="form-check-label" for="isFeatured">Tampil di Halaman Home</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input type="checkbox" name="is_active" class="form-check-input" id="isActive" value="1" checked>
                                <label class="form-check-label" for="isActive">Aktif</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-5 pt-3 border-top d-flex justify-content-end gap-2">
                    <a href="{{ url('/cms/tutorial') }}" class="btn btn-outline-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-primary px-4 shadow-sm">
                        <i class="fa-solid fa-save me-1"></i> Simpan Tutorial
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script src="{{ asset('admin/js/ckeditor-video/videouploadadapter.js') }}"></script>
<script src="{{ asset('admin/js/ckeditor-video/videodialog.js') }}"></script>
<script src="{{ asset('admin/js/ckeditor-video/videoediting.js') }}"></script>
<script src="{{ asset('admin/js/ckeditor-video/videoui.js') }}"></script>
<script src="{{ asset('admin/js/ckeditor-video/index.js') }}"></script>
<script>
    class CkUploadAdapter {
        constructor(loader) {
            this.loader = loader;
        }
        upload() {
            return this.loader.file.then(file => new Promise((resolve, reject) => {
                const isVideo = file.type.startsWith('video/');
                const data = new FormData();
                data.append('upload', file);
                fetch(isVideo ? '/cms/upload-video' : '/cms/upload-image', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                    body: data
                })
                .then(r => r.json())
                .then(r => {
                    if (!r.url) return reject(r.message || 'Upload gagal');
                    resolve({ default: r.url });
                })
                .catch(reject);
            }));
        }
        abort() {}
    }
    function CkUploadAdapterPlugin(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = loader => new CkUploadAdapter(loader);
    }

    $('.tags-select').select2({
        theme: 'bootstrap-5',
        placeholder: 'Pilih tag...',
        closeOnSelect: false,
        width: '100%'
    });

    ClassicEditor.create(document.querySelector('#editor'), {
        extraPlugins: [CkUploadAdapterPlugin, CKVideoPlugin],
        toolbar: {
            items: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'imageUpload', 'video', 'mediaEmbed', '|', 'undo', 'redo']
        },
        image: {
            toolbar: ['imageTextAlternative', 'imageStyle:inline', 'imageStyle:block', 'imageStyle:side']
        },
        mediaEmbed: {
            previewsInData: true,
            extraProviders: [
                {
                    name: 'video-direct',
                    url: /\.(mp4|webm|ogg)(\?.*)?$/i,
                    html: match => `<video src="${match[0]}" controls style="max-width: 100%; border-radius: 8px;"></video>`
                },
                {
                    name: 'facebook-video',
                    url: /^https?:\/\/(www\.)?(facebook\.com|fb\.com)\/.*\/videos\/.*/i,
                    html: match => {
                        const url = encodeURIComponent(match[0]);
                        return `<div style="position: relative; padding-bottom: 56.25%; height: 0;"><iframe src="https://www.facebook.com/plugins/video.php?href=${url}&show_text=false" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" frameborder="0" allowfullscreen></iframe></div>`;
                    }
                },
                {
                    name: 'tiktok',
                    url: /^https?:\/\/(www\.)?tiktok\.com\/@.+\/video\/\d+/i,
                    html: match => {
                        const embedUrl = match[0].replace('/video/', '/embed/v2/');
                        return `<div style="position: relative; padding-bottom: 56.25%; height: 0;"><iframe src="${embedUrl}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" frameborder="0" allowfullscreen></iframe></div>`;
                    }
                }
            ]
        }
    }).catch(error => {
        console.error(error);
    });

    document.getElementById('thumbnailInput')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                const preview = document.getElementById('thumbnailPreview');
                preview.src = ev.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
