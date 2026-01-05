<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Assuming you have 'role' or 'is_admin' field on users table
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
