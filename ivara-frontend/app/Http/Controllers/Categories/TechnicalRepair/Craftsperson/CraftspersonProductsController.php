<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\CraftspersonProduct;
use Illuminate\Support\Facades\Storage;

class CraftspersonProductsController extends Controller
{
    public function index()
    {
        $products = CraftspersonProduct::where('craftsperson_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('craftsperson.products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'status' => 'required|in:Available,Out of Stock,Discontinued',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name','category','price','quantity','unit','status']);
        $data['craftsperson_id'] = auth()->id();
        $data['total_value'] = $data['price'] * $data['quantity'];

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;
        }

        CraftspersonProduct::create($data);

        return redirect()->back()->with('success', 'Product added successfully!');
    }

    public function update(Request $request, CraftspersonProduct $product)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'category' => 'nullable|string|max:255',
        'price' => 'required|numeric|min:0',
        'quantity' => 'required|integer|min:0',
        'unit' => 'required|string|max:50',
        'status' => 'required|in:Available,Out of Stock,Discontinued',
        'image' => 'nullable|image|max:2048',
    ]);

    $data = $request->only(['name','category','price','quantity','unit','status']);
    $data['total_value'] = $data['price'] * $data['quantity'];

    if ($request->hasFile('image')) {
        if ($product->image) Storage::disk('public')->delete($product->image);
        $data['image'] = $request->file('image')->store('products', 'public');
    }

    $product->update($data);

    return redirect()->back()->with('success', 'Product updated successfully!');
}

public function destroy(CraftspersonProduct $product)
{
    if ($product->image) Storage::disk('public')->delete($product->image);
    $product->delete();

    return redirect()->back()->with('success', 'Product deleted successfully!');
}

public function toggleStatus(CraftspersonProduct $product)
{
    $product->status = $product->status == 'Available' ? 'Discontinued' : 'Available';
    $product->save();

    return redirect()->back()->with('success', 'Product status updated!');
}

}
