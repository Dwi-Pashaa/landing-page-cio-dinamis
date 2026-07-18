@extends('admin.layouts.admin')

@section('title', 'Tutorial - Admin CIO')
@section('page_title', 'Tutorial')

@section('content')
    <div class="page-header mb-4">
        <div>
            <h1 class="mb-1">Tutorial</h1>
            <div class="page-header-sub">Kelola artikel tutorial untuk pengguna</div>
        </div>
        <a href="{{ url('/cms/tutorial/create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus me-1"></i> Tambah Tutorial
        </a>
    </div>

    @php
        $catColors = [
            'Pengenalan' => 'badge-pastel-blue',
            'Voucher & Akun' => 'badge-pastel-purple',
            'Konfigurasi' => 'badge-pastel-teal',
            'Jaringan' => 'badge-pastel-orange',
            'Lainnya' => 'badge-pastel-pink',
        ];
        $catSolidColors = [
            'Pengenalan' => 'badge-solid-blue',
            'Voucher & Akun' => 'badge-solid-indigo',
            'Konfigurasi' => 'badge-solid-teal',
            'Jaringan' => 'badge-solid-amber',
            'Lainnya' => 'badge-solid-pink',
        ];
    @endphp

    <x-admin.data-table
        id="tutorialTable"
        :headers="[
            ['label' => ''],
            ['label' => 'Judul', 'sort' => 'judul'],
            ['label' => 'Kategori', 'sort' => 'kategori'],
            ['label' => 'Tags'],
            ['label' => 'Status', 'sort' => 'is_active'],
            ['label' => 'Aksi', 'width' => '100px', 'class' => 'text-center'],
        ]"
        emptyIcon="fa-newspaper"
        emptyTitle="Belum Ada Tutorial"
        emptyDescription="Mulai dengan menambahkan tutorial pertama Anda."
        createUrl="{{ url('/cms/tutorial/create') }}"
        createLabel="Tambah Tutorial"
    >
        @forelse($tutorials as $tutorial)
            <tr data-id="{{ $tutorial->id }}" data-judul="{{ $tutorial->judul }}" data-kategori="{{ $tutorial->kategori }}">
                <td>
                    @if($tutorial->thumbnail)
                        <img src="{{ asset('storage/' . $tutorial->thumbnail) }}" alt="thumb"
                             style="width: 50px; height: 35px; object-fit: cover; border-radius: 6px;">
                    @else
                        <span style="width: 50px; height: 35px; display: inline-flex; align-items: center; justify-content: center; background: var(--admin-bg-card); border-radius: 6px; color: var(--admin-text-muted); font-size: 14px;">
                            <i class="fa-solid fa-image"></i>
                        </span>
                    @endif
                </td>
                <td class="fw-semibold">{{ $tutorial->judul }}</td>
                <td>
                    <span class="badge {{ $catSolidColors[$tutorial->kategori] ?? 'badge-solid-blue' }}">
                        {{ $tutorial->kategori }}
                    </span>
                </td>
                <td>
                    @foreach($tutorial->tags as $tag)
                        <span class="badge bg-secondary bg-opacity-10 text-secondary me-1">{{ $tag->name }}</span>
                    @endforeach
                </td>
                <td>
                    @if($tutorial->is_active)
                        <span class="badge badge-solid-green"><i class="fa-solid fa-check-circle me-1"></i>Aktif</span>
                    @else
                        <span class="badge badge-solid-red"><i class="fa-solid fa-xmark-circle me-1"></i>Nonaktif</span>
                    @endif
                </td>
                <td>
                    <div class="action-btns justify-content-center">
                        <a href="{{ url('/cms/tutorial/' . $tutorial->id . '/edit') }}"
                           class="action-btn action-btn-edit"
                           data-bs-toggle="tooltip"
                           title="Edit Tutorial">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <form action="{{ url('/cms/tutorial/' . $tutorial->id) }}" method="POST" class="d-inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="action-btn action-btn-delete"
                                    data-bs-toggle="tooltip"
                                    title="Hapus Tutorial"
                                    data-delete
                                    data-confirm="Hapus tutorial &quot;{{ $tutorial->judul }}&quot;?">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr id="emptyRow">
                <td colspan="6">
                    <div class="empty-state">
                        <div class="empty-state-icon"><i class="fa-solid fa-newspaper"></i></div>
                        <h3 class="empty-state-title">Belum Ada Tutorial</h3>
                        <p class="empty-state-desc">Mulai dengan menambahkan tutorial pertama Anda.</p>
                        <a href="{{ url('/cms/tutorial/create') }}" class="btn btn-primary">
                            <i class="fa-solid fa-plus me-1"></i> Tambah Tutorial
                        </a>
                    </div>
                </td>
            </tr>
        @endforelse
    </x-admin.data-table>

    <x-admin.toast />
@endsection
