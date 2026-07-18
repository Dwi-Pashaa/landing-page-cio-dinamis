@php
    $currentUser = \Illuminate\Support\Facades\Auth::user();
@endphp
<header class="admin-topbar">
    <div class="d-flex align-items-center gap-3">
        <button class="sidebar-toggle" id="sidebarToggle" type="button">
            <i class="fa-solid fa-bars"></i>
        </button>
        <div>
            <div class="topbar-title">@yield('page_title', 'Dashboard')</div>
            <div class="page-header-sub">@yield('page_subtitle')</div>
        </div>
    </div>
    <div class="topbar-right">
        <div class="dropdown">
            <button class="btn d-flex align-items-center gap-2 border-0 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="topbar-avatar">
                    {{ substr(session('admin_name', 'A'), 0, 1) }}
                </div>
                <span class="d-none d-md-inline" style="font-size: 13px; font-weight: 600; color: var(--admin-text);">{{ session('admin_name', 'Admin') }}</span>
                <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-pill d-none d-md-inline" style="font-size: 11px;">
                    {{ $currentUser?->roles->first()?->name ?? 'Admin' }}
                </span>
                <i class="fa-solid fa-chevron-down" style="font-size: 10px; color: var(--admin-text-muted);"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-xl py-2" style="border-radius: 12px; min-width: 200px;">
                <li>
                    <div class="px-3 py-2 text-muted small">
                        <div class="fw-semibold text-dark">{{ session('admin_name') }}</div>
                        <div>{{ $currentUser?->email ?? '' }}</div>
                    </div>
                </li>
                <li><hr class="dropdown-divider my-1"></li>
                <li>
                    <a class="dropdown-item py-2" href="{{ url('/') }}" target="_blank">
                        <i class="fa-solid fa-eye me-2" style="width: 16px;"></i> Lihat Situs
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item py-2 text-danger">
                            <i class="fa-solid fa-right-from-bracket me-2" style="width: 16px;"></i> Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>
