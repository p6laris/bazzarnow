<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers       = User::count();
        $totalAdmins      = User::where('is_admin', true)->count();
        $totalProducts    = Product::count();
        $totalCartItems   = CartItem::sum('quantity');
        $totalRevenue     = Order::sum('total_amount'); // cents
        $totalPurchased   = OrderItem::sum('quantity');

        // Last 7 days: new users per day
        $userStats = collect(range(6, 0))->map(function ($i) {
            $date = Carbon::today()->subDays($i);
            $count = User::whereDate('created_at', $date)->count();
            return [
                'label' => $date->format('M d'),
                'count' => $count,
            ];
        });

        // Last 7 days: products added per day
        $productStats = collect(range(6, 0))->map(function ($i) {
            $date = Carbon::today()->subDays($i);
            $count = Product::whereDate('created_at', $date)->count();
            return [
                'label' => $date->format('M d'),
                'count' => $count,
            ];
        });

        // Recent orders with user + totals
        $recentOrders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', [
            'totalUsers'       => $totalUsers,
            'totalAdmins'      => $totalAdmins,
            'totalProducts'    => $totalProducts,
            'totalCartItems'   => $totalCartItems,
            'totalRevenue'     => $totalRevenue,
            'totalPurchased'   => $totalPurchased,
            'userStats'        => $userStats,
            'productStats'     => $productStats,
            'recentOrders'     => $recentOrders,
        ]);
    }
}
