<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Aset;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        // Mengambil semua post beserta data admin pembuat dan aset terkait
        $posts = Post::with(['author', 'aset'])->latest()->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        // Ambil data aset untuk dropdown "Terkait Kawasan/Aset"
        $asets = Aset::orderBy('nama')->get();
        return view('admin.posts.create', compact('asets'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:Kegiatan,Informasi,Pengumuman,Pengelolaan Area,Dokumentasi',
            'content' => 'required|string',
            'aset_id' => 'nullable|exists:asets,id',
            'status' => 'required|in:Draft,Published',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Buat URL Slug dari judul (ditambah waktu agar pasti unik)
        $data['slug'] = Str::slug($request->title) . '-' . time();
        
        // Catat siapa admin yang membuat post ini
        $data['created_by'] = Auth::id();

        // Atur tanggal publish jika statusnya langsung Published
        if ($data['status'] === 'Published') {
            $data['published_at'] = now();
        }

        // Proses upload thumbnail jika ada
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('posts', 'public');
        }

        $post = Post::create($data);
        ActivityLog::catat('menambah', 'post', $post->id);

        return redirect()->route('admin.posts.index')->with('status', 'Artikel berhasil ditambahkan.');
    }

    public function edit(Post $post)
    {
        $asets = Aset::orderBy('nama')->get();
        return view('admin.posts.edit', compact('post', 'asets'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:Kegiatan,Informasi,Pengumuman,Pengelolaan Area,Dokumentasi',
            'content' => 'required|string',
            'aset_id' => 'nullable|exists:asets,id',
            'status' => 'required|in:Draft,Published',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update tanggal publish jika status berubah dari Draft ke Published
        if ($data['status'] === 'Published' && $post->status === 'Draft') {
            $data['published_at'] = now();
        } elseif ($data['status'] === 'Draft') {
            $data['published_at'] = null;
        }

        // Jika judul berubah, update slug-nya juga
        if ($request->title !== $post->title) {
            $data['slug'] = Str::slug($request->title) . '-' . time();
        }

        // Proses update thumbnail
        if ($request->hasFile('thumbnail')) {
            // Hapus gambar lama jika ada
            if ($post->thumbnail && Storage::disk('public')->exists($post->thumbnail)) {
                Storage::disk('public')->delete($post->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('posts', 'public');
        }

        $post->update($data);
        ActivityLog::catat('memperbarui', 'post', $post->id);

        return redirect()->route('admin.posts.index')->with('status', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Post $post)
    {
        // Hapus file thumbnail fisik
        if ($post->thumbnail && Storage::disk('public')->exists($post->thumbnail)) {
            Storage::disk('public')->delete($post->thumbnail);
        }

        $id = $post->id;
        $post->delete();
        ActivityLog::catat('menghapus', 'post', $id);

        return back()->with('status', 'Artikel berhasil dihapus.');
    }
}