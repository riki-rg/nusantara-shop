<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\WishlistItem;

class WishlistController extends Controller
{
    public function index()
    {
        return view('wishlist.index', [
            'items' => auth()->user()->wishlistItems()->with('product.category')->latest()->get(),
        ]);
    }

    public function toggle(Product $product)
    {
        $user = auth()->user();
        $existing = WishlistItem::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($existing) {
            $existing->delete();
            $message = 'Dihapus dari wishlist.';
        } else {
            WishlistItem::create(['user_id' => $user->id, 'product_id' => $product->id]);
            $message = 'Ditambahkan ke wishlist.';
        }

        return back()->with('success', $message);
    }
}
