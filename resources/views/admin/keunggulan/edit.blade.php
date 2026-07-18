@extends('admin.layouts.admin')

@section('title', 'Edit Keunggulan - Admin CIO')
@section('page_title', 'Edit Keunggulan')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form method="POST" action="{{ url('/cms/keunggulan/' . $keunggulan->id) }}">
                @csrf
                @method('PUT')

                <div class="form-section">
                    <div class="form-section-title">Informasi Keunggulan</div>
                    <div class="form-section-divider"></div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <x-icon-picker name="icon_class" :value="$keunggulan->icon_class ?? ''" label="Icon FA Class" />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Gradient Class</label>
                        <select name="gradient_class" class="form-select">
                            <option value="">Pilih Gradient</option>
                            @foreach(['bg-gradient-blue', 'bg-gradient-purple', 'bg-gradient-pink', 'bg-gradient-orange'] as $grad)
                                <option value="{{ $grad }}" {{ $keunggulan->gradient_class == $grad ? 'selected' : '' }}>{{ ucfirst(str_replace('bg-gradient-', '', $grad)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="urutan" class="form-control" value="{{ $keunggulan->urutan }}">
                    </div>
                </div>
                <div class="mt-4">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" value="{{ $keunggulan->judul }}" required>
                </div>
                <div class="mt-4">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4">{{ $keunggulan->deskripsi }}</textarea>
                </div>
                </div>

                <div class="mt-5 pt-3 border-top d-flex justify-content-end gap-2">
                    <a href="{{ url('/cms/keunggulan') }}" class="btn btn-outline-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-primary shadow-sm px-4">
                        <i class="fa-solid fa-save me-1"></i> Update Keunggulan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
