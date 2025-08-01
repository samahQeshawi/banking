<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (Throwable $e, $request) {
            if ($request->is('api/*')) {
                if ($e instanceof ValidationException) {
                    return $this->handleApiValidationException($e);
                } elseif ($e instanceof Exception && ! ($e instanceof AuthenticationException)) {
                    return $this->handleApiGenericException($e);
                }
            } else {
                return null;
            }
        });
    }

    public function handleApiValidationException(ValidationException $exception): JsonResponse
    {
        $response = [
            'code' => 400,
            'type' => 'validation-error',
            'message' => $exception->validator->errors()->first(),
            'messages' => $exception->validator->errors(),
        ];

        if (env('APP_DEBUG')) {
            $response['file'] = $exception->getFile();
            $response['line'] = $exception->getLine();
        }
        Log::debug(__CLASS__.' '.__FUNCTION__.' validation-error', $response);

        return response()->json($response, 400);
    }

    public function handleApiGenericException(Exception $exception): JsonResponse
    {
        $response = [
            'code' => 400,
            'type' => 'general-error',
            'message' => $exception->getMessage(),
        ];

        if (env('APP_DEBUG')) {
            $response['file'] = $exception->getFile();
            $response['line'] = $exception->getLine();
        }

        Log::debug(__CLASS__.' '.__FUNCTION__.' general-error', $response);

        return response()->json($response, 400);
    }

    public function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $guard = $exception->guards()[0] ?? null;

        switch ($guard) {
            case 'admin':
                $login = route('auth.admin.login');
                break;
            case 'restaurant':
                $login = route('auth.restaurants.login');
                break;
            default:
                $login = route('login'); // fallback
                break;
        }

        return redirect()->guest($login);
    }
}
