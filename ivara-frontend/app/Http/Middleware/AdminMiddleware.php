<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && in_array(strtolower(Auth::user()->role), ['admin', 'super_admin', 'super-admin'])) {
            return $next($request);
        }

        // Redirect unauthorized users to login or home with error message
        return redirect('/login')->with('error', 'You do not have admin access.');
    }
}
