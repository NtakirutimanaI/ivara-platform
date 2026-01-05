<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Events\ActivityCreated;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 'Published')->get();
        return view('web.products', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    public function create()
    {
        $products = Product::all(); // all products for admin table
        return view('admin.create_products', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Store product image
        $imagePath = $request->file('image')->store('products', 'public');

        // Create the product
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        // Log activity
        $activity = Activity::create([
            'message' => 'New product added: ' . $product->name,
            'icon' => 'fas fa-box',
        ]);

        // Broadcast activity
        broadcast(new ActivityCreated($activity))->toOthers();

        return redirect()->route('products.create')->with('success', 'Product created successfully!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $products = Product::all(); // also send all products for the table
        return view('admin.create_products', compact('product', 'products'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();

        return redirect()->route('products.create')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.create')->with('success', 'Product deleted successfully!');
    }

    public function publish($id)
    {
        $product = Product::findOrFail($id);
        $product->status = 'Published';
        $product->save();

        return redirect()->route('products.create')->with('success', 'Product published successfully!');
    }

    public function unpublish($id)
    {
        $product = Product::findOrFail($id);
        $product->status = 'Draft';
        $product->save();

        return redirect()->route('products.create')->with('success', 'Product unpublished successfully!');
    }
}
