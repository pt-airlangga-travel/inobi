<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeaturedWork;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FeaturedWorkController extends Controller
{
    public function index()
    {
        $works = FeaturedWork::with('translations')->orderBy('sort_order')->latest('id')->paginate(12);

        return view('admin.featured-works.index', compact('works'));
    }

    public function create()
    {
        return view('admin.featured-works.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateWork($request);
        $validated['image'] = $this->storeImage($request);
        $titleEn = $validated['title_en'] ?? null;
        $descriptionEn = $validated['description_en'] ?? null;
        unset($validated['title_en'], $validated['description_en']);

        $work = FeaturedWork::create($validated);
        $work->saveTranslation('title', $titleEn);
        $work->saveTranslation('description', $descriptionEn);

        return redirect()->route('admin.featured-works.index')->with('success', 'Featured work berhasil ditambahkan.');
    }

    public function edit(FeaturedWork $featuredWork)
    {
        return view('admin.featured-works.edit', compact('featuredWork'));
    }

    public function update(Request $request, FeaturedWork $featuredWork)
    {
        $validated = $this->validateWork($request, false);
        $titleEn = $validated['title_en'] ?? null;
        $descriptionEn = $validated['description_en'] ?? null;
        unset($validated['title_en'], $validated['description_en']);

        if ($request->hasFile('image')) {
            $this->deleteImage($featuredWork->image);
            $validated['image'] = $this->storeImage($request);
        }

        $featuredWork->update($validated);
        $featuredWork->saveTranslation('title', $titleEn);
        $featuredWork->saveTranslation('description', $descriptionEn);

        return redirect()->route('admin.featured-works.index')->with('success', 'Featured work berhasil diperbarui.');
    }

    public function destroy(FeaturedWork $featuredWork)
    {
        $this->deleteImage($featuredWork->image);
        $featuredWork->delete();

        return redirect()->route('admin.featured-works.index')->with('success', 'Featured work berhasil dihapus.');
    }

    private function validateWork(Request $request, bool $imageRequired = true): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'description_en' => ['nullable', 'string', 'max:1000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image' => [$imageRequired ? 'required' : 'nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],
        ]);
    }

    private function storeImage(Request $request): string
    {
        $directory = public_path('uploads/featured-works');

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $file = $request->file('image');
        $filename = time().'_'.Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)).'.'.$file->getClientOriginalExtension();
        $file->move($directory, $filename);

        return 'uploads/featured-works/'.$filename;
    }

    private function deleteImage(?string $path): void
    {
        if ($path && str_starts_with($path, 'uploads/featured-works/') && file_exists(public_path($path))) {
            unlink(public_path($path));
        }
    }
}
