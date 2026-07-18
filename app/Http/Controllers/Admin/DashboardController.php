<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageVisit;
use App\Models\PaketInternet;
use App\Models\Tutorial;
use App\Models\HeroSection;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = now()->startOfDay();
        $startOfMonth = now()->startOfMonth();

        $totalHariIni = PageVisit::where('visited_at', '>=', $today)->count();
        $unikHariIni = PageVisit::where('visited_at', '>=', $today)->distinct('ip_address')->count('ip_address');
        $totalBulanIni = PageVisit::where('visited_at', '>=', $startOfMonth)->count();
        $totalPaketAktif = PaketInternet::where('is_active', true)->count();
        $totalTutorialAktif = Tutorial::where('is_active', true)->count();
        $heroStatus = HeroSection::where('is_active', true)->exists() ? 'Aktif' : 'Nonaktif';

        $chartData = PageVisit::select(
            DB::raw('DATE(visited_at) as date'),
            DB::raw('COUNT(*) as total')
        )
            ->where('visited_at', '>=', now()->subDays(6)->startOfDay())
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $popularPages = PageVisit::select('page', DB::raw('COUNT(*) as total'))
            ->where('visited_at', '>=', now()->subDays(7)->startOfDay())
            ->groupBy('page')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $recentPaket = PaketInternet::orderByDesc('created_at')->limit(5)->get();

        return view('admin.dashboard', compact(
            'totalHariIni', 'unikHariIni', 'totalBulanIni',
            'totalPaketAktif', 'totalTutorialAktif', 'heroStatus',
            'chartData', 'popularPages', 'recentPaket'
        ));
    }
}
