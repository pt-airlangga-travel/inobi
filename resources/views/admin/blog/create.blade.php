@extends('layouts.admin')

@section('title', 'Tambah Artikel — INOBI')

@section('content')

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Tambah Artikel Baru</h1>
        <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
    </div>

    <div class="mb-3">
        <label class="form-label"><strong>Judul Artikel (English)</strong></label>
        <input type="text" name="title_en" class="form-control" value="{{ old('title_en') }}">
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form
                action="{{ route('admin.blog.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">
                        <strong>Judul Artikel</strong>
                    </label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title') }}"
                        required
                    >
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Kategori (English)</strong></label>
                    <input type="text" name="category_en" class="form-control" value="{{ old('category_en') }}">
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">
                        <strong>Kategori</strong>
                    </label>
                    <input
                        type="text"
                        id="category"
                        name="category"
                        class="form-control @error('category') is-invalid @enderror"
                        value="{{ old('category') }}"
                        placeholder="Contoh: Biomaterial"
                    >
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Ringkasan Artikel (English)</strong></label>
                    <textarea name="excerpt_en" rows="4" class="form-control">{{ old('excerpt_en') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="excerpt" class="form-label">
                        <strong>Ringkasan Artikel</strong>
                    </label>
                    <textarea
                        id="excerpt"
                        name="excerpt"
                        rows="4"
                        class="form-control @error('excerpt') is-invalid @enderror"
                    >{{ old('excerpt') }}</textarea>
                    @error('excerpt')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Isi Artikel (English)</strong></label>
                    <textarea name="content_en" rows="12" class="form-control">{{ old('content_en') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">
                        <strong>Isi Artikel</strong>
                    </label>
                    <textarea
                        id="content"
                        name="content"
                        rows="12"
                        class="form-control @error('content') is-invalid @enderror"
                        required
                    >{{ old('content') }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- FIELD STATUS --}}
                <div class="mb-3">
                    <label for="status" class="form-label">
                        <strong>Status Artikel</strong>
                    </label>
                    <select
                        id="status"
                        name="status"
                        class="form-control @error('status') is-invalid @enderror"
                    >
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>📝 Draft</option>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>🚀 Publikasi</option>
                    </select>
                    <small class="text-muted">
                        <strong>Draft:</strong> Hanya terlihat di admin. <br>
                        <strong>Publikasi:</strong> Langsung muncul di website user.
                    </small>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="cover_image" class="form-label">
                        <strong>Cover Artikel</strong>
                    </label>
                    <input
                        type="file"
                        id="cover_image"
                        name="cover_image"
                        class="form-control @error('cover_image') is-invalid @enderror"
                        accept=".jpg,.jpeg,.png,.webp"
                    >
                    <small class="text-muted">
                        Format JPG, JPEG, PNG, WEBP. Maksimal 2 MB.
                    </small>
                    @error('cover_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="published_at" class="form-label">
                        <strong>Tanggal Publikasi</strong>
                    </label>
                    <input
                        type="datetime-local"
                        id="published_at"
                        name="published_at"
                        class="form-control @error('published_at') is-invalid @enderror"
                        value="{{ old('published_at') }}"
                    >
                    <small class="text-muted">
                        Kosongkan jika ingin menyimpan sebagai draft.
                    </small>
                    @error('published_at')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i> Simpan Artikel
                    </button>
                    <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i> Batal
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection