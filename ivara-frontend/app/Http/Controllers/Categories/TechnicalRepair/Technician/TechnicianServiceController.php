<?php
namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductService; // Make sure this model exists

class TechnicianServiceController extends Controller
{
    public function index()
    {
        $items = ProductService::all(); // Load all products and services
        return view('technician.services.index', compact('items'));
    }

    public function pay(Request $request, $id)
    {
        $item = ProductService::findOrFail($id);

        $request->validate([
            'payment_method' => 'required|string',
        ]);

        // Simulate payment
        $item->status = 'Active';
        $item->save();

        return redirect()->back()->with('success', "Payment for {$item->title} completed using {$request->payment_method}!");
    }
}
