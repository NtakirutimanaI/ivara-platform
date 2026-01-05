<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryAccessMiddleware
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

        /*
         * DEBUGGING LOGS (Temporary)
         */
        \Illuminate\Support\Facades\Log::info("CategoryAccessMiddleware: checking access", [
            'user_id' => $user->id ?? 'null',
            'user_role' => $user->role ?? 'null',
            'user_category' => $user->category ?? 'null',
            'required_category' => $category,
            'path' => $request->path()
        ]);

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

        // Check if user has category and it matches (Exact Match)
        if ($user && isset($user->category) && $user->category === $category) {
            return $next($request);
        }

        // Check for partial matches or slug variations
        if ($user && isset($user->category)) {
             // Example: 'creative-lifestyle-wellness' should match 'creative-lifestyle'
             if (str_contains($user->category, $category) || str_contains($category, $user->category)) {
                 return $next($request);
             }
             
             // Try underscores
             $userCatNorm = str_replace('-', '_', $user->category);
             $reqCatNorm = str_replace('-', '_', $category);
             if ($userCatNorm === $reqCatNorm || str_contains($userCatNorm, $reqCatNorm)) {
                 return $next($request);
             }
        }

        abort(403, "Access Denied: You do not have permission to manage the {$category} category.");
    }
}
