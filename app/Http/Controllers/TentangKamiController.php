<?php

namespace App\Http\Controllers;

use App\Models\Keunggulan;
use App\Models\SeoSetting;

class TentangKamiController extends Controller
{
    public function index()
    {
        $keunggulan = Keunggulan::ordered()->get();
        $seo = SeoSetting::getForPage('tentang-kami');

        return view('pages.tentang-kami', compact('keunggulan', 'seo'));
    }
}
