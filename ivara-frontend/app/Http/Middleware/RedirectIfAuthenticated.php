<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                
                // Logic to redirect based on role if needed
                // But for now, we want to unify the "Already Logged In" experience
                // to sending them to the category selection or dashboard.
                
                // We should reuse the dashboard logic or simply send to select-category
                // sending to select-category is safer to avoid dashboard -> select-category loop if dashboard logic is complex.
                
                return redirect()->route('auth.select-category');
            }
        }

        return $next($request);
    }
}
