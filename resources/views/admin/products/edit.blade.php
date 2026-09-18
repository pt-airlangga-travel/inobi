@extends('layouts.admin')

@section('title', 'Edit Product - Admin INOBI')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">
                <i class="fas fa-pencil-alt me-2"></i> Edit Product
            </h1>
            <p class="text-muted mb-0">
                Update product information.
            </p>
        </div>

        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back
        </a>
    </div>




    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><i class="fas fa-exclamation-circle me-2"></i> Please fix the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif


    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">

                    {{-- =========================================================
                         LEFT COLUMN - FORM
                    ========================================================= --}}
                    <div class="col-md-8">

                        {{-- NAME --}}
                        <div class="mb-3">
                            <label class="form-label">
                                <strong>Product Name</strong>
                                <span class="text-danger">*</span>
                            </label>
                            <input
                                type="text"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $product->name) }}"
                                required
                            >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        {{-- CATEGORY / FOLDER --}}
                        <div class="mb-3">
                            <label class="form-label">
                                <strong><i class="fas fa-folder me-1 text-primary"></i> Kategori / Folder Produk</strong>
                            </label>
                            <select
                                name="category_id"
                                class="form-select @error('category_id') is-invalid @enderror"
                            >
                                <option value="">-- Pilih Kategori / Folder (Opsional) --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        📁 {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        {{-- PRICE --}}
                        <div class="mb-3">
                            <label class="form-label">
                                <strong>Price (Rp)</strong>
                            </label>
                            <input
                                type="number"
                                name="price"
                                class="form-control @error('price') is-invalid @enderror"
                                value="{{ old('price', $product->price) }}"
                                min="0"
                                step="1"
                            >
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        {{-- MARKETPLACE LINKS --}}
                        <div class="mb-3">
                            <label class="form-label">
                                <strong>Marketplace Product Links</strong>
                            </label>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input
                                        type="url"
                                        name="tokopedia_url"
                                        class="form-control @error('tokopedia_url') is-invalid @enderror"
                                        value="{{ old('tokopedia_url', $product->tokopedia_url) }}"
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
                                        value="{{ old('shopee_url', $product->shopee_url) }}"
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
                        <div class="mb-4">
                            <div class="featured-product-option p-3" style="background:#f8faf5;border:1px solid #e3ead8;border-radius:10px;">
                                <div class="form-check">
                                    <input
                                        type="checkbox"
                                        name="is_featured"
                                        value="1"
                                        class="form-check-input"
                                        id="is_featured"
                                        {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="is_featured">
                                        <strong>⭐ Featured Product</strong>
                                    </label>
                                </div>
                                <small class="text-muted">
                                    Show this product in the <strong>Our Products</strong> section on the homepage.
                                    Maximum 4 products.
                                </small>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="featured-product-option p-3" style="background:#eef5ff;border:1px solid #cfe0ff;border-radius:10px;">
                                <div class="form-check">
                                    <input
                                        type="checkbox"
                                        name="is_featured_banner"
                                        value="1"
                                        class="form-check-input"
                                        id="is_featured_banner"
                                        {{ old('is_featured_banner', $product->is_featured_banner) ? 'checked' : '' }}
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


                        {{-- DESCRIPTION --}}
                        <div class="mb-3">
                            <label class="form-label">
                                <strong>Product Description</strong>
                            </label>
                            <textarea
                                name="description"
                                class="form-control @error('description') is-invalid @enderror"
                                rows="10"
                            >{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Product Description (English)</strong></label>
                            <textarea name="description_en" class="form-control" rows="10">{{ old('description_en', $product->translated('description', 'en')) }}</textarea>
                        </div>

                    </div>


                    {{-- =========================================================
                         RIGHT COLUMN - IMAGE PREVIEW
                    ========================================================= --}}
                    <div class="col-md-4">

                        <div class="card bg-light border-0">
                            <div class="card-body text-center">

                                <h6 class="mb-3">
                                    <i class="fas fa-image me-2"></i> Product Image
                                </h6>

                                {{-- PREVIEW GAMBAR SAAT INI --}}
                                <div id="currentImagePreview">
                                    @if($product->image)
                                        <div class="admin-image-preview-card d-inline-block">
                                            <img
                                                src="{{ asset($product->image) }}"
                                                alt="{{ $product->name }}"
                                                class="admin-product-preview"
                                                style="width:100%;max-width:220px;height:220px;object-fit:cover;border-radius:12px;border:1px solid #ddd;margin-bottom:15px;background:#fff;"
                                            >
                                            <button
                                                type="button"
                                                class="admin-image-remove"
                                                onclick="removeImage()"
                                                aria-label="Delete main image"
                                            >&times;</button>
                                        </div>
                                        <div class="mb-2">
                                            <small class="text-muted">
                                                <i class="fas fa-file-image me-1"></i>
                                                {{ basename($product->image) }}
                                            </small>
                                        </div>
                                        <label class="d-flex align-items-center justify-content-center gap-2 small mb-3">
                                            <input type="radio" name="main_image" value="primary" checked>
                                            Main image
                                        </label>

                                        @if($product->images->isNotEmpty())
                                            <div class="row g-2 mb-3">
                                                @foreach($product->images as $productImage)
                                                    <div class="col-4">
                                                        <div class="admin-image-preview-card">
                                                            <img
                                                                src="{{ asset($productImage->path) }}"
                                                                alt="{{ $product->name }}"
                                                                class="img-fluid rounded border"
                                                                style="height:75px;width:100%;object-fit:cover;"
                                                            >
                                                            <button
                                                                type="button"
                                                                class="admin-image-remove"
                                                                onclick="deleteAdditionalImage('{{ route('admin.products.images.destroy', [$product, $productImage]) }}')"
                                                                aria-label="Delete gallery image"
                                                            >&times;</button>
                                                        </div>
                                                        <label class="d-flex align-items-center justify-content-center gap-2 small mt-1">
                                                            <input type="radio" name="main_image" value="existing:{{ $productImage->id }}">
                                                            Main image
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    @else
                                        <div class="py-5 text-muted">
                                            <i class="fas fa-image fa-3x d-block mb-3" style="opacity:0.3;"></i>
                                            <p>No image uploaded</p>
                                        </div>
                                    @endif
                                </div>

                                {{-- PREVIEW GAMBAR BARU (akan muncul saat upload) --}}
                                <div id="newImagePreview" class="row g-2 mb-3"></div>

                                {{-- INPUT FILE --}}
                                <div class="mb-2">
                                    <label for="image" class="form-label">
                                        <strong>Choose New Image</strong>
                                    </label>
                                    <input
                                        type="file"
                                        name="image[]"
                                        id="image"
                                        multiple
                                        class="form-control @error('image') is-invalid @enderror"
                                        accept="image/jpeg,image/png,image/jpg,image/webp"
                                        onchange="previewImage(event)"
                                    >
                                    <button type="button" class="btn btn-outline-primary btn-sm mt-2" onclick="document.getElementById('image').click()">
                                        <i class="fas fa-plus me-1"></i> Tambah Foto
                                    </button>
                                    <small class="text-muted d-block mt-1">
                                        Select as many images as needed. Choose one below as the main image; existing images remain in the gallery.
                                    </small>
                                    @error('image')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                        </div>

                    </div>

                </div>


                {{-- BUTTONS --}}
                <div class="d-flex gap-2 mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i> Update Product
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i> Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

{{-- SCRIPT UNTUK PREVIEW GAMBAR --}}
<script>
    let selectedImageFiles = [];

    function previewImage(event) {
        selectedImageFiles = selectedImageFiles.concat(Array.from(event.target.files));
        renderImagePreviews();
    }

    function removeNewImage(index) {
        selectedImageFiles.splice(index, 1);
        renderImagePreviews();
    }

    function renderImagePreviews() {
        const input = document.getElementById('image');
        const preview = document.getElementById('newImagePreview');
        const dataTransfer = new DataTransfer();

        selectedImageFiles.forEach((file) => dataTransfer.items.add(file));
        input.files = dataTransfer.files;
        preview.innerHTML = '';

        if (selectedImageFiles.length > 0) {
            selectedImageFiles.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const column = document.createElement('div');
                    column.className = 'col-6';
                    column.innerHTML = `
                        <div class="admin-image-preview-card border rounded p-2 h-100 bg-white">
                            <button type="button" class="admin-image-remove" onclick="removeNewImage(${index})" aria-label="Remove ${file.name}">&times;</button>
                            <img src="${e.target.result}" alt="${file.name}" class="img-fluid rounded mb-2" style="height:100px;width:100%;object-fit:contain;">
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

            document.querySelectorAll('input[name="main_image"]').forEach((input) => {
                input.checked = false;
            });

        } else {
            const primaryImage = document.querySelector('input[name="main_image"][value="primary"]');
            if (primaryImage) {
                primaryImage.click();
            }
        }
    }

    function removeImage() {
        if (confirm('Are you sure you want to remove this image?')) {
            // Kirim request hapus gambar via AJAX
            fetch('{{ route("admin.products.remove-image", $product) }}', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Failed to remove image.');
                }
            })
            .catch(error => {
                alert('Error: ' + error);
            });
        }
    }

    function deleteAdditionalImage(url) {
        if (!confirm('Are you sure you want to delete this gallery image?')) {
            return;
        }

        fetch(url, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
        }).then((response) => {
            if (!response.ok) {
                throw new Error('Unable to delete the gallery image.');
            }

            window.location.reload();
        }).catch((error) => {
            alert(error.message);
        });
    }
</script>

@endsection