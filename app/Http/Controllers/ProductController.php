<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $selectedCategorySlug = $request->query('category');
        $activeCategory = null;

        $query = Product::with(['category', 'translations', 'images'])->latest();

        if ($selectedCategorySlug) {
            $activeCategory = Category::where('slug', $selectedCategorySlug)->first();
            if ($activeCategory) {
                $query->where('category_id', $activeCategory->id);
            }
        }

        $products = $query->paginate(12)->withQueryString();

        $categories = Category::withCount('products')->orderBy('id')->get();
        $totalProductsCount = Product::count();

        return view(
            'products.index',
            compact('products', 'categories', 'activeCategory', 'selectedCategorySlug', 'totalProductsCount')
        );
    }

    public function show(Product $product)
    {
        $product->load(['category', 'translations', 'images']);

        $related = Product::with(['category', 'translations', 'images'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(4)
            ->get();

        return view(
            'products.show',
            compact('product', 'related')
        );
    }
}
