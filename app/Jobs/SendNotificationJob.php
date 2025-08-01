<?php

namespace App\Jobs;

use App\Models\FcmToken;
use App\Models\Notification;
use App\Traits\PushNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, PushNotification, Queueable, SerializesModels;

    protected $notificationId;

    public function __construct($notificationId)
    {
        $this->notificationId = $notificationId;
    }

    public function handle()
    {
        $notification = Notification::find($this->notificationId);
        if (! $notification || $notification->status === 'sent') {
            Log::warning("Notification ID {$this->notificationId} not found or already sent.");

            return;
        }

        $tokens = FcmToken::where('is_active', 1)->pluck('fcm_token');
        $imageUrl = $notification->image ? asset($notification->image) : null;

        $successCount = 0;
        $failCount = 0;

        foreach ($tokens as $token) {
            $result = $this->sendNotification(
                $token,
                $notification->title,
                $notification->desc,
                ['id' => $notification->id],
                $imageUrl
            );

            if ($result['success']) {
                $successCount++;
            } else {
                $failCount++;
                Log::error('FCM Send Error', ['token' => $token, 'error' => $result['error']]);
            }
        }

        $notification->update(['status' => 'sent']);

        Log::info("Notification ID {$this->notificationId} sent. Success: {$successCount}, Fail: {$failCount}");
    }
}
