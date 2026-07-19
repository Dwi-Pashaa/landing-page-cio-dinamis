@extends('layouts.app')

@section('title', $tutorial->judul . ' - Cio Network Solution')
@section('meta_keywords', $seo->meta_keywords ?? '')
@section('meta_description', $seo->meta_description ?? Str::limit(strip_tags($tutorial->deskripsi), 160))

@push('additional_css')
<style>
    .page-hero-title {
        font-size: 36px;
        font-weight: 800;
        letter-spacing: -1px;
        color: var(--text-title);
        margin-bottom: 15px;
    }
    @media (max-width: 767px) {
        .page-hero-title { font-size: 28px; }
    }
    @media (max-width: 575px) {
        .page-hero-title { font-size: 24px; }
    }

    .article-body h1, .article-body h2, .article-body h3 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-weight: 700;
        line-height: 1.3;
        color: var(--text-title);
    }
    .article-body h1 { font-size: 28px; }
    .article-body h2 { font-size: 24px; }
    .article-body h3 { font-size: 20px; }
    .article-body h4 { font-size: 18px; font-weight: 600; }
    .article-body p {
        margin-bottom: 1.25rem;
        line-height: 1.8;
        color: var(--text-main);
        font-size: 16px;
    }
    .article-body ul, .article-body ol {
        margin-bottom: 1.25rem;
        padding-left: 1.5rem;
    }
    .article-body li {
        margin-bottom: 0.4rem;
        line-height: 1.7;
        color: var(--text-main);
    }
    .article-body img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        margin: 1.5rem 0;
        box-shadow: var(--shadow-card);
    }
    .article-body table {
        width: 100%;
        margin-bottom: 1.5rem;
        border-collapse: collapse;
        font-size: 15px;
    }
    .article-body table thead {
        background: rgba(37, 99, 235, 0.05);
    }
    .article-body table th {
        border: 1px solid #e2e8f0;
        padding: 12px 16px;
        font-weight: 600;
        color: var(--text-title);
        text-align: left;
        white-space: nowrap;
    }
    .article-body table td {
        border: 1px solid #e2e8f0;
        padding: 10px 16px;
        color: var(--text-main);
    }
    .article-body table tbody tr:nth-child(even) {
        background: rgba(148, 163, 184, 0.05);
    }
    .article-body table tbody tr:hover {
        background: rgba(37, 99, 235, 0.03);
    }
    .article-body blockquote {
        border-left: 4px solid var(--accent-blue);
        padding: 1rem 1.5rem;
        margin: 1.5rem 0;
        background: rgba(37, 99, 235, 0.03);
        border-radius: 0 8px 8px 0;
        color: var(--text-muted);
        font-style: italic;
        font-size: 16px;
    }
    .article-body pre {
        background: #1e293b;
        color: #e2e8f0;
        padding: 1.25rem 1.5rem;
        border-radius: 12px;
        overflow-x: auto;
        margin: 1.5rem 0;
        font-size: 14px;
        line-height: 1.6;
    }
    .article-body code {
        background: rgba(37, 99, 235, 0.08);
        color: var(--accent-blue);
        padding: 2px 6px;
        border-radius: 4px;
        font-size: 14px;
    }
    .article-body pre code {
        background: transparent;
        color: inherit;
        padding: 0;
        border-radius: 0;
    }
    .article-body a {
        color: var(--accent-blue);
        text-decoration: underline;
        text-underline-offset: 2px;
    }
    .article-body a:hover {
        color: #1d4ed8;
    }
    .article-body hr {
        border: none;
        height: 1px;
        background: var(--border-card);
        margin: 2rem 0;
    }
    .article-body figure {
        margin: 1.5rem 0;
    }
    /* Fix CKEditor 5 and Bootstrap 4 .media class conflict */
    .article-body figure.media {
        display: block;
        width: 100%;
    }
    .article-body figure.media > div {
        width: 100%;
    }
    .article-body figcaption {
        text-align: center;
        font-size: 14px;
        color: var(--text-muted);
        margin-top: 0.5rem;
    }
    .article-body {
        color: var(--text-main);
        font-size: 16px;
        line-height: 1.8;
    }

    .article-card {
        transition: box-shadow var(--transition-smooth);
    }
    .article-card:hover {
        box-shadow: var(--shadow-card-hover);
        transform: none;
    }

    @media (max-width: 575px) {
        .article-body { font-size: 15px; }
        .article-body table { font-size: 14px; }
        .article-body table th,
        .article-body table td { padding: 8px 10px; white-space: normal; }
    }
</style>
@endpush

