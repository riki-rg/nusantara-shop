<?php

namespace App\Services;

use App\Models\Order;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = (bool) config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function isConfigured(): bool
    {
        return filled(config('services.midtrans.server_key'));
    }

    /**
     * Buat Snap token untuk order. Return token (string) atau null jika belum dikonfigurasi.
     */
    public function createSnapToken(Order $order): ?string
    {
        if (! $this->isConfigured()) {
            return null;
        }

        $params = [
            'transaction_details' => [
                'order_id' => $order->code,
                'gross_amount' => (int) round($order->total_cents / 100), // rupiah
            ],
            'customer_details' => [
                'first_name' => $order->receiver_name,
                'email' => $order->user?->email,
                'phone' => $order->phone,
            ],
            'item_details' => $order->items->map(fn ($item) => [
                'id' => $item->product_id,
                'price' => (int) round($item->price_cents / 100),
                'quantity' => $item->qty,
                'name' => substr($item->product?->name ?? 'Produk', 0, 50),
            ])->values()->all(),
        ];

        try {
            return Snap::getSnapToken($params);
        } catch (\Throwable $e) {
            report($e);
            return null;
        }
    }

    /**
     * Verifikasi status transaksi langsung ke API Midtrans (lebih aman daripada percaya webhook mentah).
     */
    public function verifyTransaction(string $orderId): ?array
    {
        try {
            $status = \Midtrans\Transaction::status($orderId);
            return json_decode(json_encode($status), true);
        } catch (\Throwable $e) {
            report($e);
            return null;
        }
    }
}
