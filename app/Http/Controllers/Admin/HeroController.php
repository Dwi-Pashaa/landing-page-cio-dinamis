<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    public function edit()
    {
        $hero = HeroSection::firstOrNew();
        return view('admin.hero.edit', compact('hero'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'badge_text' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'btn_primary_text' => 'nullable|string|max:255',
            'btn_primary_url' => 'nullable|string|max:255',
            'btn_secondary_text' => 'nullable|string|max:255',
            'btn_secondary_url' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('hero_image')) {
            $request->validate(['hero_image' => 'image|mimes:jpg,jpeg,png,webp|max:10240']);
            $path = $request->file('hero_image')->store('uploads/images', 'public');
            $data['hero_image'] = $path;
        }

        HeroSection::updateOrCreate(['id' => HeroSection::first()->id ?? 1], $data);

        return redirect('/cms/hero/edit')->with('success', 'Hero berhasil diperbarui.');
    }
}
