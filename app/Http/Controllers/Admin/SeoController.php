<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoSetting;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function index()
    {
        $seoSettings = SeoSetting::all()->keyBy('page_key');
        return view('admin.seo.index', compact('seoSettings'));
    }

    public function update(Request $request)
    {
        $pages = ['home', 'tentang-kami', 'paket-internet', 'tutorial', 'kontak'];

        foreach ($pages as $page) {
            $data = $request->input($page, []);
            if (!empty($data['meta_title']) || !empty($data['meta_description'])) {
                SeoSetting::updateOrCreate(
                    ['page_key' => $page],
                    [
                        'page_label' => $data['page_label'] ?? ucfirst($page),
                        'meta_title' => $data['meta_title'] ?? null,
                        'meta_description' => $data['meta_description'] ?? null,
                        'meta_keywords' => $data['meta_keywords'] ?? null,
                        'og_title' => $data['og_title'] ?? null,
                        'og_description' => $data['og_description'] ?? null,
                    ]
                );
            }
        }

        return back()->with('success', 'SEO berhasil disimpan.');
    }
}
