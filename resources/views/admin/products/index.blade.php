@extends('layouts.app')

@section('title', 'Kelola Produk')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">📦 Kelola Produk</h1>
        <a href="{{ route('admin.products.create') }}" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">+ Produk Baru</a>
    </div>

    <div class="bg-white rounded-lg shadow-sm border overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-left text-gray-500">
                <tr>
                    <th class="p-3">Nama</th>
                    <th class="p-3">Kategori</th>
                    <th class="p-3">Harga</th>
                    <th class="p-3">Diskon</th>
                    <th class="p-3">Stok</th>
                    <th class="p-3">Status</th>
                    <th class="p-3"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="border-t">
                        <td class="p-3 font-medium">{{ $product->name }}</td>
                        <td class="p-3 text-gray-500">{{ $product->category?->name }}</td>
                        <td class="p-3">{{ $product->priceInRupiah($product->price_cents) }}</td>
                        <td class="p-3">{{ $product->discount_percent > 0 ? "-{$product->discount_percent}%" : '—' }}</td>
                        <td class="p-3 {{ $product->stock <= 5 ? 'text-red-600 font-semibold' : '' }}">{{ $product->stock }}</td>
                        <td class="p-3">
                            <span class="text-xs px-2 py-1 rounded {{ $product->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-500' }}">
                                {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="p-3 whitespace-nowrap">
                            <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="inline"
                                  onsubmit="return confirm('Hapus produk ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $products->links() }}</div>
@endsection
