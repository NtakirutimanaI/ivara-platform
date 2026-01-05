<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SupervisorMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && strtolower(Auth::user()->role) === 'supervisor') {
            return $next($request);
        }

        return redirect('/login')->with('error', 'You do not have supervisor access.');
    }
}
