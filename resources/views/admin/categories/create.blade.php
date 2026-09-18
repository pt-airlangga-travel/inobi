@extends('layouts.admin')

@section('title', 'Tambah Kategori Produk - INOBI Admin')

@section('content')
<div class="container-fluid admin-page">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Tambah Kategori / Folder Produk</h1>
            <p class="text-muted mb-0">Tambahkan jenis atau kelompok produk baru ke katalog INOBI.</p>
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
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label font-weight-bold">
                        Nama Kategori / Folder <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           name="name" 
                           class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name') }}" 
                           placeholder="Contoh: Laboratory Equipments, Glassware, dsb."
                           required autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Slug URL <small class="text-muted">(opsional, dibuat otomatis jika dikosongkan)</small>
                    </label>
                    <input type="text" 
                           name="slug" 
                           class="form-control @error('slug') is-invalid @enderror" 
                           value="{{ old('slug') }}" 
                           placeholder="contoh: laboratory-equipments">
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
                              rows="4" 
                              placeholder="Deskripsi singkat mengenai jenis produk dalam folder ini...">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-light border">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
