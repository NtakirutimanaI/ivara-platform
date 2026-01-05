<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TechnicianMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && strtolower(Auth::user()->role) === 'technician') {
            return $next($request);
        }

        return redirect('/login')->with('error', 'You do not have technician access.');
    }
}
