@extends('admin.layouts.admin')

@section('title', 'Tambah Keunggulan - Admin CIO')
@section('page_title', 'Tambah Keunggulan')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form method="POST" action="{{ url('/cms/keunggulan') }}">
                @csrf

                <div class="form-section">
                    <div class="form-section-title">Informasi Keunggulan</div>
                    <div class="form-section-divider"></div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <x-icon-picker name="icon_class" value="" label="Icon FA Class" />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Gradient Class</label>
                        <select name="gradient_class" class="form-select">
                            <option value="">Pilih Gradient</option>
                            <option value="bg-gradient-blue">Blue</option>
                            <option value="bg-gradient-purple">Purple</option>
                            <option value="bg-gradient-pink">Pink</option>
                            <option value="bg-gradient-orange">Orange</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="urutan" class="form-control" value="0">
                    </div>
                </div>
                <div class="mt-4">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>
                <div class="mt-4">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4"></textarea>
                </div>
                </div>

                <div class="mt-5 pt-3 border-top d-flex justify-content-end gap-2">
                    <a href="{{ url('/cms/keunggulan') }}" class="btn btn-outline-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-primary shadow-sm px-4">
                        <i class="fa-solid fa-save me-1"></i> Simpan Keunggulan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
