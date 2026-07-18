@extends('admin.layouts.admin')

@section('title', 'Kelola User')
@section('page_title', 'Kelola User')
@section('page_subtitle', 'Daftar semua pengguna CMS')

@push('styles')
<style>
    .user-avatar-table {
        width: 38px; height: 38px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 10px; font-weight: 700; font-size: 14px;
        color: #fff; flex-shrink: 0;
    }
    .user-avatar-colors {
        background: #4f46e5;
    }
    .user-avatar-colors:nth-child(5n+2) { background: #0891b2; }
    .user-avatar-colors:nth-child(5n+3) { background: #059669; }
    .user-avatar-colors:nth-child(5n+4) { background: #d97706; }
    .user-avatar-colors:nth-child(5n+5) { background: #dc2626; }
</style>
@endpush

@section('content')
<div class="page-header mb-4">
    <div>
        <h1 class="mb-1">@yield('page_title')</h1>
        <div class="page-header-sub">@yield('page_subtitle')</div>
    </div>
    @can('create-users')
    <a href="{{ url('/cms/users/create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus me-1"></i> Tambah User
    </a>
    @endcan
</div>

<x-admin.data-table
    id="usersTable"
    :headers="[
        ['label' => 'User', 'sort' => 'name'],
        ['label' => 'Username', 'sort' => 'username'],
        ['label' => 'Email', 'sort' => 'email'],
        ['label' => 'Level'],
        ['label' => 'Status', 'sort' => 'status'],
        ['label' => 'Aksi', 'width' => '100px'],
    ]"
>
    @forelse($users as $user)
        <tr>
            <td>
                <div class="d-flex align-items-center gap-3">
                    <div class="user-avatar-table user-avatar-colors" style="background: {{ ['#4f46e5','#0891b2','#059669','#d97706','#dc2626'][$loop->index % 5] }}">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="fw-semibold">{{ $user->name }}</div>
                        <div class="text-muted small">ID: #{{ $user->id }}</div>
                    </div>
                </div>
            </td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>
                @foreach($user->roles as $role)
                    <span class="badge badge-pastel-blue px-3 py-2 rounded-pill">
                        <i class="fa-solid fa-shield-halved me-1" style="font-size: 10px;"></i>{{ $role->name }}
                    </span>
                @endforeach
            </td>
            <td>
                @if($user->is_active)
                    <span class="badge badge-solid-green px-3 py-2 rounded-pill">
                        <i class="fa-regular fa-circle-check me-1"></i> Aktif
                    </span>
                @else
                    <span class="badge badge-solid-red px-3 py-2 rounded-pill">
                        <i class="fa-regular fa-circle-xmark me-1"></i> Nonaktif
                    </span>
                @endif
            </td>
            <td>
                <div class="action-btns">
                    @can('edit-users')
                    <a href="{{ url('/cms/users/' . $user->id . '/edit') }}" class="action-btn action-btn-edit" data-bs-toggle="tooltip" title="Edit User">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                    @endcan
                    @can('delete-users')
                    @if(!$user->hasRole('Super Admin'))
                    <form action="{{ url('/cms/users/' . $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn action-btn-delete" data-delete data-confirm="Hapus user &quot;{{ $user->name }}&quot;?" data-bs-toggle="tooltip" title="Hapus User">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                    @endif
                    @endcan
                </div>
            </td>
        </tr>
    @empty
        <tr id="emptyRow">
            <td colspan="6">
                <div class="empty-state">
                    <div class="empty-state-icon"><i class="fa-solid fa-users"></i></div>
                    <h3 class="empty-state-title">Belum Ada User</h3>
                    <p class="empty-state-desc">Mulai dengan menambahkan pengguna CMS pertama.</p>
                    <a href="{{ url('/cms/users/create') }}" class="btn btn-primary">
                        <i class="fa-solid fa-plus me-1"></i> Tambah User
                    </a>
                </div>
            </td>
        </tr>
    @endforelse
</x-admin.data-table>
@endsection
