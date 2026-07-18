<?php

namespace App\Http\Controllers;

use App\Models\Tutorial;
use App\Models\SeoSetting;

class TutorialController extends Controller
{
    public function index()
    {
        $tutorials = Tutorial::active()->ordered()->paginate(9);
        $seo = SeoSetting::getForPage('tutorial');

        return view('pages.tutorial', compact('tutorials', 'seo'));
    }

    public function show($slug)
    {
        $tutorial = Tutorial::where('slug', $slug)->firstOrFail();
        $tutorial->increment('dilihat');
        $seo = SeoSetting::getForPage('tutorial');

        return view('pages.tutorial-detail', compact('tutorial', 'seo'));
    }
}
