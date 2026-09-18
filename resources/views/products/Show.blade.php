@extends('layouts.app')

@section('title', $product->name . ' — PT. Inovasi Bioproduk Indonesia')

@section('content')
@php
    $galleryImages = collect([$product->image])
        ->filter()
        ->merge($product->images->pluck('path'))
        ->unique()
        ->values();
@endphp
<section class="product-detail-page">
    <div class="product-detail-container">

        {{-- TOP OVERVIEW CARD (GALLERY & BUY BOX) --}}
        <div class="product-overview-card">

            {{-- LEFT: IMAGE GALLERY --}}
            <div class="product-gallery-side">
                <div class="product-gallery-main">
                    @if($galleryImages->isNotEmpty())
                        <button type="button" class="product-main-image-button" id="productMainImageButton" aria-label="{{ __('ui.product_gallery') }}">
                            <img
                            src="{{ asset($galleryImages->first()) }}"
                            alt="{{ $product->name }}"
                            class="product-main-image"
                            id="productGalleryImage"
                            >
                        </button>
                    @else
                        <div class="product-no-image-box">
                            <span class="no-image-icon">📦</span>
                            <span class="no-image-text">{{ __('ui.image_unavailable') }}</span>
                        </div>
                    @endif

                    @if($product->is_featured)
                        <span class="product-badge-featured">⭐ Featured Product</span>
                    @endif
                </div>

                @if($galleryImages->count() > 1)
                    <div class="product-gallery-thumbnails" aria-label="{{ __('ui.product_gallery') }}">
                        @foreach($galleryImages as $index => $galleryImage)
                            <button
                                type="button"
                                class="product-gallery-thumbnail {{ $index === 0 ? 'active' : '' }}"
                                data-gallery-image="{{ asset($galleryImage) }}"
                                aria-label="{{ __('ui.product_image_number', ['number' => $index + 1]) }}"
                            >
                                <img src="{{ asset($galleryImage) }}" alt="{{ $product->name }} {{ $index + 1 }}">
                            </button>
                        @endforeach
                    </div>
                @endif

                <div class="product-gallery-footer">
                    <div class="product-trust-pill">
                        <span class="trust-icon">🛡️</span>
                        <span>{{ __('ui.official_product') }}</span>
                    </div>
                    <div class="product-trust-pill">
                        <span class="trust-icon">🔬</span>
                        <span>{{ __('ui.research_standard') }}</span>
                    </div>
                </div>
            </div>

            {{-- RIGHT: BUY BOX & PRODUCT SUMMARY --}}
            <div class="product-info-side">
                
                @if($product->category)
                    <div class="product-category-tag">
                        <span>{{ $product->category->name }}</span>
                    </div>
                @endif

                <h1 class="product-title">{{ $product->name }}</h1>

                {{-- PRICE BOX --}}
                <div class="product-price-box">
                    <div class="product-price-label">{{ __('ui.product_price') }}</div>
                    <div class="product-price-value">
                        @if($product->hasPublicPrice() && $product->price !== null)
                            <span class="currency">Rp</span>
                            <span class="amount">{{ number_format($product->price, 0, ',', '.') }}</span>
                        @else
                            <span class="contact-for-price">{{ __('ui.contact_us_price') }}</span>
                        @endif
                    </div>
                </div>

                {{-- QUICK SPECIFICATIONS SUMMARY TABLE --}}
                <div class="product-specs-summary">
                    <div class="spec-row">
                        <span class="spec-label">{{ __('ui.producer_brand') }}</span>
                        <span class="spec-value">PT. Inovasi Bioproduk Indonesia</span>
                    </div>
                    @if($product->category)
                        <div class="spec-row">
                            <span class="spec-label">{{ __('ui.category') }}</span>
                            <span class="spec-value">{{ $product->category->name }}</span>
                        </div>
                    @endif
                    <div class="spec-row">
                        <span class="spec-label">{{ __('ui.application') }}</span>
                        <span class="spec-value">Laboratorium, Riset Klinis & Diagnostik</span>
                    </div>
                    <div class="spec-row">
                        <span class="spec-label">{{ __('ui.quality_assurance') }}</span>
                        <span class="spec-value">Tersertifikasi & Teruji Kualitas</span>
                    </div>
                </div>

                {{-- ACTION BUTTONS --}}
                <div class="product-action-group">
                    @if($product->tokopedia_url)
                        <a href="{{ $product->tokopedia_url }}" target="_blank" rel="noopener noreferrer" class="btn-tokopedia">
                            <span class="marketplace-letter">T</span>
                            <span>{{ __('ui.buy_tokopedia') }}</span>
                            <span class="btn-arrow">→</span>
                        </a>
                    @endif
                    @if($product->shopee_url)
                        <a
                            href="{{ $product->shopee_url }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="btn-shopee"
                        >
                            <svg class="shopee-svg" viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                                <path d="M19.5 7.5h-2.25A5.25 5.25 0 0 0 12 2.25a5.25 5.25 0 0 0-5.25 5.25H4.5A2.25 2.25 0 0 0 2.25 9.75l1.5 10.5A2.25 2.25 0 0 0 6 22.5h12a2.25 2.25 0 0 0 2.25-2.25l1.5-10.5a2.25 2.25 0 0 0-2.25-2.25zM12 4.25a3.25 3.25 0 0 1 3.25 3.25H8.75A3.25 3.25 0 0 1 12 4.25zm6.5 16H5.5L4.25 9.75h15.5z"/>
                            </svg>
                            <span>{{ __('ui.buy_shopee') }}</span>
                            <span class="btn-arrow">→</span>
                        </a>
                    @endif

                    <a
                        href="https://wa.me/6281237411413?text={{ urlencode(__('ui.whatsapp_product_message', ['product' => $product->name])) }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="btn-whatsapp"
                    >
                        <svg class="whatsapp-svg" viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                            <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2zm0 18.15c-1.49 0-2.96-.4-4.24-1.16l-.3-.18-3.14.82.84-3.06-.2-.31a8.196 8.196 0 0 1-1.26-4.36c0-4.52 3.68-8.2 8.2-8.2 2.19 0 4.25.85 5.8 2.4 1.55 1.55 2.4 3.61 2.4 5.8 0 4.52-3.68 8.19-8.2 8.19zm4.49-6.14c-.25-.12-1.47-.72-1.7-.81-.23-.08-.39-.12-.56.12-.17.25-.64.81-.79.97-.14.17-.29.19-.54.06-.25-.12-1.05-.39-2-1.23-.74-.66-1.24-1.47-1.39-1.72-.14-.25-.02-.38.11-.51.11-.11.25-.29.37-.43.12-.15.17-.25.25-.42.08-.17.04-.31-.02-.43s-.56-1.36-.77-1.86c-.2-.49-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31-.22.25-.86.84-.86 2.05s.88 2.38 1 2.55c.12.17 1.73 2.65 4.2 3.71.59.25 1.05.4 1.41.52.59.19 1.13.16 1.56.1.48-.07 1.47-.6 1.68-1.18.21-.58.21-1.07.15-1.18-.07-.1-.23-.17-.48-.3z"/>
                        </svg>
                        <span>{{ __('ui.ask_whatsapp') }}</span>
                    </a>
                </div>

                {{-- VALUE PROPOSITIONS / TRUST BADGES --}}
                <div class="product-guarantee-list">
                    <div class="guarantee-item">
                        <span class="icon">📦</span>
                        <div class="text">
                            <strong>{{ __('ui.lab_packaging') }}</strong>
                            <small>{{ __('ui.lab_packaging_description') }}</small>
                        </div>
                    </div>
                    <div class="guarantee-item">
                        <span class="icon">🚚</span>
                        <div class="text">
                            <strong>{{ __('ui.shipping') }}</strong>
                            <small>{{ __('ui.shipping_description') }}</small>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        {{-- BOTTOM CARD: PRODUCT DESCRIPTION --}}
        <div class="product-description-container">
            <div class="product-description-card">
                <div class="product-tab-header">
                    <div class="product-tab-btn active">
                        <span class="tab-icon">📋</span>
                        <span>{{ __('ui.full_product_description') }}</span>
                    </div>
                </div>

                <div class="product-description-body">
                    @if($product->translated('description'))
                        <article class="product-markdown-content">
                            {!! Str::markdown(
                                $product->translated('description'),
                                [
                                    'html_input' => 'strip',
                                    'allow_unsafe_links' => false,
                                ]
                            ) !!}
                        </article>
                    @else
                        <div class="product-empty-description">
                            <p>Belum ada deskripsi detail untuk produk ini. Silakan hubungi kami untuk informasi spesifikasi teknis selengkapnya.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- BOTTOM: RELATED PRODUCTS --}}
        @if($related->count())
            <div class="related-products-wrapper">
                <div class="related-header">
                    <span class="related-eyebrow">REKOMENDASI PRODUK LAINNYA</span>
                    <h2>Produk Terkait</h2>
                    <p>Temukan solusi dan bioproduk inovatif lainnya yang relevan untuk kebutuhan laboratorium dan riset Anda.</p>
                    <div class="related-header-line"></div>
                </div>

                <div class="products-grid">
                    @foreach($related as $item)
                        <article class="product-card">
                            <div class="product-image-wrapper-wrap">
                                <a href="{{ route('products.show', $item) }}" class="product-image-wrapper">
                                    @if($item->image)
                                        <img
                                            src="{{ asset($item->image) }}"
                                            alt="{{ $item->name }}"
                                            class="product-image"
                                            loading="lazy"
                                        >
                                    @else
                                        <div class="product-no-image">
                                            <span>No Image</span>
                                        </div>
                                    @endif
                                </a>
                                @if($item->category)
                                    <span class="product-category-overlay">
                                        {{ $item->category->name }}
                                    </span>
                                @endif
                            </div>

                            <div class="product-card-content">

                                <h2 class="product-name">
                                    <a href="{{ route('products.show', $item) }}">
                                        {{ $item->name }}
                                    </a>
                                </h2>

                                <p class="product-description">
                                    {{ Str::limit(strip_tags(Str::markdown($item->translated('description') ?? '')), 90) ?: Str::limit($item->translated('description') ?? __('ui.no_description'), 90) }}
                                </p>

                                <div class="product-card-footer">
                                    @if($item->hasPublicPrice() && $item->price !== null)
                                        <div class="product-price">
                                            Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </div>
                                    @endif

                                    <a
                                        href="{{ route('products.show', $item) }}"
                                        class="product-detail-btn"
                                    >
                                        View Details
                                        <span>→</span>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</section>

