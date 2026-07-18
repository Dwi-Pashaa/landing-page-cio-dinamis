@extends('admin.layouts.admin')

@section('title', 'Dashboard - Admin CIO')
@section('page_title', 'Dashboard')
@section('page_subtitle', 'Overview & statistik terkini')

@section('content')
    <div class="welcome-banner">
        <div class="welcome-text">
            <h4 class="welcome-title">Selamat Datang, <strong>{{ session('admin_name', 'Admin') }}</strong></h4>
            <p class="welcome-desc">{{ now()->translatedFormat('l, d F Y') }} &middot; Berikut ringkasan data hari ini.</p>
        </div>
        <div class="welcome-actions">
            <a href="{{ url('/cms/analytics') }}" class="btn btn-welcome">
                <i class="fa-solid fa-chart-line me-1"></i> Lihat Analitik
            </a>
            <a href="{{ url('/') }}" target="_blank" class="btn btn-welcome-outline">
                <i class="fa-solid fa-eye me-1"></i> Lihat Situs
            </a>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card stat-card-blue h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-value">{{ $totalHariIni }}</div>
                        <div class="stat-label">Kunjungan Hari Ini</div>
                        <div class="stat-trend up">
                            <i class="fa-solid fa-arrow-up"></i> +12%
                        </div>
                    </div>
                    <div class="stat-icon">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card stat-card-green h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-value">{{ $unikHariIni }}</div>
                        <div class="stat-label">Pengunjung Unik</div>
                        <div class="stat-trend up">
                            <i class="fa-solid fa-arrow-up"></i> +8%
                        </div>
                    </div>
                    <div class="stat-icon">
                        <i class="fa-solid fa-users"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card stat-card-indigo h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-value">{{ $totalBulanIni }}</div>
                        <div class="stat-label">Kunjungan Bulan Ini</div>
                        <div class="stat-trend up">
                            <i class="fa-solid fa-arrow-up"></i> +5%
                        </div>
                    </div>
                    <div class="stat-icon">
                        <i class="fa-solid fa-chart-simple"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card stat-card-amber h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-value">{{ $totalPaketAktif }}</div>
                        <div class="stat-label">Paket Aktif</div>
                    </div>
                    <div class="stat-icon">
                        <i class="fa-solid fa-wifi"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="card chart-card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-bottom px-4 py-3 d-flex align-items-center justify-content-between">
                    <span>
                        <i class="fa-solid fa-chart-area me-2" style="color: #3B82F6;"></i>
                        <span class="fw-bold">Grafik Kunjungan 7 Hari</span>
                    </span>
                    <span class="badge badge-pastel-blue">7 hari terakhir</span>
                </div>
                <div class="card-body p-4">
                    <canvas id="visitsChart" height="280"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-bottom px-4 py-3 d-flex align-items-center justify-content-between">
                    <span>
                        <i class="fa-solid fa-ranking-star me-2" style="color: #F59E0B;"></i>
                        <span class="fw-bold">Terpopuler</span>
                    </span>
                    <span class="badge badge-pastel-amber">{{ $popularPages->count() }} halaman</span>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush popular-list">
                        @forelse($popularPages as $i => $page)
                            <div class="list-group-item d-flex justify-content-between align-items-center border-0 border-bottom">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="popular-rank">{{ $i + 1 }}</span>
                                    <code class="popular-page">{{ $page->page }}</code>
                                </div>
                                <span class="popular-badge">{{ $page->total }}</span>
                            </div>
                        @empty
                            <div class="text-center text-muted py-4">Belum ada data kunjungan</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-lg-3 d-flex">
            <a href="{{ url('/cms/hero/edit') }}" class="card quick-card quick-card-blue flex-grow-1">
                <div class="quick-card-icon"><i class="fa-solid fa-pen-to-square"></i></div>
                <div class="quick-card-text">
                    <div class="quick-card-title">Edit Hero</div>
                    <div class="quick-card-desc">Banner utama</div>
                </div>
                <i class="fa-solid fa-chevron-right quick-card-arrow"></i>
            </a>
        </div>
        <div class="col-sm-6 col-lg-3 d-flex">
            <a href="{{ url('/cms/paket') }}" class="card quick-card quick-card-green flex-grow-1">
                <div class="quick-card-icon"><i class="fa-solid fa-wifi"></i></div>
                <div class="quick-card-text">
                    <div class="quick-card-title">Paket Internet</div>
                    <div class="quick-card-desc"><strong>{{ $totalPaketAktif }}</strong> paket aktif</div>
                </div>
                <i class="fa-solid fa-chevron-right quick-card-arrow"></i>
            </a>
        </div>
        <div class="col-sm-6 col-lg-3 d-flex">
            <a href="{{ url('/cms/tutorial') }}" class="card quick-card quick-card-purple flex-grow-1">
                <div class="quick-card-icon"><i class="fa-solid fa-video"></i></div>
                <div class="quick-card-text">
                    <div class="quick-card-title">Tutorial</div>
                    <div class="quick-card-desc"><strong>{{ $totalTutorialAktif }}</strong> tutorial</div>
                </div>
                <i class="fa-solid fa-chevron-right quick-card-arrow"></i>
            </a>
        </div>
        <div class="col-sm-6 col-lg-3 d-flex">
            <a href="{{ url('/cms/seo') }}" class="card quick-card quick-card-amber flex-grow-1">
                <div class="quick-card-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                <div class="quick-card-text">
                    <div class="quick-card-title">SEO Settings</div>
                    <div class="quick-card-desc">Optimasi meta &amp; OG</div>
                </div>
                <i class="fa-solid fa-chevron-right quick-card-arrow"></i>
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent border-bottom px-4 py-3 d-flex align-items-center justify-content-between">
                    <span class="fw-bold"><i class="fa-solid fa-box me-2" style="color: var(--admin-accent);"></i> Paket Terbaru</span>
                    <a href="{{ url('/cms/paket') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fa-solid fa-arrow-right me-1"></i> Lihat Semua
                    </a>
                </div>
                <div class="card-body p-0">
                    <x-admin.data-table
                        id="recentPaketTable"
                        :headers="[
                            ['label' => 'Nama', 'sort' => 'nama'],
                            ['label' => 'Tipe', 'sort' => 'tipe'],
                            ['label' => 'Harga', 'sort' => 'harga'],
                            ['label' => 'Status', 'sort' => 'is_active'],
                            ['label' => 'Dibuat', 'sort' => 'created_at'],
                        ]"
                    >
                        @forelse($recentPaket as $paket)
                            <tr>
                                <td class="fw-semibold">{{ $paket->nama }}</td>
                                <td><span class="badge badge-pastel-blue">{{ ucfirst($paket->tipe) }}</span></td>
                                <td class="fw-bold" style="color: var(--admin-accent);">Rp{{ number_format($paket->harga, 0, ',', '.') }}</td>
                                <td>
                                    @if($paket->is_active)
                                        <span class="badge badge-solid-green"><i class="fa-regular fa-circle-check me-1"></i>Aktif</span>
                                    @else
                                        <span class="badge badge-solid-red"><i class="fa-regular fa-circle-xmark me-1"></i>Nonaktif</span>
                                    @endif
                                </td>
                                <td style="color: var(--admin-text-secondary); font-size: 13px;">{{ $paket->created_at ? $paket->created_at->format('d/m/Y') : '-' }}</td>
                            </tr>
                        @empty
                            <tr id="emptyRow">
                                <td colspan="5" class="text-center text-muted py-4">Belum ada paket</td>
                            </tr>
                        @endforelse
                    </x-admin.data-table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    var ctx = document.getElementById('visitsChart').getContext('2d');
    var chartData = @json($chartData);
    var labels = chartData.map(function(d) { return d.date; });
    var values = chartData.map(function(d) { return d.total; });

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Kunjungan',
                data: values,
                borderColor: '#3B82F6',
                backgroundColor: function(context) {
                    var chart = context.chart;
                    var ctx = chart.ctx;
                    var gradient = ctx.createLinearGradient(0, 0, 0, chart.height);
                    gradient.addColorStop(0, 'rgba(59, 130, 246, 0.3)');
                    gradient.addColorStop(0.5, 'rgba(59, 130, 246, 0.1)');
                    gradient.addColorStop(1, 'rgba(59, 130, 246, 0.01)');
                    return gradient;
                },
                borderWidth: 3.5,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#3B82F6',
                pointBorderColor: '#fff',
                pointBorderWidth: 3,
                pointRadius: 5,
                pointHoverRadius: 8,
                pointHoverBackgroundColor: '#2563EB',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#fff',
                    titleColor: '#1E293B',
                    bodyColor: '#475569',
                    borderColor: '#DBEAFE',
                    borderWidth: 2,
                    cornerRadius: 12,
                    padding: 12,
                    boxPadding: 6,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1, font: { size: 12, weight: '600' } },
                    grid: { color: '#F1F5F9', drawBorder: false }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 12 } }
                }
            }
        }
    });
</script>
@endpush
