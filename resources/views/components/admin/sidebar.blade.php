<aside class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-header" style="padding: 16px 14px; border-bottom: 1px solid rgba(255,255,255,0.08);">
        <a href="{{ url('/cms') }}" class="sidebar-brand" style="display: block; text-decoration: none; width: 100%;">
            <div class="sidebar-logos" style="background: #ffffff; border-radius: 10px; padding: 8px 12px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(0,0,0,0.15); width: 100%;">
                <img src="{{ asset('img/logo_baru.png') }}" alt="PT CIO NETWORK NUSANTARA" class="sidebar-logo-img" style="height: 38px; width: auto; max-width: 100%; object-fit: contain; display: block;">
            </div>
        </a>
    </div>
    <nav class="sidebar-nav">
        <ul class="nav-list">
            <li class="nav-section-title">
                <span>Menu</span>
            </li>
            @can('view-dashboard')
            <li class="nav-item {{ request()->routeIs('admin.dashboard') || request()->is('cms') ? 'active' : '' }}">
                <a href="{{ url('/cms') }}" class="nav-link">
                    <i class="fa-solid fa-gauge-high nav-icon"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            @endcan
            @can('view-analytics')
            <li class="nav-item {{ request()->is('cms/analytics*') ? 'active' : '' }}">
                <a href="{{ url('/cms/analytics') }}" class="nav-link">
                    <i class="fa-solid fa-chart-line nav-icon"></i>
                    <span class="nav-label">Analitik</span>
                </a>
            </li>
            @endcan

            <li class="nav-section-title">
                <span>Konten</span>
            </li>
            @can('view-hero')
            <li class="nav-item {{ request()->is('cms/hero*') ? 'active' : '' }}">
                <a href="{{ url('/cms/hero/edit') }}" class="nav-link">
                    <i class="fa-solid fa-window-maximize nav-icon"></i>
                    <span class="nav-label">Hero</span>
                </a>
            </li>
            @endcan
            @can('view-tentang-kami')
            <li class="nav-item {{ request()->is('cms/tentang-kami*') ? 'active' : '' }}">
                <a href="{{ url('/cms/tentang-kami/edit') }}" class="nav-link">
                    <i class="fa-solid fa-address-card nav-icon"></i>
                    <span class="nav-label">Tentang Kami</span>
                </a>
            </li>
            @endcan
            @can('view-paket')
            <li class="nav-item {{ request()->is('cms/paket*') ? 'active' : '' }}">
                <a href="{{ url('/cms/paket') }}" class="nav-link">
                    <i class="fa-solid fa-wifi nav-icon"></i>
                    <span class="nav-label">Paket Internet</span>
                </a>
            </li>
            @endcan
            @can('view-tutorial')
            <li class="nav-item {{ request()->is('cms/tutorial*') ? 'active' : '' }}">
                <a href="{{ url('/cms/tutorial') }}" class="nav-link">
                    <i class="fa-solid fa-newspaper nav-icon"></i>
                    <span class="nav-label">Tutorial</span>
                </a>
            </li>
            @endcan
            @can('view-tags')
            <li class="nav-item {{ request()->is('cms/tags*') ? 'active' : '' }}">
                <a href="{{ url('/cms/tags') }}" class="nav-link">
                    <i class="fa-solid fa-tags nav-icon"></i>
                    <span class="nav-label">Tags</span>
                </a>
            </li>
            @endcan
            @can('view-keunggulan')
            <li class="nav-item {{ request()->is('cms/keunggulan*') ? 'active' : '' }}">
                <a href="{{ url('/cms/keunggulan') }}" class="nav-link">
                    <i class="fa-solid fa-star nav-icon"></i>
                    <span class="nav-label">Keunggulan</span>
                </a>
            </li>
            @endcan

            <li class="nav-section-title">
                <span>Pengaturan</span>
            </li>
            @can('view-seo')
            <li class="nav-item {{ request()->is('cms/seo*') ? 'active' : '' }}">
                <a href="{{ url('/cms/seo') }}" class="nav-link">
                    <i class="fa-solid fa-magnifying-glass nav-icon"></i>
                    <span class="nav-label">SEO</span>
                </a>
            </li>
            @endcan
            @can('view-settings')
            <li class="nav-item {{ request()->is('cms/settings*') ? 'active' : '' }}">
                <a href="{{ url('/cms/settings') }}" class="nav-link">
                    <i class="fa-solid fa-gear nav-icon"></i>
                    <span class="nav-label">Pengaturan</span>
                </a>
            </li>
            @endcan

            <li class="nav-section-title">
                <span>Akses</span>
            </li>
            @can('view-users')
            <li class="nav-item {{ request()->is('cms/users*') ? 'active' : '' }}">
                <a href="{{ url('/cms/users') }}" class="nav-link">
                    <i class="fa-solid fa-users nav-icon"></i>
                    <span class="nav-label">User</span>
                </a>
            </li>
            @endcan
            @can('view-roles')
            <li class="nav-item {{ request()->is('cms/roles*') ? 'active' : '' }}">
                <a href="{{ url('/cms/roles') }}" class="nav-link">
                    <i class="fa-solid fa-shield-halved nav-icon"></i>
                    <span class="nav-label">Level</span>
                </a>
            </li>
            @endcan
        </ul>
    </nav>
    <div class="sidebar-footer">
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Keluar</span>
            </button>
        </form>
    </div>
</aside>
<div class="admin-sidebar-overlay" id="sidebarOverlay"></div>
