<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Hanya pembeli yang pernah membeli produk ini bisa mengulas
        $hasPurchased = OrderItem::whereHas('order', fn ($q) => $q
                ->where('user_id', auth()->id())
                ->whereIn('status', ['paid', 'processing', 'shipped', 'completed']))
            ->where('product_id', $product->id)
            ->exists();

        if (! $hasPurchased) {
            return back()->with('error', 'Anda hanya bisa mengulas produk yang sudah dibeli.');
        }

        Review::updateOrCreate(
            ['product_id' => $product->id, 'user_id' => auth()->id()],
            $validated
        );

        return back()->with('success', 'Terima kasih atas ulasannya!');
    }
}
