<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\BusinesspersonProduct;

class BusinessProductController extends Controller
{
    /**
     * Show all products.
     */
    public function myProducts()
    {
        $products = BusinesspersonProduct::all();
        return view('business.my_products', compact('products'));
    }

    /**
     * Store a new product.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'price'    => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'unit'     => 'required|string|max:50',
            'status'   => 'required|in:Available,Out of Stock,Unavailable',
            'image'    => 'nullable|image|max:2048',
        ]);

        // Upload image if provided
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        // Auto compute total_value
        $validated['total_value'] = $validated['price'] * $validated['quantity'];

        BusinesspersonProduct::create($validated);

        return redirect()->route('business.products')->with('success', 'Product created successfully!');
    }

    /**
     * Update a product.
     */
    public function update(Request $request, $id)
    {
        $product = BusinesspersonProduct::findOrFail($id);

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'price'    => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'unit'     => 'required|string|max:50',
            'status'   => 'required|in:Available,Out of Stock,Unavailable',
            'image'    => 'nullable|image|max:2048',
        ]);

        // Image upload if new file provided
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        // Update total value
        $validated['total_value'] = $validated['price'] * $validated['quantity'];

        $product->update($validated);

        return redirect()->route('business.products')->with('success', 'Product updated successfully!');
    }

    /**
     * Delete a product.
     */
    public function destroy($id)
    {
        $product = BusinesspersonProduct::findOrFail($id);
        $product->delete();

        return redirect()->route('business.products')->with('success', 'Product deleted successfully!');
    }

    /**
     * Toggle Publish/Unpublish product.
     */
    public function toggleStatus($id)
    {
        $product = BusinesspersonProduct::findOrFail($id);

        if ($product->status === 'Available') {
            $product->status = 'Unavailable';
        } else {
            $product->status = 'Available';
        }

        $product->save();

        return redirect()->route('business.products')->with('success', 'Product status updated!');
    }
}
