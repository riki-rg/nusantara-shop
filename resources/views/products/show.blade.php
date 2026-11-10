@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <a href="{{ route('products.index') }}" class="text-sm text-gray-500 hover:text-emerald-700">← Kembali ke katalog</a>

    <div class="mt-4 bg-white rounded-lg shadow-sm border p-8">
        <div class="flex items-start justify-between">
            <div class="flex gap-6">
                @if ($product->image)
                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-48 h-48 object-cover rounded-xl ring-1 ring-gray-200">
                @else
                    <div class="w-48 h-48 rounded-xl bg-gradient-to-br from-emerald-100 to-teal-50 flex items-center justify-center text-6xl">📦</div>
                @endif
                <div>
                    <h1 class="text-3xl font-bold">{{ $product->name }}</h1>
                    <p class="text-xs text-gray-400 mt-1">{{ $product->category?->name }}</p>
                </div>
            </div>
            @auth
                <form method="POST" action="{{ route('wishlist.toggle', $product) }}">
                    @csrf
                    <button class="text-2xl hover:scale-110 transition" title="Wishlist">
                        {{ auth()->user()->wishlistItems()->where('product_id', $product->id)->exists() ? '❤️' : '🤍' }}
                    </button>
                </form>
            @endauth
        </div>

        <div class="mt-3 flex items-baseline gap-3">
            @if ($product->discount_percent > 0)
                <span class="bg-red-100 text-red-700 px-2 py-1 rounded font-bold text-sm">-{{ $product->discount_percent }}%</span>
                <span class="text-gray-400 line-through">{{ $product->priceInRupiah($product->price_cents) }}</span>
            @endif
            <p class="text-emerald-700 text-3xl font-bold">{{ $product->priceInRupiah() }}</p>
        </div>

        <div class="mt-2 flex gap-4 text-sm">
            <span class="{{ $product->stock <= 5 ? 'text-red-500 font-semibold' : 'text-gray-500' }}">
                {{ $product->stock === 0 ? 'Stok habis' : ($product->stock <= 5 ? '⚡ Sisa ' . $product->stock : 'Stok: ' . $product->stock) }}
            </span>
            @if ($avgRating > 0)
                <span>⭐ {{ $avgRating }} / 5 · {{ $product->reviews->count() }} ulasan</span>
            @endif
        </div>

        <p class="text-gray-600 mt-4 leading-relaxed">{{ $product->description }}</p>

        <form method="POST" action="{{ route('cart.add', $product) }}" class="mt-6 flex gap-3">
            @csrf
            <button type="submit" class="px-6 py-3 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 disabled:opacity-40"
                    {{ $product->stock === 0 ? 'disabled' : '' }}>
                + Keranjang
            </button>
        </form>
    </div>

    @if ($product->reviews->isNotEmpty())
        <div class="mt-6 bg-white rounded-lg shadow-sm border p-6">
            <h2 class="font-semibold text-lg mb-4">Ulasan Pembeli</h2>
            @foreach ($product->reviews as $review)
                <div class="py-3 border-b last:border-0">
                    <div class="flex items-center gap-2">
                        <span class="font-semibold text-sm">{{ $review->user->name }}</span>
                        <span class="text-amber-500 text-sm">{{ str_repeat('⭐', $review->rating) }}</span>
                    </div>
                    @if ($review->comment)
                        <p class="text-gray-600 text-sm mt-1">{{ $review->comment }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    @if ($related->isNotEmpty())
        <div class="mt-6">
            <h2 class="font-semibold text-lg mb-4">Produk Serupa</h2>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                @foreach ($related as $item)
                    <a href="{{ route('products.show', $item) }}" class="bg-white rounded-lg shadow-sm border p-4 hover:shadow-md transition">
                        <p class="font-semibold text-sm line-clamp-2">{{ $item->name }}</p>
                        <p class="text-emerald-700 font-bold text-sm mt-2">{{ $item->priceInRupiah() }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
@endsection
