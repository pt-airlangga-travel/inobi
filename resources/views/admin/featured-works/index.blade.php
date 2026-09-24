@extends('layouts.admin')

@section('title', __('ui.featured_work_admin').' — INOBI')

@section('content')
<div class="container-fluid admin-page">
    <div class="admin-page-header">
        <div>
            <h1>Featured Work</h1>
            <p>Kelola foto kegiatan yang tampil di halaman utama.</p>
        </div>
        <a href="{{ route('admin.featured-works.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>{{ __('ui.add') }} Foto</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card admin-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table admin-table align-middle mb-0">
                    <thead><tr><th width="90">Urutan</th><th width="120">Foto</th><th>Judul & Deskripsi</th><th width="180">Aksi</th></tr></thead>
                    <tbody>
                    @forelse($works as $work)
                        <tr>
                            <td><span class="badge bg-light text-dark">#{{ $work->sort_order }}</span></td>
                            <td><img src="{{ asset($work->image) }}" alt="{{ $work->translated('title') }}" class="admin-work-thumb"></td>
                            <td><strong>{{ $work->translated('title') }}</strong><div class="text-muted small mt-1">{{ \Illuminate\Support\Str::limit($work->translated('description'), 130) }}</div></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.featured-works.edit', $work) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.featured-works.destroy', $work) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted py-5">Belum ada featured work.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($works->hasPages())<div class="card-footer">{{ $works->links() }}</div>@endif
    </div>
</div>
@endsection
