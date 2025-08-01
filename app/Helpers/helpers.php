<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

function userHasAnyPermissionLike(string $prefix): bool
{
    $user = auth('admin')->user();
    if (!$user) return false;

    foreach ($user->getAllPermissions() as $permission) {
        if (Str::startsWith($permission->name, $prefix)) {
            return true;
        }
    }

    return false;
}
function sendResponse($message, $result, $code = 200)
{
    $response = [
        'status' => true,
        'message' => $message,
    ];
    if (! empty($result)) {
        $response['data'] = $result;
    }

    return response()->json($response, $code);
}

function sendError($error, $errorMessages = [], $code = 422)
{
    $response = [
        'status' => false,
        'message' => $error,
    ];

    if (! empty($errorMessages)) {
        $response['data'] = $errorMessages;
    }

    return response()->json($response, $code);
}

function getimg($filename)
{
    return asset($filename);
}

/**
 * Upload an image
 *
 * @param  $img
 */
function uploader($value, $directory)
{
    $path = '/storage/'.\Storage::disk('public')->putFile($directory, $value);

    return $path;
}

function check_promocode($promocode, $today)
{
    $back['status'] = 0;

    if (! $promocode) {
        $back['message'] = __('lang.not_found_promocode');

        return $back;
    } elseif ($promocode->status == 'not_active') {
        $back['message'] = __('lang.in_active_promocode');

        return $back;
    } elseif ($promocode->end <= $today || $promocode->start > $today) {
        $back['message'] = __('lang.expired_promocode');

        return $back;
    }

    $back['status'] = 1;

    return $back;
}
function whatsapp($phone, $body)
{

    $params = [
        //        'token' => 'pp8p7e3fv3tazhls',
        'token' => '93qarq16bsjuynln',
        'to' => $phone,
        'body' => $body,

    ];
    $curl = curl_init();
    curl_setopt_array($curl, [
        // CURLOPT_URL => "https://api.ultramsg.com/instance43739/messages/chat",.
        CURLOPT_URL => 'https://api.ultramsg.com/instance63271/messages/chat',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => http_build_query($params),
        CURLOPT_HTTPHEADER => [
            'content-type: application/x-www-form-urlencoded',
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo 'cURL Error #:'.$err;
    }
    //        else {
    //            echo $response;
    //        }

}
