@extends('admin.layouts.admin')

@section('title', 'Edit Level')

@push('styles')
<style>
    .perm-group-card {
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        overflow: hidden;
        transition: all 0.2s ease;
        height: 100%;
        background: #fff;
    }
    .perm-group-card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.06);
        border-color: #CBD5E1;
    }
    .perm-group-header {
        background: linear-gradient(135deg, #F8FAFC, #F1F5F9);
        padding: 14px 16px;
        border-bottom: 1px solid #E2E8F0;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .perm-group-title {
        font-size: 13px;
        font-weight: 700;
        color: #1E293B;
        text-transform: capitalize;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .perm-group-title i {
        width: 20px;
        color: #3B82F6;
        font-size: 14px;
        text-align: center;
    }
    .perm-group-badge {
        background: #EFF6FF;
        color: #2563EB;
        font-size: 11px;
        font-weight: 700;
        padding: 2px 10px;
        border-radius: 20px;
    }
    .perm-group-body {
        padding: 8px;
    }
    .perm-checkbox-wrapper {
        padding: 3px 8px;
        border-radius: 8px;
        transition: all 0.12s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .perm-checkbox-wrapper:hover {
        background: #F8FAFC;
    }
    .perm-checkbox-wrapper .form-check-input {
        margin-top: 0;
        flex-shrink: 0;
    }
    .perm-checkbox-wrapper .form-check-label {
        font-size: 12px;
        color: #475569;
        cursor: pointer;
        padding: 4px 0;
        display: flex;
        align-items: center;
        gap: 6px;
        flex: 1;
        min-width: 0;
    }
    .perm-checkbox-wrapper .form-check-label .perm-action-icon {
        width: 20px;
        height: 20px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        flex-shrink: 0;
    }
    .perm-checkbox-wrapper .form-check-label .perm-label-text {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .perm-checkbox-wrapper .form-check-input:checked ~ .form-check-label {
        color: #1E293B;
        font-weight: 600;
    }
    .perm-group-select-all {
        font-size: 11px;
        color: #3B82F6;
        cursor: pointer;
        font-weight: 600;
        border: none;
        background: none;
        padding: 0;
        transition: color 0.15s;
    }
    .perm-group-select-all:hover {
        color: #1D4ED8;
    }
</style>
@endpush

@section('content')
<div class="page-header mb-4">
    <div>
        <div class="mb-1">
            <a href="{{ url('/cms/roles') }}" class="text-decoration-none text-muted small">
                <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Level
            </a>
        </div>
        <h1 class="mb-1">Edit Level</h1>
        <div class="page-header-sub">Atur hak akses untuk level: <strong>{{ $role->name }}</strong></div>
    </div>
    <div class="d-flex align-items-center gap-2">
        <span class="badge bg-secondary px-3 py-2 rounded-pill">{{ $role->guard_name }}</span>
        <span class="badge badge-pastel-indigo px-3 py-2 rounded-pill">
            <i class="fa-solid fa-key me-1"></i>{{ $role->permissions->count() }} permission
        </span>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="{{ url('/cms/roles/' . $role->id) }}" method="POST" id="roleForm">
            @csrf
            @method('PUT')

            <div class="form-section">
                <div class="form-section-title">Informasi Level</div>
                <div class="form-section-divider"></div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Nama Level</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $role->name) }}" required placeholder="contoh: Editor, Writer, dll">
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="d-flex align-items-center justify-content-between mb-1">
                    <div>
                        <div class="form-section-title">Hak Akses (Permission)</div>
                        <div class="text-muted small">Centang permission yang ingin diberikan ke level ini</div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="document.querySelectorAll('.perm-checkbox').forEach(cb => cb.checked = true); updateCounts();">
                            <i class="fa-solid fa-check-double me-1"></i> Pilih Semua
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="document.querySelectorAll('.perm-checkbox').forEach(cb => cb.checked = false); updateCounts();">
                            <i class="fa-solid fa-xmark me-1"></i> Hapus Semua
                        </button>
                    </div>
                </div>
                <div class="form-section-divider"></div>

                <div class="row g-3">
                    @php
                        $groupIcons = [
                            'dashboard' => 'fa-solid fa-gauge-high',
                            'analytics' => 'fa-solid fa-chart-line',
                            'hero' => 'fa-solid fa-images',
                            'paket' => 'fa-solid fa-wifi',
                            'tutorial' => 'fa-solid fa-graduation-cap',
                            'keunggulan' => 'fa-solid fa-star',
                            'seo' => 'fa-solid fa-magnifying-glass',
                            'settings' => 'fa-solid fa-gear',
                            'users' => 'fa-solid fa-users',
                            'roles' => 'fa-solid fa-shield-halved',
                        ];
                    @endphp
                    @foreach($permissions as $group => $groupPermissions)
                    <div class="col-md-4">
                        <div class="perm-group-card">
                            <div class="perm-group-header">
                                <div class="perm-group-title">
                                    <i class="{{ $groupIcons[$group] ?? 'fa-solid fa-lock' }}"></i>
                                    {{ str_replace('-', ' ', $group) }}
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <button type="button" class="perm-group-select-all" data-group="{{ $group }}">Semua</button>
                                    <span class="perm-group-badge" id="count-{{ $group }}">{{ $groupPermissions->count() }}</span>
                                </div>
                            </div>
                            <div class="perm-group-body">
                                @foreach($groupPermissions as $perm)
                                @php
                                    $parts = explode('-', $perm->name);
                                    $action = $parts[0];
                                    $feature = implode(' ', array_slice($parts, 1));
                                    $actionIcon = $action === 'view' ? 'fa-eye' : ($action === 'create' ? 'fa-plus' : ($action === 'edit' || $action === 'update' ? 'fa-pen' : ($action === 'delete' ? 'fa-trash' : 'fa-check')));
                                @endphp
                                <div class="perm-checkbox-wrapper">
                                    <input class="form-check-input perm-checkbox" type="checkbox" name="permissions[]" value="{{ $perm->id }}" id="perm_{{ $perm->id }}"
                                        data-group="{{ $group }}"
                                        {{ in_array($perm->id, old('permissions', $rolePermissions)) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="perm_{{ $perm->id }}">
                                        <span class="perm-action-icon" style="background: {{ in_array($perm->id, old('permissions', $rolePermissions)) ? '#EFF6FF' : '#F8FAFC' }}; color: {{ in_array($perm->id, old('permissions', $rolePermissions)) ? '#2563EB' : '#94A3B8' }};">
                                            <i class="fa-solid {{ $actionIcon }}"></i>
                                        </span>
                                        <span class="perm-label-text">{{ ucwords($action) }} {{ ucwords($feature) }}</span>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                @error('permissions')<div class="text-danger small mt-3">{{ $message }}</div>@enderror
            </div>

            <hr class="my-4">
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ url('/cms/roles') }}" class="btn btn-secondary px-4">
                    <i class="fa-solid fa-xmark me-1"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fa-solid fa-save me-1"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function updateCounts() {
        document.querySelectorAll('.perm-group-card').forEach(function(card) {
            var checkboxes = card.querySelectorAll('.perm-checkbox');
            var checked = card.querySelectorAll('.perm-checkbox:checked');
            var badge = card.querySelector('.perm-group-badge');
            if (badge) badge.textContent = checked.length + '/' + checkboxes.length;
        });
    }

    document.querySelectorAll('.perm-checkbox').forEach(function(cb) {
        cb.addEventListener('change', function() {
            var label = this.closest('.perm-checkbox-wrapper').querySelector('.perm-action-icon');
            if (label) {
                if (this.checked) {
                    label.style.background = '#EFF6FF';
                    label.style.color = '#2563EB';
                } else {
                    label.style.background = '#F8FAFC';
                    label.style.color = '#94A3B8';
                }
            }
            updateCounts();
        });
    });

    document.querySelectorAll('.perm-group-select-all').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var group = this.getAttribute('data-group');
            var checkboxes = document.querySelectorAll('.perm-checkbox[data-group="' + group + '"]');
            var allChecked = true;
            checkboxes.forEach(function(cb) { if (!cb.checked) allChecked = false; });
            checkboxes.forEach(function(cb) {
                cb.checked = !allChecked;
                var label = cb.closest('.perm-checkbox-wrapper').querySelector('.perm-action-icon');
                if (label) {
                    if (cb.checked) {
                        label.style.background = '#EFF6FF';
                        label.style.color = '#2563EB';
                    } else {
                        label.style.background = '#F8FAFC';
                        label.style.color = '#94A3B8';
                    }
                }
            });
            updateCounts();
        });
    });

    updateCounts();
</script>
@endpush
