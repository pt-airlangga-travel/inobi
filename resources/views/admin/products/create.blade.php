@extends('layouts.admin')

@section('title', 'Add Product - Admin INOBI')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="h3 mb-1">
                Add New Product
            </h1>

            <p class="text-muted mb-0">
                Add a new product to the INOBI catalog.
            </p>
        </div>

        <a
            href="{{ route('admin.products.index') }}"
            class="btn btn-secondary"
        >
            ← Back
        </a>

    </div>


    @if($errors->any())

        <div class="alert alert-danger">

            <strong>
                Please fix the following errors:
            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <div class="card">

        <div class="card-body">

            <form
                action="{{ route('admin.products.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                <div class="row">


                    {{-- PRODUCT NAME --}}

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Product Name
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}"
                            placeholder="Enter full product name"
                            required
                        >

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- CATEGORY / FOLDER --}}

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            <i class="fas fa-folder me-1 text-primary"></i> Kategori / Folder Produk
                        </label>

                        <select
                            name="category_id"
                            class="form-select @error('category_id') is-invalid @enderror"
                        >
                            <option value="">-- Pilih Kategori / Folder (Opsional) --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    📁 {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('category_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- PRICE --}}

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Price (Rp)
                        </label>

                        <input
                            type="number"
                            name="price"
                            class="form-control @error('price') is-invalid @enderror"
                            value="{{ old('price') }}"
                            min="0"
                            step="1"
                            placeholder="250000"
                        >

                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- DESCRIPTION --}}
                    <div class="col-12 mb-3">
                        <label class="form-label">
                            Product Description (Indonesia)
                        </label>
                        <textarea
                            name="description"
                            class="form-control @error('description') is-invalid @enderror"
                            rows="10"
                            placeholder="Indonesian product description"
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">
                            You can use Markdown formatting such as headings, bold text, and lists.
                        </small>
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">
                            Product Description (English)
                        </label>
                        <textarea
                            name="description_en"
                            class="form-control"
                            rows="10"
                            placeholder="English product description"
                        >{{ old('description_en') }}</textarea>
                        <small class="text-muted">
                            Fill this field to show the English description when English is selected.
                        </small>
                    </div>


                    {{-- IMAGE --}}

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Product Image
                        </label>

                        <input
                            type="file"
                            name="image[]"
                            id="image"
                            multiple
                            class="form-control @error('image') is-invalid @enderror"
                            accept="image/jpeg,image/png,image/jpg,image/webp"
                            onchange="previewImages(event)"
                        >
                        <button type="button" class="btn btn-outline-primary btn-sm mt-2" onclick="document.getElementById('image').click()">
                            <i class="fas fa-plus me-1"></i> Tambah Foto
                        </button>

                        <small class="text-muted d-block">
                            Select as many JPG, PNG, or WEBP images as needed. Choose one below as the main image.
                        </small>
                        <div id="imagePreview" class="row g-2 mt-2"></div>

                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- MARKETPLACE LINKS --}}
                    <div class="col-12 mb-3">
                        <label class="form-label">
                            Marketplace Product Links
                        </label>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input
                                    type="url"
                                    name="tokopedia_url"
                                    class="form-control @error('tokopedia_url') is-invalid @enderror"
                                    value="{{ old('tokopedia_url') }}"
                                    placeholder="Tokopedia URL (opsional)"
                                >
                                @error('tokopedia_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <input
                                    type="url"
                                    name="shopee_url"
                                    class="form-control @error('shopee_url') is-invalid @enderror"
                                    value="{{ old('shopee_url') }}"
                                    placeholder="Shopee URL (opsional)"
                                >
                                @error('shopee_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <small class="text-muted">Tambahkan link marketplace jika produk tersedia untuk dibeli online.</small>
                    </div>


                    {{-- FEATURED --}}

                    <div class="col-12 mb-4">

                        <div class="featured-product-option">

                            <div class="form-check">

                                <input
                                    type="checkbox"
                                    name="is_featured"
                                    value="1"
                                    class="form-check-input"
                                    id="is_featured"
                                    {{ old('is_featured') ? 'checked' : '' }}
                                >

                                <label
                                    class="form-check-label"
                                    for="is_featured"
                                >
                                    <strong>
                                        Featured Product
                                    </strong>
                                </label>

                            </div>

                            <small class="text-muted">
                                Show this product in the
                                <strong>Our Products</strong>
                                section on the homepage.
                                Maximum 4 products.
                            </small>

                        </div>
                    </div>

                    <div class="col-12 mb-4">
                        <div class="featured-product-option" style="background:#eef5ff;border:1px solid #cfe0ff;border-radius:10px;">
                            <div class="form-check">
                                <input
                                    type="checkbox"
                                    name="is_featured_banner"
                                    value="1"
                                    class="form-check-input"
                                    id="is_featured_banner"
                                    {{ old('is_featured_banner') ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="is_featured_banner">
                                    <strong>🔵 Featured Product (Blue Section)</strong>
                                </label>
                            </div>
                            <small class="text-muted">
                                Show this product in the blue Featured Product section. Only one product can be selected.
                            </small>
                        </div>
                    </div>


                </div>


                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Save Product
                    </button>

                    <a
                        href="{{ route('admin.products.index') }}"
                        class="btn btn-secondary"
                    >
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection

@push('scripts')
<script>
    let selectedImageFiles = [];

    function previewImages(event) {
        selectedImageFiles = selectedImageFiles.concat(Array.from(event.target.files));
        renderImagePreviews();
    }

    function removeNewImage(index) {
        selectedImageFiles.splice(index, 1);
        renderImagePreviews();
    }

    function renderImagePreviews() {
        const input = document.getElementById('image');
        const preview = document.getElementById('imagePreview');
        const dataTransfer = new DataTransfer();

        selectedImageFiles.forEach((file) => dataTransfer.items.add(file));
        input.files = dataTransfer.files;
        preview.innerHTML = '';

        selectedImageFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function (loadEvent) {
                const column = document.createElement('div');
                column.className = 'col-6 col-lg-4';
                column.innerHTML = `
                    <div class="admin-image-preview-card border rounded p-2 h-100 bg-white">
                        <button type="button" class="admin-image-remove" onclick="removeNewImage(${index})" aria-label="Remove ${file.name}">&times;</button>
                        <img src="${loadEvent.target.result}" alt="${file.name}" class="img-fluid rounded mb-2" style="height:110px;width:100%;object-fit:contain;">
                        <label class="d-flex align-items-center gap-2 small">
                            <input type="radio" name="main_image" value="new:${index}" ${index === 0 ? 'checked' : ''}>
                            Main image
                        </label>
                    </div>
                `;
                preview.appendChild(column);
            };
            reader.readAsDataURL(file);
        });
    }
</script>
@endpush