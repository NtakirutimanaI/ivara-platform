<?php

namespace App\Modules\CreativeLifestyle\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\CreativeLifestyle\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::latest()->paginate(10);
        return view('admin.categories.creative-lifestyle.payments', compact('payments'));
    }

    public function create()
    {
        return view('admin.categories.creative-lifestyle.payments_create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|string|in:active,inactive',
        ]);

        Payment::create($validated);

        return redirect()->route('admin.creative-lifestyle.payments')
            ->with('success', 'Payment created successfully.');
    }

    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        return view('admin.categories.creative-lifestyle.payments_edit', compact('payment'));
    }

    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|string|in:active,inactive',
        ]);

        $payment->update($validated);

        return redirect()->route('admin.creative-lifestyle.payments')
            ->with('success', 'Payment updated successfully.');
    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return redirect()->route('admin.creative-lifestyle.payments')
            ->with('success', 'Payment deleted successfully.');
    }
}
