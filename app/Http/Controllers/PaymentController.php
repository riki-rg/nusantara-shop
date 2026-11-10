<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\MidtransService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(private MidtransService $midtrans)
    {
    }

    /**
     * Halaman bayar: tampilkan Snap popup Midtrans untuk order pending.
     */
    public function pay(Order $order)
    {
        abort_unless($order->user_id === auth()->id(), 403);
        abort_if($order->status !== 'pending', 400, 'Pesanan ini sudah dibayar/diproses.');

        $snapToken = $this->midtrans->createSnapToken($order);

        return view('orders.pay', [
            'order' => $order,
            'snapToken' => $snapToken,
            'clientKey' => config('services.midtrans.client_key'),
            'snapUrl' => config('services.midtrans.snap_url'),
        ]);
    }

    /**
     * Webhook dari Midtrans (HTTP notification).
     */
    public function webhook(Request $request)
    {
        $data = $request->validate([
            'order_id' => 'required|string',
            'transaction_status' => 'required|string',
            'status_code' => 'required|string',
            'gross_amount' => 'required|string',
            'signature_key' => 'required|string',
        ]);

        // Verifikasi signature: sha512(order_id + status_code + gross_amount + serverKey)
        $serverKey = config('services.midtrans.server_key');
        $expected = hash('sha512', $data['order_id'] . $data['status_code'] . $data['gross_amount'] . $serverKey);
        abort_unless(hash_equals($expected, $data['signature_key']), 403, 'Signature tidak valid.');

        $order = Order::where('code', $data['order_id'])->first();
        abort_unless($order, 404);

        // Verifikasi ulang langsung ke API Midtrans
        $remote = $this->midtrans->verifyTransaction($data['order_id']);
        $status = $remote['transaction_status'] ?? $data['transaction_status'];

        match ($status) {
            'settlement', 'capture' => $order->status === 'pending' ? $order->update(['status' => 'paid']) : null,
            'expire' => $order->status === 'pending' ? $order->update(['status' => 'cancelled']) : null,
            default => null,
        };

        return response()->json(['ok' => true]);
    }
}
