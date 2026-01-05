<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\TailorProduct;

class TailorProductsController extends Controller
{
    public function myProducts()
    {
        $products = TailorProduct::where('tailor_id', auth()->id())->get();
        return view('tailor.my_products', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
            'status' => 'required|in:Available,Out of Stock,Unavailable',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        TailorProduct::create([
            'tailor_id' => auth()->id(),
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'status' => $request->status,
            'image' => $imagePath,
        ]);

        return redirect()->route('tailor.my_products')->with('success', 'Product added successfully.');
    }

    public function update(Request $request, $id)
    {
        $product = TailorProduct::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
            'status' => 'required|in:Available,Out of Stock,Unavailable',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'status' => $request->status,
        ]);

        return redirect()->route('tailor.my_products')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = TailorProduct::findOrFail($id);
        $product->delete();
        return redirect()->route('tailor.my_products')->with('success', 'Product deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $product = TailorProduct::findOrFail($id);
        $product->status = ($product->status == 'Available') ? 'Unavailable' : 'Available';
        $product->save();
        return redirect()->route('tailor.my_products')->with('success', 'Product status updated.');
    }
}
