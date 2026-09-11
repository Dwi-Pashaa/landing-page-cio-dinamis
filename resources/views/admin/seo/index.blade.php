@extends('admin.layouts.admin')

@section('title', 'SEO - Admin CIO')
@section('page_title', 'SEO Management')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form method="POST" action="{{ url('/cms/seo') }}">
                @csrf
                @method('PUT')

                <ul class="nav nav-tabs" id="seoTabs" role="tablist">
                    @php $pages = [
                        'home' => 'Beranda',
                        'tentang-kami' => 'Tentang Kami',
                        'paket-internet' => 'Paket Internet',
                        'tutorial' => 'Tutorial',
                        'kontak' => 'Kontak'
                    ] @endphp
                    @foreach($pages as $key => $label)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="{{ $key }}-tab" data-bs-toggle="tab" data-bs-target="#{{ $key }}" type="button" role="tab">
                                {{ $label }}
                            </button>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content" id="seoTabContent">
                    @foreach($pages as $key => $label)
                        @php $seo = $seoSettings->get($key) @endphp
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $key }}" role="tabpanel">
                            <input type="hidden" name="{{ $key }}[page_label]" value="{{ $label }}">

                            <div class="row g-4">
                                <div class="col-lg-7">
                                    <div class="mb-3">
                                        <label class="form-label">Meta Title</label>
                                        <input type="text" name="{{ $key }}[meta_title]" class="form-control"
                                            value="{{ old($key . '.meta_title', $seo->meta_title ?? '') }}" maxlength="60"
                                            placeholder="Judul halaman (max 60 karakter)">
                                        <div class="char-counter {{ isset($seo->meta_title) && strlen($seo->meta_title) <= 60 ? 'success' : '' }}">
                                            {{ strlen($seo->meta_title ?? '') }}/60
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Meta Description</label>
                                        <textarea name="{{ $key }}[meta_description]" class="form-control" maxlength="160"
                                            placeholder="Deskripsi halaman (max 160 karakter)">{{ old($key . '.meta_description', $seo->meta_description ?? '') }}</textarea>
                                        <div class="char-counter {{ isset($seo->meta_description) && strlen($seo->meta_description) <= 160 ? 'success' : '' }}">
                                            {{ strlen($seo->meta_description ?? '') }}/160
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Meta Keywords</label>
                                        <input type="text" name="{{ $key }}[meta_keywords]" class="form-control"
                                            value="{{ old($key . '.meta_keywords', $seo->meta_keywords ?? '') }}"
                                            placeholder="keyword1, keyword2, keyword3">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">OG Title</label>
                                        <input type="text" name="{{ $key }}[og_title]" class="form-control"
                                            value="{{ old($key . '.og_title', $seo->og_title ?? '') }}"
                                            placeholder="Judul untuk share sosial media">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">OG Description</label>
                                        <textarea name="{{ $key }}[og_description]" class="form-control"
                                            placeholder="Deskripsi untuk share sosial media">{{ old($key . '.og_description', $seo->og_description ?? '') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-5">
                                    <label class="form-label">Preview Google Search</label>
                                    <div class="seo-preview-card mb-3">
                                        <div class="preview-url">cionetwork.id/{{ $key === 'home' ? '' : $key }}</div>
                                        <div class="preview-title">{{ $seo->meta_title ?? $label . ' - PT CIO NETWORK NUSANTARA' }}</div>
                                        <div class="preview-desc">{{ $seo->meta_description ?? '' }}</div>
                                    </div>

                                    <label class="form-label">Preview Facebook Share (OG)</label>
                                    <div class="seo-preview-card">
                                        <div class="preview-url">cionetwork.id</div>
                                        <div class="preview-title">{{ $seo->og_title ?? $seo->meta_title ?? $label }}</div>
                                        <div class="preview-desc">{{ $seo->og_description ?? $seo->meta_description ?? '' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-5 pt-3 border-top d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-5 shadow-sm">
                        <i class="fa-solid fa-save me-1"></i> Simpan Semua SEO
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
