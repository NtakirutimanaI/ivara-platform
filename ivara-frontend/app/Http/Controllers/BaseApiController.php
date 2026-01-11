<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

/**
 * Base API Controller
 * All module controllers should extend this to use API gateway instead of direct database access
 */
class BaseApiController extends Controller
{
    protected $apiBaseUrl;
    protected $apiEndpoint;

    public function __construct()
    {
        $baseUrl = env('BACKEND_API_URL', 'http://localhost:5001');
        // Ensure no trailing slash
        $baseUrl = rtrim($baseUrl, '/');
        
        // Only append /api if it doesn't already end with it
        if (!str_ends_with($baseUrl, '/api')) {
            $baseUrl .= '/api';
        }
        
        $this->apiBaseUrl = $baseUrl;
    }

    /**
     * Make GET request to API
     */
    protected function apiGet($endpoint, $params = [])
    {
        try {
            $url = $this->apiBaseUrl . $endpoint;
            $response = Http::get($url, $params);
            
            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => $response->json()['data'] ?? $response->json(),
                    'response' => $response->json()
                ];
            }
            
            return [
                'success' => false,
                'error' => 'API request failed',
                'data' => null
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'data' => null
            ];
        }
    }

    /**
     * Make POST request to API
     */
    protected function apiPost($endpoint, $data = [])
    {
        try {
            $url = $this->apiBaseUrl . $endpoint;
            $response = Http::post($url, $data);
            
            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => $response->json()['data'] ?? $response->json(),
                    'response' => $response->json()
                ];
            }
            
            return [
                'success' => false,
                'error' => $response->json()['message'] ?? 'API request failed',
                'data' => null
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'data' => null
            ];
        }
    }

    /**
     * Make PUT request to API
     */
    protected function apiPut($endpoint, $data = [])
    {
        try {
            $url = $this->apiBaseUrl . $endpoint;
            $response = Http::put($url, $data);
            
            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => $response->json()['data'] ?? $response->json(),
                    'response' => $response->json()
                ];
            }
            
            return [
                'success' => false,
                'error' => $response->json()['message'] ?? 'API request failed',
                'data' => null
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'data' => null
            ];
        }
    }

    /**
     * Make DELETE request to API
     */
    protected function apiDelete($endpoint)
    {
        try {
            $url = $this->apiBaseUrl . $endpoint;
            $response = Http::delete($url);
            
            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => $response->json()['data'] ?? $response->json(),
                    'response' => $response->json()
                ];
            }
            
            return [
                'success' => false,
                'error' => $response->json()['message'] ?? 'API request failed',
                'data' => null
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'data' => null
            ];
        }
    }

    /**
     * Handle API response for views
     */
    protected function handleApiResponse($result, $viewName, $dataKey = 'items', $defaultData = [])
    {
        if ($result['success']) {
            return view($viewName, [$dataKey => collect($result['data'])]);
        }
        
        return view($viewName, [$dataKey => collect($defaultData)])
            ->with('error', $result['error'] ?? 'Failed to fetch data from API');
    }

    /**
     * Handle API response for redirects
     */
    protected function handleApiRedirect($result, $successRoute, $successMessage = 'Operation successful', $errorMessage = 'Operation failed')
    {
        if ($result['success']) {
            return redirect()->route($successRoute)->with('success', $successMessage);
        }
        
        return back()->with('error', $result['error'] ?? $errorMessage)->withInput();
    }
}
