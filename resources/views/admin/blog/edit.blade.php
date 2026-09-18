@extends('layouts.admin')

@section('title', 'Edit Artikel')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Edit Artikel</h1>
        <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.blog.update', $post) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Judul Artikel</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Judul Artikel (English)</label>
                    <input type="text" name="title_en" class="form-control" value="{{ old('title_en', $post->translated('title', 'en')) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="category" class="form-control" value="{{ old('category', $post->category) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori (English)</label>
                    <input type="text" name="category_en" class="form-control" value="{{ old('category_en', $post->translated('category', 'en')) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Ringkasan</label>
                    <textarea name="excerpt" rows="4" class="form-control">{{ old('excerpt', $post->excerpt) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ringkasan (English)</label>
                    <textarea name="excerpt_en" rows="4" class="form-control">{{ old('excerpt_en', $post->translated('excerpt', 'en')) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Isi Artikel</label>
                    <textarea name="content" rows="10" class="form-control" required>{{ old('content', $post->content) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Isi Artikel (English)</label>
                    <textarea name="content_en" rows="10" class="form-control">{{ old('content_en', $post->translated('content', 'en')) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>

                @if ($post->cover_image)
                    <div class="mb-3">
                        <label class="form-label">Cover Saat Ini</label>
                        <div>
                            <img src="{{ asset($post->cover_image) }}" style="width:200px; height:120px; object-fit:cover; border-radius:8px;">
                        </div>
                    </div>
                @endif

                <div class="mb-3">
                    <label class="form-label">Cover Artikel</label>
                    <input type="file" name="cover_image" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Publikasi</label>
                    <input type="datetime-local" name="published_at" class="form-control" value="{{ old('published_at', $post->published_at?->format('Y-m-d\TH:i')) }}">
                </div>

                <button type="submit" class="btn btn-primary">Update Artikel</button>
                <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection