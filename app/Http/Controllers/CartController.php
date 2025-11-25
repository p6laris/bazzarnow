<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class CartController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $items = CartItem::with('product')
            ->where('user_id', $user->id)
            ->get();

        $cartCount = $items->sum('quantity');
        $total = $items->sum(fn ($item) => $item->product->price * $item->quantity);

        // For now we only track purchases via orders table; this is used for UI cards
        $purchasedCount = OrderItem::whereHas('order', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->sum('quantity');

        return view('cart.index', [
            'items'           => $items,
            'cartCount'       => $cartCount,
            'total'           => $total,
            'purchasedCount'  => $purchasedCount,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
        ]);

        $user = auth()->user();
        $productId = $data['product_id'];

        $item = CartItem::firstOrNew([
            'user_id'    => $user->id,
            'product_id' => $productId,
        ]);

        $item->quantity = ($item->quantity ?? 0) + 1;
        $item->save();

        return back()->with('status', 'Added to cart.');
    }

    public function update(Request $request, CartItem $item)
    {
        $this->authorizeItem($item);

        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $item->quantity = $data['quantity'];
        $item->save();

        return back()->with('status', 'Cart updated.');
    }

    public function destroy(CartItem $item)
    {
        $this->authorizeItem($item);

        $item->delete();

        return back()->with('status', 'Item removed from cart.');
    }

    public function checkout(Request $request)
    {
        $user = $request->user();

        $items = CartItem::with('product')
            ->where('user_id', $user->id)
            ->get();

        if ($items->isEmpty()) {
            return back()->with('status', 'Your cart is empty.');
        }

        $totalAmount = $items->sum(fn ($item) => $item->product->price * $item->quantity);
        $itemsCount  = $items->sum('quantity');

        // Create order
        $order = Order::create([
            'user_id'     => $user->id,
            'items_count' => $itemsCount,
            'total_amount'=> $totalAmount,
        ]);

        // Create order items
        foreach ($items as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'unit_price' => $item->product->price,
                'line_total' => $item->product->price * $item->quantity,
            ]);
        }

        // Clear cart
        CartItem::where('user_id', $user->id)->delete();

        return redirect()->route('cart.index')
            ->with('status', 'Demo purchase completed. Your items have been added to your history.');
    }

    protected function authorizeItem(CartItem $item): void
    {
        if ($item->user_id !== auth()->id()) {
            abort(403);
        }
    }
}
