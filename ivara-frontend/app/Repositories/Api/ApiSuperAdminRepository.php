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
        try {
            $response = Http::withHeaders($this->getAuthHeaders())
                ->timeout(5)
                ->get(str_replace('super-admin', 'auth', $this->getApiUrl()) . '/users-by-roles', [
                    'roles' => 'admin,manager,supervisor'
                ]);
            
            return $response->successful() ? $this->normalizeUsers($response->json()) : [];
        } catch (\Exception $e) {
            Log::error('API Get Admins failed: ' . $e->getMessage());
            return [];
        }
    }

    public function createAdmin(array $data)
    {
        try {
            $response = Http::withHeaders($this->getAuthHeaders())
                ->timeout(5)
                ->post(str_replace('super-admin', 'auth', $this->getApiUrl()) . '/register', $data);
            
            return $response->successful() ? $this->normalizeUser($response->json()) : null;
        } catch (\Exception $e) {
            Log::error('API Create Admin failed: ' . $e->getMessage());
            return null;
        }
    }

    public function updateAdmin($id, array $data)
    {
        try {
            $response = Http::withHeaders($this->getAuthHeaders())
                ->timeout(5)
                ->put($this->getApiUrl() . '/users/' . $id, $data);
            
            return $response->successful() ? $this->normalizeUser($response->json()) : null;
        } catch (\Exception $e) {
            Log::error('API Update Admin failed: ' . $e->getMessage());
            return null;
        }
    }

    public function deleteAdmin($id)
    {
        try {
            $response = Http::withHeaders($this->getAuthHeaders())
                ->timeout(5)
                ->delete($this->getApiUrl() . '/users/' . $id);
            
            return $response->successful();
        } catch (\Exception $e) {
            Log::error('API Delete Admin failed: ' . $e->getMessage());
            return false;
        }
    }

    public function findUserById($id)
    {
        try {
            $response = Http::withHeaders($this->getAuthHeaders())
                ->timeout(5)
                ->get(str_replace('super-admin', 'auth', $this->getApiUrl()) . '/user/' . $id);
            
            return $response->successful() ? $this->normalizeUser($response->json()) : null;
        } catch (\Exception $e) {
            Log::error('API Find User by ID failed: ' . $e->getMessage());
            return null;
        }
    }

    public function updateUserStatus($id, $status)
    {
        try {
            $response = Http::withHeaders($this->getAuthHeaders())
                ->timeout(5)
                ->put($this->getApiUrl() . '/users/' . $id, ['status' => $status]);
            
            return $response->successful() ? $this->normalizeUser($response->json()) : null;
        } catch (\Exception $e) {
            Log::error('API Update User Status failed: ' . $e->getMessage());
            return null;
        }
    }

    public function getUsersByRole(array $roles)
    {
        try {
            $response = Http::withHeaders($this->getAuthHeaders())
                ->timeout(5)
                ->get(str_replace('super-admin', 'auth', $this->getApiUrl()) . '/users-by-roles', [
                    'roles' => implode(',', $roles)
                ]);
            
            return $response->successful() ? $this->normalizeUsers($response->json()) : [];
        } catch (\Exception $e) {
            Log::error('API Get UsersByRole failed: ' . $e->getMessage());
            return [];
        }
    }

    public function getAllUsers()
    {
        try {
            $response = Http::withHeaders($this->getAuthHeaders())
                ->timeout(10)
                ->get($this->getApiUrl() . '/users');
            
            return $response->successful() ? $this->normalizeUsers($response->json()) : [];
        } catch (\Exception $e) {
            Log::error('API Get All Users failed: ' . $e->getMessage());
            return [];
        }
    }

    private function normalizeUsers($users)
    {
        if (!is_array($users)) return [];
        return array_map([$this, 'normalizeUser'], $users);
    }

    private function normalizeUser($user)
    {
        if (!$user) return null;
        $user = (array) $user;
        if (isset($user['_id']) && !isset($user['id'])) {
            $user['id'] = $user['_id'];
        }
        return $user;
    }

    public function getSystemOverview()
    {
        try {
            $response = Http::withHeaders($this->getAuthHeaders())
                ->timeout(5)
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
                    'total_clients' => $stats['totalClients'] ?? 0,
                    'online_admins' => $stats['onlineAdmins'] ?? 0,
                    'online_managers' => $stats['onlineManagers'] ?? 0,
                    'online_supervisors' => $stats['onlineSupervisors'] ?? 0,
                    'pending_verifications' => $stats['pendingVerifications'] ?? 0,
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
            'total_clients' => 0,
            'online_admins' => 0,
            'online_managers' => 0,
            'online_supervisors' => 0,
            'pending_verifications' => 0,
            'total_orders' => 0,
            'total_revenue' => 0,
            'role_counts' => [],
            'recent_events' => []
        ];
    }
}
