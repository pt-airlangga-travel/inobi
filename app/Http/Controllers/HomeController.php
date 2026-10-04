<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FeaturedWork;
use App\Models\Post;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'translations'])
            ->where('is_featured', true)
            ->latest()
            ->take(4)
            ->get();

        $featuredProduct = Product::with(['category', 'translations'])
            ->where('is_featured_banner', true)
            ->latest('updated_at')
            ->first();

        $posts = Post::where('status', 'published')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->take(3)
            ->get();

        $featuredWorks = FeaturedWork::with('translations')->orderBy('sort_order')->latest('id')->get();

        $categories = Category::withCount('products')->orderBy('id')->get();

        return view(
            'home',
            compact('products', 'featuredProduct', 'posts', 'featuredWorks', 'categories')
        );
    }
}
