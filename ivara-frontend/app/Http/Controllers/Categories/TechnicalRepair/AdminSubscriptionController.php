<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Subscription;

class AdminSubscriptionController extends Controller
{
    /**
     * Display a list of subscriptions with users and available plans.
     */
    public function index()
    {
        // Load all subscriptions with their related user
        $subscriptions = Subscription::with('user')->get();

        // Example list of plans (could also be dynamic from a plans table)
        $availablePlans = [
            ['name' => 'Basic', 'price' => 10000],
            ['name' => 'Standard', 'price' => 25000],
            ['name' => 'Premium', 'price' => 50000],
        ];

        return view('admin.subscriptions', compact('subscriptions', 'availablePlans'));
    }

    /**
     * Change subscription plan or toggle status.
     */
    public function change(Request $request, $id)
    {
        // Find the subscription by ID
        $subscription = Subscription::findOrFail($id);

        // Update plan and price if provided
        if ($request->has('plan') && $request->has('price')) {
            $subscription->plan = $request->plan;
            $subscription->price = $request->price;
        }

        // Toggle status if requested
        if ($request->has('toggle_status') && $request->toggle_status) {
            $subscription->status = $subscription->status === 'active' ? 'inactive' : 'active';
        }

        $subscription->save();

        return redirect()->back()->with('success', 'Subscription updated successfully!');
    }

    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'subscription_ids' => 'required|array',
            'action' => 'required|string|in:activate,deactivate,cancel'
        ]);

        $statusMap = [
            'activate' => 'active',
            'deactivate' => 'inactive',
            'cancel' => 'cancelled'
        ];

        Subscription::whereIn('id', $request->subscription_ids)
            ->update(['status' => $statusMap[$request->action]]);

        return redirect()->back()->with('success', 'Selected subscriptions updated successfully!');
    }
}
