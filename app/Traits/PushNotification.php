<?php

namespace App\Traits;

use Exception;
use Google\Auth\ApplicationDefaultCredentials;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait PushNotification
{
    public function sendNotification($token, $title, $body, $data, $imageUrl = null)
    {
        $projectName = config('services.firebase.project_name');
        $fcmUrl = "https://fcm.googleapis.com/v1/projects/$projectName/messages:send";

        $notificationPayload = [
            'title' => $title,
            'body' => $body,
        ];

        if ($imageUrl) {
            $notificationPayload['image'] = $imageUrl;
        }

        $notification = [
            'message' => [
                'notification' => $notificationPayload,
                'token' => $token,
                'android' => [
                    'notification' => [
                        'sound' => 'default',
                    ],
                ],
                'apns' => [
                    'payload' => [
                        'aps' => [
                            'alert' => [
                                'title' => $title,
                                'body' => $body,
                            ],
                            'sound' => 'default',
                        ],
                    ],
                ],
                'data' => $data,
            ],
        ];

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$this->getAccessToken(),
                'Content-Type' => 'application/json',
            ])->post($fcmUrl, $notification);

            if ($response->successful()) {
                return ['success' => true, 'data' => $response->json()];
            } else {
                return ['success' => false, 'error' => $response->body()];
            }
        } catch (Exception $e) {
            Log::error("Error sending push notification to token: {$token} - ".$e->getMessage());

            return false;
        }
    }

    private function getAccessToken()
    {
        $keyPath = config('services.firebase.key_path');  // Load the path to the service account JSON file from config
        putenv('GOOGLE_APPLICATION_CREDENTIALS='.$keyPath);  // Set the environment variable for Google SDK

        // Define the scope needed for Firebase messaging
        $scopes = ['https://www.googleapis.com/auth/firebase.messaging'];

        // Get the credentials using the SDK
        $credentials = ApplicationDefaultCredentials::getCredentials($scopes);

        // Fetch the auth token from the credentials
        $token = $credentials->fetchAuthToken();

        // Return the access token or null if it's not available
        return $token['access_token'] ?? null;
    }
}
