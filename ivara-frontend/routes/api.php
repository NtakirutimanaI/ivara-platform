<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\UserApiController;

/*
|--------------------------------------------------------------------------
| API Routes - User Management
|--------------------------------------------------------------------------
|
| These routes provide RESTful API endpoints for user management.
| They work with both MySQL and MongoDB through the repository pattern.
|
| All routes are prefixed with /api and use JSON responses.
|
*/

// User Management API Routes
Route::prefix('users')->group(function () {
    
    // Get all users (with optional filters)
    // GET /api/users?role=admin&status=active&search=john
    Route::get('/', [UserApiController::class, 'index'])->name('api.users.index');
    
    // Get user statistics
    // GET /api/users/statistics
    Route::get('/statistics', [UserApiController::class, 'statistics'])->name('api.users.statistics');
    
    // Search users
    // GET /api/users/search?q=john&fields[]=name&fields[]=email
    Route::get('/search', [UserApiController::class, 'search'])->name('api.users.search');
    
    // Get users by role
    // GET /api/users/role/admin
    Route::get('/role/{role}', [UserApiController::class, 'getByRole'])->name('api.users.by-role');
    
    // Get specific user
    // GET /api/users/1
    Route::get('/{id}', [UserApiController::class, 'show'])->name('api.users.show');
    
    // Create new user
    // POST /api/users
    Route::post('/', [UserApiController::class, 'store'])->name('api.users.store');
    
    // Update user
    // PUT/PATCH /api/users/1
    Route::put('/{id}', [UserApiController::class, 'update'])->name('api.users.update');
    Route::patch('/{id}', [UserApiController::class, 'update'])->name('api.users.patch');
    
    // Delete user
    // DELETE /api/users/1
    Route::delete('/{id}', [UserApiController::class, 'destroy'])->name('api.users.destroy');
});


// Order Management API Routes
Route::prefix('orders')->group(function () {
    Route::get('/', [\App\Http\Controllers\Api\OrderApiController::class, 'index'])->name('api.orders.index');
    Route::get('/{id}', [\App\Http\Controllers\Api\OrderApiController::class, 'show'])->name('api.orders.show');
    Route::post('/', [\App\Http\Controllers\Api\OrderApiController::class, 'store'])->name('api.orders.store');
    Route::put('/{id}', [\App\Http\Controllers\Api\OrderApiController::class, 'update'])->name('api.orders.update');
    Route::patch('/{id}', [\App\Http\Controllers\Api\OrderApiController::class, 'update'])->name('api.orders.patch');
    Route::delete('/{id}', [\App\Http\Controllers\Api\OrderApiController::class, 'destroy'])->name('api.orders.destroy');
});

if (!function_exists('proxyToMicroservice')) {
    /**
     * Helper function to proxy requests to backend microservice with authentication
     */
    function proxyToMicroservice(Request $request, string $endpoint) {
        try {
            // Get the authorization header from the incoming request
            $authToken = $request->header('Authorization');
            
            // If no auth header from API request, try to get from session/cookie
            if (!$authToken && $request->user()) {
                // Generate or retrieve token for authenticated Laravel user
                $authToken = 'Bearer ' . session('api_token', '');
            }
            
            // Build the request to microservice
            $httpRequest = Http::timeout(10);
            
            // Add authorization header if available
            if ($authToken) {
                $httpRequest = $httpRequest->withHeaders([
                    'Authorization' => $authToken,
                    'X-Forwarded-For' => $request->ip(),
                    'X-Forwarded-User-Agent' => $request->userAgent(),
                ]);
            }
            
            $response = $httpRequest->get('http://localhost:5001/api/' . $endpoint);
            
            // Return the response with same status code
            return response()->json($response->json(), $response->status());
        } catch (\Exception $e) {
            \Log::error('Microservice proxy error: ' . $e->getMessage());
            return response()->json([
                'error' => 'API unavailable',
                'message' => 'The backend service is temporarily unavailable. Please try again later.'
            ], 503);
        }
    }
}

// Technician API Routes (proxy to backend microservice)
// Protected by Laravel auth middleware + role check
Route::prefix('technician')->middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', function (Request $request) {
        // Check if user has technician role
        $user = $request->user();
        $allowedRoles = ['technician', 'admin', 'super-admin', 'manager', 'supervisor'];
        
        if (!$user || !in_array(strtolower($user->role ?? ''), array_map('strtolower', $allowedRoles))) {
            return response()->json([
                'error' => 'Forbidden',
                'message' => 'You do not have permission to access this resource.'
            ], 403);
        }
        
        return proxyToMicroservice($request, 'technician/dashboard');
    })->name('api.technician.dashboard');
    
    Route::get('/jobs', function (Request $request) {
        $user = $request->user();
        $allowedRoles = ['technician', 'admin', 'super-admin', 'manager', 'supervisor'];
        
        if (!$user || !in_array(strtolower($user->role ?? ''), array_map('strtolower', $allowedRoles))) {
            return response()->json(['error' => 'Forbidden'], 403);
        }
        
        return proxyToMicroservice($request, 'technician/jobs');
    })->name('api.technician.jobs');
    
    Route::get('/inventory', function (Request $request) {
        $user = $request->user();
        $allowedRoles = ['technician', 'admin', 'super-admin', 'manager', 'supervisor'];
        
        if (!$user || !in_array(strtolower($user->role ?? ''), array_map('strtolower', $allowedRoles))) {
            return response()->json(['error' => 'Forbidden'], 403);
        }
        
        return proxyToMicroservice($request, 'technician/inventory');
    })->name('api.technician.inventory');
    
    Route::get('/bookings', function (Request $request) {
        $user = $request->user();
        $allowedRoles = ['technician', 'admin', 'super-admin', 'manager', 'supervisor'];
        
        if (!$user || !in_array(strtolower($user->role ?? ''), array_map('strtolower', $allowedRoles))) {
            return response()->json(['error' => 'Forbidden'], 403);
        }
        
        return proxyToMicroservice($request, 'technician/bookings');
    })->name('api.technician.bookings');
    
    Route::get('/schedule', function (Request $request) {
        $user = $request->user();
        $allowedRoles = ['technician', 'admin', 'super-admin', 'manager', 'supervisor'];
        
        if (!$user || !in_array(strtolower($user->role ?? ''), array_map('strtolower', $allowedRoles))) {
            return response()->json(['error' => 'Forbidden'], 403);
        }
        
        return proxyToMicroservice($request, 'technician/schedule');
    })->name('api.technician.schedule');
});

// Header Data Routes
Route::middleware('auth')->group(function () {
    Route::get('/header/notifications', [\App\Http\Controllers\Api\HeaderApiController::class, 'notifications']);
    Route::get('/header/messages', [\App\Http\Controllers\Api\HeaderApiController::class, 'messages']);
});
