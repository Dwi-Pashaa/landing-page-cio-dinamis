@extends('admin.layouts.admin')

@section('title', 'Kelola Level')
@section('page_title', 'Kelola Level')
@section('page_subtitle', 'Atur level pengguna dan hak aksesnya')

@section('content')
<div class="page-header mb-4">
    <div>
        <h1 class="mb-1">@yield('page_title')</h1>
        <div class="page-header-sub">@yield('page_subtitle')</div>
    </div>
    @can('create-roles')
    <a href="{{ url('/cms/roles/create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus me-1"></i> Tambah Level
    </a>
    @endcan
</div>

<x-admin.data-table
    id="rolesTable"
    :headers="[
        ['label' => 'Level', 'sort' => 'name'],
        ['label' => 'Guard', 'sort' => 'guard'],
        ['label' => 'Total Permission', 'sort' => 'permissions_count'],
        ['label' => 'Total User', 'sort' => 'users_count'],
        ['label' => 'Aksi', 'width' => '100px'],
    ]"
>
    @forelse($roles as $role)
        <tr>
            <td>
                <div class="d-flex align-items-center gap-2">
                    @if($role->name === 'Super Admin')
                        <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 32px; height: 32px; background: linear-gradient(135deg, #F59E0B, #EF4444); color: #fff; font-size: 14px; flex-shrink: 0;">
                            <i class="fa-solid fa-crown"></i>
                        </div>
                    @elseif($role->name === 'Admin')
                        <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 32px; height: 32px; background: linear-gradient(135deg, #3B82F6, #6366F1); color: #fff; font-size: 14px; flex-shrink: 0;">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                    @else
                        <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 32px; height: 32px; background: linear-gradient(135deg, #10B981, #06B6D4); color: #fff; font-size: 14px; flex-shrink: 0;">
                            <i class="fa-solid fa-user-gear"></i>
                        </div>
                    @endif
                    <div>
                        <div class="fw-semibold">{{ $role->name }}</div>
                        @if($role->name === 'Super Admin')
                            <div class="text-muted small" style="font-size: 11px;">Akses penuh</div>
                        @endif
                    </div>
                </div>
            </td>
            <td><span class="badge bg-secondary px-3 py-2 rounded-pill">{{ $role->guard_name }}</span></td>
            <td>
                <span class="badge badge-pastel-indigo px-3 py-2 rounded-pill">
                    <i class="fa-solid fa-key me-1"></i> {{ $role->permissions->count() }} permission
                </span>
            </td>
            <td>
                <span class="badge badge-pastel-blue px-3 py-2 rounded-pill">
                    <i class="fa-solid fa-users me-1"></i> {{ $role->users_count }} user
                </span>
            </td>
            <td>
                <div class="action-btns">
                    @can('edit-roles')
                    <a href="{{ url('/cms/roles/' . $role->id . '/edit') }}" class="action-btn action-btn-edit" data-bs-toggle="tooltip" title="Edit Level">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                    @endcan
                    @can('delete-roles')
                    @if($role->name !== 'Super Admin')
                    <form action="{{ url('/cms/roles/' . $role->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn action-btn-delete" data-delete data-confirm="Hapus level &quot;{{ $role->name }}&quot;?" data-bs-toggle="tooltip" title="Hapus Level">
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
            <td colspan="5">
                <div class="empty-state">
                    <div class="empty-state-icon"><i class="fa-solid fa-shield-halved"></i></div>
                    <h3 class="empty-state-title">Belum Ada Level</h3>
                    <p class="empty-state-desc">Buat level pengguna dan atur hak aksesnya.</p>
                    <a href="{{ url('/cms/roles/create') }}" class="btn btn-primary">
                        <i class="fa-solid fa-plus me-1"></i> Tambah Level
                    </a>
                </div>
            </td>
        </tr>
    @endforelse
</x-admin.data-table>
@endsection
