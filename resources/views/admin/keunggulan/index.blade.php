@extends('admin.layouts.admin')

@section('title', 'Keunggulan - Admin CIO')
@section('page_title', 'Keunggulan')

@section('content')
    <div class="page-header mb-4">
        <div>
            <h1 class="mb-1">Keunggulan</h1>
            <div class="page-header-sub">Kelola poin keunggulan perusahaan</div>
        </div>
        <a href="{{ url('/cms/keunggulan/create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus me-1"></i> Tambah Keunggulan
        </a>
    </div>

    <x-admin.data-table
        id="keunggulanTable"
        :headers="[
            ['label' => 'Urutan', 'sort' => 'urutan', 'width' => '80px'],
            ['label' => 'Ikon'],
            ['label' => 'Judul', 'sort' => 'judul'],
            ['label' => 'Aksi', 'width' => '100px'],
        ]"
    >
        @forelse($keunggulans as $keunggulan)
            <tr>
                <td class="fw-semibold">{{ $keunggulan->urutan }}</td>
                <td>
                    <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 36px; height: 36px; background: var(--admin-accent-light); color: var(--admin-accent);">
                        <i class="fa-solid {{ $keunggulan->icon_class }}"></i>
                    </div>
                </td>
                <td class="fw-semibold">{{ $keunggulan->judul }}</td>
                <td>
                    <div class="action-btns">
                        <a href="{{ url('/cms/keunggulan/' . $keunggulan->id . '/edit') }}" class="action-btn action-btn-edit" data-bs-toggle="tooltip" title="Edit Keunggulan">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <form action="{{ url('/cms/keunggulan/' . $keunggulan->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn action-btn-delete" data-delete data-confirm="Hapus keunggulan &quot;{{ $keunggulan->judul }}&quot;?" data-bs-toggle="tooltip" title="Hapus Keunggulan">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr id="emptyRow">
                <td colspan="4">
                    <div class="empty-state">
                        <div class="empty-state-icon"><i class="fa-solid fa-star"></i></div>
                        <h3 class="empty-state-title">Belum Ada Keunggulan</h3>
                        <p class="empty-state-desc">Tambahkan poin keunggulan perusahaan Anda.</p>
                        <a href="{{ url('/cms/keunggulan/create') }}" class="btn btn-primary">
                            <i class="fa-solid fa-plus me-1"></i> Tambah Keunggulan
                        </a>
                    </div>
                </td>
            </tr>
        @endforelse
    </x-admin.data-table>
@endsection
