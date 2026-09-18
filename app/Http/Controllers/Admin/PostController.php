<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('translations')->latest()->paginate(10);

        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
            'category_en' => 'nullable|string|max:100',
            'excerpt' => 'nullable|string',
            'excerpt_en' => 'nullable|string',
            'content' => 'required|string',
            'content_en' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        unset($validated['title_en'], $validated['category_en'], $validated['excerpt_en'], $validated['content_en']);

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');

            $filename = time().'_'.$file->getClientOriginalName();

            $file->move(
                public_path('uploads/blog'),
                $filename
            );

            $validated['cover_image'] = 'uploads/blog/'.$filename;
        }

        /*
         * Jika status published tetapi tanggal publikasi kosong,
         * otomatis gunakan waktu sekarang.
         */
        if (
            $validated['status'] === 'published' &&
            empty($validated['published_at'])
        ) {
            $validated['published_at'] = now();
        }

        $post = Post::create($validated);
        $post->saveTranslation('title', $request->input('title_en'));
        $post->saveTranslation('category', $request->input('category_en'));
        $post->saveTranslation('excerpt', $request->input('excerpt_en'));
        $post->saveTranslation('content', $request->input('content_en'));

        return redirect()
            ->route('admin.blog.index')
            ->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(Post $post)
    {
        return view('admin.blog.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
            'category_en' => 'nullable|string|max:100',
            'excerpt' => 'nullable|string',
            'excerpt_en' => 'nullable|string',
            'content' => 'required|string',
            'content_en' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        unset($validated['title_en'], $validated['category_en'], $validated['excerpt_en'], $validated['content_en']);

        if ($request->hasFile('cover_image')) {

            if (
                $post->cover_image &&
                file_exists(public_path($post->cover_image))
            ) {
                unlink(public_path($post->cover_image));
            }

            $file = $request->file('cover_image');

            $filename = time().'_'.$file->getClientOriginalName();

            $file->move(
                public_path('uploads/blog'),
                $filename
            );

            $validated['cover_image'] = 'uploads/blog/'.$filename;
        }

        if (
            $validated['status'] === 'published' &&
            empty($validated['published_at'])
        ) {
            $validated['published_at'] = now();
        }

        $post->update($validated);
        $post->saveTranslation('title', $request->input('title_en'));
        $post->saveTranslation('category', $request->input('category_en'));
        $post->saveTranslation('excerpt', $request->input('excerpt_en'));
        $post->saveTranslation('content', $request->input('content_en'));

        return redirect()
            ->route('admin.blog.index')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Post $post)
    {
        if (
            $post->cover_image &&
            file_exists(public_path($post->cover_image))
        ) {
            unlink(public_path($post->cover_image));
        }

        $post->delete();

        return redirect()
            ->route('admin.blog.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }
}
