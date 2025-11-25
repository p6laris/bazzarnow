<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $orders = Order::with(['items.product'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $totalSpent = $orders->sum('total_amount');
        $totalItems = $orders->sum('items_count');
        $lastOrder  = $orders->first();

        return view('dashboard', [
            'user'       => $user,
            'orders'     => $orders,
            'totalSpent' => $totalSpent,
            'totalItems' => $totalItems,
            'lastOrder'  => $lastOrder,
        ]);
    }
}
