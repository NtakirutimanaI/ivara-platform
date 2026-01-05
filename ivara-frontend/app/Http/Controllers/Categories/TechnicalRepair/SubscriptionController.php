<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\Payment;
use App\Models\Profile;
use Illuminate\Support\Facades\Session;

class SubscriptionController extends Controller
{
    /**
     * Show the subscription page for the client.
     */
    public function index()
    {
        return view('client.subscription'); // resources/views/client/subscription.blade.php
    }

    /**
     * Upgrade subscription via AJAX or standard request.
     */
    public function upgradePlan(Request $request)
    {
        // Validate input
        $request->validate([
            'plan'           => 'required|string|in:basic,pro,enterprise',
            'payment_method' => 'required|string|in:card,paypal',
        ]);

        $user = auth()->user();

        // Define plan pricing
        $plans = [
            'basic'      => 10,
            'pro'        => 25,
            'enterprise' => 50,
        ];
        $amount = $plans[$request->plan];

        // Update or create subscription record
        Subscription::updateOrCreate(
            ['user_id' => $user->id],
            [
                'plan'       => $request->plan,
                'price'      => $amount,
                'start_date' => now(),
                'end_date'   => now()->addMonth(),
                'status'     => 'active',
            ]
        );

        // Log payment
        Payment::create([
            'client_id'      => $user->id,
            'plan'           => $request->plan,
            'payment_method' => $request->payment_method,
            'amount'         => $amount,
            'transaction_id' => 'TXN' . strtoupper(uniqid()),
            'status'         => 'success',
            'paid_at'        => now(),
        ]);

        // Update profile subscription info
        Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'subscription_plan' => $request->plan,
                'next_billing_date' => now()->addMonth(),
            ]
        );

        // Return response (AJAX or redirect)
        if ($request->ajax()) {
            return response()->json([
                'message'  => 'Subscription upgraded successfully!',
                'new_plan' => ucfirst($request->plan),
            ]);
        }

        return redirect()->route('client.subscription')
            ->with('success', 'Subscription upgraded successfully.');
    }
    public function subscribe(Request $request)
    {
        // Validate email
        $request->validate([
            'email' => 'required|email',
        ]);

        try {
            // Call backend API to save newsletter subscription
            $response = \Illuminate\Support\Facades\Http::post('http://localhost:5001/api/newsletter/subscribe', [
                'email' => $request->email,
            ]);

            if ($response->successful()) {
                // Set success message
                Session::flash('success', 'Thank you for subscribing to our newsletter!');
            } else {
                $errorMessage = $response->json()['message'] ?? 'Subscription failed. Please try again.';
                Session::flash('error', $errorMessage);
            }
        } catch (\Exception $e) {
            Session::flash('error', 'Unable to process subscription. Please try again later.');
        }

        return redirect()->back();
    }
}
