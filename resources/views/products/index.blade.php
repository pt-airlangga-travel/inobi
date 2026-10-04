@extends('layouts.app')

@section('title', isset($activeCategory) ? $activeCategory->name . ' — ' . __('ui.products') : __('ui.products'))

@section('content')

<section class="products-page">

    <div class="products-container">

        {{-- PAGE HEADER --}}
        <div class="products-header">
            <span class="products-eyebrow">{{ __('ui.our_products') }}</span>
            <h1>{{ __('ui.products') }}</h1>
            <p>{{ __('ui.products_description') }}</p>
            <div class="products-header-line"></div>
        </div>

        <div class="product-catalog-layout">
            {{-- CATEGORY / FOLDER NAVIGATION --}}
            @if(isset($categories) && $categories->count() > 0)
                <aside class="product-directory">
                    <div class="product-directory-heading">
                        <span class="product-directory-kicker">{{ app()->getLocale() === 'id' ? 'Jelajahi' : 'Explore' }}</span>
                        <h2>{{ app()->getLocale() === 'id' ? 'Folder Produk' : 'Product Folders' }}</h2>
                        <p>{{ $totalProductsCount }} {{ __('ui.products') }}</p>
                    </div>

                    <nav class="product-directory-list" aria-label="{{ app()->getLocale() === 'id' ? 'Folder produk' : 'Product folders' }}">
                        <a href="{{ route('products.index') }}" class="product-directory-link {{ !$selectedCategorySlug ? 'is-active' : '' }}">
                            <span class="product-directory-icon"><i class="fas fa-layer-group"></i></span>
                            <span>{{ app()->getLocale() === 'id' ? 'Semua Produk' : 'All Products' }}</span>
                            <b>{{ $totalProductsCount }}</b>
                        </a>

                        @foreach($categories as $category)
                            <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="product-directory-link {{ $selectedCategorySlug === $category->slug ? 'is-active' : '' }}">
                                <span class="product-directory-icon"><i class="fas fa-folder"></i></span>
                                <span>{{ $category->name }}</span>
                                <b>{{ $category->products_count }}</b>
                            </a>
                        @endforeach
                    </nav>
                </aside>
            @endif

            <div class="product-results">
                @if($activeCategory)
                    <div class="active-folder-banner">
                        <div class="active-folder-header">
                            <span class="active-folder-badge">
                                <i class="fas fa-folder-open"></i> {{ $activeCategory->name }}
                            </span>
                            <span class="active-folder-count">{{ $products->total() }} {{ __('ui.products') }}</span>
                        </div>
                        @if($activeCategory->description)
                            <p class="active-folder-text">{{ $activeCategory->description }}</p>
                        @endif
                    </div>
                @endif

                {{-- PRODUCT GRID --}}
                @if($products->count() > 0)
                    <div class="products-grid">
                        @foreach($products as $product)
                            <article class="product-card {{ $product->hasPublicPrice() ? 'product-card-priced' : 'product-card-description' }}">
                                <div class="product-image-wrapper-wrap">
                                    <a href="{{ route('products.show', $product) }}" class="product-image-wrapper">
                                        @if($product->image_url)
                                            <img
                                                src="{{ $product->image_url }}"
                                                alt="{{ $product->name }}"
                                                class="product-image"
                                                loading="lazy"
                                                onerror="this.style.display='none'; if(this.nextElementSibling){this.nextElementSibling.style.display='flex';}"
                                            >
                                            <div class="product-no-image" style="display: none;">
                                                <span>{{ __('ui.no_image') }}</span>
                                            </div>
                                        @else
                                            <div class="product-no-image"><span>{{ __('ui.no_image') }}</span></div>
                                        @endif
                                    </a>
                                    @if($product->category)
                                        <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="product-category-overlay" style="text-decoration:none;">
                                            {{ $product->category->name }}
                                        </a>
                                    @endif
                                </div>

                                <div class="product-card-content">

                                    <h2 class="product-name">
                                        <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                                    </h2>

                                    <p class="product-description">{{ Str::limit(strip_tags(Str::markdown($product->translated('description') ?? '')), 90) ?: Str::limit($product->translated('description') ?? 'No description available.', 90) }}</p>

                                    <div class="product-card-footer">
                                        @if($product->hasPublicPrice() && $product->price !== null)
                                            <div class="product-price">
                                                <small>{{ __('ui.starting_from') }}</small>
                                                Rp {{ number_format($product->price, 0, ',', '.') }}
                                            </div>
                                        @else
                                            <span class="product-description-label">{{ __('ui.contact_for_product') }}</span>
                                        @endif

                                        <div class="product-card-actions">
                                            <a href="{{ route('products.show', $product) }}" class="product-detail-btn">
                                                {{ __('ui.view_details') }} <span>→</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    @if($products->hasPages())
                        <div class="products-pagination">{{ $products->links() }}</div>
                    @endif
                @else
                    <div class="products-empty">
                        <div class="products-empty-icon">📁</div>
                        @if($activeCategory)
                            <h2>Belum ada produk di dalam folder "{{ $activeCategory->name }}"</h2>
                            <p>{{ $activeCategory->description ?? 'INOBI menyediakan konsultasi dan pengadaan untuk seluruh kebutuhan kategori ini.' }}</p>
                            <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; margin-top: 20px;">
                                <a href="https://wa.me/6281237411413?text={{ urlencode('Halo PT INOBI, saya ingin menanyakan informasi pengadaan untuk kategori ' . $activeCategory->name) }}" class="btn-whatsapp" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 600;">
                                    <span>💬</span> Tanya Pengadaan via WhatsApp
                                </a>
                                <a href="{{ route('products.index') }}" class="btn-shopee" style="background: #2A416A; display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 600;">
                                    <span>📂</span> Lihat Semua Produk
                                </a>
                            </div>
                        @else
                            <h2>{{ __('ui.no_products') }}</h2>
                            <p>{{ __('ui.no_products_description') }}</p>
                        @endif
                    </div>
                @endif
            </div>
        </div>

    </div>

</section>

@endsection
