document.addEventListener('DOMContentLoaded', function () {
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mainNav = document.getElementById('mainNav');
    const mobileBackdrop = document.getElementById('mobileBackdrop');
    const productsDropdownBtn = document.getElementById('productsDropdownBtn');
    const navDropdown = document.getElementById('navDropdown');

    if (!mobileMenuBtn || !mainNav) {
        return;
    }

    function openMenu() {
        mobileMenuBtn.classList.add('is-active');
        mobileMenuBtn.setAttribute('aria-expanded', 'true');
        mainNav.classList.add('is-open');
        if (mobileBackdrop) {
            mobileBackdrop.classList.add('is-open');
        }
        document.body.classList.add('menu-open');
    }

    function closeMenu() {
        mobileMenuBtn.classList.remove('is-active');
        mobileMenuBtn.setAttribute('aria-expanded', 'false');
        mainNav.classList.remove('is-open');
        if (mobileBackdrop) {
            mobileBackdrop.classList.remove('is-open');
        }
        document.body.classList.remove('menu-open');
        if (navDropdown) {
            navDropdown.classList.remove('is-open');
        }
        if (productsDropdownBtn) {
            productsDropdownBtn.setAttribute('aria-expanded', 'false');
        }
    }

    function toggleMenu() {
        const isOpen = mainNav.classList.contains('is-open');
        if (isOpen) {
            closeMenu();
        } else {
            openMenu();
        }
    }

    mobileMenuBtn.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        toggleMenu();
    });

    if (mobileBackdrop) {
        mobileBackdrop.addEventListener('click', function () {
            closeMenu();
        });
    }

    // Toggle products dropdown on mobile
    if (productsDropdownBtn && navDropdown) {
        productsDropdownBtn.addEventListener('click', function (e) {
            if (window.innerWidth <= 767) {
                e.preventDefault();
                e.stopPropagation();
                const isDropdownOpen = navDropdown.classList.toggle('is-open');
                productsDropdownBtn.setAttribute('aria-expanded', isDropdownOpen ? 'true' : 'false');
            }
        });
    }

    // Close mobile menu when clicking normal links
    mainNav.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', function () {
            if (window.innerWidth <= 767) {
                closeMenu();
            }
        });
    });

    // Close on Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && mainNav.classList.contains('is-open')) {
            closeMenu();
        }
    });

    // Close when window resized to desktop
    window.addEventListener('resize', function () {
        if (window.innerWidth > 767 && mainNav.classList.contains('is-open')) {
            closeMenu();
        }
    });
});
