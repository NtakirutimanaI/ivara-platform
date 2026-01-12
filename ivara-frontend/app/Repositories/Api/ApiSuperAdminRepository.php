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
        
        // Ensure common timestamp availability
        if (isset($user['createdAt']) && !isset($user['created_at'])) {
            $user['created_at'] = \Carbon\Carbon::parse($user['createdAt'])->diffForHumans();
        }
        
        return $user;
    }

    private function normalizeProduct($p)
    {
        if (!$p) return null;
        $p = (array) $p;
        
        // Identity & Timestamps
        if (isset($p['_id']) && !isset($p['id'])) $p['id'] = $p['_id'];
        if (isset($p['createdAt'])) $p['created_at'] = \Carbon\Carbon::parse($p['createdAt'])->format('M d, Y');
        else $p['created_at'] = 'Just now';

        // Mapping API terms to Frontend terms
        $p['plan'] = $p['tier'] ?? 'Basic';
        $p['seller_id'] = $p['seller'] ?? '0';
        $p['seller_name'] = $p['sellerName'] ?? 'Platform Seller';
        
        return $p;
    }

    private function normalizePlan($plan)
    {
        if (!$plan) return null;
        $plan = (array) $plan;
        
        // Map API 'features' array to frontend 'benefits' string
        if (isset($plan['features']) && is_array($plan['features'])) {
            $plan['benefits'] = implode(', ', $plan['features']);
        } else {
            $plan['benefits'] = $plan['benefits'] ?? 'Standard Platform Access';
        }
        
        return $plan;
    }

    private function normalizeMediator($m)
    {
        if (!$m) return null;
        $m = (array) $m;
        
        // Identity normalization
        if (isset($m['_id']) && !isset($m['id'])) $m['id'] = $m['_id'];
        
        // Map API fields to frontend expectations
        $m['clients'] = $m['clientsProvided'] ?? 0;
        
        // Map numeric level to tier name
        if (isset($m['level'])) {
            $levelMap = [1 => 'Basic', 2 => 'Standard', 3 => 'Premium'];
            $m['level'] = is_numeric($m['level']) ? ($levelMap[$m['level']] ?? 'Basic') : $m['level'];
        } else {
            $m['level'] = 'Basic';
        }
        
        // Calculate requirement for next tier
        $m['requirement'] = $m['nextMilestone'] ?? 0;
        $m['earnings'] = $m['earnings'] ?? 0;
        
        return $m;
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

    public function getMarketplaceData()
    {
        try {
            $response = Http::withHeaders($this->getAuthHeaders())
                ->timeout(5)
                ->get($this->getApiUrl() . '/marketplace');
            
            if ($response->successful()) {
                $data = $response->json();
                return [
                    'stats' => $data['stats'] ?? [],
                    'products' => array_map([$this, 'normalizeProduct'], $data['products'] ?? []),
                    'plans' => array_map([$this, 'normalizePlan'], $data['plans'] ?? []),
                    'mediators' => array_map([$this, 'normalizeMediator'], $data['mediators'] ?? [])
                ];
            }
            return ['stats' => [], 'products' => [], 'plans' => [], 'mediators' => []];
        } catch (\Exception $e) {
            Log::error('API Get Marketplace failed: ' . $e->getMessage());
            return ['stats' => [], 'products' => [], 'plans' => [], 'mediators' => []];
        }
    }

    public function moderateProductListing($id, $action)
    {
        try {
            $response = Http::withHeaders($this->getAuthHeaders())
                ->timeout(5)
                ->post($this->getApiUrl() . '/marketplace/product/' . $id, [
                    'action' => $action
                ]);
            
            return $response->successful();
        } catch (\Exception $e) {
            Log::error('API Moderate Product failed: ' . $e->getMessage());
            return false;
        }
    }

    public function getRoleRegistry()
    {
        try {
            $response = Http::withHeaders($this->getAuthHeaders())
                ->timeout(5)
                ->get($this->getApiUrl() . '/roles');
            
            return $response->successful() ? $response->json() : [];
        } catch (\Exception $e) {
            Log::error('API Get Roles failed: ' . $e->getMessage());
            return [];
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