@if($galleryImages->isNotEmpty())
    <div class="product-lightbox" id="productLightbox" aria-hidden="true">
        <button type="button" class="product-lightbox-close" id="productLightboxClose" aria-label="Close">&times;</button>
        <img src="{{ asset($galleryImages->first()) }}" alt="{{ $product->name }}" id="productLightboxImage">
    </div>
@endif

@if($galleryImages->count() > 1)
    <script>
        const galleryImage = document.getElementById('productGalleryImage');
        const lightboxImage = document.getElementById('productLightboxImage');

        document.querySelectorAll('.product-gallery-thumbnail').forEach((thumbnail) => {
            thumbnail.addEventListener('click', () => {
                galleryImage.src = thumbnail.dataset.galleryImage;
                lightboxImage.src = thumbnail.dataset.galleryImage;
                document.querySelectorAll('.product-gallery-thumbnail').forEach((item) => item.classList.remove('active'));
                thumbnail.classList.add('active');
            });
        });
    </script>
@endif

@if($galleryImages->isNotEmpty())
    <script>
        const productLightbox = document.getElementById('productLightbox');
        const productMainImageButton = document.getElementById('productMainImageButton');
        const productLightboxClose = document.getElementById('productLightboxClose');

        productMainImageButton?.addEventListener('click', () => {
            productLightbox.classList.add('is-open');
            productLightbox.setAttribute('aria-hidden', 'false');
        });

        productLightboxClose?.addEventListener('click', () => {
            productLightbox.classList.remove('is-open');
            productLightbox.setAttribute('aria-hidden', 'true');
        });

        productLightbox?.addEventListener('click', (event) => {
            if (event.target === productLightbox) {
                productLightboxClose.click();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                productLightboxClose?.click();
            }
        });
    </script>
@endif

@endsection