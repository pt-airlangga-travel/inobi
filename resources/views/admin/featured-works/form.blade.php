<form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="card admin-card p-4">
    @csrf
    @if($method !== 'POST') @method($method) @endif
    @if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
    <div class="mb-3"><label class="form-label">Judul</label><input name="title" class="form-control" value="{{ old('title', $featuredWork?->title) }}" required></div>
    <div class="mb-3"><label class="form-label">Judul (English)</label><input name="title_en" class="form-control" value="{{ old('title_en', $featuredWork?->translated('title', 'en')) }}"></div>
    <div class="mb-3"><label class="form-label">Deskripsi</label><textarea name="description" class="form-control" rows="4" required>{{ old('description', $featuredWork?->description) }}</textarea></div>
    <div class="mb-3"><label class="form-label">Deskripsi (English)</label><textarea name="description_en" class="form-control" rows="4">{{ old('description_en', $featuredWork?->translated('description', 'en')) }}</textarea></div>
    <div class="mb-3"><label class="form-label">Urutan tampil</label><input type="number" name="sort_order" class="form-control" min="0" value="{{ old('sort_order', $featuredWork?->sort_order ?? 0) }}"></div>
    <div class="mb-4"><label class="form-label">Foto {{ $featuredWork ? '(opsional untuk mengganti)' : '' }}</label><input type="file" name="image" class="form-control" accept="image/jpeg,image/png,image/jpg,image/webp" {{ $featuredWork ? '' : 'required' }}></div>
    @if($featuredWork)<img src="{{ asset($featuredWork->image) }}" class="admin-work-preview mb-4" alt="{{ $featuredWork->title }}">@endif
    <div class="d-flex gap-2"><button class="btn btn-primary"><i class="fas fa-save me-2"></i>Simpan</button><a href="{{ route('admin.featured-works.index') }}" class="btn btn-light">Batal</a></div>
</form>
