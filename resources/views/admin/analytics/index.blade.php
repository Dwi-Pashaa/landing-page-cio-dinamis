@extends('admin.layouts.admin')

@section('title', 'Analitik - Admin CIO')
@section('page_title', 'Analitik Kunjungan')
@section('page_subtitle', 'Analisis traffic & statistik detail')

@section('content')
    <div class="card filter-card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <form method="GET" class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label class="form-label filter-label"><i class="fa-regular fa-calendar me-1"></i> Dari Tanggal</label>
                    <input type="date" name="start" class="form-control" value="{{ $startDate }}">
                </div>
                <div class="col-md-5">
                    <label class="form-label filter-label"><i class="fa-regular fa-calendar me-1"></i> Sampai Tanggal</label>
                    <input type="date" name="end" class="form-control" value="{{ $endDate }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100 btn-filter">
                        <i class="fa-solid fa-filter me-1"></i> Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="card chart-card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-bottom px-4 py-3 d-flex align-items-center justify-content-between">
                    <span>
                        <i class="fa-solid fa-chart-area me-2" style="color: #3B82F6;"></i>
                        <span class="fw-bold">Grafik Kunjungan</span>
                    </span>
                    <span class="badge badge-pastel-blue">{{ $startDate }} — {{ $endDate }}</span>
                </div>
                <div class="card-body p-4">
                    <canvas id="analyticsChart" height="300"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-bottom px-4 py-3 d-flex align-items-center justify-content-between">
                    <span>
                        <i class="fa-solid fa-chart-pie me-2" style="color: #6366F1;"></i>
                        <span class="fw-bold">Distribusi</span>
                    </span>
                    <span class="badge badge-pastel-indigo">{{ $pageStats->count() }} halaman</span>
                </div>
                <div class="card-body p-4 d-flex align-items-center justify-content-center">
                    <canvas id="pieChart" height="260"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-transparent border-bottom px-4 py-3 d-flex align-items-center justify-content-between">
            <span class="fw-bold"><i class="fa-solid fa-table me-2" style="color: #3B82F6;"></i> Detail Per Halaman</span>
            <form action="{{ url('/cms/analytics/clear') }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger btn-sm" data-delete data-confirm="Hapus semua data kunjungan?">
                    <i class="fa-solid fa-trash-can me-1"></i> Bersihkan
                </button>
            </form>
        </div>
        <div class="card-body p-0">
            <x-admin.data-table
                id="analyticsTable"
                :headers="[
                    ['label' => 'Halaman', 'sort' => 'page'],
                    ['label' => 'Kunjungan', 'sort' => 'total', 'class' => 'text-end'],
                    ['label' => 'Pengunjung Unik', 'sort' => 'unik', 'class' => 'text-end'],
                    ['label' => '% Total', 'class' => 'text-end'],
                ]"
            >
                @forelse($pageStats as $stat)
                    <tr>
                        <td><code class="analytic-page">{{ $stat->page }}</code></td>
                        <td class="text-end fw-semibold">{{ number_format($stat->total) }}</td>
                        <td class="text-end">{{ number_format($stat->unik) }}</td>
                        <td class="text-end">
                            @if($grandTotal > 0)
                                <span class="badge badge-pastel-blue" style="font-size: 12px;">
                                    {{ round(($stat->total / $grandTotal) * 100, 1) }}%
                                </span>
                            @else
                                <span class="text-muted">0%</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr id="emptyRow">
                        <td colspan="4" class="text-center text-muted py-4">Belum ada data kunjungan</td>
                    </tr>
                @endforelse
                @if(count($pageStats) > 0)
                    <tr data-keep class="analytic-total-row">
                        <td class="fw-bold">Total</td>
                        <td class="text-end fw-bold">{{ number_format($grandTotal) }}</td>
                        <td class="text-end fw-bold">{{ number_format($pageStats->sum('unik')) }}</td>
                        <td class="text-end fw-bold">100%</td>
                    </tr>
                @endif
            </x-admin.data-table>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    var chartData = @json($chartData);
    var labels = chartData.map(function(d) { return d.date; });
    var values = chartData.map(function(d) { return d.total; });

    new Chart(document.getElementById('analyticsChart'), {
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
                pointRadius: 4,
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
                }
            },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1, font: { size: 12, weight: '600' } }, grid: { color: '#F1F5F9', drawBorder: false } },
                x: { grid: { display: false }, ticks: { font: { size: 12 } } }
            }
        }
    });

    var pageStats = @json($pageStats);
    var pageLabels = pageStats.map(function(p) { return p.page; });
    var pageValues = pageStats.map(function(p) { return p.total; });

    new Chart(document.getElementById('pieChart'), {
        type: 'doughnut',
        data: {
            labels: pageLabels,
            datasets: [{
                data: pageValues,
                backgroundColor: ['#3B82F6', '#8B5CF6', '#EF4444', '#22C55E', '#F59E0B', '#06B6D4', '#EC4899', '#14B8A6'],
                borderWidth: 2,
                borderColor: '#fff',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { font: { size: 11, weight: '600' }, padding: 12, usePointStyle: true }
                },
                tooltip: {
                    backgroundColor: '#fff',
                    titleColor: '#1E293B',
                    bodyColor: '#475569',
                    borderColor: '#DBEAFE',
                    borderWidth: 2,
                    cornerRadius: 12,
                    padding: 12,
                }
            },
            cutout: '65%',
        }
    });
</script>
@endpush
