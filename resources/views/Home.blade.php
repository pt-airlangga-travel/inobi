@extends('layouts.app')

@section('title', 'PT. Inovasi Bioproduk Indonesia')

@section('description', 'PT. Inovasi Bioproduk Indonesia menyediakan produk bioproduk, peralatan laboratorium, diagnostik, dan kebutuhan penelitian.')

@section('content')

<!-- =========================================================
     HERO
========================================================= -->

<section class="hero">

    <!-- VIDEO -->
    <video
        autoplay
        muted
        loop
        playsinline
        class="hero-video">

        <source
            src="{{ asset('videos/Video-Home-inobi-11.mp4') }}"
            type="video/mp4">

        {{ __('ui.video_not_supported') }}

    </video>


    <!-- HERO CONTENT -->
    <div class="hero-content">

        <p class="hero-label">
            INNOVATION • BIOPRODUCT • HEALTH
        </p>

        <h1>
            {{ __('ui.hero_title') }}
            <br>
            {{ __('ui.hero_title_2') }}
        </h1>

        <p class="hero-description">
            {{ __('ui.hero_description') }}
        </p>

        <div class="hero-buttons">

            <a
                href="#products"
                class="btn btn-primary">
                {{ __('ui.explore_products') }}
            </a>

        </div>

    </div>

</section>



<!-- =========================================================
     {{ __('ui.about_company') }}
========================================================= -->

<section
    class="about-company"
    id="about-company">

    <div class="container">

        <div class="about-company-grid">

            <!-- LEFT -->
            <div class="about-company-heading">

                <span>
                    ABOUT COMPANY
                </span>

                <img
                    src="{{ asset('images/logo-inobi.png') }}"
                    alt="Logo PT. Inovasi Bioproduk Indonesia"
                    class="about-company-logo">

                <h2>
                    PT. Inovasi Bioproduk Indonesia
                </h2>

            </div>


            <!-- RIGHT -->
            <div class="about-company-content">

                <p>
                    {{ __('ui.about_intro') }}
                </p>

                <p>
                    {{ __('ui.about_mission') }}
                </p>


                <!-- COMMITMENT -->

                <div class="about-commitment">

                    <span>
                            {{ __('ui.our_commitment') }}
                    </span>

                    <p>
                        {{ __('ui.commitment_one') }}
                    </p>

                    <p>
                        {{ __('ui.commitment_two') }}
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>



<!-- =========================================================
     PRODUCTS
========================================================= -->

<section class="home-products" id="products">

    <div class="products-container">

        {{-- SECTION HEADER --}}
        <div class="products-header">

            <span class="products-eyebrow">{{ __('ui.our_products') }}</span>

            <h2>{{ __('ui.featured_products') }}</h2>

            <p>
                {{ __('ui.products_description') }}
            </p>

            <div class="products-header-line"></div>

        </div>


        {{-- PRODUCT GRID --}}
        @if($products->count() > 0)

            <div class="products-grid">

                @foreach($products as $product)

                    <article class="product-card {{ $product->hasPublicPrice() ? 'product-card-priced' : 'product-card-description' }}">

                        {{-- IMAGE + CATEGORY OVERLAY --}}
                        <div class="product-image-wrapper-wrap">
                            <a href="{{ route('products.show', $product) }}" class="product-image-wrapper">

                                @if($product->image)
                                    <img
                                        src="{{ asset($product->image) }}"
                                        alt="{{ $product->name }}"
                                        class="product-image"
                                        loading="lazy"
                                    >
                                @else
                                    <div class="product-no-image">
                                        <span>{{ __('ui.no_image') }}</span>
                                    </div>
                                @endif

                            </a>

                            {{-- CATEGORY BADGE ON IMAGE --}}
                            @if($product->category)
                                <span class="product-category-overlay">
                                    {{ $product->category->name }}
                                </span>
                            @endif
                        </div>


                        {{-- CONTENT --}}
                        <div class="product-card-content">

                            {{-- NAME --}}
                            <h2 class="product-name">
                                <a href="{{ route('products.show', $product) }}">
                                    {{ $product->name }}
                                </a>
                            </h2>


                            {{-- DESCRIPTION --}}
                            <p class="product-description">
                                {{ Str::limit(strip_tags(Str::markdown($product->translated('description') ?? '')), 90) ?: Str::limit($product->translated('description') ?? 'No description available.', 90) }}
                            </p>


                            {{-- FOOTER --}}
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

        @else

            {{-- EMPTY --}}
            <div class="products-empty">

                <div class="products-empty-icon">
                    📦
                </div>

                <h2>{{ __('ui.no_products') }}</h2>

                <p>
                    {{ __('ui.no_products_description') }}
                </p>

            </div>

        @endif


        <div class="home-products-action">

            <a
                href="{{ route('products.index') }}"
                class="home-products-button"
            >
                {{ __('ui.view_all_products') }} →
            </a>

        </div>

    </div>

