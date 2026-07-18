@extends('admin.layouts.admin')

@section('title', 'Edit Tag - Admin CIO')
@section('page_title', 'Edit Tag')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form method="POST" action="{{ url('/cms/tags/' . $tag->id) }}">
                @csrf
                @method('PUT')

                <div class="form-section">
                    <div class="form-section-title">Informasi Tag</div>
                    <div class="form-section-divider"></div>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label">Nama Tag</label>
                            <input type="text" name="name" class="form-control" value="{{ $tag->name }}" required>
                            <small class="text-muted">Slug: <code>{{ $tag->slug }}</code></small>
                        </div>
                    </div>
                </div>

                <div class="mt-5 pt-3 border-top d-flex justify-content-end gap-2">
                    <a href="{{ url('/cms/tags') }}" class="btn btn-outline-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-primary px-4 shadow-sm">
                        <i class="fa-solid fa-save me-1"></i> Update Tag
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
