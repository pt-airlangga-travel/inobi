<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeaturedWorkController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/language/{locale}', function (string $locale) {
    abort_unless(in_array($locale, ['id', 'en'], true), 404);

    session(['locale' => $locale]);

    return back();
})->name('language.switch');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post}', [BlogController::class, 'show'])->name('blog.show');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES - PASTIKAN INI PERTAMA KALI DIBAHAGIAN INI
|--------------------------------------------------------------------------
*/

// ROUTE LOGIN - TANPA MIDDLEWARE DULU UNTUK TESTING
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');
    Route::delete('/products/{product}/images/{productImage}', [AdminProductController::class, 'destroyImage'])
        ->name('products.images.destroy');
    Route::delete('/products/{product}/remove-image', [AdminProductController::class, 'removeImage'])
        ->name('products.remove-image');

    Route::resource('categories', AdminCategoryController::class);

    Route::get('/blog', [AdminPostController::class, 'index'])->name('blog.index');
    Route::get('/blog/create', [AdminPostController::class, 'create'])->name('blog.create');
    Route::post('/blog', [AdminPostController::class, 'store'])->name('blog.store');
    Route::get('/blog/{post}/edit', [AdminPostController::class, 'edit'])->name('blog.edit');
    Route::put('/blog/{post}', [AdminPostController::class, 'update'])->name('blog.update');
    Route::delete('/blog/{post}', [AdminPostController::class, 'destroy'])->name('blog.destroy');

    Route::get('/featured-works', [FeaturedWorkController::class, 'index'])->name('featured-works.index');
    Route::get('/featured-works/create', [FeaturedWorkController::class, 'create'])->name('featured-works.create');
    Route::post('/featured-works', [FeaturedWorkController::class, 'store'])->name('featured-works.store');
    Route::get('/featured-works/{featuredWork}/edit', [FeaturedWorkController::class, 'edit'])->name('featured-works.edit');
    Route::put('/featured-works/{featuredWork}', [FeaturedWorkController::class, 'update'])->name('featured-works.update');
    Route::delete('/featured-works/{featuredWork}', [FeaturedWorkController::class, 'destroy'])->name('featured-works.destroy');

    Route::resource('users', UserController::class)->except('show');
    Route::resource('settings', SettingsController::class)->only(['index', 'edit', 'update']);
});
