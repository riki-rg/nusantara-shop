<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
        $validated['image'] = $this->storeImage($request);

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
        if ($request->hasFile('image')) {
            // hapus foto lama kalau ada
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $this->storeImage($request);
        }
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
            'image' => 'nullable|image|mimes:png,jpg,jpeg,webp,gif|max:2048',
            'is_active' => 'boolean',
        ]) + ['is_active' => $request->boolean('is_active')];
    }

    private function storeImage(Request $request): ?string
    {
        if (! $request->hasFile('image')) {
            return null;
        }

        return $request->file('image')->store('products', 'public');
    }
}
