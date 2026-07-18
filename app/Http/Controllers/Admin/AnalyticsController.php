<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->get('start', now()->subDays(29)->format('Y-m-d'));
        $endDate = $request->get('end', now()->format('Y-m-d'));

        $chartData = PageVisit::select(
            DB::raw('DATE(visited_at) as date'),
            DB::raw('COUNT(*) as total')
        )
            ->where('visited_at', '>=', $startDate . ' 00:00:00')
            ->where('visited_at', '<=', $endDate . ' 23:59:59')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $pageStats = PageVisit::select(
            'page',
            DB::raw('COUNT(*) as total'),
            DB::raw('COUNT(DISTINCT ip_address) as unik')
        )
            ->where('visited_at', '>=', $startDate . ' 00:00:00')
            ->where('visited_at', '<=', $endDate . ' 23:59:59')
            ->groupBy('page')
            ->orderByDesc('total')
            ->get();

        $grandTotal = $pageStats->sum('total');

        return view('admin.analytics.index', compact(
            'chartData', 'pageStats', 'grandTotal', 'startDate', 'endDate'
        ));
    }

    public function clear()
    {
        PageVisit::truncate();
        return back()->with('success', 'Data kunjungan berhasil dibersihkan.');
    }
}
