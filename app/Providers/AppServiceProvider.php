<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('ar');
        App::setLocale(session('locale', 'ar'));
        Gate::before(function ($user, $ability) {
            return $user->hasRole('admin') ? true : null; // يعطي الصلاحية دائمًا
        });

        Blade::if('adminCan', function ($permission) {
            return auth('admin')->check() && auth('admin')->user()->can($permission);
        });

        Response::macro('success', function ($data = [], $message = null, $status = true, $code = 200) {
            $response = [
                'status' => $status,
            ];

            if (! is_null($message)) {
                $response['message'] = $message;
            }

            if (! is_null($data)) {
                if ($data instanceof JsonResource) {
                    $response_data = $data->response()->getData(true);
                    $response = array_merge($response, $response_data);
                } else {
                    $response['data'] = $data;
                }
            }

            return response()->json($response, $code);
        });
    }
}
