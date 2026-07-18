<?php

namespace App\Http\Controllers;

use App\Models\PaketInternet;
use App\Models\SeoSetting;

class PaketInternetController extends Controller
{
    public function index()
    {
        $paketHome = PaketInternet::active()->where('tipe', 'home')->ordered()->get();
        $paketVoucher = PaketInternet::active()->where('tipe', 'voucher')->ordered()->get();
        $seo = SeoSetting::getForPage('paket-internet');

        return view('pages.paket-internet', compact('paketHome', 'paketVoucher', 'seo'));
    }
}
