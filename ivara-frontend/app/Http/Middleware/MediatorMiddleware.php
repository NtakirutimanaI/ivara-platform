<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MediatorMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && strtolower(Auth::user()->role) === 'mediator') {
            return $next($request);
        }

        return redirect('/login')->with('error', 'You do not have mediator access.');
    }
}
