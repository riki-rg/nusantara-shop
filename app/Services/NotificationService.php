<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotificationService
{
    /**
     * Kirim notifikasi status pesanan ke semua channel yang aktif (email, WhatsApp, Telegram).
     */
    public static function orderStatusChanged(Order $order, string $oldStatus): void
    {
        $message = sprintf(
            "🔔 *Nusantara Shop*\nHalo %s,\nStatus pesanan %s berubah:\n%s → %s\n\nTotal: %s\nLacak: %s",
            $order->receiver_name,
            $order->code,
            Order::STATUS_LABELS[$oldStatus] ?? $oldStatus,
            $order->statusLabel(),
            $order->totalInRupiah(),
            route('orders.show', $order),
        );

        // Email
        if ($order->user?->email) {
            try {
                Mail::raw($message, function ($mail) use ($order) {
                    $mail->to($order->user->email)
                        ->subject("Pesanan {$order->code} — {$order->statusLabel()}");
                });
            } catch (\Throwable $e) {
                Log::warning("Email notif gagal: {$e->getMessage()}");
            }
        }

        // WhatsApp (Fonnte)
        self::sendWhatsApp($order->phone, $message);

        // Telegram (admin)
        self::sendTelegram($message);
    }

    public static function orderCreated(Order $order): void
    {
        $message = sprintf(
            "🛒 *Pesanan Baru!*\n%s\nPembeli: %s\nTotal: %s\nStatus: %s",
            $order->code,
            $order->receiver_name,
            $order->totalInRupiah(),
            $order->statusLabel(),
        );

        self::sendTelegram($message);
        self::sendWhatsApp($order->phone, sprintf(
            "Terima kasih %s! 🎉\nPesanan %s berhasil dibuat.\nTotal: %s\nKami akan segera memproses pesananmu.",
            $order->receiver_name,
            $order->code,
            $order->totalInRupiah(),
        ));
    }

    public static function sendWhatsApp(string $phone, string $message): bool
    {
        $token = config('services.fonnte.token');
        if (! $token || ! $phone) {
            return false;
        }

        try {
            $response = Http::withHeaders(['Authorization' => $token])
                ->asForm()
                ->post('https://api.fonnte.com/send', [
                    'target' => preg_replace('/[^0-9]/', '', $phone),
                    'message' => $message,
                ]);

            return $response->successful();
        } catch (\Throwable $e) {
            Log::warning("WA notif gagal: {$e->getMessage()}");
            return false;
        }
    }

    public static function sendTelegram(string $message): bool
    {
        $token = config('services.telegram.bot_token');
        $chatId = config('services.telegram.chat_id');
        if (! $token || ! $chatId) {
            return false;
        }

        try {
            $response = Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'Markdown',
            ]);

            return $response->successful();
        } catch (\Throwable $e) {
            Log::warning("Telegram notif gagal: {$e->getMessage()}");
            return false;
        }
    }
}
