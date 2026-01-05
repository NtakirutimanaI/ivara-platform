<?php

namespace App\Http\Controllers\Categories\TechnicalRepair\Technician;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TechnicianProduct;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class TechnicianProductController extends Controller
{
    /**
     * Display all products
     */
    public function index()
    {
        $products = TechnicianProduct::with('technician')->get();

        // Only fetch users who are technicians (optional if you have a role column)
        $technicians = User::all(); // or: User::where('role', 'technician')->get();

        return view('technician.products.index', compact('products', 'technicians'));
    }

    /**
     * Store new product
     */
    public function store(Request $request)
    {
        $request->validate([
            'technician_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
            'brand' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name', 'description', 'price', 'stock', 'brand', 'category', 'technician_id']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        TechnicianProduct::create($data);

        return redirect()->back()->with('success', 'Product created successfully!');
    }

    /**
     * Update product
     */
    public function update(Request $request, TechnicianProduct $product)
    {
        $request->validate([
            'technician_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
            'brand' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name', 'description', 'price', 'stock', 'brand', 'category', 'technician_id']);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->back()->with('success', 'Product updated successfully!');
    }

    /**
     * Delete product
     */
    public function destroy(TechnicianProduct $product)
    {
        // Delete image from storage
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully!');
    }

    /**
     * Toggle product publish status
     */
    public function togglePublish(TechnicianProduct $product)
    {
        $product->is_published = !$product->is_published;
        $product->save();

        return redirect()->back()->with('success', 'Product publish status updated!');
    }
}
