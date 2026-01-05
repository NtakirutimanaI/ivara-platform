<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Payment;

class MechanicPaymentsInvoicesController extends Controller
{
    // Apply auth middleware to ensure user is logged in
 

    // Show Create Invoice / Payments page
    public function index()
    {
        return view('mechanic.payments_invoices');
    }

    // Save a new service (from Create Invoice modal)
    public function storeService(Request $request)
    {
        $userId = auth()->id();

        if (!$userId) {
            return redirect()->back()->with('error', 'You must be logged in to create a service.');
        }

        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'description'   => 'nullable|string',
            'price'         => 'required|numeric',
            'duration'      => 'nullable|string|max:100',
            'available_time'=> 'nullable|string|max:100',
            'category'      => 'nullable|string|max:100',
        ]);

        // Create the service for the logged-in mechanic
        Service::create(array_merge($validated, [
            'client_id'     => $userId,
            'technician_id' => $userId,
            'is_active'     => 1,
        ]));

        return redirect()
            ->route('mechanic.payments_invoices')
            ->with('success', 'Service saved successfully! Now proceed to payment.');
    }

    // Save payment for the service
    public function makePayment(Request $request)
    {
        $userId = auth()->id();

        if (!$userId) {
            return redirect()->back()->with('error', 'You must be logged in to make a payment.');
        }

        $validated = $request->validate([
            'payment_amount' => 'required|numeric',
            'method'         => 'required|string',
        ]);

        Payment::create([
            'invoice_id'     => rand(1000, 9999),
            'client_id'      => $userId,
            'plan'           => 1, // adjust if needed
            'method'         => $validated['method'],
            'transaction_id' => uniqid(),
            'payment_amount' => $validated['payment_amount'],
            'status'         => 'pending',
            'paid_at'        => now(),
        ]);

        return redirect()
            ->route('mechanic.payments_invoices')
            ->with('success', 'Payment completed successfully!');
    }
}
