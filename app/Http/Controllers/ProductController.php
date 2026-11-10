<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()
            ->where('is_active', true)
            ->with('category')
            ->search($request->query('q'))
            ->when($request->query('kategori'), fn ($q, $slug) => $q
                ->whereHas('category', fn ($c) => $c->where('slug', $slug)))
            ->when($request->query('diskon') === '1', fn ($q) => $q->where('discount_percent', '>', 0))
            ->when($request->query('urut') === 'murah', fn ($q) => $q
                ->orderByRaw('price_cents * (100 - discount_percent) / 100'))
            ->when($request->query('urut') === 'mahal', fn ($q) => $q
                ->orderByDesc('price_cents'))
            ->when($request->query('urut') === 'baru', fn ($q) => $q->latest())
            ->when(! $request->query('urut'), fn ($q) => $q->latest())
            ->paginate(12)
            ->withQueryString();

        return view('products.index', [
            'products' => $products,
            'categories' => Category::orderBy('name')->get(),
            'q' => $request->query('q'),
        ]);
    }

    public function show(Product $product)
    {
        abort_unless($product->is_active, 404);

        $product->load(['category', 'reviews.user']);

        return view('products.show', [
            'product' => $product,
            'avgRating' => round($product->reviews()->avg('rating') ?? 0, 1),
            'related' => Product::where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)
                ->where('is_active', true)
                ->limit(4)->get(),
        ]);
    }
}
