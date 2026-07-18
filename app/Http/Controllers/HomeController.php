<?php

namespace App\Http\Controllers;

use App\Models\HeroSection;
use App\Models\PaketInternet;
use App\Models\Tutorial;
use App\Models\SiteSetting;
use App\Models\SeoSetting;

class HomeController extends Controller
{
    public function index()
    {
        $hero = HeroSection::where('is_active', true)->first();
        $featuredPaket = PaketInternet::active()->featured()->ordered()->get();
        $featuredTutorial = Tutorial::active()->featured()->ordered()->limit(3)->get();
        $seo = SeoSetting::getForPage('home');

        return view('pages.home', compact('hero', 'featuredPaket', 'featuredTutorial', 'seo'));
    }
}
