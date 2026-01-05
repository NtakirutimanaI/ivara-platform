<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Product; // Admin products
use App\Models\ProductService; // Client products
use App\Models\TechnicianProduct; // Technician products
use App\Models\MechanicProduct; // Mechanician products
use App\Models\CraftspersonProduct; // Crafts products
use App\Models\BusinesspersonProduct; // Business person products
use Illuminate\Support\Facades\Auth;

class ClientProductsController extends Controller
{
    /**
     * Display all products for clients with all categories
     */
    public function clientProducts()
    {
        // Company products (admin)
        $products = Product::where('status', 'Published')->get();

        // Client products
        $clientProducts = ProductService::where('type', 'product')
            ->where('status', 'Active')
            ->get();

        // Technician products
        $technicianProducts = TechnicianProduct::where('is_published', 1)->get();

        // Mechanician products
        $mechanicianProducts = MechanicProduct::where('is_published', 1)->get();

        // Craftsperson products
        $craftspersonProducts = CraftspersonProduct::where('status', 'Available')->get();

        // Business person products
        $businessPersonProducts = BusinesspersonProduct::where('status', 'Available')->get();

        return view('client.products_payments', compact(
            'products',
            'clientProducts',
            'technicianProducts',
            'mechanicianProducts',
            'craftspersonProducts',
            'businessPersonProducts'
        ));
    }

    /**
     * Show checkout page with cart items
     */
    public function checkout()
    {
        $cartItems = session()->get('cart', []);
        return view('client.checkout', compact('cartItems'));
    }

    /**
     * Confirm payment and clear cart
     */
    public function confirmPayment(Request $request)
    {
        $cartItems = session()->get('cart', []);

        if (empty($cartItems)) {
            return redirect()->route('client.checkout')->with('error', 'Your cart is empty!');
        }

        // Clear cart
        session()->forget('cart');

        return redirect()->route('client.checkout')->with('success', 'Payment confirmed! Thank you for your order.');
    }

    /**
     * Add Admin product to cart
     */
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $this->addItemToSession('admin', $product, $request->quantity);
        return redirect()->route('client.products_payments')->with('success', 'Product added to cart!');
    }

    /**
     * Add Client product to cart
     */
    public function addClientProductToCart(Request $request, $id)
    {
        $product = ProductService::findOrFail($id);
        $this->addItemToSession('client', $product, $request->quantity, 'title');
        return redirect()->route('client.products_payments')->with('success', 'Client product added to cart!');
    }

    /**
     * Add Technician product to cart
     */
    public function addTechnicianToCart(Request $request, $id)
    {
        $product = TechnicianProduct::findOrFail($id);
        $this->addItemToSession('technician', $product, $request->quantity);
        return redirect()->route('client.products_payments')->with('success', 'Technician product added to cart!');
    }

    /**
     * Add Mechanician product to cart
     */
    public function addMechanicianToCart(Request $request, $id)
    {
        $product = MechanicProduct::findOrFail($id);
        $this->addItemToSession('mechanician', $product, $request->quantity);
        return redirect()->route('client.products_payments')->with('success', 'Mechanician product added to cart!');
    }

    /**
     * Add Craftsperson product to cart
     */
    public function addCraftspersonToCart(Request $request, $id)
    {
        $product = CraftspersonProduct::findOrFail($id);
        $this->addItemToSession('craftsperson', $product, $request->quantity);
        return redirect()->route('client.products_payments')->with('success', 'Craftsperson product added to cart!');
    }

    /**
     * Add Business person product to cart
     */
    public function addBusinessToCart(Request $request, $id)
    {
        $product = BusinesspersonProduct::findOrFail($id);
        $this->addItemToSession('business', $product, $request->quantity);
        return redirect()->route('client.products_payments')->with('success', 'Business product added to cart!');
    }

    /**
     * Helper function to store items in session cart
     */
    private function addItemToSession($prefix, $product, $quantity = 1, $titleField = 'name')
    {
        $quantity = $quantity ?? 1;
        $cart = session()->get('cart', []);

        $key = $prefix . '_' . $product->id;

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $quantity;
        } else {
            $cart[$key] = [
                'name' => $product->$titleField,
                'price' => $product->price,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);
    }
}
