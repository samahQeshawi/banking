<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleRedirectMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $user = auth()->user();

            // Check the current route name to avoid redirect loops
            $currentRouteName = $request->route()->getName();

            // Redirect based on user role but avoid redirecting if already on the target route
            if ($user->role == 'restaurant' && $currentRouteName !== 'restaurant.dashboard') {
                return redirect()->route('restaurant.dashboard');
            } elseif ($user->role == 'admin' && $currentRouteName !== 'admin.dashboard') {
                return redirect()->route('admin.dashboard');
            }
        }

        // Proceed to the next request if no redirect is needed
        return $next($request);
    }
}
