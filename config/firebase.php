<?php

return [
    'url' => env('FIREBASE_API_URL', 'https://fcm.googleapis.com/v1/projects/shipping-ninja-fef25/messages:send'),
    'credentials' => storage_path('firebase/service_account.json'),
];
