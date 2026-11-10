<div>
    <label class="block text-sm mb-1">Nama Produk</label>
    <input name="name" value="{{ old('name', $product->name ?? '') }}" required class="w-full px-3 py-2 border rounded-lg">
</div>
<div>
    <label class="block text-sm mb-1">Kategori</label>
    <select name="category_id" class="w-full px-3 py-2 border rounded-lg">
        <option value="">— Tanpa kategori —</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>
<div>
    <label class="block text-sm mb-1">Foto Produk</label>
    @isset($product)
        @if ($product->image)
            <img src="{{ Storage::url($product->image) }}" alt="Foto produk" class="w-32 h-32 object-cover rounded-lg mb-2 ring-1 ring-gray-200">
        @endif
    @endisset
    <input type="file" name="image" accept="image/png,image/jpeg,image/webp,image/gif" class="w-full px-3 py-2 border rounded-lg file:mr-3 file:px-3 file:py-1 file:rounded-md file:border-0 file:bg-emerald-50 file:text-emerald-700 file:text-sm">
    @error('image')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
</div>
<div>
    <label class="block text-sm mb-1">Deskripsi</label>
    <textarea name="description" rows="4" class="w-full px-3 py-2 border rounded-lg">{{ old('description', $product->description ?? '') }}</textarea>
</div>
<div class="grid sm:grid-cols-3 gap-4">
    <div>
        <label class="block text-sm mb-1">Harga (sen, 85000 = Rp 850)</label>
        <input type="number" name="price_cents" value="{{ old('price_cents', $product->price_cents ?? 0) }}" required class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm mb-1">Diskon %</label>
        <input type="number" name="discount_percent" value="{{ old('discount_percent', $product->discount_percent ?? 0) }}" min="0" max="100" class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm mb-1">Stok</label>
        <input type="number" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" min="0" required class="w-full px-3 py-2 border rounded-lg">
    </div>
</div>
<label class="flex items-center gap-2 text-sm">
    <input type="hidden" name="is_active" value="0">
    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }} class="rounded">
    Produk aktif (tampil di katalog)
</label>