@section('content')
    <section class="hero-section" style="min-height: auto; padding: 140px 0 60px 0;">
        <div class="hero-shapes">
            <div class="shape-glow glow-1" style="width: 250px; height: 250px;"></div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 hero-content text-left">
                    <a href="{{ url('/tutorial') }}" class="text-white-50 text-decoration-none mb-3 d-inline-block">
                        <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Tutorial
                    </a>
                    <span class="badge badge-indigo mb-3">{{ $tutorial->kategori }}</span>
                    <h1 class="page-hero-title">{{ $tutorial->judul }}</h1>
                    <div class="d-flex flex-wrap gap-3 text-white-50" style="font-size: 14px;">
                        @if($tutorial->penulis)
                            <span><i class="fa-solid fa-user me-1"></i> {{ $tutorial->penulis }}</span>
                        @endif
                        <span><i class="fa-solid fa-calendar me-1"></i> {{ $tutorial->created_at ? $tutorial->created_at->format('d M Y') : '-' }}</span>
                        <span><i class="fa-solid fa-eye me-1"></i> {{ number_format($tutorial->dilihat) }} dilihat</span>
                    </div>
                    @if($tutorial->tags->count())
                        <div class="mt-3">
                            @foreach($tutorial->tags as $tag)
                                <span class="badge badge-indigo me-1" style="font-size: 12px; padding: 4px 10px;">#{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="about-section layout_padding py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="glass-card article-card p-4 p-md-5">
                        @if($tutorial->thumbnail)
                            <div class="mb-4" style="border-radius: 12px; overflow: hidden; max-height: 400px;">
                                <img src="{{ asset('storage/' . $tutorial->thumbnail) }}" alt="{{ $tutorial->judul }}"
                                     style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        @else
                            <div class="mb-4 d-flex align-items-center justify-content-center"
                                 style="border-radius: 12px; overflow: hidden; height: 300px; background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);">
                                <div class="text-center text-white">
                                    <i class="fa-solid fa-book-open" style="font-size: 64px; opacity: 0.6; margin-bottom: 12px; display: block;"></i>
                                    <span style="font-size: 15px; opacity: 0.7; letter-spacing: 0.5px;">{{ $tutorial->kategori ?? 'Tutorial' }}</span>
                                </div>
                            </div>
                        @endif

                        <div class="article-body">
                            {!! $tutorial->konten !!}
                        </div>
                    </div>

                    <hr class="my-5" style="border: none; height: 1px; background: var(--border-card);">

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <a href="{{ url('/tutorial') }}" class="btn btn-outline-indigo">
                            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Tutorial
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($tutorial->judul . ' - ' . url('/tutorial/' . $tutorial->slug)) }}"
                           target="_blank" class="btn" style="background: #25D366; border-color: #25D366; color: #fff; font-weight: 700; border-radius: 8px; padding: 12px 30px; transition: var(--transition-smooth);">
                            <i class="fa-brands fa-whatsapp me-1"></i> Bagikan via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('additional_js')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.article-body oembed').forEach(element => {
            const url = element.getAttribute('url');
            if (!url) return;

            let embedHtml = '';
            
            // YouTube regex pattern
            const ytRegex = /^(?:https?:\/\/)?(?:www\.)?(?:m\.)?(?:youtube\.com|youtu\.be)\/(?:watch\?v=|embed\/|v\/)?([a-zA-Z0-9_-]{11})(?:&.*|[\?#].*)?$/i;
            const ytMatch = url.match(ytRegex);
            
            if (ytMatch) {
                const id = ytMatch[1];
                embedHtml = `<div style="position: relative; padding-bottom: 56.25%; height: 0; border-radius: 12px; overflow: hidden; margin: 1.5rem 0; box-shadow: var(--shadow-card);"><iframe src="https://www.youtube.com/embed/${id}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe></div>`;
            }
            
            // Google Drive video regex pattern
            const gdRegex = /^https?:\/\/drive\.google\.com\/file\/d\/([a-zA-Z0-9_-]+)/i;
            const gdMatch = url.match(gdRegex);
            if (gdMatch) {
                const id = gdMatch[1];
                embedHtml = `<div style="position: relative; padding-bottom: 56.25%; height: 0; border-radius: 12px; overflow: hidden; margin: 1.5rem 0; box-shadow: var(--shadow-card);"><iframe src="https://drive.google.com/file/d/${id}/preview" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;" allow="autoplay" allowfullscreen></iframe></div>`;
            }
            
            // Vimeo regex pattern
            const vimeoRegex = /^(?:https?:\/\/)?(?:www\.)?vimeo\.com\/(\d+)(?:&.*|[\?#].*)?$/i;
            const vimeoMatch = url.match(vimeoRegex);
            if (vimeoMatch) {
                const id = vimeoMatch[1];
                embedHtml = `<div style="position: relative; padding-bottom: 56.25%; height: 0; border-radius: 12px; overflow: hidden; margin: 1.5rem 0; box-shadow: var(--shadow-card);"><iframe src="https://player.vimeo.com/video/${id}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe></div>`;
            }

            if (embedHtml) {
                const figure = element.closest('figure.media');
                if (figure) {
                    figure.outerHTML = embedHtml;
                } else {
                    element.outerHTML = embedHtml;
                }
            }
        });
    });
</script>
@endsection

