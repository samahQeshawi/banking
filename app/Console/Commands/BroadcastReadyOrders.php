<?php

namespace App\Console\Commands;

use App\Enums\OrderMethods;
use App\Enums\OrderStatuses;
use App\Models\Driver;
use App\Models\NotificationTemplate;
use App\Models\Order;
use App\Utilities\Firebase\Firebase;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class BroadcastReadyOrders extends Command
{
    protected $signature = 'orders:broadcast-ready';

    protected $description = 'Broadcast READY delivery orders to nearby available drivers';

    public function handle(): void
    {
        $orders = Order::with('address')
            ->where('status', OrderStatuses::READY->value)
            ->where('order_method', OrderMethods::DELIVERY->value)
            ->whereNull('driver_id')
            ->get();

        foreach ($orders as $order) {
            $lat = $order->address->latitude ?? null;
            $lng = $order->address->longitude ?? null;

            if (! $lat || ! $lng) {
                Log::warning("Order {$order->id} is missing address location.");

                continue;
            }

            $drivers = Driver::where('is_available', true)
                ->selectRaw('*, (6371 * acos(
                    cos(radians(?)) *
                    cos(radians(latitude)) *
                    cos(radians(longitude) - radians(?)) +
                    sin(radians(?)) *
                    sin(radians(latitude))
                )) AS distance', [
                    $lat,
                    $lng,
                    $lat,
                ])
                ->having('distance', '<=', 10)
                ->orderBy('distance')
                ->get();

            if ($drivers->isEmpty()) {
                Log::info("No drivers found within 10km for order {$order->id}.");

                continue;
            }

            foreach ($drivers as $driver) {
                Log::info("Broadcasting order {$order->id} to driver {$driver->id}");

                $recipients = [
                    [
                        'id' => $driver->id,
                        'type' => 'App\\Models\\Driver',
                        'fcm_token' => $driver->fcm_token,
                    ],
                ];
                $notificationTemplate = NotificationTemplate::find(2);
                (new Firebase($notificationTemplate, $recipients, []))->makeHttpCall();
            }
        }

        $this->info('Broadcast process completed.');
    }
}
