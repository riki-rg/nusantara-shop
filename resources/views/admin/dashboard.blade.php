@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">⚙️ Admin Dashboard</h1>
        <div class="flex gap-3 text-sm">
            <a href="{{ route('admin.products.index') }}" class="px-3 py-2 bg-white border rounded-lg hover:border-emerald-500">Produk</a>
            <a href="{{ route('admin.orders.index') }}" class="px-3 py-2 bg-white border rounded-lg hover:border-emerald-500">Pesanan</a>
        </div>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-lg shadow-sm border p-5">
            <p class="text-sm text-gray-500">Total Produk</p>
            <p class="text-3xl font-bold mt-1">{{ $totalProducts }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-sm border p-5">
            <p class="text-sm text-gray-500">Total Pesanan</p>
            <p class="text-3xl font-bold mt-1">{{ $totalOrders }}</p>
            <p class="text-xs text-amber-600 mt-1">{{ $pendingOrders }} menunggu pembayaran</p>
        </div>
        <div class="bg-white rounded-lg shadow-sm border p-5">
            <p class="text-sm text-gray-500">Pendapatan</p>
            <p class="text-3xl font-bold mt-1 text-emerald-700">Rp {{ number_format($revenueCents / 100, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-sm border p-5">
            <p class="text-sm text-gray-500">Pelanggan</p>
            <p class="text-3xl font-bold mt-1">{{ $totalCustomers }}</p>
        </div>
    </div>

    <div class="grid lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow-sm border p-6">
            <h2 class="font-semibold mb-4">⚡ Stok Menipis (≤5)</h2>
            @forelse ($lowStock as $product)
                <div class="flex justify-between py-2 border-b last:border-0 text-sm">
                    <span>{{ $product->name }}</span>
                    <span class="text-red-600 font-semibold">Sisa {{ $product->stock }}</span>
                </div>
            @empty
                <p class="text-gray-500 text-sm">Semua stok aman 👍</p>
            @endforelse
        </div>

        <div class="bg-white rounded-lg shadow-sm border p-6">
            <h2 class="font-semibold mb-4">🧾 Pesanan Terbaru</h2>
            @forelse ($recentOrders as $order)
                <div class="flex justify-between py-2 border-b last:border-0 text-sm">
                    <a href="{{ route('orders.show', $order) }}" class="hover:text-emerald-700">{{ $order->code }}</a>
                    <span>{{ $order->totalInRupiah() }} · {{ $order->statusLabel() }}</span>
                </div>
            @empty
                <p class="text-gray-500 text-sm">Belum ada pesanan.</p>
            @endforelse
        </div>
    </div>
@endsection
