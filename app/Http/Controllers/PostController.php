<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['author', 'aset'])->where('status', 'Published')->latest('published_at');
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        $posts = $query->paginate(6)->withQueryString();
        $categories = ['Kegiatan', 'Informasi', 'Pengumuman', 'Pengelolaan Area', 'Dokumentasi'];

        return view('pages.informasi.index', compact('posts', 'categories'));    }

    public function show(Post $post)
    {
        if ($post->status !== 'Published') {
            abort(404);
        }

        $relatedPosts = Post::where('status', 'Published')
            ->where('id', '!=', $post->id)
            ->where('category', $post->category)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('pages.informasi.show', compact('post', 'relatedPosts'));    }
}