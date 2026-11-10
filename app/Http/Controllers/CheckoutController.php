<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function create()
    {
        $cart = session('cart', []);
        abort_if(empty($cart), 302, redirect()->route('cart.index')->getTargetUrl());

        $items = collect($cart)->map(fn ($qty, $id) => [
            'product' => Product::findOrFail($id),
            'qty' => $qty,
        ]);
        $total = $items->sum(fn ($i) => $i['product']->finalPriceCents() * $i['qty']);

        return view('checkout.create', ['items' => $items, 'total' => $total]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'receiver_name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'note' => 'nullable|string|max:500',
        ]);

        $cart = session('cart', []);
        abort_if(empty($cart), 400);

        $order = DB::transaction(function () use ($cart, $validated) {
            $total = 0;
            $order = Order::create($validated + [
                'user_id' => auth()->id(),
                'code' => 'INV-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6)),
                'total_cents' => 0,
                'status' => 'pending',
            ]);

            foreach ($cart as $productId => $qty) {
                $product = Product::lockForUpdate()->findOrFail($productId);
                abort_if($product->stock < $qty, 400, "Stok {$product->name} tidak cukup.");

                $price = $product->finalPriceCents();
                $order->items()->create([
                    'product_id' => $product->id,
                    'qty' => $qty,
                    'price_cents' => $price,
                ]);
                $product->decrement('stock', $qty);
                $total += $price * $qty;
            }

            $order->update(['total_cents' => $total]);

            return $order;
        });

        session()->forget('cart');

        \App\Services\NotificationService::orderCreated($order);

        return redirect()->route('orders.show', $order)
            ->with('success', "Pesanan {$order->code} berhasil dibuat!");
    }
}
