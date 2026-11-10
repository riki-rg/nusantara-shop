@extends('layouts.app')

@section('title', 'Kelola Pesanan')

@section('content')
    <h1 class="text-2xl font-bold mb-6">🧾 Kelola Pesanan</h1>

    <div class="flex gap-2 mb-4 flex-wrap">
        <a href="{{ route('admin.orders.index') }}"
           class="px-3 py-1.5 text-sm rounded-lg {{ !request('status') ? 'bg-emerald-600 text-white' : 'bg-white border' }}">Semua</a>
        @foreach ($statuses as $key => $label)
            <a href="{{ route('admin.orders.index', ['status' => $key]) }}"
               class="px-3 py-1.5 text-sm rounded-lg {{ request('status') === $key ? 'bg-emerald-600 text-white' : 'bg-white border' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    <div class="bg-white rounded-lg shadow-sm border overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-left text-gray-500">
                <tr>
                    <th class="p-3">Kode</th>
                    <th class="p-3">Tanggal</th>
                    <th class="p-3">Total</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Ubah Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr class="border-t">
                        <td class="p-3">
                            <a href="{{ route('orders.show', $order) }}" class="font-medium hover:text-emerald-700">{{ $order->code }}</a>
                        </td>
                        <td class="p-3 text-gray-500">{{ $order->created_at->format('d M Y H:i') }}</td>
                        <td class="p-3">{{ $order->totalInRupiah() }}</td>
                        <td class="p-3">{{ $order->statusLabel() }}</td>
                        <td class="p-3">
                            <form method="POST" action="{{ route('admin.orders.status', $order) }}" class="flex gap-2">
                                @csrf @method('PATCH')
                                <select name="status" class="px-2 py-1 border rounded text-xs">
                                    @foreach ($statuses as $key => $label)
                                        <option value="{{ $key }}" {{ $order->status === $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                <button class="px-3 py-1 bg-blue-600 text-white rounded text-xs hover:bg-blue-700">Update</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $orders->links() }}</div>
@endsection
