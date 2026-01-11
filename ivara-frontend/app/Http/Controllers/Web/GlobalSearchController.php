<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

// Import Models
use App\Models\Product;
use App\Models\Client;
use App\Models\Order;
use App\Models\Device;
use App\Models\Repair; // Or RegisterRepair depending on usage
use App\Models\Inventory;

class GlobalSearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        if (strlen($query) < 2) {
            return response()->json(['results' => []]);
        }

        $user = Auth::user();
        if (!$user) {
            return response()->json(['results' => []]);
        }

        $results = [];

        // 1. Search Products (My Products)
        // Assuming Product model has user_id or similar scoping
        try {
            $products = Product::where('user_id', $user->id) // Or seller_id
                ->where('name', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%")
                ->take(5)
                ->get();

            foreach ($products as $product) {
                $results[] = [
                    'category' => 'Product',
                    'title' => $product->name,
                    'description' => Str::limit($product->description ?? '', 50),
                    'url' => route('product.show', $product->id), // Or edit route
                    'icon' => 'fas fa-box'
                ];
            }
        } catch (\Exception $e) { /* Ignore if table/column missing */ }

        // 2. Search Clients
        try {
            $clients = Client::where('user_id', $user->id) // Assuming relationship
                ->where('name', 'LIKE', "%{$query}%")
                ->orWhere('email', 'LIKE', "%{$query}%")
                ->take(5)
                ->get();
            
            foreach ($clients as $client) {
                $results[] = [
                    'category' => 'Client',
                    'title' => $client->name,
                    'description' => $client->email,
                    'url' => '#', // route('clients.show', $client->id)
                    'icon' => 'fas fa-user'
                ];
            }
        } catch (\Exception $e) {}

        // 3. Search Orders
        try {
            $orders = Order::where('user_id', $user->id)
                ->where('order_number', 'LIKE', "%{$query}%")
                ->take(5)
                ->get();

            foreach ($orders as $order) {
                $results[] = [
                    'category' => 'Order',
                    'title' => 'Order #' . $order->order_number,
                    'description' => 'Status: ' . $order->status,
                    'url' => route('orders.show', $order->id),
                    'icon' => 'fas fa-shopping-bag'
                ];
            }
        } catch (\Exception $e) {}

        // 4. Search Devices (for Technicians/Managers)
        try {
             $devices = Device::where('user_id', $user->id)
                ->where('name', 'LIKE', "%{$query}%")
                ->orWhere('serial_number', 'LIKE', "%{$query}%")
                ->take(5)
                ->get();

            foreach ($devices as $device) {
                $results[] = [
                    'category' => 'Device',
                    'title' => $device->name,
                    'description' => 'SN: ' . $device->serial_number,
                    'url' => '#', 
                    'icon' => 'fas fa-mobile-alt'
                ];
            }
        } catch (\Exception $e) {}

        return response()->json(['results' => $results]);
    }
}
