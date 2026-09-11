<?php

namespace App\Http\Controllers;

use App\Models\Keunggulan;
use App\Models\SeoSetting;
use App\Models\TentangKamiSection;

class TentangKamiController extends Controller
{
    public function index()
    {
        $about = TentangKamiSection::first();
        $keunggulan = Keunggulan::ordered()->get();
        $seo = SeoSetting::getForPage('tentang-kami');

        return view('pages.tentang-kami', compact('about', 'keunggulan', 'seo'));
    }
}
