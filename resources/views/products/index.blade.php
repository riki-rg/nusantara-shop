@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('content')
    <form method="GET" class="flex flex-col sm:flex-row gap-3 mb-6">
        <input type="text" name="q" value="{{ $q }}" placeholder="Cari produk..."
               class="flex-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none">
        <select name="kategori" class="px-3 py-2 border rounded-lg">
            <option value="">Semua kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category->slug }}" {{ request('kategori') === $category->slug ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <select name="urut" class="px-3 py-2 border rounded-lg">
            <option value="">Terbaru</option>
            <option value="murah" {{ request('urut') === 'murah' ? 'selected' : '' }}>Harga terendah</option>
            <option value="mahal" {{ request('urut') === 'mahal' ? 'selected' : '' }}>Harga tertinggi</option>
        </select>
        <label class="flex items-center gap-2 text-sm px-2">
            <input type="checkbox" name="diskon" value="1" {{ request('diskon') ? 'checked' : '' }} class="rounded">
            Diskon saja
        </label>
        <button class="px-5 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">Cari</button>
    </form>

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
        @forelse ($products as $product)
            <div class="bg-white rounded-lg shadow-sm border p-4 flex flex-col hover:shadow-md transition">
                <a href="{{ route('products.show', $product) }}" class="font-semibold hover:text-emerald-700 line-clamp-2">
                    {{ $product->name }}
                </a>
                <p class="text-xs text-gray-400 mt-1">{{ $product->category?->name }}</p>
                <div class="mt-2">
                    @if ($product->discount_percent > 0)
                        <span class="text-xs bg-red-100 text-red-700 px-2 py-0.5 rounded font-bold">-{{ $product->discount_percent }}%</span>
                        <span class="text-xs text-gray-400 line-through ml-1">{{ $product->priceInRupiah($product->price_cents) }}</span>
                    @endif
                    <p class="font-bold text-emerald-700">{{ $product->priceInRupiah() }}</p>
                </div>
                <div class="mt-3 flex items-center justify-between text-xs">
                    <span class="{{ $product->stock <= 5 ? 'text-red-500 font-semibold' : 'text-gray-400' }}">
                        {{ $product->stock === 0 ? 'Habis' : ($product->stock <= 5 ? 'Sisa ' . $product->stock : 'Stok ' . $product->stock) }}
                    </span>
                    <form method="POST" action="{{ route('cart.add', $product) }}">
                        @csrf
                        <button type="submit" class="px-3 py-1.5 bg-emerald-600 text-white rounded hover:bg-emerald-700 disabled:opacity-40"
                                {{ $product->stock === 0 ? 'disabled' : '' }}>+ Keranjang</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-500 col-span-full">Tidak ada produk yang cocok.</p>
        @endforelse
    </div>

    <div class="mt-8">{{ $products->links() }}</div>
@endsection
