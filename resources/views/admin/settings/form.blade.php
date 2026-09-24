@extends('layouts.admin')

@section('title', 'Edit Pengaturan - INOBI Admin')

@section('content')
<div class="container-fluid admin-page">
    <div class="admin-page-header">
        <div>
            <h1>Edit Pengaturan</h1>
            <p>Kelola data pengaturan situs.</p>
        </div>
        <div>
            <a href="{{ route('admin.settings.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card admin-card">
        <div class="card-body">
            <form action="{{ route('admin.settings.update', $setting) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Pengaturan (Key) <span class="text-danger">*</span></label>
                    <input type="text" name="key" class="form-control" value="{{ old('key', $setting->key) }}" readonly>
                    <small class="text-muted">Key tidak dapat diubah setelah dibuat.</small>
                </div>

                <div class="mb-4">
                    <label class="form-label">Nilai</label>
                    <textarea name="value" class="form-control" rows="4" placeholder="Masukkan nilai pengaturan...">{{ old('value', $setting->value ?? '') }}</textarea>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.settings.index') }}" class="btn btn-light">Batal</a>
                    <button type="submit" class="btn btn-warning" style="background-color: #f59e0b; color: white; border: none;">
                        <i class="fas fa-save me-2"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
