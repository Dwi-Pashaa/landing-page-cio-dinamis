<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaketInternet;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index()
    {
        $pakets = PaketInternet::orderBy('urutan')->get();
        return view('admin.paket.index', compact('pakets'));
    }

    public function create()
    {
        return view('admin.paket.create');
    }

    public function store(Request $request)
    {
        $data = $this->validatePaket($request);
        $data['fitur'] = array_filter($request->fitur ?? []);
        $data['keuntungan_tambahan'] = array_filter($request->keuntungan_tambahan ?? []);
        $data['is_featured'] = $request->has('is_featured');
        $data['is_rekomendasi'] = $request->has('is_rekomendasi');
        $data['is_active'] = $request->has('is_active');

        PaketInternet::create($data);

        return redirect('/cms/paket')->with('success', 'Paket berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $paket = PaketInternet::findOrFail($id);
        return view('admin.paket.edit', compact('paket'));
    }

    public function update(Request $request, $id)
    {
        $paket = PaketInternet::findOrFail($id);
        $data = $this->validatePaket($request);
        $data['fitur'] = array_filter($request->fitur ?? []);
        $data['keuntungan_tambahan'] = array_filter($request->keuntungan_tambahan ?? []);
        $data['is_featured'] = $request->has('is_featured');
        $data['is_rekomendasi'] = $request->has('is_rekomendasi');
        $data['is_active'] = $request->has('is_active');

        $paket->update($data);

        return redirect('/cms/paket')->with('success', 'Paket berhasil diperbarui.');
    }

    public function destroy($id)
    {
        PaketInternet::findOrFail($id)->delete();
        return back()->with('success', 'Paket berhasil dihapus.');
    }

    private function validatePaket(Request $request)
    {
        return $request->validate([
            'tipe' => 'required|in:home,voucher',
            'nama' => 'required|string|max:255',
            'sub_judul' => 'nullable|string|max:255',
            'harga' => 'required|integer',
            'periode' => 'required|string|max:255',
            'highlight_text' => 'nullable|string|max:255',
            'sub_highlight' => 'nullable|string|max:255',
            'wa_number' => 'nullable|string|max:255',
            'wa_message' => 'nullable|string',
            'urutan' => 'nullable|integer',
        ]);
    }
}
