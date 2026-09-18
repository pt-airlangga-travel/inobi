@extends('layouts.admin')

@section('title', 'Dashboard - Admin INOBI')

@section('content')
<div class="container-fluid">
    
    {{-- Welcome Section --}}
    <div class="welcome-section mb-4">
        <div class="welcome-card">
            <div class="welcome-text">
                <h2>Welcome back, {{ Auth::user()->name ?? 'Admin' }}! 👋</h2>
                <p class="text-muted">Here's what's happening with your business today.</p>
            </div>
            <div class="welcome-date">
                <span class="date-badge">
                    <i class="far fa-calendar-alt me-2"></i>
                    {{ date('l, d F Y') }}
                </span>
            </div>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="stat-card stat-card-primary">
                <div class="stat-icon">
                    <i class="fas fa-box"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-number">{{ $totalProducts }}</h3>
                    <p class="stat-label">Total Products</p>
                </div>
                <div class="stat-trend trend-up">
                    <i class="fas fa-arrow-up"></i> 12%
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stat-card stat-card-success">
                <div class="stat-icon">
                    <i class="fas fa-newspaper"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-number">{{ $totalBlogs }}</h3>
                    <p class="stat-label">Total Blogs</p>
                </div>
                <div class="stat-trend trend-up">
                    <i class="fas fa-arrow-up"></i> 8%
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stat-card stat-card-warning">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-number">{{ $totalUsers }}</h3>
                    <p class="stat-label">Total Users</p>
                </div>
                <div class="stat-trend trend-up">
                    <i class="fas fa-arrow-up"></i> 5%
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stat-card stat-card-info">
                <div class="stat-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-number">{{ number_format($totalViews) }}</h3>
                    <p class="stat-label">Total Views</p>
                </div>
                <div class="stat-trend trend-up">
                    <i class="fas fa-arrow-up"></i> 23%
                </div>
            </div>
        </div>
    </div>

    {{-- Content Row --}}
    <div class="row g-4">
        
        {{-- Quick Actions --}}
        <div class="col-xl-4 col-lg-5">
            <div class="card action-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-bolt me-2 text-primary"></i>Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="action-grid">
                        <a href="{{ route('admin.products.index') }}" class="action-item">
                            <div class="action-icon" style="background: #e8f0fe; color: #2A416A;">
                                <i class="fas fa-box"></i>
                            </div>
                            <span>Manage Products</span>
                        </a>
                        <a href="{{ route('admin.blog.index') }}" class="action-item">
                            <div class="action-icon" style="background: #e6f7e6; color: #28a745;">
                                <i class="fas fa-newspaper"></i>
                            </div>
                            <span>Manage Blog</span>
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="action-item">
                            <div class="action-icon" style="background: #fff3e0; color: #ffc107;">
                                <i class="fas fa-users"></i>
                            </div>
                            <span>Manage Users</span>
                        </a>
                        <a href="{{ route('admin.settings') }}" class="action-item">
                            <div class="action-icon" style="background: #f3e5f5; color: #9c27b0;">
                                <i class="fas fa-cog"></i>
                            </div>
                            <span>Settings</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Recent Activity --}}
        <div class="col-xl-4 col-lg-7">
            <div class="card activity-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-clock me-2 text-primary"></i>Recent Activity
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="activity-list">
                        @forelse($recentActivities as $activity)
                            <div class="activity-item">
                                <div class="activity-icon">{{ $activity['icon'] }}</div>
                                <div class="activity-content">
                                    <span class="activity-message">{{ $activity['message'] }}</span>
                                    <span class="activity-time">{{ $activity['time'] }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-muted py-4">No recent activity</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- Recent Products --}}
<div class="col-xl-4 col-lg-12">
    <div class="card product-card h-100">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">
                <i class="fas fa-box me-2 text-primary"></i>Recent Products
            </h5>
            <a href="{{ route('admin.products.index') }}" class="btn-link">View All →</a>
        </div>
        <div class="card-body p-0">
            <div class="product-list">
                @forelse($recentProducts as $product)
                    <div class="product-item">
                        <div class="product-info">
                            <span class="product-name">{{ $product->name }}</span>
                            <span class="product-category">{{ $product->category?->name ?? 'Uncategorized' }}</span>
                        </div>
                        <span class="product-price">Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}</span>
                    </div>
                @empty
                    <div class="text-center text-muted py-4">No products yet</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

    {{-- Recent Blogs Row --}}
    <div class="row g-4 mt-2">
        <div class="col-12">
            <div class="card blog-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-newspaper me-2 text-primary"></i>Recent Blog Posts
                    </h5>
                    <a href="{{ route('admin.blog.index') }}" class="btn-link">View All →</a>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        @forelse($recentBlogs as $blog)
                            <div class="col-md-4">
                                <div class="blog-mini-card">
                                    <div class="blog-mini-image" style="background: linear-gradient(135deg, #2A416A, #1f3152);">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                    <div class="blog-mini-content">
                                        <h6>{{ Str::limit($blog->title ?? 'Untitled', 40) }}</h6>
                                        <span class="blog-mini-date">{{ $blog->created_at->diffForHumans() ?? 'Just now' }}</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center text-muted py-4">No blog posts yet</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('styles')
