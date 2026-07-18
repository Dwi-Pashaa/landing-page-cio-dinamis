<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::withCount('tutorials')->orderBy('name')->get();
        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:tags,name',
        ]);

        Tag::create($data);

        return redirect('/cms/tags')->with('success', 'Tag berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $tag = Tag::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $tag->id,
        ]);

        $tag->update($data);

        return redirect('/cms/tags')->with('success', 'Tag berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Tag::findOrFail($id)->delete();
        return back()->with('success', 'Tag berhasil dihapus.');
    }
}
