<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()->is_admin, 403);
        return view('admin.dashboard', [
            'totalProducts' => Product::count(),
            'lowStock' => Product::where('stock', '<=', 5)->where('is_active', true)->get(),
            'totalOrders' => Order::count(),
            'pendingOrders' => Order::where('status', 'pending')->count(),
            'revenueCents' => Order::whereIn('status', ['paid', 'processing', 'shipped', 'completed'])->sum('total_cents'),
            'recentOrders' => Order::latest()->limit(5)->get(),
            'totalCustomers' => User::where('is_admin', false)->count(),
        ]);
    }
}
