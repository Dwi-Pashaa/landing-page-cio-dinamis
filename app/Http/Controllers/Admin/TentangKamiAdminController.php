<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TentangKamiSection;
use Illuminate\Http\Request;

class TentangKamiAdminController extends Controller
{
    public function edit()
    {
        $about = TentangKamiSection::first();

        if (!$about) {
            $about = new TentangKamiSection([
                'hero_badge' => 'Profil Perusahaan',
                'hero_title' => 'Tentang <span>PT CIO NETWORK NUSANTARA</span>',
                'hero_description' => 'Penyedia dan pengelola solusi jaringan internet terjangkau dengan pengalaman lebih dari 5 tahun. Mitra resmi ISP Andira Infomedia — beroperasi dengan legalitas yang jelas dan terpercaya.',
                'about_title' => 'Siapa Kami?',
                'about_lead' => 'Cio Network adalah penyedia dan pengelola solusi jaringan internet terjangkau dengan pengalaman lebih dari 5 tahun.',
                'about_description' => 'Sebagai mitra resmi ISP Andira Infomedia, kami beroperasi dengan legalitas yang jelas dan terpercaya. Kami hadir untuk menyambungkan setiap rumah and bisnis dengan koneksi internet cepat, stabil, dan tanpa batas kuota — baik melalui layanan bulanan maupun sistem voucher yang fleksibel.',
                'about_image' => null,
                'visi_title' => 'Visi Kami',
                'visi_text' => 'Menjadi penyedia layanan internet kabel fiber optic terdepan di Indonesia yang dikenal karena keandalan jaringan, transparansi biaya, dan layanan pelanggan yang responsif demi mewujudkan masyarakat digital yang cerdas dan produktif.',
                'misi_title' => 'Misi Kami',
                'misi_items' => [
                    'Memperluas jangkauan serat optik murni hingga ke pemukiman dan perkantoran.',
                    'Menjaga kestabilan koneksi dengan redundant server tingkat tinggi.',
                    'Menyediakan harga flat yang transparan dan bersahabat tanpa biaya tersembunyi.',
                ],
                'is_active' => true,
            ]);
        }

        return view('admin.tentang-kami.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'hero_badge' => 'nullable|string|max:255',
            'hero_title' => 'required|string|max:255',
            'hero_description' => 'nullable|string',
            'about_title' => 'required|string|max:255',
            'about_lead' => 'nullable|string',
            'about_description' => 'nullable|string',
            'visi_title' => 'nullable|string|max:255',
            'visi_text' => 'nullable|string',
            'misi_title' => 'nullable|string|max:255',
            'misi_items' => 'nullable|array',
            'misi_items.*' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->has('is_active');

        // Filter empty misi items
        if (isset($data['misi_items'])) {
            $data['misi_items'] = array_values(array_filter($data['misi_items'], function ($item) {
                return !is_null($item) && trim($item) !== '';
            }));
        } else {
            $data['misi_items'] = [];
        }

        if ($request->hasFile('about_image')) {
            $request->validate(['about_image' => 'image|mimes:jpg,jpeg,png,webp|max:10240']);
            $path = $request->file('about_image')->store('uploads/images', 'public');
            $data['about_image'] = $path;
        }

        $record = TentangKamiSection::first();
        if ($record) {
            $record->update($data);
        } else {
            TentangKamiSection::create($data);
        }

        return redirect('/cms/tentang-kami/edit')->with('success', 'Konten Tentang Kami berhasil diperbarui.');
    }
}
