<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('orders.index', [
            'orders' => auth()->user()->orders()->latest()->paginate(10),
        ]);
    }

    public function show(Order $order)
    {
        $this->authorizeOrder($order);

        return view('orders.show', ['order' => $order->load('items.product')]);
    }

    public function confirm(Request $request, Order $order)
    {
        $this->authorizeOrder($order);

        if ($order->status !== 'shipped') {
            return back()->with('error', 'Pesanan belum dikirim.');
        }

        $order->update(['status' => 'completed']);

        return back()->with('success', 'Terima kasih! Pesanan telah selesai.');
    }

    private function authorizeOrder(Order $order): void
    {
        abort_unless($order->user_id === auth()->id() || auth()->user()->is_admin, 403);
    }
}
