@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Checkout</h1>

    <div class="grid lg:grid-cols-3 gap-6">
        <form method="POST" action="{{ route('checkout.store') }}" class="lg:col-span-2 bg-white rounded-lg shadow-sm border p-6 space-y-4">
            @csrf
            <h2 class="font-semibold text-lg">Alamat Pengiriman</h2>
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm mb-1">Nama Penerima</label>
                    <input name="receiver_name" value="{{ old('receiver_name') }}" required class="w-full px-3 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-sm mb-1">No. HP</label>
                    <input name="phone" value="{{ old('phone') }}" required class="w-full px-3 py-2 border rounded-lg">
                </div>
            </div>
            <div>
                <label class="block text-sm mb-1">Alamat Lengkap</label>
                <textarea name="address" rows="3" required class="w-full px-3 py-2 border rounded-lg">{{ old('address') }}</textarea>
            </div>
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm mb-1">Kota</label>
                    <input name="city" value="{{ old('city') }}" required class="w-full px-3 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-sm mb-1">Kode Pos</label>
                    <input name="postal_code" value="{{ old('postal_code') }}" required class="w-full px-3 py-2 border rounded-lg">
                </div>
            </div>
            <div>
                <label class="block text-sm mb-1">Catatan (opsional)</label>
                <textarea name="note" rows="2" class="w-full px-3 py-2 border rounded-lg">{{ old('note') }}</textarea>
            </div>
            <button class="w-full py-3 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-semibold">
                Buat Pesanan
            </button>
        </form>

        <div class="bg-white rounded-lg shadow-sm border p-6 h-fit">
            <h2 class="font-semibold text-lg mb-4">Ringkasan</h2>
            @foreach ($items as $item)
                <div class="flex justify-between text-sm py-2 border-b">
                    <span>{{ Str::limit($item['product']->name, 25) }} × {{ $item['qty'] }}</span>
                    <span>Rp {{ number_format($item['product']->finalPriceCents() * $item['qty'] / 100, 0, ',', '.') }}</span>
                </div>
            @endforeach
            <p class="text-xl font-bold mt-4">Total: Rp {{ number_format($total / 100, 0, ',', '.') }}</p>
        </div>
    </div>
@endsection
