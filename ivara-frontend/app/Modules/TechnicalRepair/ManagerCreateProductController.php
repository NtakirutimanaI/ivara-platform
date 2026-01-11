<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Events\ActivityCreated;

class ManagerCreateProductController extends Controller
{
    /**
     * Display all products for the manager dashboard.
     */
    public function index()
    {
        $products = Product::all();
        return view('manager.create_products.index', compact('products'));
    }

    /**
     * Store a new product.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
            'status' => 'Draft',
        ]);

        // Log manager activity
        $activity = Activity::create([
            'message' => 'Manager added new product: ' . $product->name,
            'icon' => 'fas fa-box',
        ]);

        broadcast(new ActivityCreated($activity))->toOthers();

        return redirect()->route('manager.create_products.index')
                         ->with('success', 'Product created successfully!');
    }

    /**
     * Show specific product details as JSON.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    /**
     * Update a product.
     */
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
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        // Log activity
        $activity = Activity::create([
            'message' => 'Manager updated product: ' . $product->name,
            'icon' => 'fas fa-edit',
        ]);
        broadcast(new ActivityCreated($activity))->toOthers();

        return redirect()->route('manager.create_products.index')
                         ->with('success', 'Product updated successfully!');
    }

    /**
     * Delete a product.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        // Log deletion
        $activity = Activity::create([
            'message' => 'Manager deleted product: ' . $product->name,
            'icon' => 'fas fa-trash',
        ]);
        broadcast(new ActivityCreated($activity))->toOthers();

        return redirect()->route('manager.create_products.index')
                         ->with('success', 'Product deleted successfully!');
    }

    /**
     * Publish product.
     */
    public function publish($id)
    {
        $product = Product::findOrFail($id);
        $product->status = 'Published';
        $product->save();

        $activity = Activity::create([
            'message' => 'Manager published product: ' . $product->name,
            'icon' => 'fas fa-check',
        ]);
        broadcast(new ActivityCreated($activity))->toOthers();

        return redirect()->route('manager.create_products.index')
                         ->with('success', 'Product published successfully!');
    }

    /**
     * Unpublish product.
     */
    public function unpublish($id)
    {
        $product = Product::findOrFail($id);
        $product->status = 'Draft';
        $product->save();

        $activity = Activity::create([
            'message' => 'Manager unpublished product: ' . $product->name,
            'icon' => 'fas fa-ban',
        ]);
        broadcast(new ActivityCreated($activity))->toOthers();

        return redirect()->route('manager.create_products.index')
                         ->with('success', 'Product unpublished successfully!');
    }
}
