@extends('admin.layouts.admin')

@section('title', 'Tags - Admin CIO')
@section('page_title', 'Tags')

@section('content')
    <div class="page-header mb-4">
        <div>
            <h1 class="mb-1">Tags</h1>
            <div class="page-header-sub">Kelola tag untuk tutorial</div>
        </div>
        <a href="{{ url('/cms/tags/create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus me-1"></i> Tambah Tag
        </a>
    </div>

    <x-admin.data-table
        id="tagTable"
        :headers="[
            ['label' => 'Nama Tag'],
            ['label' => 'Slug'],
            ['label' => 'Jumlah Tutorial'],
            ['label' => 'Aksi', 'width' => '100px', 'class' => 'text-center'],
        ]"
        emptyIcon="fa-tags"
        emptyTitle="Belum Ada Tag"
        emptyDescription="Mulai dengan menambahkan tag pertama Anda."
        createUrl="{{ url('/cms/tags/create') }}"
        createLabel="Tambah Tag"
    >
        @forelse($tags as $tag)
            <tr>
                <td class="fw-semibold">{{ $tag->name }}</td>
                <td><code>{{ $tag->slug }}</code></td>
                <td>
                    <span class="badge bg-secondary bg-opacity-10 text-secondary">
                        {{ $tag->tutorials_count }} tutorial
                    </span>
                </td>
                <td>
                    <div class="action-btns justify-content-center">
                        <a href="{{ url('/cms/tags/' . $tag->id . '/edit') }}"
                           class="action-btn action-btn-edit"
                           data-bs-toggle="tooltip"
                           title="Edit Tag">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <form action="{{ url('/cms/tags/' . $tag->id) }}" method="POST" class="d-inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="action-btn action-btn-delete"
                                    data-bs-toggle="tooltip"
                                    title="Hapus Tag"
                                    data-delete
                                    data-confirm="Hapus tag &quot;{{ $tag->name }}&quot;?">
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
                        <div class="empty-state-icon"><i class="fa-solid fa-tags"></i></div>
                        <h3 class="empty-state-title">Belum Ada Tag</h3>
                        <p class="empty-state-desc">Mulai dengan menambahkan tag pertama Anda.</p>
                        <a href="{{ url('/cms/tags/create') }}" class="btn btn-primary">
                            <i class="fa-solid fa-plus me-1"></i> Tambah Tag
                        </a>
                    </div>
                </td>
            </tr>
        @endforelse
    </x-admin.data-table>

    <x-admin.toast />
@endsection
