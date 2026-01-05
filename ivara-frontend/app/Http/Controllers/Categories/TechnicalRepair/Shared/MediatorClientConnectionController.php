<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductService;
use App\Models\Mediator;
use App\Models\Client;
use App\Models\MediatorCommission;
use App\Models\ProductLike; 
use App\Models\Cart;        
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MediatorClientConnectionController extends Controller
{
    // ===== CLIENT: View & Manage Own Products/Services =====
    public function clientProducts($client_id)
    {
        $products_services = DB::table('products_services')
            ->where('client_id', $client_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('client.products_services.index', compact('products_services'));
    }

    // ===== MEDIATOR: View All Clients Products/Services =====
    public function mediatorViewClients()
{
    // Fetch all active products/services with their client info using Eloquent
    $products_services = ProductService::withCount('likes')
    ->where('status', 'Active')
    ->orderBy('created_at', 'desc')
    ->get();


    return view('mediator.clients.products_services', compact('products_services'));
}



    // ===== CLIENT: Create/Update Product =====
    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:product,service',
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:Active,Inactive',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->filled('product_id')) {
            $product = ProductService::find($request->product_id);
            if (!$product) {
                return redirect()->back()->with('error', 'Product not found.');
            }
        } else {
            $product = new ProductService();
            $product->client_id = Auth::id();
        }

        $product->type = $validated['type'];
        $product->title = $validated['title'];
        $product->price = $validated['price'];
        $product->status = $validated['status'];
        $product->description = $validated['description'] ?? null;

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products_images', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        $message = $request->filled('product_id') ? 'Product updated successfully!' : 'Product created successfully!';

        return redirect()->back()->with('success', $message);
    }

    // ===== Toggle Product Status =====
    public function toggleProductStatus($id)
    {
        $product = ProductService::findOrFail($id);
        $product->status = $product->status === 'Active' ? 'Inactive' : 'Active';
        $product->save();

        return redirect()->back()->with('success', 'Product status updated successfully.');
    }

    // ===== MEDIATOR: Join Client Product/Service and store commission =====
    public function joinProduct(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products_services,id',
        ]);

        $product = ProductService::findOrFail($request->product_id);

        // Store commission record
        MediatorCommission::create([
            'mediator_id' => Auth::id(),
            'client_id' => $product->client_id,
            'activity_type' => 'Product',
            'amount' => $product->price,
            'commission_amount' => $product->price * 0.1, // Example: 10%
            'paid_at' => now(),
        ]);

        return redirect()->back()->with('success', 'You joined the product successfully!');
    }

    // ===== Toggle Like / Dislike =====
    public function toggleLike($product_id)
    {
        $product = ProductService::findOrFail($product_id);

        $like = ProductLike::where('product_id', $product->id)
                            ->where('user_id', Auth::id())
                            ->first();

        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            ProductLike::create([
                'product_id' => $product->id,
                'user_id' => Auth::id()
            ]);
            $liked = true;
        }

        $likes_count = $product->likes()->count();

        return response()->json([
            'liked' => $liked,
            'likes_count' => $likes_count
        ]);
    }

    // ===== Add Product to Cart =====
    public function addToCart($product_id)
    {
        $product = ProductService::findOrFail($product_id);

        // Example using a Cart model
        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'quantity' => 1
        ]);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    // ===== Connect to Client =====
    public function connectClient($client_id)
    {
        $client = Client::findOrFail($client_id);

        // Redirect to chat or contact form
        return redirect()->route('mediator.chat', ['client_id' => $client->id]);
    }

    // ===== DEMO: Mediator & Client Commissions =====
    public function demoCommissions()
    {
        $mediator = Mediator::find(1);
        foreach ($mediator->commissions as $commission) {
            echo $commission->activity_type . ' - ' . $commission->commission_amount . "<br>";
        }

        $client = Client::find(5);
        foreach ($client->commissions as $commission) {
            echo $commission->amount . ' from mediator ' . $commission->mediator->name . "<br>";
        }

        MediatorCommission::create([
            'mediator_id' => 1,
            'client_id' => 5,
            'activity_type' => 'Product',
            'amount' => 1000,
            'commission_amount' => 100,
            'paid_at' => now(),
        ]);
    }

    public function chat($client_id)
    {
        $client = User::findOrFail($client_id); 
        return view('mediator.chat', compact('client'));
    }


     public function destroyProduct($id)
    {
        $product = ProductService::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully.');
    }
}
