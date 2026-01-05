<?php
namespace App\Modules\Core\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class PermissionController extends Controller {

    private function getBaseUrl(): string
    {
        $baseUrl = env('BACKEND_API_URL', 'http://localhost:5001');
        $baseUrl = rtrim($baseUrl, '/');
        if (str_ends_with($baseUrl, '/api')) {
            $baseUrl = substr($baseUrl, 0, -4);
        }
        return $baseUrl;
    }

    private function getAuthHeader(): array
    {
        $token = Session::get('auth_token');
        return [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ];
    }

    // =========================
    // Display roles, permissions, and users
    // =========================
    public function index() {
        // Log activity via API
        try {
            Http::withHeaders($this->getAuthHeader())
                ->post($this->getBaseUrl() . '/api/activities', [
                    'message' => 'Accessed roles and permissions page.',
                    'type' => 'info'
                ]);
        } catch (\Exception $e) {
            Log::warning('Failed to log activity: ' . $e->getMessage());
        }

        // FETCH DATA FROM API
        // Ideally we should have endpoints for roles/permissions.
        // For now, we fetch users.
        $users = [];
        try {
            $response = Http::withHeaders($this->getAuthHeader())
                ->get($this->getBaseUrl() . '/api/auth/users-by-roles', ['roles' => 'admin,manager,supervisor,user']);
            if ($response->successful()) {
                $users = $response->json();
            }
        } catch (\Exception $e) {
            Log::error('Failed to fetch users: ' . $e->getMessage());
        }

        // Mock Roles/Permissions for display until backend has full RBAC endpoints
        // or check if we can fetch unique roles from users
        $roles = [
            ['id' => 1, 'name' => 'super_admin', 'permissions' => ['all']],
            ['id' => 2, 'name' => 'admin', 'permissions' => ['manage_category']],
            ['id' => 3, 'name' => 'manager', 'permissions' => ['view_reports']],
            ['id' => 4, 'name' => 'supervisor', 'permissions' => ['manage_staff']],
            ['id' => 5, 'name' => 'user', 'permissions' => ['basic_access']],
        ];

        $permissions = ['manage_category', 'view_reports', 'manage_staff', 'basic_access'];

        return view('admin.roles_permissions', [
            'roles' => $roles,
            'permissions' => $permissions,
            'users' => $users,
            'team' => [], // Add API call if needed
            'technicians' => [], // Add API call if needed
        ]);
    }

    // =========================
    // Create a new role
    // =========================
    public function storeRole(Request $req) {
        // Log activity via API
        try {
            Http::withHeaders($this->getAuthHeader())
                ->post($this->getBaseUrl() . '/api/activities', [
                    'message' => 'New role created: ' . $req->name,
                    'type' => 'action'
                ]);
        } catch (\Exception $e) {}

        // TODO: Call backend to store role
        return response()->json(['ok']);
    }

    // =========================
    // Update role permissions
    // =========================
    public function updatePermissions(Request $req) {
        // Log activity via API
        try {
            Http::withHeaders($this->getAuthHeader())
                ->post($this->getBaseUrl() . '/api/activities', [
                    'message' => 'Updated permissions for role ID: ' . $req->role_id,
                    'type' => 'action'
                ]);
        } catch (\Exception $e) {}

        // TODO: Call backend to update permissions
        return response()->json(['ok']);
    }

    // =========================
    // Assign role to users
    // =========================
    public function assignRole(Request $req) {
        // Log activity via API
        try {
            Http::withHeaders($this->getAuthHeader())
                ->post($this->getBaseUrl() . '/api/activities', [
                    'message' => 'Assigned role ID ' . $req->role_id . ' to users.',
                    'type' => 'action'
                ]);
        } catch (\Exception $e) {}

        // TODO: Call backend to assign role
        return response()->json(['ok']);
    }
}
