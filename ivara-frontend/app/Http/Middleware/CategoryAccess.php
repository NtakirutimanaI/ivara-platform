<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $category
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ?string $category = null): Response
    {
        $user = auth()->user();

        // If category not passed to middleware, check route parameter 'category'
        if (!$category) {
            $category = $request->route('category');
        }

        if (!$category) {
            // If still no category and user is super_admin, let them pass to general areas
            if ($user && ($user->role === 'super_admin' || $user->role === 'super-admin')) {
                return $next($request);
            }
            abort(400, "Missing category context for authorization.");
        }

        // Super Admin has bypass
        if ($user && ($user->role === 'super_admin' || $user->role === 'super-admin')) {
            return $next($request);
        }

        // Check if user has category and it matches
        if ($user && isset($user->category) && $user->category === $category) {
            return $next($request);
        }

        // Try underscores for legacy or mismatch
        $categoryUnderscore = str_replace('-', '_', $category);
        if ($user && isset($user->category) && str_replace('-', '_', $user->category) === $categoryUnderscore) {
            return $next($request);
        }

        abort(403, "Access Denied: You do not have permission to manage the {$category} category.");
    }
}
