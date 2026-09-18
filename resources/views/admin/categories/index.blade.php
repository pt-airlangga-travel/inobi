@extends('layouts.admin')

@section('title', 'Kategori Produk - INOBI Admin')

@section('content')
<div class="container-fluid admin-page">
    <div class="admin-page-header">
        <div>
            <h1>Kategori & Folder Produk</h1>
            <p>{{ app()->getLocale() === 'id' ? 'Kelola jenis dan folder kategori produk sesuai katalog INOBI.' : 'Manage product types and folder categories according to the INOBI catalog.' }}</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-box me-1"></i> Lihat Produk
            </a>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i> Tambah Kategori
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card admin-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table admin-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>Nama Kategori / Folder</th>
                            <th>Slug</th>
                            <th>Deskripsi</th>
                            <th width="140" class="text-center">Jumlah Produk</th>
                            <th width="150" class="text-end">{{ __('ui.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration + ($categories->currentPage() - 1) * $categories->perPage() }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div style="width: 36px; height: 36px; border-radius: 8px; background: rgba(42,65,106,0.08); color: #2A416A; display: flex; align-items: center; justify-content: center; font-size: 16px;">
                                            <i class="fas fa-folder"></i>
                                        </div>
                                        <div>
                                            <strong class="text-dark">{{ $category->name }}</strong>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <code class="text-muted" style="font-size: 12px;">{{ $category->slug }}</code>
                                </td>
                                <td>
                                    <span class="text-muted" style="font-size: 13px;">
                                        {{ Str::limit($category->description ?? 'Belum ada deskripsi.', 75) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge" style="background: {{ $category->products_count > 0 ? '#2A416A' : '#e2e8f0' }}; color: {{ $category->products_count > 0 ? '#ffffff' : '#64748b' }}; font-weight: 600; padding: 6px 12px; border-radius: 20px; font-size: 12px;">
                                        {{ $category->products_count }} {{ __('ui.products') }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-1">
                                        <a href="{{ route('admin.categories.edit', $category) }}" 
                                           class="btn btn-outline-primary btn-sm"
                                           title="Edit Kategori">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Produk dalam kategori ini tidak akan terhapus namun status kategorinya akan dikosongkan.');"
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-outline-danger btn-sm"
                                                    title="Hapus Kategori">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <div class="mb-2"><i class="fas fa-folder-open fa-2x text-muted"></i></div>
                                    Belum ada kategori yang dibuat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($categories->hasPages())
            <div class="card-footer bg-white border-top py-3">
                <div class="d-flex justify-content-end">
                    {{ $categories->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

