<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'translations'])->latest()
            ->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'image' => ['nullable', 'array'],
            'image.*' => ['image', 'mimes:jpeg,png,jpg,webp'],
            'main_image' => ['nullable', 'string'],
            'shopee_url' => ['nullable', 'url', 'max:2048'],
            'tokopedia_url' => ['nullable', 'url', 'max:2048'],
            'is_featured' => ['nullable', 'boolean'],
            'is_featured_banner' => ['nullable', 'boolean'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Featured Product - Max 4
        |--------------------------------------------------------------------------
        */
        $isFeatured = $request->boolean('is_featured');

        if ($isFeatured) {
            $featuredCount = Product::where('is_featured', true)->count();

            if ($featuredCount >= 4) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'is_featured' => 'Maximum 4 featured products are allowed.',
                    ]);
            }
        }

        $validated['is_featured'] = $isFeatured;
        $validated['is_featured_banner'] = $request->boolean('is_featured_banner');
        unset($validated['description_en']);
        unset($validated['image']);

        if ($validated['is_featured_banner']) {
            Product::where('is_featured_banner', true)->update(['is_featured_banner' => false]);
        }

        /*
        |--------------------------------------------------------------------------
        | Upload Image
        |--------------------------------------------------------------------------
        */
        $uploadedImages = $this->storeUploadedImages($request);

        $mainImage = $this->resolveUploadedMainImage($request, $uploadedImages);

        if ($mainImage !== null) {
            $validated['image'] = $mainImage;
        }

        $product = Product::create($validated);
        $this->createAdditionalImages(
            $product,
            array_values(array_diff($uploadedImages, [$mainImage])),
        );
        $product->saveTranslation('description', $request->input('description_en'));

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        $product->load(['images', 'category']);
        $categories = Category::orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'image' => ['nullable', 'array'],
            'image.*' => ['image', 'mimes:jpeg,png,jpg,webp'],
            'main_image' => ['nullable', 'string'],
            'shopee_url' => ['nullable', 'url', 'max:2048'],
            'tokopedia_url' => ['nullable', 'url', 'max:2048'],
            'is_featured' => ['nullable', 'boolean'],
            'is_featured_banner' => ['nullable', 'boolean'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Featured Product - Max 4
        |--------------------------------------------------------------------------
        */
        $isFeatured = $request->boolean('is_featured');

        if ($isFeatured && ! $product->is_featured) {
            $featuredCount = Product::where('is_featured', true)
                ->where('id', '!=', $product->id)
                ->count();

            if ($featuredCount >= 4) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'is_featured' => 'Maximum 4 featured products are allowed.',
                    ]);
            }
        }

        $validated['is_featured'] = $isFeatured;
        $validated['is_featured_banner'] = $request->boolean('is_featured_banner');
        unset($validated['description_en']);
        unset($validated['image']);

        if ($validated['is_featured_banner']) {
            Product::where('is_featured_banner', true)
                ->where('id', '!=', $product->id)
                ->update(['is_featured_banner' => false]);
        }

        /*
        |--------------------------------------------------------------------------
        | Replace Image
        |--------------------------------------------------------------------------
        */
        $uploadedImages = $this->storeUploadedImages($request);

        $selectedExistingImage = $this->resolveExistingMainImage($product, $request->input('main_image'));
        $selectedUploadedImage = $this->resolveUploadedMainImage($request, $uploadedImages);
        $oldMainImage = $product->image;

        if ($selectedExistingImage !== null) {
            $validated['image'] = $selectedExistingImage->path;
            $selectedExistingImage->delete();
        } elseif ($selectedUploadedImage !== null) {
            $validated['image'] = $selectedUploadedImage;
        }

        $product->update($validated);

        if ($selectedExistingImage !== null && $oldMainImage) {
            $this->createAdditionalImages($product, [$oldMainImage]);
        }

        if ($selectedUploadedImage !== null) {
            $additionalImages = array_values(array_diff($uploadedImages, [$selectedUploadedImage]));

            if ($oldMainImage && $oldMainImage !== $selectedUploadedImage) {
                $additionalImages[] = $oldMainImage;
            }

            $this->createAdditionalImages($product, $additionalImages);
        }
        $product->saveTranslation('description', $request->input('description_en'));

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        foreach ($product->images as $image) {
            $this->deleteStoredImage($image->path);
            $image->delete();
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully!');
    }

    /*
    |--------------------------------------------------------------------------
    | REMOVE IMAGE (AJAX)
    |--------------------------------------------------------------------------
    | Digunakan untuk menghapus gambar produk dari halaman edit
    | tanpa harus update seluruh form.
    */
    public function removeImage(Product $product)
    {
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        $nextImage = $product->images()->first();
        if ($nextImage) {
            $product->image = $nextImage->path;
            $nextImage->delete();
        } else {
            $product->image = null;
        }

        $product->save();

        return response()->json([
            'success' => true,
            'message' => 'Image removed successfully!',
        ]);
    }

    public function destroyImage(Product $product, ProductImage $productImage)
    {
        abort_unless($productImage->product_id === $product->id, 404);

        $this->deleteStoredImage($productImage->path);
        $productImage->delete();

        return back()->with('success', 'Product image deleted successfully!');
    }

    /**
     * @return array<int, string>
     */
    private function storeUploadedImages(Request $request): array
    {
        $files = $request->file('image', []);
        $files = is_array($files) ? $files : [$files];
        $paths = [];

        foreach ($files as $file) {
            if ($file instanceof UploadedFile) {
                $paths[] = $this->storeUploadedImage($file);
            }
        }

        return $paths;
    }

    private function storeUploadedImage(UploadedFile $file): string
    {
        $uploadPath = public_path('uploads/products');

        if (! is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $baseFilename = Str::uuid().'_'.Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));

        if (strtolower($file->getClientOriginalExtension()) === 'webp') {
            $image = imagecreatefromwebp($file->getRealPath());

            if ($image === false) {
                throw new \RuntimeException('The uploaded WebP image could not be decoded.');
            }

            $filename = $baseFilename.'.jpg';
            imagejpeg($image, $uploadPath.DIRECTORY_SEPARATOR.$filename, 92);
            imagedestroy($image);
        } else {
            $filename = $baseFilename.'.'.$file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
        }

        return 'uploads/products/'.$filename;
    }

    /**
     * @param  array<int, string>  $paths
     */
    private function resolveUploadedMainImage(Request $request, array $paths): ?string
    {
        if ($paths === []) {
            return null;
        }

        $selection = $request->input('main_image');

        if (is_string($selection) && str_starts_with($selection, 'new:')) {
            $index = filter_var(substr($selection, 4), FILTER_VALIDATE_INT);

            if ($index !== false && isset($paths[$index])) {
                return $paths[$index];
            }
        }

        return $paths[0];
    }

    private function resolveExistingMainImage(Product $product, mixed $selection): ?ProductImage
    {
        if (! is_string($selection) || ! str_starts_with($selection, 'existing:')) {
            return null;
        }

        $id = filter_var(substr($selection, 9), FILTER_VALIDATE_INT);

        if ($id === false) {
            return null;
        }

        return $product->images->firstWhere('id', $id);
    }

    /**
     * @param  array<int, string>  $paths
     */
    private function createAdditionalImages(Product $product, array $paths): void
    {
        $sortOrder = (int) $product->images()->max('sort_order') + 1;

        foreach ($paths as $path) {
            $product->images()->create([
                'path' => $path,
                'sort_order' => $sortOrder++,
            ]);
        }
    }

    private function deleteStoredImage(string $path): void
    {
        if (str_starts_with($path, 'uploads/products/') && file_exists(public_path($path))) {
            unlink(public_path($path));
        }
    }
}
