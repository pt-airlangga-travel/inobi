@extends('layouts.admin')

@section('title', __('ui.products').' - INOBI '. __('ui.admin'))

@section('content')
<div class="container-fluid admin-page">
    <div class="admin-page-header">
        <div>
            <h1>Products</h1>
            <p>Kelola produk yang tampil di website INOBI.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> {{ __('ui.add') }} {{ __('ui.products') }}
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
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
                            <th width="80">Image</th>
                            <th>Name</th>
                            <th>Kategori / Folder</th>
                            <th>Price</th>
                            <th width="280">{{ __('ui.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    @if($product->image)
                                        <img src="{{ asset($product->image) }}" 
                                             alt="{{ $product->name }}" 
                                             width="50" height="50" 
                                             style="object-fit: cover; border-radius: 6px;">
                                    @else
                                        <div style="width:50px;height:50px;background:#f0f2f5;border-radius:6px;display:flex;align-items:center;justify-content:center;color:#999;font-size:10px;">
                                            No Image
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $product->name }}</strong>
                                    @if($product->is_featured)
                                        <span class="badge bg-warning text-dark ms-1" style="font-size: 10px;">Featured</span>
                                    @endif
                                    @if($product->is_featured_banner)
                                        <span class="badge bg-info text-dark ms-1" style="font-size: 10px;">Banner</span>
                                    @endif
                                </td>
                                <td>
                                    @if($product->category)
                                        <span class="badge" style="background: rgba(42,65,106,0.08); color: #2A416A; border: 1px solid rgba(42,65,106,0.2); font-weight: 600; font-size: 11px; padding: 5px 9px; border-radius: 6px;">
                                            <i class="fas fa-folder me-1 text-primary"></i> {{ $product->category->name }}
                                        </span>
                                    @else
                                        <span class="badge bg-light text-muted border" style="font-size: 11px; font-weight: normal;">
                                            Belum berkategori
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if($product->price !== null)
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    @else
                                        <span class="text-muted">Opsional / belum diisi</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        <a href="{{ route('products.show', $product) }}"
                                           class="btn btn-info btn-sm"
                                           title="View product detail"
                                           target="_blank"
                                           rel="noopener noreferrer">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if($product->shopee_url)
                                            <a href="{{ $product->shopee_url }}"
                                               class="btn btn-sm"
                                               style="background:#ee4d2d;color:#fff;"
                                               title="Buy on Shopee"
                                               target="_blank"
                                               rel="noopener noreferrer">
                                                <i class="fas fa-shopping-bag"></i>
                                            </a>
                                        @endif
                                        @if($product->tokopedia_url)
                                            <a href="{{ $product->tokopedia_url }}"
                                               class="btn btn-sm"
                                               style="background:#42b549;color:#fff;"
                                               title="Buy on Tokopedia"
                                               target="_blank"
                                               rel="noopener noreferrer">
                                                <strong>T</strong>
                                            </a>
                                        @endif
                                        <a href="https://wa.me/6281237411413?text={{ urlencode(__('ui.whatsapp_product_message', ['product' => $product->name])) }}"
                                           class="btn btn-success btn-sm"
                                           title="Ask via WhatsApp"
                                           target="_blank"
                                           rel="noopener noreferrer">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                        <a href="{{ route('admin.products.edit', $product) }}" 
                                           class="btn btn-warning btn-sm" 
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this product?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-5">
                                    <i class="fas fa-box fa-2x d-block mb-3" style="opacity:0.3;"></i>
                                    No products found. 
                                    <a href="{{ route('admin.products.create') }}" class="text-primary">Create your first product</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection