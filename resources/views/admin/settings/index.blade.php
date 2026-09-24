@extends('layouts.admin')

@section('title', 'Pengaturan Situs - INOBI Admin')

@section('content')
<div class="container-fluid admin-page">
    <div class="admin-page-header">
        <div>
            <h1>Pengaturan Situs</h1>
            <p>Kelola pengaturan website secara dinamis (key-value).</p>
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
                            <th>Nama Pengaturan</th>
                            <th>Nilai</th>
                            <th>Diperbarui</th>
                            <th width="150" class="text-end"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($settings as $setting)
                            <tr>
                                <td>
                                    <strong>{{ Str::title(str_replace('_', ' ', $setting->key)) }}</strong>
                                    <br><small class="text-muted" style="font-size: 11px; font-family: monospace;">{{ $setting->key }}</small>
                                </td>
                                <td><span class="text-muted">{{ Str::limit($setting->value ?? '[Kosong]', 60) }}</span></td>
                                <td><span class="text-muted" style="font-size: 13px;">{{ $setting->updated_at->diffForHumans() }}</span></td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-3">
                                        <a href="{{ route('admin.settings.edit', $setting) }}" class="text-warning text-decoration-none" title="Edit">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    <div class="mb-2"><i class="fas fa-cogs fa-2x text-muted"></i></div>
                                    Belum ada pengaturan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
