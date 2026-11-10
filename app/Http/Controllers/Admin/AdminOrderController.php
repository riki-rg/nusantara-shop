<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(auth()->user()->is_admin, 403);

        $orders = Order::query()
            ->when($request->query('status'), fn ($q, $s) => $q->where('status', $s))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.orders.index', [
            'orders' => $orders,
            'statuses' => Order::STATUS_LABELS,
        ]);
    }

    public function updateStatus(Request $request, Order $order)
    {
        abort_unless(auth()->user()->is_admin, 403);

        $validated = $request->validate(['status' => 'required|in:' . implode(',', Order::STATUSES)]);
        $oldStatus = $order->status;
        $order->update($validated);

        \App\Services\NotificationService::orderStatusChanged($order, $oldStatus);

        return back()->with('success', "Status {$order->code} → {$order->statusLabel()}.");
    }
}
