<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MarketplaceController extends Controller
{
    /**
     * Display the marketplace category page with products from API.
     */
    public function index($category = null)
    {
        try {
            // Map URL slugs to database category names
            $categoryMap = [
                'tech' => 'technical',
                'technical' => 'technical',
                'creative' => 'creative',
                'lifestyle' => 'creative',
                'transport' => 'transport',
                'travel' => 'transport',
                'fashion' => 'food-fashion',
                'food' => 'food-fashion',
                'food-fashion' => 'food-fashion',
                'education' => 'education',
                'knowledge' => 'education',
                'agriculture' => 'agriculture',
                'environment' => 'agriculture',
                'media' => 'media',
                'entertainment' => 'media',
                'legal' => 'legal',
                'professional' => 'legal',
                'other' => 'other',
                'services' => 'other'
            ];
            
            // Get the actual category name from the map
            $actualCategory = $category && isset($categoryMap[$category]) 
                ? $categoryMap[$category] 
                : $category;
            
            // Base URL should NOT include /api
            $baseUrl = env('BACKEND_API_URL', 'http://localhost:5001');
            // Remove trailing /api if it exists
            $baseUrl = rtrim($baseUrl, '/');
            if (str_ends_with($baseUrl, '/api')) {
                $baseUrl = substr($baseUrl, 0, -4);
            }
            
            // If category is provided, get products for that category
            if ($actualCategory && $actualCategory !== 'all') {
                $url = "{$baseUrl}/api/products/category/{$actualCategory}";
                \Log::info("Fetching products for '{$category}' (mapped to '{$actualCategory}') from: " . $url);
                $response = Http::get($url);
            } else {
                // Get all products
                $url = "{$baseUrl}/api/products";
                \Log::info("Fetching all products from: " . $url);
                $response = Http::get($url);
            }
            
            \Log::info("API Response Status: " . $response->status());
            \Log::info("API Response Body: " . $response->body());
            
            if ($response->successful()) {
                $data = $response->json();
                $rawProducts = $data['data'] ?? [];
                
                // Convert Mongoose documents to plain arrays
                $products = array_map(function($product) {
                    // If product has _doc property (Mongoose document), extract it
                    if (isset($product['_doc'])) {
                        return $product['_doc'];
                    }
                    return $product;
                }, $rawProducts);
                
                $pagination = $data['pagination'] ?? null;
                
                \Log::info("Products count: " . count($products));
                if (count($products) > 0) {
                    \Log::info("First product ID: " . ($products[0]['_id'] ?? 'NO ID'));
                }
                
                return view('web.marketplace.category', [
                    'category' => $category ?? 'all',
                    'products' => $products,
                    'pagination' => $pagination,
                    'backendUrl' => $baseUrl
                ]);
            }
            
            // Fallback to empty products
            \Log::warning("API call unsuccessful, status: " . $response->status());
            return view('web.marketplace.category', [
                'category' => $category ?? 'all',
                'products' => [],
                'pagination' => null,
                'error' => 'API returned status: ' . $response->status(),
                'backendUrl' => $baseUrl
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Marketplace API Error:', ['error' => $e->getMessage()]);
            
            return view('web.marketplace.category', [
                'category' => $category ?? 'all',
                'products' => [],
                'pagination' => null,
                'error' => 'Unable to load products: ' . $e->getMessage(),
                'backendUrl' => env('BACKEND_API_URL', 'http://localhost:5001')
            ]);
        }
    }
    
    /**
     * Display single product details
     */
    public function show($id)
    {
        try {
            $baseUrl = env('BACKEND_API_URL', 'http://localhost:5001');
            $baseUrl = rtrim($baseUrl, '/');
            if (str_ends_with($baseUrl, '/api')) {
                $baseUrl = substr($baseUrl, 0, -4);
            }
            
            $response = Http::get("{$baseUrl}/api/products/{$id}");
            
            if ($response->successful()) {
                $data = $response->json();
                $product = $data['data'] ?? null;
                
                if ($product) {
                    return view('web.marketplace.product', [
                        'product' => $product,
                        'backendUrl' => $baseUrl,
                        'backendApiUrl' => $baseUrl . '/api'
                    ]);
                }
            }
            
            return redirect()->route('marketplace.index')
                ->with('error', 'Product not found');
                
        } catch (\Exception $e) {
            \Log::error('Product API Error:', ['error' => $e->getMessage()]);
            
            return redirect()->route('marketplace.index')
                ->with('error', 'Unable to load product');
        }
    }
}
