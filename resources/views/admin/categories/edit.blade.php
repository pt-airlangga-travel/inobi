@extends('layouts.admin')

@section('title', 'Edit Kategori Produk - INOBI Admin')

@section('content')
<div class="container-fluid admin-page">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Edit Kategori / Folder Produk</h1>
            <p class="text-muted mb-0">Ubah detail kategori produk <strong>{{ $category->name }}</strong>.</p>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
            ← Kembali
        </a>
    </div>

    @if(isset($errors) && $errors->any())
        <div class="alert alert-danger">
            <strong>Periksa kembali data yang diinput:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card admin-card">
        <div class="card-body p-4">
            <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label font-weight-bold">
                        Nama Kategori / Folder <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           name="name" 
                           class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name', $category->name) }}" 
                           required autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Slug URL
                    </label>
                    <input type="text" 
                           name="slug" 
                           class="form-control @error('slug') is-invalid @enderror" 
                           value="{{ old('slug', $category->slug) }}">
                    @error('slug')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        Deskripsi Kategori <small class="text-muted">(opsional)</small>
                    </label>
                    <textarea name="description" 
                              class="form-control @error('description') is-invalid @enderror" 
                              rows="4">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-light border">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Perbarui Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
