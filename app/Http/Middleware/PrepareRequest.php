<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;

class PrepareRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(Request): (Response|RedirectResponse)  $next
     * @return Response|RedirectResponse
     *
     * @throws \Exception
     */
    public function handle(Request $request, Closure $next)
    {
        // setting default headers.
        $deviceId = $request->header('x-device-id', 'anonymous');
        $language = $request->header('x-language', 'en');
        $deviceOS = $request->header('x-device-os', 'anonymous');
        $deviceIPAddress = $request->header('x-device-ip-address', 'anonymous');
        // appending default headers.
        $request->headers->set('x-device-id', $deviceId);
        $request->headers->set('x-language', $language);
        $request->headers->set('x-device-os', $deviceOS);
        $request->headers->set('x-device-ip-address', $deviceIPAddress);
        // setting app language.
        App::setLocale($language);

        return $next($request);

    }
}
