<footer class="site-footer">

    <div class="footer-main">

        <div class="container footer-grid">

            {{-- =================================================
                 BRAND
            ================================================== --}}
            <div class="footer-brand">

                <img
                    src="{{ asset('images/logo-inobi.png') }}"
                    alt="PT. Inovasi Bioproduk Indonesia"
                    class="footer-logo"
                >

                <h3>
                    {{ $siteSettings['site_name'] ?? 'INOBI' }}
                </h3>

                <p>
                    {{ $siteSettings['site_description'] ?? 'Innovation in Bioproducts for Health and Research.' }}
                </p>

            </div>


            {{-- =================================================
                 SITE NAVIGATION
            ================================================== --}}
            <div class="footer-column">

                <h4>
                    {{ __('ui.explore_inobi') }}
                </h4>

                <div class="footer-links">

                    <a href="{{ url('/') }}">
                        {{ __('ui.home') }}
                    </a>

                    <a href="{{ url('/#about-company') }}">
                        {{ __('ui.about') }}
                    </a>

                    <a href="{{ route('products.index') }}">
                        {{ __('ui.products') }}
                    </a>

                    <a href="{{ route('blog.index') }}">
                        {{ __('ui.blog') }}
                    </a>

                </div>

            </div>


            {{-- =================================================
                 CONTACT US
            ================================================== --}}
            <div class="footer-column">

                <h4>
                    {{ __('ui.find_us') }}
                </h4>

                <div class="footer-links">

                    @if(filled($siteSettings['company_email'] ?? $siteSettings['admin_email'] ?? null))
                        <a href="mailto:{{ $siteSettings['company_email'] ?? $siteSettings['admin_email'] }}">
                            {{ $siteSettings['company_email'] ?? $siteSettings['admin_email'] }}
                        </a>
                    @endif

                    <a
                        href="{{ $siteSettings['instagram_url'] ?? 'https://www.instagram.com/inobi.id/' }}"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        Instagram
                    </a>

                    <a
                        href="{{ $siteSettings['facebook_url'] ?? 'https://www.facebook.com/inobi.id' }}"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        Facebook
                    </a>

                    <a
                        href="{{ $siteSettings['whatsapp_url'] ?? 'https://wa.me/6281237411413' }}"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        WhatsApp
                    </a>

                    @if(filled($siteSettings['linkedin_url'] ?? null))
                        <a
                            href="{{ $siteSettings['linkedin_url'] }}"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            LinkedIn
                        </a>
                    @endif

                    @if(filled($siteSettings['address'] ?? null))
                        <span>{{ $siteSettings['address'] }}</span>
                    @endif

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         FOOTER BOTTOM
    ========================================================== --}}
    <div class="footer-bottom">

        <div class="container">

            <p>
                © {{ date('Y') }}
                {{ $siteSettings['site_name'] ?? 'INOBI' }}.
                {{ app()->getLocale() === 'id' ? 'Hak Cipta Dilindungi.' : 'All Rights Reserved.' }}
            </p>

        </div>

    </div>

</footer>