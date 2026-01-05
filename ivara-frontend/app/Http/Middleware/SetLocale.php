<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if locale is stored in session
        if (Session::has('locale')) {
            $locale = Session::get('locale');
        } 
        // Check if locale is in the request (for API calls)
        elseif ($request->has('locale')) {
            $locale = $request->input('locale');
            Session::put('locale', $locale);
        }
        // Check Accept-Language header
        elseif ($request->hasHeader('Accept-Language')) {
            $headerLocale = substr($request->header('Accept-Language'), 0, 2);
            $locale = in_array($headerLocale, ['en', 'rw', 'sw', 'fr']) ? $headerLocale : 'en';
        }
        // Default to English
        else {
            $locale = 'en';
        }
        
        // Set the application locale
        App::setLocale($locale);
        
        // Add locale to request for use in controllers
        $request->attributes->add(['locale' => $locale]);
        
        return $next($request);
    }
}
