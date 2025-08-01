<?php

namespace App\Utilities\Firebase;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\MulticastSendReport;
use Kreait\Firebase\Messaging\Notification;

class FirebaseService
{
    protected $messaging;

    public function __construct()
    {
        $credentials = config('firebase.credentials');
        $this->messaging = (new Factory)
            ->withServiceAccount($credentials)
            ->createMessaging();
    }

    public function sendToMultiple(array $tokens, string $title, string $body, array $data = []): MulticastSendReport
    {
        $notification = Notification::create($title, $body);
        $message = CloudMessage::new()->withNotification($notification)->withData($data);

        return $this->messaging->sendMulticast($message, $tokens);
    }
}
