<?php

namespace App\Http\Controllers;

use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $items = collect($cart)->map(function ($qty, $id) {
            $product = Product::find($id);

            return $product ? ['product' => $product, 'qty' => $qty] : null;
        })->filter()->values();

        $total = $items->sum(fn ($i) => $i['product']->price_cents * $i['qty']);

        return view('cart.index', ['items' => $items, 'total' => $total]);
    }

    public function add(Product $product)
    {
        $cart = session('cart', []);
        $qty = ($cart[$product->id] ?? 0) + 1;

        if ($qty > $product->stock) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        $cart[$product->id] = $qty;
        session(['cart' => $cart]);

        return back()->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function remove(Product $product)
    {
        $cart = session('cart', []);
        unset($cart[$product->id]);
        session(['cart' => $cart]);

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }

    public function clear()
    {
        session()->forget('cart');

        return back()->with('success', 'Keranjang dikosongkan.');
    }
}
