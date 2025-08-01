<?php

namespace App\Utilities\Firebase;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Firebase
{
    private mixed $notificationTemplate;

    private array $recipients;

    private array $options;

    public function __construct($notificationTemplate, array $recipients, array $options = [])
    {
        $this->notificationTemplate = $notificationTemplate;
        $this->recipients = $recipients;
        $this->options = $options;
    }

    public function makeHttpCall(): array
    {
        $fcmTokens = $this->getFcmTokens();

        if ($fcmTokens->isEmpty()) {
            return [];
        }

        $firebaseService = new FirebaseService;
        $report = $firebaseService->sendToMultiple(
            $fcmTokens->all(),
            $this->notificationTemplate->title,
            $this->notificationTemplate->body,
            $this->options
        );

        $tokenStatusMap = $this->mapTokenDeliveryStatus($report);
        $notifications = $this->buildNotificationRecords($tokenStatusMap);

        DB::table('notifications')->insert($notifications);

        return $notifications;
    }

    private function getFcmTokens(): Collection
    {
        return collect($this->recipients)
            ->pluck('fcm_token')
            ->filter()
            ->values();
    }

    private function mapTokenDeliveryStatus($report): Collection
    {
        return collect($report->getItems())
            ->mapWithKeys(fn ($item) => [
                $item->target()->value() => $item->isSuccess(),
            ]);
    }

    private function buildNotificationRecords(Collection $tokenStatusMap): array
    {
        $now = now();
        $title = $this->notificationTemplate->title;
        $body = $this->notificationTemplate->body;
        $options = $this->options;

        return collect($this->recipients)->map(function ($recipient) use ($now, $title, $body, $tokenStatusMap, $options) {
            $fcmToken = $recipient['fcm_token'] ?? null;
            $isSent = $fcmToken && $tokenStatusMap->get($fcmToken, false);

            return [
                'notifiable_id' => $recipient['id'],
                'notifiable_type' => $recipient['type'],
                'options' => json_encode(empty($options) ? [] : $options),
                'data' => json_encode([
                    'title' => $title,
                    'body' => $body,
                ]),
                'read_at' => null,
                'sent_at' => $isSent ? $now : null,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        })->all();
    }
}
