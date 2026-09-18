<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik
        $totalProducts = Product::count();
        $totalBlogs = Post::count();
        $totalUsers = User::count();
        $totalViews = 1234;

        // Recent Activities
        $recentActivities = [
            [
                'icon' => '👤',
                'message' => 'New user registered',
                'time' => '5 min ago',
            ],
            [
                'icon' => '📝',
                'message' => 'New blog post published',
                'time' => '1 hour ago',
            ],
            [
                'icon' => '🛒',
                'message' => 'New product added',
                'time' => '3 hours ago',
            ],
            [
                'icon' => '🔐',
                'message' => 'Admin logged in',
                'time' => 'Just now',
            ],
        ];

        // Recent Products
        $recentProducts = Product::latest()
            ->take(4)
            ->get();

        // Recent Blogs
        // Data tetap berasal dari tabel posts
        $recentBlogs = Post::latest()
            ->take(3)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalBlogs',
            'totalUsers',
            'totalViews',
            'recentActivities',
            'recentProducts',
            'recentBlogs'
        ));
    }
}
