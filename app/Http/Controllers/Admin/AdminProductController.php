<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()->is_admin, 403);

        return view('admin.products.index', [
            'products' => Product::with('category')->latest()->paginate(15),
        ]);
    }

    public function create()
    {
        abort_unless(auth()->user()->is_admin, 403);

        return view('admin.products.create', ['categories' => Category::all()]);
    }

    public function store(Request $request)
    {
        abort_unless(auth()->user()->is_admin, 403);

        $validated = $this->validateProduct($request);
        $validated['slug'] = Str::slug($validated['name']) . '-' . Str::random(4);

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produk dibuat.');
    }

    public function edit(Product $product)
    {
        abort_unless(auth()->user()->is_admin, 403);

        return view('admin.products.edit', [
            'product' => $product,
            'categories' => Category::all(),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        abort_unless(auth()->user()->is_admin, 403);

        $validated = $this->validateProduct($request);
        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produk diperbarui.');
    }

    public function destroy(Product $product)
    {
        abort_unless(auth()->user()->is_admin, 403);

        $product->delete();

        return back()->with('success', 'Produk dihapus.');
    }

    private function validateProduct(Request $request): array
    {
        return $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:200',
            'description' => 'nullable|string|max:2000',
            'price_cents' => 'required|integer|min:0',
            'discount_percent' => 'required|integer|min:0|max:100',
            'stock' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]) + ['is_active' => $request->boolean('is_active')];
    }
}
