<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Keunggulan;
use Illuminate\Http\Request;

class KeunggulanController extends Controller
{
    public function index()
    {
        $keunggulans = Keunggulan::ordered()->get();
        return view('admin.keunggulan.index', compact('keunggulans'));
    }

    public function create()
    {
        return view('admin.keunggulan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'icon_class' => 'nullable|string|max:255',
            'gradient_class' => 'nullable|string|max:255',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'urutan' => 'nullable|integer',
        ]);

        Keunggulan::create($data);

        return redirect('/cms/keunggulan')->with('success', 'Keunggulan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $keunggulan = Keunggulan::findOrFail($id);
        return view('admin.keunggulan.edit', compact('keunggulan'));
    }

    public function update(Request $request, $id)
    {
        $keunggulan = Keunggulan::findOrFail($id);
        $data = $request->validate([
            'icon_class' => 'nullable|string|max:255',
            'gradient_class' => 'nullable|string|max:255',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'urutan' => 'nullable|integer',
        ]);

        $keunggulan->update($data);

        return redirect('/cms/keunggulan')->with('success', 'Keunggulan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Keunggulan::findOrFail($id)->delete();
        return back()->with('success', 'Keunggulan berhasil dihapus.');
    }
}
