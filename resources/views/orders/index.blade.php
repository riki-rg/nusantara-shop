@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Pesanan Saya</h1>

    @forelse ($orders as $order)
        <a href="{{ route('orders.show', $order) }}"
           class="block bg-white rounded-lg shadow-sm border p-4 mb-3 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="font-semibold">{{ $order->code }}</p>
                    <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y H:i') }} · {{ $order->items->count() }} produk</p>
                </div>
                <div class="text-right">
                    <span class="text-xs px-2 py-1 rounded
                        {{ $order->status === 'completed' ? 'bg-emerald-100 text-emerald-700' : ($order->status === 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700') }}">
                        {{ $order->statusLabel() }}
                    </span>
                    <p class="font-bold mt-1">{{ $order->totalInRupiah() }}</p>
                </div>
            </div>
        </a>
    @empty
        <p class="text-gray-500">
            Belum ada pesanan. <a href="{{ route('products.index') }}" class="text-emerald-700 underline">Mulai belanja →</a>
        </p>
    @endforelse

    <div class="mt-6">{{ $orders->links() }}</div>
@endsection
