<?php

namespace App\Repositories\Api;

use App\Contracts\Repositories\SuperAdminRepositoryInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class ApiSuperAdminRepository implements SuperAdminRepositoryInterface
{
    private function getApiUrl(): string
    {
        $baseUrl = env('BACKEND_API_URL', 'http://127.0.0.1:5001/api');
        $baseUrl = rtrim($baseUrl, '/');
        if (str_ends_with($baseUrl, '/api')) {
            $baseUrl = substr($baseUrl, 0, -4);
        }
        return $baseUrl . '/api/super-admin';
    }

    private function getAuthHeaders(): array
    {
        $token = Session::get('auth_token') ?? Session::get('api_token');
        return [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ];
    }

    public function getAllAdmins()
    {
        // For now, reuse the auth/users-by-roles if needed, or implement in backend
        try {
            $response = Http::withHeaders($this->getAuthHeaders())
                ->get(str_replace('super-admin', 'auth', $this->getApiUrl()) . '/users-by-roles', [
                    'roles' => 'admin,manager,supervisor'
                ]);
            
            return $response->successful() ? $response->json() : [];
        } catch (\Exception $e) {
            Log::error('API Get Admins failed: ' . $e->getMessage());
            return [];
        }
    }

    public function createAdmin(array $data)
    {
        try {
            $response = Http::withHeaders($this->getAuthHeaders())
                ->post(str_replace('super-admin', 'auth', $this->getApiUrl()) . '/register', $data);
            
            return $response->successful() ? $response->json() : null;
        } catch (\Exception $e) {
            Log::error('API Create Admin failed: ' . $e->getMessage());
            return null;
        }
    }

    public function updateAdmin($id, array $data)
    {
        // Implement if needed in backend
        return null;
    }

    public function deleteAdmin($id)
    {
        // Implement if needed in backend
        return false;
    }

    public function getUsersByRole(array $roles)
    {
        try {
            $response = Http::withHeaders($this->getAuthHeaders())
                ->get(str_replace('super-admin', 'auth', $this->getApiUrl()) . '/users-by-roles', [
                    'roles' => implode(',', $roles)
                ]);
            
            return $response->successful() ? $response->json() : [];
        } catch (\Exception $e) {
            Log::error('API Get UsersByRole failed: ' . $e->getMessage());
            return [];
        }
    }

    public function getSystemOverview()
    {
        try {
            $response = Http::withHeaders($this->getAuthHeaders())
                ->get($this->getApiUrl() . '/overview');
            
            if ($response->successful()) {
                $data = $response->json();
                $stats = $data['platformStats'] ?? [];
                
                return [
                    'total_users' => $stats['totalUsers'] ?? 0,
                    'total_admins' => $stats['totalAdmins'] ?? 0,
                    'total_managers' => $stats['totalManagers'] ?? 0,
                    'total_supervisors' => $stats['totalSupervisors'] ?? 0,
                    'total_providers' => $stats['totalProviders'] ?? 0,
                    'total_orders' => $stats['totalOrders'] ?? 0,
                    'total_revenue' => $stats['totalRevenue'] ?? 0,
                    'role_counts' => $data['roleCounts'] ?? [],
                    'recent_events' => $data['recentPlatformEvents'] ?? []
                ];
            }
            
            return $this->getFallbackStats();
        } catch (\Exception $e) {
            Log::error('API System Overview failed: ' . $e->getMessage());
            return $this->getFallbackStats();
        }
    }

    private function getFallbackStats(): array
    {
        return [
            'total_users' => 0,
            'total_admins' => 0,
            'total_managers' => 0,
            'total_supervisors' => 0,
            'total_providers' => 0,
            'total_orders' => 0,
            'total_revenue' => 0,
            'role_counts' => [],
            'recent_events' => []
        ];
    }
}
