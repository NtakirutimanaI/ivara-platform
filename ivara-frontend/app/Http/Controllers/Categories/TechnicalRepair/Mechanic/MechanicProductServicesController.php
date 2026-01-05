<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\MechanicProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MechanicProductServicesController extends Controller
{
    // Show all products/services for the logged-in mechanic
    public function index()
    {
        $products = MechanicProduct::where('mechanic_id', Auth::id())->get();
        return view('mechanic.products_services', compact('products'));
    }

    // Store a new product/service
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'category'    => 'nullable|string|max:255',
            'type'        => 'required|in:product,service',
            'image'       => 'nullable|image|max:2048',
        ]);

        $data['mechanic_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('mechanic_products', 'public');
        }

        $data['is_published'] = true;

        MechanicProduct::create($data);

        return redirect()->route('mechanic.products_services')->with('success', 'Product created successfully!');
    }

    // Show product as JSON (used for AJAX or API)
    public function show($id)
    {
        $product = MechanicProduct::findOrFail($id);
        return response()->json($product);
    }

    // Update a product/service
    public function update(Request $request, $id)
    {
        $product = MechanicProduct::findOrFail($id);

        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'category'    => 'nullable|string|max:255',
            'type'        => 'required|in:product,service',
            'image'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('mechanic_products', 'public');
        }

        $product->update($data);

        return redirect()->route('mechanic.products_services')->with('success', 'Product updated successfully!');
    }

    // Delete a product/service
    public function destroy($id)
    {
        $product = MechanicProduct::findOrFail($id);

        // Delete image if exists
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('mechanic.products_services')->with('success', 'Product deleted successfully!');
    }

    public function publish($id)
{
    // Find the product by ID
    $product = MechanicProduct::findOrFail($id);

    // Toggle the published status
    $product->is_published = !$product->is_published;
    $product->save();

    // Redirect back with success message
    return redirect()->route('mechanic.products_services')
        ->with('success', $product->is_published ? 'Product published!' : 'Product unpublished!');
}


    // Toggle publish/unpublish
    public function togglePublish($id)
    {
        $product = MechanicProduct::findOrFail($id);
        $product->is_published = !$product->is_published;
        $product->save();

        $message = $product->is_published ? 'Product published successfully!' : 'Product unpublished successfully!';

        return redirect()->route('mechanic.products_services')->with('success', $message);
    }
}
