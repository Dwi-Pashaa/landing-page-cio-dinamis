<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tutorial;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TutorialAdminController extends Controller
{
    public function index()
    {
        $tutorials = Tutorial::with('tags')->orderBy('urutan')->get();
        return view('admin.tutorial.index', compact('tutorials'));
    }

    public function create()
    {
        $tags = Tag::orderBy('name')->get();
        return view('admin.tutorial.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $data = $this->validateTutorial($request);
        $data['is_featured'] = $request->has('is_featured');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('uploads/tutorials', 'public');
        }

        $tutorial = Tutorial::create($data);

        if ($request->has('tags')) {
            $tutorial->tags()->sync($request->tags);
        }

        return redirect('/cms/tutorial')->with('success', 'Tutorial berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $tutorial = Tutorial::with('tags')->findOrFail($id);
        $tags = Tag::orderBy('name')->get();
        return view('admin.tutorial.edit', compact('tutorial', 'tags'));
    }

    public function update(Request $request, $id)
    {
        $tutorial = Tutorial::findOrFail($id);
        $data = $this->validateTutorial($request);
        $data['is_featured'] = $request->has('is_featured');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('uploads/tutorials', 'public');
        }

        $tutorial->update($data);

        if ($request->has('tags')) {
            $tutorial->tags()->sync($request->tags);
        } else {
            $tutorial->tags()->sync([]);
        }

        return redirect('/cms/tutorial')->with('success', 'Tutorial berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Tutorial::findOrFail($id)->delete();
        return back()->with('success', 'Tutorial berhasil dihapus.');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120'
        ]);

        $path = $request->file('upload')->store('uploads/tutorials/images', 'public');

        return response()->json([
            'success' => true,
            'url' => asset('storage/' . $path)
        ]);
    }

    public function uploadVideo(Request $request)
    {
        $request->validate([
            'upload' => 'required|mimetypes:video/mp4,video/webm,video/ogg,video/quicktime|max:102400'
        ]);

        $path = $request->file('upload')->store('uploads/tutorials/videos', 'public');

        return response()->json([
            'success' => true,
            'url' => asset('storage/' . $path)
        ]);
    }

    private function validateTutorial(Request $request)
    {
        return $request->validate([
            'kategori' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'konten' => 'nullable|string',
            'penulis' => 'nullable|string|max:255',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'urutan' => 'nullable|integer',
        ]);
    }
}
