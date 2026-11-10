@extends('layouts.app')

@section('title', 'Bayar ' . $order->code)

@section('content')
<div class="max-w-2xl mx-auto mt-8 bg-white rounded-lg shadow-sm border p-8 text-center">
    <h1 class="text-2xl font-bold">💳 Bayar Pesanan</h1>
    <p class="text-gray-500 mt-1">{{ $order->code }}</p>
    <p class="text-3xl font-bold text-emerald-700 my-4">{{ $order->totalInRupiah() }}</p>

    @if ($snapToken)
        <button id="pay-button" class="px-8 py-3 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 shadow-lg shadow-emerald-200">
            Bayar Sekarang (Semua Metode)
        </button>
        <p class="text-xs text-gray-400 mt-3">Diproses aman oleh Midtrans — QRIS, e-wallet, transfer bank, kartu.</p>
    @else
        <div class="rounded-lg bg-yellow-50 border border-yellow-200 text-yellow-800 text-sm px-4 py-3">
            Payment gateway belum dikonfigurasi. Isi <code>MIDTRANS_SERVER_KEY</code> di file <code>.env</code>, lalu coba lagi.
        </div>
    @endif

    <a href="{{ route('orders.show', $order) }}" class="block mt-6 text-sm text-gray-500 hover:text-emerald-700">← Kembali ke detail pesanan</a>
</div>

@if ($snapToken)
<script src="{{ $snapUrl }}" data-client-key="{{ $clientKey }}"></script>
<script>
document.getElementById('pay-button').addEventListener('click', function () {
    snap.pay('{{ $snapToken }}', {
        onSuccess: function (result) {
            window.location = '{{ route("orders.show", $order) }}?bayar=berhasil';
        },
        onPending: function (result) {
            window.location = '{{ route("orders.show", $order) }}?bayar=pending';
        },
        onError: function (result) {
            alert('Pembayaran gagal, silakan coba lagi.');
        },
        onClose: function () {
            // user tutup popup — status tetap pending, bisa coba lagi
        }
    });
});
</script>
@endif
@endsection
