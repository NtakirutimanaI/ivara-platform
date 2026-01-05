<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * API Gateway: User Controller
 * 
 * This controller provides RESTful API endpoints for user management.
 * It works with both MySQL and MongoDB through the service layer.
 * 
 * Base URL: /api/users
 */
class UserApiController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Get all users
     * 
     * GET /api/users
     * 
     * Query parameters:
     * - role: Filter by role (admin, manager, supervisor, technician, user)
     * - status: Filter by status (active, inactive, suspended)
     * - search: Search in name, email, username
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $filters = $request->only(['role', 'status', 'search']);
            $users = $this->userService->getAllUsers($filters);

            return response()->json([
                'success' => true,
                'data' => $users,
                'count' => $users->count(),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch users',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get user by ID
     * 
     * GET /api/users/{id}
     */
    public function show($id): JsonResponse
    {
        try {
            $user = $this->userService->getUserById($id);

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $user,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch user',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Create a new user
     * 
     * POST /api/users
     * 
     * Body:
     * {
     *   "name": "John Doe",
     *   "email": "john@example.com",
     *   "username": "johndoe",
     *   "password": "password123",
     *   "role": "user",
     *   "status": "active",
     *   "phone": "+1234567890",
     *   "country_code": "+1",
     *   "location": "New York"
     * }
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'username' => 'nullable|string|max:255|unique:users,username',
                'password' => 'required|string|min:8',
                'role' => 'nullable|in:admin,manager,supervisor,technician,user',
                'status' => 'nullable|in:active,inactive,suspended',
                'phone' => 'nullable|string|max:20',
                'country_code' => 'nullable|string|max:5',
                'location' => 'nullable|string|max:255',
            ]);

            $user = $this->userService->createUser($validated);

            return response()->json([
                'success' => true,
                'message' => 'User created successfully',
                'data' => $user,
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create user',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update user
     * 
     * PUT/PATCH /api/users/{id}
     * 
     * Body: (all fields optional)
     * {
     *   "name": "John Doe Updated",
     *   "email": "john.updated@example.com",
     *   "role": "manager",
     *   "status": "active"
     * }
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'sometimes|string|max:255',
                'email' => 'sometimes|email|unique:users,email,' . $id,
                'username' => 'sometimes|string|max:255|unique:users,username,' . $id,
                'password' => 'sometimes|string|min:8',
                'role' => 'sometimes|in:admin,manager,supervisor,technician,user',
                'status' => 'sometimes|in:active,inactive,suspended',
                'phone' => 'sometimes|string|max:20',
                'country_code' => 'sometimes|string|max:5',
                'location' => 'sometimes|string|max:255',
            ]);

            $user = $this->userService->updateUser($id, $validated);

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'User updated successfully',
                'data' => $user,
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update user',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Delete user
     * 
     * DELETE /api/users/{id}
     */
    public function destroy($id): JsonResponse
    {
        try {
            $deleted = $this->userService->deleteUser($id);

            if (!$deleted) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete user',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get users by role
     * 
     * GET /api/users/role/{role}
     */
    public function getByRole($role): JsonResponse
    {
        try {
            $users = $this->userService->getUsersByRole($role);

            return response()->json([
                'success' => true,
                'data' => $users,
                'count' => $users->count(),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch users',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get user statistics
     * 
     * GET /api/users/statistics
     */
    public function statistics(): JsonResponse
    {
        try {
            $stats = $this->userService->getUserStatistics();

            return response()->json([
                'success' => true,
                'data' => $stats,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch statistics',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Search users
     * 
     * GET /api/users/search?q={query}
     */
    public function search(Request $request): JsonResponse
    {
        try {
            $query = $request->input('q', '');
            $fields = $request->input('fields', ['name', 'email', 'username']);

            if (empty($query)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Search query is required',
                ], 400);
            }

            $users = $this->userService->searchUsers($query, $fields);

            return response()->json([
                'success' => true,
                'data' => $users,
                'count' => $users->count(),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Search failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
