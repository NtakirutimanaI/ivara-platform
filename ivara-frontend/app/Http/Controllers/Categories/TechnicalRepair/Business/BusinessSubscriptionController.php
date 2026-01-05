<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class BusinessSubscriptionController extends Controller
{
    /**
     * Display the subscription & billing page.
     */
    public function index()
    {
        // Fetch subscription/billing data for the logged-in business user
        // Example: $subscriptions = auth()->user()->subscriptions;
        // For now, we will use dummy data
        $subscriptions = [
            [
                'id' => 1,
                'plan' => 'Basic',
                'status' => 'active',
                'start_date' => '2025-01-01',
                'end_date' => '2025-12-31',
                'price' => 49.99
            ],
            [
                'id' => 2,
                'plan' => 'Premium',
                'status' => 'inactive',
                'start_date' => '2024-01-01',
                'end_date' => '2024-12-31',
                'price' => 99.99
            ]
        ];

        // Dummy invoices
        $invoices = [
            [
                'id' => 101,
                'paid_at' => '2025-02-01',
                'payment_amount' => 49.99,
                'status' => 'success'
            ],
            [
                'id' => 102,
                'paid_at' => null,
                'payment_amount' => 99.99,
                'status' => 'pending'
            ]
        ];

        // Available plans
        $availablePlans = [
            ['name' => 'Basic', 'price' => 49.99],
            ['name' => 'Standard', 'price' => 79.99],
            ['name' => 'Premium', 'price' => 99.99],
        ];

        return view('business.subscription_billing', compact('subscriptions', 'invoices', 'availablePlans'));
    }
}
