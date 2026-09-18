<?php

namespace App\Http\Controllers;

use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        // Hanya tampilkan post dengan status 'published'
        $posts = Post::with('translations')->where('status', 'published')
            ->latest('published_at')
            ->paginate(9);

        return view('blog.index', compact('posts'));
    }

    public function show(Post $post)
    {
        // Pastikan hanya published yang bisa diakses user
        if ($post->status !== 'published') {
            abort(404);
        }

        $post->load('translations');

        return view('blog.show', compact('post'));
    }
}
