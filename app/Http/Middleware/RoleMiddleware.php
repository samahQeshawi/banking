<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->role == $role) {
            return $next($request);
        }
        if ($role == 'restaurant') {
            return redirect('/restaurant/login');
        } elseif ($role == 'admin') {
            return redirect('/admin-panel/login');
        }

        return redirect('/'); // or another route for unauthorized access
    }
}
