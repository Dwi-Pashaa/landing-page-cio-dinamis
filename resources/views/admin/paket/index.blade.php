@extends('admin.layouts.admin')

@section('title', 'Paket Internet - Admin CIO')
@section('page_title', 'Paket Internet')
@section('page_subtitle', 'Kelola paket internet yang ditampilkan di halaman utama')

@section('content')
    <div class="page-header mb-4">
        <div>
            <h1 class="mb-1">Paket Internet</h1>
            <div class="page-header-sub">Kelola paket internet yang ditampilkan di halaman utama</div>
        </div>
        <a href="{{ url('/cms/paket/create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus me-1"></i> Tambah Paket
        </a>
    </div>

    <x-admin.data-table
        id="paketTable"
        :headers="[
            ['label' => 'Nama', 'sort' => 'nama'],
            ['label' => 'Tipe', 'sort' => 'tipe'],
            ['label' => 'Harga', 'sort' => 'harga'],
            ['label' => 'Periode', 'sort' => 'periode'],
            ['label' => 'Rekomendasi', 'sort' => 'is_rekomendasi'],
            ['label' => 'Featured', 'sort' => 'is_featured'],
            ['label' => 'Aktif', 'sort' => 'is_active'],
            ['label' => 'Aksi', 'width' => '100px'],
        ]"
    >
        @forelse($pakets as $paket)
            <tr>
                <td class="fw-semibold">{{ $paket->nama }}</td>
                <td><span class="badge badge-pastel-blue">{{ ucfirst($paket->tipe) }}</span></td>
                <td class="fw-semibold">Rp{{ number_format($paket->harga, 0, ',', '.') }}</td>
                <td style="color: var(--admin-text-secondary);">{{ $paket->periode }}</td>
                <td>
                    @if($paket->is_rekomendasi)
                        <span class="badge badge-solid-amber"><i class="fa-solid fa-star me-1"></i>Rekomendasi</span>
                    @else
                        <span style="color: var(--admin-text-muted); font-size: 13px;">—</span>
                    @endif
                </td>
                <td>
                    <form action="{{ url('/cms/paket/' . $paket->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="tipe" value="{{ $paket->tipe }}">
                        <input type="hidden" name="nama" value="{{ $paket->nama }}">
                        <input type="hidden" name="harga" value="{{ $paket->harga }}">
                        <input type="hidden" name="periode" value="{{ $paket->periode }}">
                        <input type="hidden" name="is_featured" value="{{ $paket->is_featured ? 0 : 1 }}">
                        <div class="form-check form-switch mb-0">
                            <input type="checkbox" class="form-check-input toggle-switch" {{ $paket->is_featured ? 'checked' : '' }} onchange="this.form.submit()">
                        </div>
                    </form>
                </td>
                <td>
                    <form action="{{ url('/cms/paket/' . $paket->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="tipe" value="{{ $paket->tipe }}">
                        <input type="hidden" name="nama" value="{{ $paket->nama }}">
                        <input type="hidden" name="harga" value="{{ $paket->harga }}">
                        <input type="hidden" name="periode" value="{{ $paket->periode }}">
                        <input type="hidden" name="is_active" value="{{ $paket->is_active ? 0 : 1 }}">
                        <div class="form-check form-switch mb-0">
                            <input type="checkbox" class="form-check-input toggle-switch" {{ $paket->is_active ? 'checked' : '' }} onchange="this.form.submit()">
                        </div>
                    </form>
                </td>
                <td>
                    <div class="action-btns">
                        <a href="{{ url('/cms/paket/' . $paket->id . '/edit') }}" class="action-btn action-btn-edit" data-bs-toggle="tooltip" title="Edit Paket">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <form action="{{ url('/cms/paket/' . $paket->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn action-btn-delete" data-delete data-confirm="Hapus paket &quot;{{ $paket->nama }}&quot;?" data-bs-toggle="tooltip" title="Hapus Paket">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr id="emptyRow">
                <td colspan="8">
                    <div class="empty-state">
                        <div class="empty-state-icon"><i class="fa-solid fa-wifi"></i></div>
                        <h3 class="empty-state-title">Belum Ada Paket</h3>
                        <p class="empty-state-desc">Mulai dengan menambahkan paket internet pertama Anda.</p>
                        <a href="{{ url('/cms/paket/create') }}" class="btn btn-primary">
                            <i class="fa-solid fa-plus me-1"></i> Tambah Paket
                        </a>
                    </div>
                </td>
            </tr>
        @endforelse
    </x-admin.data-table>
@endsection
