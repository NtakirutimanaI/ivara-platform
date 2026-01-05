<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TechnicalRepairApiService
{
    protected $baseUrl;
    protected $token;

    public function __construct()
    {
        $this->baseUrl = config('services.backend.url', env('BACKEND_API_URL', 'http://localhost:5001/api'));
        $this->token = session('api_token'); // Assuming we store the JWT in session
    }

    protected function request()
    {
        return Http::withToken($this->token)
            ->baseUrl($this->baseUrl);
    }

    // Generic methods to fetch data from the microservice
    public function get($endpoint)
    {
        try {
            $response = $this->request()->get($endpoint);
            return $response->successful() ? $response->json() : [];
        } catch (\Exception $e) {
            Log::error("API Get Error ($endpoint): " . $e->getMessage());
            return [];
        }
    }

    public function post($endpoint, $data)
    {
        try {
            $response = $this->request()->post($endpoint, $data);
            return $response->successful() ? $response->json() : null;
        } catch (\Exception $e) {
            Log::error("API Post Error ($endpoint): " . $e->getMessage());
            return null;
        }
    }

    public function put($endpoint, $data)
    {
        try {
            $response = $this->request()->put($endpoint, $data);
            return $response->successful() ? $response->json() : null;
        } catch (\Exception $e) {
            Log::error("API Put Error ($endpoint): " . $e->getMessage());
            return null;
        }
    }

    public function delete($endpoint)
    {
        try {
            $response = $this->request()->delete($endpoint);
            return $response->successful();
        } catch (\Exception $e) {
            Log::error("API Delete Error ($endpoint): " . $e->getMessage());
            return false;
        }
    }
}
