@extends('layouts.app')

@section('title', 'Wishlist')

@section('content')
    <h1 class="text-2xl font-bold mb-6">❤️ Wishlist</h1>

    @if ($items->isEmpty())
        <p class="text-gray-500">Wishlist masih kosong. Klik ❤️ pada produk untuk menyimpannya.</p>
    @else
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($items as $item)
                @if ($item->product)
                    <div class="bg-white rounded-lg shadow-sm border p-4">
                        <a href="{{ route('products.show', $item->product) }}" class="font-semibold hover:text-emerald-700">
                            {{ $item->product->name }}
                        </a>
                        <p class="font-bold text-emerald-700 mt-2">{{ $item->product->priceInRupiah() }}</p>
                        <div class="mt-3 flex gap-2">
                            <form method="POST" action="{{ route('cart.add', $item->product) }}" class="flex-1">
                                @csrf
                                <button class="w-full py-1.5 bg-emerald-600 text-white rounded text-sm hover:bg-emerald-700">+ Keranjang</button>
                            </form>
                            <form method="POST" action="{{ route('wishlist.toggle', $item->product) }}">
                                @csrf
                                <button class="px-3 py-1.5 bg-red-50 text-red-600 rounded text-sm hover:bg-red-100">❌</button>
                            </form>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
@endsection
