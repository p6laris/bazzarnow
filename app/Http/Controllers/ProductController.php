<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected array $validCategories = [
        'skincare',
        'fragrance',
        'eyes',
        'lips',
        'body',
    ];

    public function index(Request $request)
    {
        $category = $request->query('category');
        $category = in_array($category, $this->validCategories, true) ? $category : null;

        $query = Product::query();

        if ($category) {
            $query->where('category', $category);
        }

        $products = $query
            ->orderBy('created_at', 'desc')
            ->paginate(12)
            ->withQueryString();

        $cartCount      = 0;
        $purchasedCount = 0;

        if (auth()->check()) {
            $cartCount = CartItem::where('user_id', auth()->id())->sum('quantity');
        }

        return view('products.index', [
            'products'        => $products,
            'cartCount'       => $cartCount,
            'purchasedCount'  => $purchasedCount,
            'activeCategory'  => $category,
            'validCategories' => $this->validCategories,
        ]);
    }

    public function rate(Request $request, Product $product)
    {
        $data = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
        ]);

        // Simple approach: store last rating in product.rating
        $product->rating = $data['rating'];
        $product->save();

        return back()->with('status', 'Thanks for rating this product.');
    }
}