<style>
    /* Welcome Section */
    .welcome-card {
        background: linear-gradient(135deg, #2A416A 0%, #1f3152 100%);
        border-radius: 12px;
        padding: 25px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .welcome-text h2 {
        color: #fff;
        font-size: 24px;
        font-weight: 700;
        margin: 0;
    }

    .welcome-text p {
        color: rgba(255,255,255,0.7);
        margin: 5px 0 0;
        font-size: 14px;
    }

    .date-badge {
        background: rgba(255,255,255,0.15);
        color: #fff;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        backdrop-filter: blur(10px);
    }

    /* Stat Cards */
    .stat-card {
        background: #fff;
        border-radius: 12px;
        padding: 20px 24px;
        border: 1px solid #e8eaed;
        display: flex;
        align-items: center;
        gap: 16px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }

    .stat-card-primary .stat-icon {
        background: #e8f0fe;
        color: #2A416A;
    }

    .stat-card-success .stat-icon {
        background: #e6f7e6;
        color: #28a745;
    }

    .stat-card-warning .stat-icon {
        background: #fff3e0;
        color: #ffc107;
    }

    .stat-card-info .stat-icon {
        background: #e3f2fd;
        color: #17a2b8;
    }

    .stat-content {
        flex: 1;
        min-width: 0;
    }

    .stat-number {
        font-size: 28px;
        font-weight: 800;
        color: #14171C;
        margin: 0;
        line-height: 1.2;
    }

    .stat-label {
        font-size: 13px;
        color: #777;
        margin: 2px 0 0;
    }

    .stat-trend {
        font-size: 12px;
        font-weight: 600;
        padding: 2px 10px;
        border-radius: 20px;
        flex-shrink: 0;
    }

    .trend-up {
        background: #e6f7e6;
        color: #28a745;
    }

    .trend-down {
        background: #fde8e8;
        color: #dc3545;
    }

    /* Action Grid */
    .action-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .action-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        padding: 16px 12px;
        border-radius: 10px;
        border: 1px solid #e8eaed;
        text-decoration: none;
        color: #14171C;
        transition: all 0.25s ease;
    }

    .action-item:hover {
        border-color: #2A416A;
        background: #f8f9fc;
        transform: translateY(-2px);
        text-decoration: none;
        color: #14171C;
    }

    .action-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .action-item span {
        font-size: 12px;
        font-weight: 600;
        text-align: center;
    }

    /* Activity List */
    .activity-list {
        padding: 8px 0;
    }

    .activity-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 12px 20px;
        border-bottom: 1px solid #f0f0f0;
        transition: background 0.2s ease;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-item:hover {
        background: #f8f9fc;
    }

    .activity-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #f0f2f5;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .activity-content {
        flex: 1;
        min-width: 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
    }

    .activity-message {
        font-size: 14px;
        font-weight: 500;
        color: #333;
    }

    .activity-time {
        font-size: 12px;
        color: #999;
        flex-shrink: 0;
    }

    /* Product List */
    .product-list {
        padding: 8px 0;
    }

    .product-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 20px;
        border-bottom: 1px solid #f0f0f0;
        transition: background 0.2s ease;
    }

    .product-item:last-child {
        border-bottom: none;
    }

    .product-item:hover {
        background: #f8f9fc;
    }

    .product-info {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .product-name {
        font-size: 14px;
        font-weight: 600;
        color: #14171C;
    }

    .product-category {
        font-size: 11px;
        color: #999;
    }

    .product-price {
        font-size: 14px;
        font-weight: 700;
        color: #2A416A;
    }

    /* Blog Mini Card */
    .blog-mini-card {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 12px 16px;
        border: 1px solid #e8eaed;
        border-radius: 10px;
        transition: all 0.25s ease;
    }

    .blog-mini-card:hover {
        border-color: #2A416A;
        background: #f8f9fc;
    }

    .blog-mini-image {
        width: 48px;
        height: 48px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 20px;
        flex-shrink: 0;
    }

    .blog-mini-content {
        flex: 1;
        min-width: 0;
    }

    .blog-mini-content h6 {
        margin: 0;
        font-size: 14px;
        font-weight: 600;
        color: #14171C;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .blog-mini-date {
        font-size: 11px;
        color: #999;
    }

    .btn-link {
        color: #2A416A;
        font-weight: 600;
        font-size: 13px;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .btn-link:hover {
        color: #1f3152;
        text-decoration: underline;
    }

    /* Card */
    .card {
        border-radius: 12px;
        border: 1px solid #e8eaed;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        transition: all 0.25s ease;
    }

    .card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.06);
    }

    .card-header {
        background: transparent;
        border-bottom: 1px solid #e8eaed;
        padding: 16px 20px;
    }

    .card-title {
        font-size: 15px;
        font-weight: 700;
        color: #14171C;
    }

    .card-body {
        padding: 0;
    }

    .action-card .card-body {
        padding: 16px 20px 20px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .welcome-card {
            flex-direction: column;
            align-items: flex-start;
            padding: 20px;
        }

        .stat-card {
            padding: 16px 18px;
        }

        .stat-number {
            font-size: 22px;
        }

        .action-grid {
            grid-template-columns: 1fr 1fr;
        }

        .product-item {
            flex-wrap: wrap;
            gap: 8px;
        }

        .blog-mini-card {
            flex-wrap: wrap;
        }
    }

    @media (max-width: 480px) {
        .action-grid {
            grid-template-columns: 1fr;
        }

        .stat-card {
            flex-wrap: wrap;
        }
    }
</style>
@endpush