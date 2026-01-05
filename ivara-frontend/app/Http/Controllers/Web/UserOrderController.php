<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UserOrderController extends Controller
{
    /**
     * Display the user's order history.
     */
    public function index()
    {
        try {
            $userId = auth()->id();
            
            if (!$userId) {
                return redirect()->route('login')->with('error', 'Please login to view your orders');
            }
            
            $baseUrl = env('BACKEND_API_URL', 'http://localhost:5001');
            $baseUrl = rtrim($baseUrl, '/');
            if (str_ends_with($baseUrl, '/api')) {
                $baseUrl = substr($baseUrl, 0, -4);
            }
            
            $url = "{$baseUrl}/api/orders/buyer/{$userId}";
            Log::info("Fetching orders for user {$userId} from: " . $url);
            
            $response = Http::get($url);
            
            $orders = [];
            
            if ($response->successful()) {
                $data = $response->json();
                if ($data['success']) {
                    $orders = $data['data'] ?? [];
                }
            } else {
                Log::warning("Failed to fetch orders: " . $response->status());
            }
            
            return view('web.marketplace.orders', [
                'orders' => $orders,
                'backendUrl' => $baseUrl
            ]);
            
        } catch (\Exception $e) {
            Log::error('Orders Page Error:', ['error' => $e->getMessage()]);
            
            return view('web.marketplace.orders', [
                'orders' => [],
                'error' => 'Unable to load orders. Please try again later.',
                'backendUrl' => env('BACKEND_API_URL', 'http://localhost:5001')
            ]);
        }
    }

    /**
     * Display a specific order detail.
     */
    public function show($id)
    {
        try {
            $baseUrl = env('BACKEND_API_URL', 'http://localhost:5001');
            $baseUrl = rtrim($baseUrl, '/');
            if (str_ends_with($baseUrl, '/api')) {
                $baseUrl = substr($baseUrl, 0, -4);
            }
            
            $response = Http::get("{$baseUrl}/api/orders/{$id}");
            
            if ($response->successful()) {
                $data = $response->json();
                if ($data['success']) {
                    return view('web.marketplace.order_detail', [
                        'order' => $data['data'],
                        'backendUrl' => $baseUrl
                    ]);
                }
            }
            
            return redirect()->route('orders.index')->with('error', 'Order not found');
            
        } catch (\Exception $e) {
            Log::error('Order Detail Page Error:', ['error' => $e->getMessage()]);
            return redirect()->route('orders.index')->with('error', 'Unable to load order details');
        }
    }
}