</section>


<!-- =========================================================
     {{ __('ui.featured_product') }}
========================================================= -->

@if($featuredProduct)
<section class="featured-product">

    <div class="container">

        <div class="featured-grid">


            <!-- IMAGE -->

            <div class="featured-image">

                <img
                    src="{{ asset($featuredProduct->image ?: 'images/bhanex.png') }}"
                    alt="{{ $featuredProduct->name }}">

            </div>



            <!-- CONTENT -->

            <div class="featured-content">

                <span class="section-label">
                    FEATURED PRODUCT
                </span>

                <h2>
                    {{ $featuredProduct->name }}
                </h2>

                <p>
                    {{ Str::limit(strip_tags(Str::markdown($featuredProduct->translated('description') ?: 'Produk unggulan INOBI untuk mendukung kebutuhan biomaterial, penelitian, dan aplikasi medis.')), 220) }}
                </p>


                <!-- PRODUCT INFORMATION -->

                <div class="featured-info">

                    <div class="featured-info-item">

                        <strong>
                            {{ __('ui.biomaterial') }}
                        </strong>

                        <span>
                            {{ __('ui.bone_material') }}
                        </span>

                    </div>


                    <div class="featured-info-item">

                        <strong>
                            {{ __('ui.research') }}
                        </strong>

                        <span>
                            {{ __('ui.research_support') }}
                        </span>

                    </div>


                    <div class="featured-info-item">

                        <strong>
                            {{ __('ui.innovation') }}
                        </strong>

                        <span>
                            {{ __('ui.bioproduct') }}
                        </span>

                    </div>

                </div>

                @if($featuredProduct->hasPublicPrice())
                    <div class="featured-price">
                        <span>{{ __('ui.starting_from') }}</span>
                        <strong>Rp {{ number_format($featuredProduct->price, 0, ',', '.') }}</strong>
                    </div>
                @endif

                <div class="featured-actions">
                    <a
                        href="{{ route('products.show', $featuredProduct) }}"
                        class="btn btn-light">
                        {{ __('ui.explore_product') }} →
                    </a>
                    @if($featuredProduct->tokopedia_url)
                        <a href="{{ $featuredProduct->tokopedia_url }}" class="featured-marketplace tokopedia" target="_blank" rel="noopener noreferrer">
                            {{ __('ui.buy_tokopedia') }}
                        </a>
                    @endif
                    @if($featuredProduct->shopee_url)
                        <a href="{{ $featuredProduct->shopee_url }}" class="featured-marketplace shopee" target="_blank" rel="noopener noreferrer">
                            {{ __('ui.buy_shopee') }}
                        </a>
                    @endif
                </div>

            </div>

        </div>

    </div>

</section>
@endif



<!-- =========================================================
     FIND US
========================================================= -->

