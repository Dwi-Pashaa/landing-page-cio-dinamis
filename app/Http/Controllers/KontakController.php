<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Models\SeoSetting;

class KontakController extends Controller
{
    public function index()
    {
        $seo = SeoSetting::getForPage('kontak');

        return view('pages.kontak', compact('seo'));
    }
}
