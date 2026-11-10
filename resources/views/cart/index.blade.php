@extends('layouts.app')

@section('title', 'Keranjang')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Keranjang Belanja</h1>

    @if ($items->isEmpty())
        <p class="text-gray-500">
            Keranjang masih kosong.
            <a href="{{ route('products.index') }}" class="text-emerald-700 underline">Mulai belanja →</a>
        </p>
    @else
        <div class="bg-white rounded-lg shadow-sm border divide-y">
            @foreach ($items as $item)
                <div class="p-4 flex items-center justify-between">
                    <div>
                        <a href="{{ route('products.show', $item['product']) }}" class="font-semibold hover:text-emerald-700">
                            {{ $item['product']->name }}
                        </a>
                        <p class="text-sm text-gray-500">
                            {{ $item['product']->priceInRupiah() }} × {{ $item['qty'] }}
                        </p>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="font-bold">Rp {{ number_format($item['product']->price_cents * $item['qty'] / 100, 0, ',', '.') }}</span>
                        <form method="POST" action="{{ route('cart.remove', $item['product']) }}">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6 flex items-center justify-between">
            <form method="POST" action="{{ route('cart.clear') }}">
                @csrf
                <button type="submit" class="text-sm text-gray-500 hover:text-red-600">Kosongkan keranjang</button>
            </form>
            <div class="text-xl font-bold">
                Total: Rp {{ number_format($total / 100, 0, ',', '.') }}
            </div>
        </div>
    @endif
@endsection
