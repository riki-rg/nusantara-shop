@extends('layouts.app')

@section('title', $order->code)

@section('content')
    <a href="{{ route('orders.index') }}" class="text-sm text-gray-500 hover:text-emerald-700">← Semua pesanan</a>

    <div class="mt-3 bg-white rounded-lg shadow-sm border p-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-xl font-bold">{{ $order->code }}</h1>
                <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y H:i') }}</p>
            </div>
            <div class="text-right">
                <span class="text-xs px-2 py-1 rounded bg-amber-100 text-amber-700">{{ $order->statusLabel() }}</span>
                <p class="text-xl font-bold mt-1">{{ $order->totalInRupiah() }}</p>
            </div>
        </div>

        <div class="border-t pt-4">
            @foreach ($order->items as $item)
                <div class="flex items-center justify-between py-3 border-b last:border-0">
                    <div>
                        <a href="{{ route('products.show', $item->product) }}" class="font-semibold hover:text-emerald-700">
                            {{ $item->product->name }}
                        </a>
                        <p class="text-sm text-gray-500">Rp {{ number_format($item->price_cents / 100, 0, ',', '.') }} × {{ $item->qty }}</p>
                    </div>
                    <span class="font-bold">{{ $item->subtotalInRupiah() }}</span>
                </div>
            @endforeach
        </div>

        <div class="mt-4 pt-4 border-t text-sm text-gray-600">
            <p><strong>Penerima:</strong> {{ $order->receiver_name }} ({{ $order->phone }})</p>
            <p><strong>Alamat:</strong> {{ $order->address }}, {{ $order->city }} {{ $order->postal_code }}</p>
            @if ($order->note)
                <p><strong>Catatan:</strong> {{ $order->note }}</p>
            @endif
        </div>

        @if ($order->status === 'pending')
            <a href="{{ route('orders.pay', $order) }}"
                class="mt-6 block w-full py-3 text-center bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-semibold shadow-lg shadow-emerald-200">
                💳 Bayar Sekarang
            </a>
        @endif

        @if ($order->status === 'shipped')
            <form method="POST" action="{{ route('orders.confirm', $order) }}" class="mt-6">
                @csrf
                <button class="w-full py-3 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-semibold">
                    ✅ Pesanan Diterima
                </button>
            </form>
        @endif
    </div>
@endsection
