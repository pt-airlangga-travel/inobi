<footer class="site-footer">

    <div class="footer-main">

        <div class="container footer-grid">

            {{-- =================================================
                 BRAND
            ================================================== --}}
            <div class="footer-brand">

                <div class="footer-brand-header">
                    <img
                        src="{{ asset('images/logo-footer-new.png') }}"
                        alt="PT. Inovasi Bioproduk Indonesia"
                        class="footer-logo"
                    >
                    <h3>{{ $siteSettings['site_name'] ?? 'PT. Inovasi Bioproduk Indonesia' }}</h3>
                </div>

                <div class="footer-parent-company">
                    Part of <a href="{{ $siteSettings['footer_part_of_url'] ?? 'https://dpacorp.id/' }}" target="_blank" rel="noopener noreferrer">{{ $siteSettings['footer_part_of_' . app()->getLocale()] ?? $siteSettings['footer_part_of_id'] ?? 'PT Dharma Putra Airlangga' }}</a>
                </div>

                <p>
                    {{ $siteSettings['site_description_' . app()->getLocale()] ?? $siteSettings['site_description_id'] ?? __('ui.company_profile_footer') }}
                </p>

                <div class="footer-social-icons">
                    <a href="{{ $siteSettings['instagram_url'] ?? 'https://www.instagram.com/inobi.id/' }}" target="_blank" rel="noopener noreferrer" class="social-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                    </a>
                    <a href="{{ $siteSettings['linkedin_url'] ?? 'https://www.linkedin.com/company/ptinobi/home/' }}" target="_blank" rel="noopener noreferrer" class="social-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                    </a>
                    <a href="{{ $siteSettings['whatsapp_url'] ?? 'https://wa.me/6281237411413' }}" target="_blank" rel="noopener noreferrer" class="social-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                    </a>
                </div>

            </div>
            
            {{-- =================================================
                 SITE NAVIGATION
            ================================================== --}}
            <div class="footer-column">

                <h4>
                    {{ $siteSettings['footer_explore_title_' . app()->getLocale()] ?? $siteSettings['footer_explore_title_id'] ?? __('ui.explore_inobi') }}
                </h4>

                <div class="footer-links with-chevron">
                    <a href="{{ url('/') }}">{{ __('ui.home') }}</a>
                    <a href="{{ url('/#about-company') }}">{{ __('ui.about') }}</a>
                    <a href="{{ route('products.index') }}">{{ __('ui.products') }}</a>
                    <a href="{{ route('blog.index') }}">{{ __('ui.blog') }}</a>
                </div>

            </div>


            {{-- =================================================
                 CONTACT US
            ================================================== --}}
            <div class="footer-column">

                <h4>
                    {{ $siteSettings['footer_find_us_title_' . app()->getLocale()] ?? $siteSettings['footer_find_us_title_id'] ?? __('ui.find_us') }}
                </h4>

                <div class="footer-contact">

                    <div class="contact-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#ffb703" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        <span>{{ $siteSettings['address_' . app()->getLocale()] ?? $siteSettings['address_id'] ?? 'Plaza Universitas Airlangga Kampus MERR C, Jalan Dr. Ir. H. Soekarno, Mulyorejo, Kecamatan Mulyorejo, Kota Surabaya, Jawa Timur 60115' }}</span>
                    </div>
                    
                    @if(filled($siteSettings['company_email'] ?? $siteSettings['admin_email'] ?? 'admin@inobi.com'))
                        <div class="contact-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="#ffb703" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                            <a href="mailto:{{ $siteSettings['company_email'] ?? $siteSettings['admin_email'] ?? 'admin@inobi.com' }}">
                                {{ $siteSettings['company_email'] ?? $siteSettings['admin_email'] ?? 'admin@inobi.com' }}
                            </a>
                        </div>
                    @endif

                    <div class="contact-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#ffb703" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                        <a href="{{ $siteSettings['whatsapp_url'] ?? 'https://wa.me/6281237411413' }}" target="_blank" rel="noopener noreferrer">
                            WhatsApp
                        </a>
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         FOOTER BOTTOM
    ========================================================== --}}
    <div class="footer-bottom">

        <div class="container footer-bottom-container">

            <p style="text-align: left; margin: 0;">
                &copy; {{ date('Y') }} PT. Inovasi Bioproduk Indonesia. {{ app()->getLocale() === 'id' ? 'Hak Cipta Dilindungi.' : 'All Rights Reserved.' }}
            </p>

            <div class="footer-bottom-links">
                <a href="#">{{ app()->getLocale() === 'id' ? 'Hubungi Kami' : 'Contact Us' }}</a>
                <a href="#">{{ app()->getLocale() === 'id' ? 'Kebijakan Privasi' : 'Privacy Policy' }}</a>
            </div>

        </div>

    </div>

</footer>
