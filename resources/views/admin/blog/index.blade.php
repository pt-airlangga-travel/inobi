@extends('layouts.admin')

@section('title', __('ui.blog').' — INOBI')

@section('content')

<div class="container-fluid admin-page">

{{-- HEADER --}}
<div class="admin-page-header">
    <div>
        <h1>Blog</h1>
        <p>
            Kelola artikel yang tampil di website INOBI.
        </p>
    </div>

    <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>
        {{ __('ui.add') }} Artikel
    </a>
</div>


{{-- SUCCESS MESSAGE --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
        ></button>
    </div>
@endif


{{-- ERROR MESSAGE --}}
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Terjadi kesalahan:</strong>

        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
        ></button>
    </div>
@endif


{{-- BLOG TABLE --}}
<div class="card admin-card">

    <div class="card-body">

        @if ($posts->count())

            <div class="table-responsive">

                <table class="table admin-table align-middle mb-0">

                    <thead>
                        <tr>
                            <th width="70">No</th>
                            <th width="100">Cover</th>
                            <th>Artikel</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($posts as $post)

                            <tr>

                                {{-- NOMOR --}}
                                <td>
                                    {{ $posts->firstItem() + $loop->index }}
                                </td>


                                {{-- COVER --}}
                                <td>

                                    @if ($post->cover_image)

                                        <img
                                            src="{{ asset($post->cover_image) }}"
                                            alt="{{ $post->translated('title') }}"
                                            style="
                                                width: 80px;
                                                height: 60px;
                                                object-fit: cover;
                                                border-radius: 8px;
                                            "
                                        >

                                    @else

                                        <div
                                            class="d-flex align-items-center justify-content-center bg-light"
                                            style="
                                                width: 80px;
                                                height: 60px;
                                                border-radius: 8px;
                                            "
                                        >
                                            <i class="fas fa-image text-muted"></i>
                                        </div>

                                    @endif

                                </td>


                                {{-- ARTIKEL --}}
                                <td>

                                    <div>
                                        <strong>
                                            {{ $post->translated('title') }}
                                        </strong>
                                    </div>

                                    @if ($post->excerpt)

                                        <small class="text-muted">
                                            {{ \Illuminate\Support\Str::limit($post->translated('excerpt'), 100) }}
                                        </small>

                                    @endif

                                </td>


                                {{-- KATEGORI --}}
                                <td>

                                    @if ($post->category)

                                        <span class="badge bg-secondary">
                                            {{ $post->translated('category') }}
                                        </span>

                                    @else

                                        <span class="text-muted">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- STATUS --}}
                                <td>

                                    @if ($post->status === 'published')

                                        <span class="badge bg-success">
                                            <i class="fas fa-globe me-1"></i>
                                            Published
                                        </span>

                                    @else

                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-file-alt me-1"></i>
                                            Draft
                                        </span>

                                    @endif

                                </td>


                                {{-- TANGGAL --}}
                                <td>

                                    @if ($post->published_at)

                                        <div>
                                            {{ $post->published_at->format('d M Y') }}
                                        </div>

                                        <small class="text-muted">
                                            {{ $post->published_at->format('H:i') }}
                                        </small>

                                    @else

                                        <span class="text-muted">
                                            Belum dipublikasi
                                        </span>

                                    @endif

                                </td>


                                {{-- AKSI --}}
                                <td>

                                    <div class="d-flex gap-2">

                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route('admin.blog.edit', $post) }}"
                                            class="btn btn-sm btn-warning"
                                            title="Edit artikel"
                                        >
                                            <i class="fas fa-edit"></i>
                                        </a>


                                        {{-- LIHAT --}}
                                        @if ($post->status === 'published')

                                            <a
                                                href="{{ route('blog.show', $post) }}"
                                                target="_blank"
                                                class="btn btn-sm btn-info"
                                                title="Lihat artikel"
                                            >
                                                <i class="fas fa-eye"></i>
                                            </a>

                                        @endif


                                        {{-- DELETE --}}
                                        <form
                                            action="{{ route('admin.blog.destroy', $post) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah kamu yakin ingin menghapus artikel ini?');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-danger"
                                                title="Hapus artikel"
                                            >
                                                <i class="fas fa-trash"></i>
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- PAGINATION --}}
            <div class="mt-4">

                {{ $posts->links() }}

            </div>


        @else

            {{-- EMPTY STATE --}}
            <div class="text-center py-5">

                <div class="mb-3">
                    <i
                        class="fas fa-newspaper fa-3x text-muted"
                    ></i>
                </div>

                <h5>Belum Ada Artikel</h5>

                <p class="text-muted">
                    Belum ada artikel blog yang dibuat.
                </p>

                <a
                    href="{{ route('admin.blog.create') }}"
                    class="btn btn-primary"
                >
                    <i class="fas fa-plus me-2"></i>
                    Tambah Artikel Pertama
                </a>

            </div>

        @endif

    </div>

</div>

</div>

@endsection
