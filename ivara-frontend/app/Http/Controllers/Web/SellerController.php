<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SellerController extends Controller
{
    /**
     * Display seller dashboard and pending orders.
     */
    public function dashboard(Request $request)
    {
        try {
            $userId = auth()->id();
            if (!$userId) return redirect()->route('login');

            $baseUrl = $this->getBackendUrl();
            $status = $request->query('status', '');
            
            // Fetch seller orders
            $page = $request->query('page', 1);
            $url = "{$baseUrl}/api/orders/seller/{$userId}?page={$page}" . ($status ? "&status={$status}" : "");
            
            $response = Http::get($url);
            
            $orders = [];
            $pagination = null;
            $stats = null;

            if ($response->successful()) {
                $data = $response->json();
                $orders = $data['data'] ?? [];
                $pagination = $data['pagination'] ?? null;
            }

            // Fetch seller stats
            $statsResponse = Http::get("{$baseUrl}/api/orders/seller/{$userId}/stats");
            if ($statsResponse->successful()) {
                $stats = $statsResponse->json()['data'] ?? null;
            }
            
            return view('web.marketplace.seller.dashboard', [
                'orders' => $orders,
                'pagination' => $pagination,
                'stats' => $stats,
                'currentStatus' => $status,
                'backendUrl' => $baseUrl
            ]);

        } catch (\Exception $e) {
            Log::error('Seller Dashboard Error: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'Unable to load dashboard');
        }
    }

    /**
     * Update order status.
     */
    public function updateOrderStatus(Request $request, $orderId)
    {
        try {
            $userId = auth()->id();
            if (!$userId) return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);

            $status = $request->input('status');
            $baseUrl = $this->getBackendUrl();
            
            $response = Http::patch("{$baseUrl}/api/orders/{$orderId}/status", [
                'status' => $status
            ]);

            if ($response->successful()) {
                return response()->json(['success' => true]);
            }

            return response()->json([
                'success' => false, 
                'message' => $response->json()['message'] ?? 'Failed to update status'
            ], 400);

        } catch (\Exception $e) {
             return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Show create product form.
     */
    public function create()
    {
        // View existing products (mini version)
        $userId = auth()->id();
        $baseUrl = $this->getBackendUrl();
        $response = Http::get("{$baseUrl}/api/products/seller/{$userId}?limit=10");
        $products = $response->successful() ? ($response->json()['data'] ?? []) : [];

        return view('web.marketplace.seller.create_product', [
            'products' => $products,
            'backendUrl' => $baseUrl
        ]);
    }

    /**
     * Store new product.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stockQuantity' => 'required|integer|min:1',
            'description' => 'required|string',
            'image' => 'required|image|max:5120', // 5MB
        ]);

        try {
            $userId = auth()->id();
            if (!$userId) return redirect()->route('login');

            $baseUrl = $this->getBackendUrl();
            
            // 1. Upload Image
            $imageUrl = '';
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $uploadResponse = Http::attach(
                    'file', 
                    file_get_contents($file->getRealPath()), 
                    $file->getClientOriginalName(),
                    ['Content-Type' => $file->getClientMimeType()]
                )->post("{$baseUrl}/api/upload");
                
                if ($uploadResponse->successful()) {
                    $imageUrl = $uploadResponse->json()['data']['url'] ?? '';
                } else {
                    return back()->with('error', 'Failed to upload image: ' . $uploadResponse->body());
                }
            }

            // 2. Create Product
            $productData = [
                'name' => $request->name,
                'category' => $request->category,
                'price' => (float) $request->price,
                'stockQuantity' => (int) $request->stockQuantity,
                'description' => $request->description,
                'images' => [$imageUrl], // Backend expects array
                'seller' => $userId,
                'variants' => [], // Optional for now
            ];

            $response = Http::post("{$baseUrl}/api/products", $productData);

            if ($response->successful()) {
                return redirect()->route('seller.dashboard')->with('success', 'Product published successfully!');
            } else {
                 return back()->with('error', 'Failed to create product: ' . $response->body());
            }

        } catch (\Exception $e) {
            Log::error('Create Product Error: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while creating the product.');
        }
    }

    /**
     * Show edit product form.
     */
    public function edit($id)
    {
        try {
            $baseUrl = $this->getBackendUrl();
            $response = Http::get("{$baseUrl}/api/products/{$id}");
            
            if ($response->successful()) {
                $product = $response->json()['data'];
                if ($product['seller']['_id'] !== auth()->id() && $product['seller'] !== auth()->id()) {
                     return redirect()->route('seller.products.create')->with('error', 'Unauthorized access');
                }
                
                return view('web.marketplace.seller.edit_product', [
                    'product' => $product,
                    'backendUrl' => $baseUrl
                ]);
            }
            return back()->with('error', 'Product not found');
        } catch (\Exception $e) {
            return back()->with('error', 'Error loading product');
        }
    }

    /**
     * Update product.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stockQuantity' => 'required|integer|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|max:5120',
        ]);

        try {
            $baseUrl = $this->getBackendUrl();
            
            $updateData = [
                'name' => $request->name,
                'category' => $request->category,
                'price' => (float) $request->price,
                'stockQuantity' => (int) $request->stockQuantity,
                'description' => $request->description,
            ];

            // Handle Image Upload if provided
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $uploadResponse = Http::attach(
                    'file', 
                    file_get_contents($file->getRealPath()), 
                    $file->getClientOriginalName(),
                    ['Content-Type' => $file->getClientMimeType()]
                )->post("{$baseUrl}/api/upload");
                
                if ($uploadResponse->successful()) {
                    $updateData['images'] = [$uploadResponse->json()['data']['url']];
                }
            }

            $response = Http::put("{$baseUrl}/api/products/{$id}", $updateData);

            if ($response->successful()) {
                return redirect()->route('seller.products.create')->with('success', 'Product updated successfully');
            }
            
            return back()->with('error', 'Failed to update product');

        } catch (\Exception $e) {
            return back()->with('error', 'Error updating product');
        }
    }

    /**
     * Delete product.
     */
    public function destroy($id)
    {
        try {
            $baseUrl = $this->getBackendUrl();
            $response = Http::delete("{$baseUrl}/api/products/{$id}");

            if ($response->successful()) {
                return back()->with('success', 'Product deleted successfully');
            }
            return back()->with('error', 'Failed to delete product');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting product');
        }
    }

    /**
     * Display seller's products.
     */
    public function products(Request $request)
    {
        try {
            $userId = auth()->id();
            if (!$userId) return redirect()->route('login');

            $baseUrl = $this->getBackendUrl();
            $page = $request->query('page', 1);
            
            // Fetch products
            $url = "{$baseUrl}/api/products/seller/{$userId}?page={$page}&limit=20";
            $response = Http::get($url);
            
            $products = [];
            $pagination = null;

            if ($response->successful()) {
                $data = $response->json();
                $products = $data['data'] ?? [];
                $pagination = $data['pagination'] ?? null;
            }

            return view('web.marketplace.seller.products', [
                'products' => $products,
                'pagination' => $pagination,
                'backendUrl' => $baseUrl
            ]);

        } catch (\Exception $e) {
            Log::error('Seller Products Error: ' . $e->getMessage());
            return redirect()->route('seller.dashboard')->with('error', 'Unable to load products');
        }
    }

    private function getBackendUrl()
    {
        $baseUrl = env('BACKEND_API_URL', 'http://localhost:5001');
        $baseUrl = rtrim($baseUrl, '/');
        if (str_ends_with($baseUrl, '/api')) {
            $baseUrl = substr($baseUrl, 0, -4);
        }
        return $baseUrl;
    }
}