<section class="section find-section" id="shop">

    <div class="container">

        <div class="section-heading">
            <span>{{ __('ui.find_us') }}</span>
            <h2>{{ __('ui.shop_our_products') }}</h2>
            <p>{{ __('ui.marketplace_description') }}</p>
        </div>

        <div class="marketplace-grid">

            <!-- TOKOPEDIA -->
            <a href="https://www.tokopedia.com/inobi" target="_blank" rel="noopener noreferrer" class="marketplace">
                <div class="marketplace-logo">
                    <img src="{{ asset('images/tokopedia.png') }}" alt="Tokopedia">
                </div>
                <div class="marketplace-content">
                    <span class="marketplace-label">{{ __('ui.marketplace') }}</span>
                    <h3>Tokopedia</h3>
                    <p>{{ __('ui.tokopedia_description') }}</p>
                    <span class="marketplace-link">{{ __('ui.visit_store') }} <span>→</span></span>
                </div>
            </a>

            <!-- SHOPEE -->
            <a href="https://shopee.co.id/shop/227544336" target="_blank" rel="noopener noreferrer" class="marketplace">
                <div class="marketplace-logo">
                    <img src="{{ asset('images/shopee.png') }}" alt="Shopee">
                </div>
                <div class="marketplace-content">
                    <span class="marketplace-label">{{ __('ui.marketplace') }}</span>
                    <h3>Shopee</h3>
                    <p>{{ __('ui.shopee_description') }}</p>
                    <span class="marketplace-link">{{ __('ui.visit_store') }} <span>→</span></span>
                </div>
            </a>

        </div>

    </div>

</section>



<!-- =========================================================
     FEATURED WORK
========================================================= -->

<section class="section featured-work" id="our-work">

    <div class="container">

        <div class="section-heading left">
            <span>{{ __('ui.featured_work') }}</span>
            <h2>{{ __('ui.our_work_innovation') }}</h2>
            <p>{{ __('ui.work_description') }}</p>
        </div>

        <div class="work-carousel" aria-label="Dokumentasi kegiatan INOBI">
            <div class="work-track">
                @foreach($featuredWorks as $work)
                    <article class="work-card">
                        <div class="work-image">
                            <img src="{{ asset($work->image) }}" alt="{{ $work->translated('title') }}" loading="lazy">
                            <div class="work-overlay">
                                <span class="work-index">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                <h3>{{ $work->translated('title') }}</h3>
                                <p>{{ $work->translated('description') }}</p>
                            </div>
                        </div>
                    </article>
                @endforeach

                @foreach($featuredWorks as $work)
                    <article class="work-card" aria-hidden="true">
                        <div class="work-image">
                            <img src="{{ asset($work->image) }}" alt="" loading="lazy">
                            <div class="work-overlay">
                                <span class="work-index">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                <h3>{{ $work->translated('title') }}</h3>
                                <p>{{ $work->translated('description') }}</p>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>

    </div>

</section>



<!-- =========================================================
     CUSTOMERS
========================================================= -->

<section class="customers" id="our-customers">
    <div class="container">

        <div class="section-heading">
            <span>OUR CUSTOMERS</span>
            <h2>Trusted by Institutions</h2>
            <p>Dipercaya oleh berbagai institusi pendidikan, penelitian, dan kesehatan.</p>
        </div>

        <div class="customers-grid">
            <div class="customer-item"><img src="{{ asset('images/unair.png') }}" alt="Universitas Airlangga"></div>
            <div class="customer-item"><img src="{{ asset('images/uc.png') }}" alt="Universitas Ciputra"></div>
            <div class="customer-item"><img src="{{ asset('images/poltekkes.png') }}" alt="Poltekkes Surabaya"></div>
            <div class="customer-item"><img src="{{ asset('images/customer.png') }}" alt="Customer"></div>
            <div class="customer-item"><img src="{{ asset('images/seed-origin.png') }}" alt="Seed Origin" class="is-round"></div>
            <div class="customer-item"><img src="{{ asset('images/itd.png') }}" alt="Institute of Tropical Disease"></div>
            <div class="customer-item"><img src="{{ asset('images/rshp.png') }}" alt="Rumah Sakit Hewan"></div>
        </div>

    </div>
</section>
@endsection