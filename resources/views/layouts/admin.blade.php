<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel - INOBI')</title>

    {{-- Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Manrope', -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;
            background: #f0f2f5;
            min-height: 100vh;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background: #14171C;
            color: #fff;
            padding: 20px 0;
            transition: transform 0.3s ease;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar-brand {
            text-align: center;
            padding: 0 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 20px;
        }

        .sidebar-brand img {
            width: 62px;
            height: 62px;
            padding: 5px;
            object-fit: contain;
            background: #fff;
            border: 1px solid rgba(42, 65, 106, 0.14);
            border-radius: 50%;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.18);
            margin-bottom: 10px;
        }

        .sidebar-brand h3 {
            font-size: 16px;
            font-weight: 800;
            color: #fff;
            margin: 0;
        }

        .sidebar-brand small {
            font-size: 11px;
            color: rgba(255,255,255,0.5);
        }

        .sidebar-menu {
            list-style: none;
            padding: 0 15px;
            margin: 0;
        }

        .sidebar-menu li {
            margin-bottom: 2px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.25s ease;
            font-size: 14px;
            font-weight: 500;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(255,255,255,0.08);
            color: #fff;
        }

        .sidebar-menu a i {
            width: 20px;
            font-size: 16px;
            text-align: center;
        }

        .sidebar-menu .divider {
            padding: 15px 16px 8px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.3);
        }

        .language-switcher {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: #7b8794;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .language-switcher a {
            color: inherit;
            text-decoration: none;
        }

        .language-switcher a.active,
        .language-switcher a:hover {
            color: #2A416A;
        }

        .admin-language-switcher {
            margin-left: auto;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px 30px;
            min-height: 100vh;
        }

        .top-nav {
            background: #fff;
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-nav h4 {
            margin: 0;
            font-size: 21px;
            font-weight: 700;
            color: #14171C;
            letter-spacing: -0.2px;
        }

        .top-nav .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .top-nav .user-info .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #2A416A;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 16px;
        }

        .top-nav .user-info .name {
            font-size: 14px;
            font-weight: 600;
            color: #14171C;
        }

        .top-nav .user-info .role {
            font-size: 12px;
            color: #999;
        }

        .toggle-sidebar {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            color: #14171C;
            cursor: pointer;
        }

        .card {
            border-radius: 10px;
            border: 1px solid #e8eaed;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            transition: all 0.25s ease;
        }

        .card:hover {
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid #e8eaed;
            padding: 16px 20px;
            font-weight: 600;
        }

        .card-body {
            padding: 20px;
        }

        .admin-page {
            font-size: 14px;
            color: #263238;
        }

        .admin-page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 24px;
        }

        .admin-page-header h1 {
            margin: 0 0 5px;
            font-size: 26px;
            font-weight: 800;
            letter-spacing: -0.4px;
        }

        .admin-page-header p {
            margin: 0;
            color: #7b8794;
            line-height: 1.5;
        }

        .admin-card {
            overflow: hidden;
        }

        .admin-table thead th {
            padding: 14px 16px;
            background: #f8fafc;
            color: #59636e;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .04em;
            text-transform: uppercase;
            border-bottom: 1px solid #e8eaed;
        }

        .admin-table tbody td {
            padding: 15px 16px;
            color: #374151;
        }

        .admin-work-thumb {
            width: 82px;
            height: 58px;
            object-fit: cover;
            border-radius: 8px;
            background: #f1f3f5;
        }

        .admin-work-preview {
            width: 220px;
            height: 145px;
            object-fit: cover;
            border-radius: 10px;
        }

        .admin-image-preview-card {
            position: relative;
        }

        .admin-image-remove {
            position: absolute;
            top: 5px;
            right: 5px;
            z-index: 2;
            width: 24px;
            height: 24px;
            padding: 0;
            border: 0;
            border-radius: 50%;
            color: #fff;
            background: #dc3545;
            font-size: 16px;
            line-height: 24px;
            cursor: pointer;
        }

        .admin-page .form-label {
            font-size: 13px;
            font-weight: 700;
            color: #374151;
        }

        .admin-page .form-control,
        .admin-page .form-select {
            min-height: 42px;
            border-color: #dfe3e8;
            border-radius: 8px;
            font-family: inherit;
            font-size: 14px;
        }

        .admin-page textarea.form-control {
            min-height: 100px;
        }

        .admin-page .btn {
            font-family: inherit;
            font-size: 13px;
            font-weight: 700;
        }

        .admin-page .admin-table strong {
            font-weight: 750;
            color: #263238;
        }

        @media (max-width: 768px) {
            .admin-page-header {
                align-items: flex-start;
                flex-direction: column;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 15px;
            }

            .toggle-sidebar {
                display: block;
            }

            .top-nav {
                flex-wrap: wrap;
                gap: 10px;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- Sidebar --}}
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <img src="{{ asset('images/logo-inobi.png') }}" alt="INOBI">
            <h3>INOBI {{ __('ui.admin') }}</h3>
            <small>PT. Inovasi Bioproduk Indonesia</small>
        </div>

        <ul class="sidebar-menu">
            <li class="divider">{{ __('ui.dashboard') }}</li>
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-pie"></i> {{ __('ui.dashboard') }}
                </a>
            </li>

            <li class="divider">{{ __('ui.content') }}</li>
            <li>
                <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="fas fa-box"></i> {{ __('ui.products') }}
                </a>
            </li>
            <li>
                <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="fas fa-folder"></i> Kategori Produk
                </a>
            </li>
            <li>
                <a href="{{ route('admin.blog.index') }}" class="{{ request()->routeIs('admin.blog.*') ? 'active' : '' }}">
                    <i class="fas fa-newspaper"></i> {{ __('ui.blog') }}
                </a>
            </li>
            <li>
                <a href="{{ route('admin.featured-works.index') }}" class="{{ request()->routeIs('admin.featured-works.*') ? 'active' : '' }}">
                    <i class="fas fa-images"></i> {{ __('ui.featured_work_admin') }}
                </a>
            </li>

            <li class="divider">{{ __('ui.system') }}</li>
            <li>
                <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> {{ __('ui.users') }}
                </a>
            </li>
            <li>
                <a href="{{ route('admin.settings') }}" class="{{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i> {{ __('ui.settings') }}
                </a>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" style="background: none; border: none; width: 100%; text-align: left; padding: 12px 16px; color: rgba(255,255,255,0.7); font-size: 14px; font-weight: 500; border-radius: 6px; transition: all 0.25s ease; display: flex; align-items: center; gap: 12px; cursor: pointer;">
                        <i class="fas fa-sign-out-alt"></i> {{ __('ui.logout') }}
                    </button>
                </form>
            </li>
        </ul>
    </nav>

    {{-- Main Content --}}
    <div class="main-content">

        {{-- Top Nav --}}
        <div class="top-nav">
            <div class="d-flex align-items-center gap-3">
                <button class="toggle-sidebar" id="toggleSidebar">
                    <i class="fas fa-bars"></i>
                </button>
                <h4>@yield('title', 'Dashboard')</h4>
            </div>

            <div class="user-info">
                <div>
                    <div class="name">{{ Auth::user()->name ?? 'Admin' }}</div>
                    <div class="role">{{ __('ui.administrator') }}</div>
                </div>
                <div class="language-switcher admin-language-switcher">
                    <a href="{{ route('language.switch', 'id') }}" class="{{ app()->getLocale() === 'id' ? 'active' : '' }}">ID</a>
                    <span>/</span>
                    <a href="{{ route('language.switch', 'en') }}" class="{{ app()->getLocale() === 'en' ? 'active' : '' }}">EN</a>
                </div>
                <div class="avatar">
                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                </div>
            </div>
        </div>

        {{-- Content --}}
        @yield('content')

    </div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('toggleSidebar')?.addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('open');
        });

        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.getElementById('toggleSidebar');

            if (window.innerWidth <= 768) {
                if (!sidebar.contains(e.target) && !toggle.contains(e.target)) {
                    sidebar.classList.remove('open');
                }
            }
        });
    </script>
    @stack('scripts')
</body>
</html>