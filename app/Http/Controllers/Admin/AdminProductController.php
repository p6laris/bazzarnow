<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    protected array $categories = [
        'skincare',
        'fragrance',
        'eyes',
        'lips',
        'body',
    ];

    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(12);

        return view('admin.products.index', [
            'products'   => $products,
            'categories' => $this->categories,
        ]);
    }

    public function create()
    {
        return view('admin.products.create', [
            'categories' => $this->categories,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price'       => ['required', 'numeric', 'min:0'],
            'category'    => ['required', 'string', 'in:' . implode(',', $this->categories)],
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $slugBase = Str::slug($data['name']);
        $slug     = $slugBase . '-' . random_int(1000, 9999);

        // Handle image upload
        if ($request->hasFile('image')) {
            $path     = $request->file('image')->store('products', 'public');
            $imageUrl = asset('storage/' . $path);
        } else {
            // fallback placeholder if no image uploaded
            $imageUrl = 'https://picsum.photos/seed/' . random_int(1, 1000) . '/600/600';
        }

        Product::create([
            'name'        => $data['name'],
            'slug'        => $slug,
            'description' => $data['description'] ?? '',
            'price'       => (int) round($data['price'] * 100),
            'image_url'   => $imageUrl,
            'rating'      => 5, // default rating; users can change via ratings
            'category'    => $data['category'],
        ]);

        return redirect()->route('admin.products.index')
            ->with('status', 'Product created.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', [
            'product'    => $product,
            'categories' => $this->categories,
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price'       => ['required', 'numeric', 'min:0'],
            'category'    => ['required', 'string', 'in:' . implode(',', $this->categories)],
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $imageUrl = $product->image_url;

        if ($request->hasFile('image')) {
            $path     = $request->file('image')->store('products', 'public');
            $imageUrl = asset('storage/' . $path);
        }

        $product->update([
            'name'        => $data['name'],
            'description' => $data['description'] ?? '',
            'price'       => (int) round($data['price'] * 100),
            'image_url'   => $imageUrl,
            'category'    => $data['category'],
        ]);

        return redirect()->route('admin.products.index')
            ->with('status', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('status', 'Product deleted.');
    }
}
