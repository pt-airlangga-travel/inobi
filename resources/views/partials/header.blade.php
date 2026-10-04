<header class="site-header">

    <div class="header-container">

        <!-- BRAND -->
        <a href="{{ url('/') }}" class="brand">
            <img src="{{ asset('images/logo-inobi.png') }}" alt="PT. Inovasi Bioproduk Indonesia">
            <span>PT. Inovasi Bioproduk Indonesia</span>
        </a>

        <!-- NAVIGATION -->
        <nav class="main-nav" id="mainNav">

            <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">
                {{ __('ui.home') }}
            </a>

            <a href="{{ url('/#about-company') }}">
                {{ __('ui.about') }}
            </a>
            
            <div class="nav-dropdown" id="navDropdown">

                <button type="button" class="products-link {{ request()->is('products*') ? 'active' : '' }}" id="productsDropdownBtn" aria-expanded="false">
                    <span>{{ __('ui.products') }}</span> <span class="arrow">⌄</span>
                </button>

                <div class="dropdown-menu">

                    <div class="dropdown-heading">
                        <span>{{ __('ui.our_products') }}</span>
                        <p>{{ __('ui.featured_products') }}</p>
                    </div>

                    <div class="dropdown-products">

                        @forelse ($headerProducts ?? [] as $product)

                            <a href="{{ route('products.show', $product) }}">
                                <strong>{{ $product->name }}</strong>
                                <small>{{ $product->category?->name ?? __('ui.products') }}</small>
                            </a>

                        @empty

                            <div class="dropdown-empty">
                                <span>{{ __('ui.no_products') }}</span>
                            </div>

                        @endforelse

                    </div>

                    <a href="{{ route('products.index') }}" class="view-all-products">
                        {{ __('ui.view_all_products') }} <span>→</span>
                    </a>

                </div>

            </div>

            <a href="{{ url('/blog') }}" class="{{ request()->is('blog*') ? 'active' : '' }}">
                {{ __('ui.blog') }}
            </a>

        </nav>

        <!-- ACTIONS: LANGUAGE SWITCHER & MOBILE BUTTON -->
        <div class="header-actions">
            <div class="language-switcher" aria-label="{{ __('ui.language') }}">
                <a href="{{ route('language.switch', 'id') }}" class="{{ app()->getLocale() === 'id' ? 'active' : '' }}">ID</a>
                <span>/</span>
                <a href="{{ route('language.switch', 'en') }}" class="{{ app()->getLocale() === 'en' ? 'active' : '' }}">EN</a>
            </div>

            <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="{{ __('ui.menu') }}" aria-expanded="false" aria-controls="mainNav">
                <span class="hamburger-icon" aria-hidden="true">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </button>
        </div>

    </div>

    <!-- MOBILE BACKDROP -->
    <div class="mobile-menu-backdrop" id="mobileBackdrop" aria-hidden="true"></div>

</header>