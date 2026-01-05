<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    /**
     * Display the user's cart.
     */
    public function index()
    {
        try {
            $userId = auth()->id();
            
            if (!$userId) {
                return redirect()->route('login')->with('error', 'Please login to view your cart');
            }
            
            $baseUrl = env('BACKEND_API_URL', 'http://localhost:5001');
            $baseUrl = rtrim($baseUrl, '/');
            if (str_ends_with($baseUrl, '/api')) {
                $baseUrl = substr($baseUrl, 0, -4);
            }
            
            $url = "{$baseUrl}/api/cart/{$userId}";
            Log::info("Fetching cart for user {$userId} from: " . $url);
            
            $response = Http::get($url);
            
            $cart = null;
            $items = [];
            $total = 0;
            
            if ($response->successful()) {
                $data = $response->json();
                if ($data['success']) {
                    $cart = $data['data'];
                    $items = $cart['items'] ?? [];
                    $total = $cart['totalAmount'] ?? 0;
                    
                    // If items have product IDs but no details, we might need to fetch details
                    // However, usually the cart API should return populated items.
                    // Assuming the backend returns populated product details.
                }
            } else {
                Log::warning("Failed to fetch cart: " . $response->status());
            }
            
            return view('web.marketplace.cart', [
                'items' => $items,
                'total' => $total,
                'cartId' => $cart['_id'] ?? null,
                'backendUrl' => $baseUrl
            ]);
            
        } catch (\Exception $e) {
            Log::error('Cart Page Error:', ['error' => $e->getMessage()]);
            
            return view('web.marketplace.cart', [
                'items' => [],
                'total' => 0,
                'error' => 'Unable to load cart. Please try again later.',
                'backendUrl' => env('BACKEND_API_URL', 'http://localhost:5001')
            ]);
        }
    }

    /**
     * Checkout page.
     */
    public function checkout()
    {
        try {
            $userId = auth()->id();
            if (!$userId) return redirect()->route('login');

            $baseUrl = env('BACKEND_API_URL', 'http://localhost:5001');
            $baseUrl = rtrim($baseUrl, '/');
            if (str_ends_with($baseUrl, '/api')) {
                $baseUrl = substr($baseUrl, 0, -4);
            }

            $response = Http::get("{$baseUrl}/api/cart/{$userId}");
            
            $items = [];
            $total = 0;
            if ($response->successful()) {
                $data = $response->json();
                if ($data['success']) {
                    $items = $data['data']['items'] ?? [];
                    $total = $data['data']['totalAmount'] ?? 0;
                }
            }

            if (empty($items)) {
                return redirect()->route('cart.index')->with('error', 'Your cart is empty');
            }

            return view('web.marketplace.checkout', [
                'items' => $items,
                'total' => $total,
                'backendUrl' => $baseUrl
            ]);
        } catch (\Exception $e) {
            Log::error('Checkout Page Error:', ['error' => $e->getMessage()]);
            return redirect()->route('cart.index')->with('error', 'Unable to load checkout page.');
        }
    }
    
    /**
     * Place order (proxy to backend)
     */
    public function placeOrder(Request $request)
    {
        try {
            $userId = auth()->id();
            if (!$userId) {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
            }

            $baseUrl = env('BACKEND_API_URL', 'http://localhost:5001');
            $baseUrl = rtrim($baseUrl, '/');
            if (str_ends_with($baseUrl, '/api')) {
                $baseUrl = substr($baseUrl, 0, -4);
            }
            
            $url = "{$baseUrl}/api/orders/create";
            Log::info("Creating order for user {$userId} at: " . $url);
            Log::info("Order data:", $request->all());
            
            $response = Http::post($url, [
                'userId' => $userId,
                'shippingAddress' => $request->input('shippingAddress'),
                'paymentMethod' => $request->input('paymentMethod', 'Mobile Money'),
                'notes' => $request->input('notes', '')
            ]);

            Log::info("Backend response status: " . $response->status());
            Log::info("Backend response body: " . $response->body());

            if ($response->successful()) {
                return response()->json($response->json());
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to create order: ' . $response->body()
            ], $response->status());

        } catch (\Exception $e) {
            Log::error('Place Order Error:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json([
                'success' => false,
                'message' => 'Unable to place order: ' . $e->getMessage()
            ], 500);
        }
    }
}
