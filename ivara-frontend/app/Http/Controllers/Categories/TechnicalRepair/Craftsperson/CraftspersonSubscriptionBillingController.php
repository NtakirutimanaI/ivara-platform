<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\PaymentMethod;
use App\Models\Invoice;
use App\Models\craftsperson;
use App\Models\Message;
use App\Models\Activity;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CraftspersonSubscriptionBillingController extends Controller
{
    // Show subscription page
    public function subscriptionBilling()
    {
        $userId = auth()->id();

        $subscriptions = Subscription::where('user_id', $userId)->get();
        $paymentMethods = PaymentMethod::where('craftsperson_id', $userId)->get();
        $invoices = Invoice::where('craftsperson_id', $userId)->orderBy('created_at', 'desc')->get();

        $availablePlans = [
            ['name' => 'Basic', 'price' => 10],
            ['name' => 'Standard', 'price' => 25],
            ['name' => 'Premium', 'price' => 50],
        ];

        return view('craftsperson.subscription_billing', compact('subscriptions', 'paymentMethods', 'invoices', 'availablePlans'));
    }

    // Show upgrade/downgrade plan page
    public function upgrade()
    {
        $plans = Subscription::all(); // fetch all available plans
        $currentPlan = auth()->user()->subscription; // current user's plan
        return view('craftsperson.upgrade', compact('plans', 'currentPlan'));
    }

    // Remove payment method
    public function removePayment($id)
    {
        $method = auth()->user()->paymentMethods()->findOrFail($id);
        $method->delete();

        return redirect()->route('subscription.billing')
                         ->with('success', 'Payment method removed.');
    }

    // Download invoice PDF
    public function downloadInvoice($id)
    {
        $invoice = Invoice::where('id', $id)
                    ->where('craftsperson_id', auth()->id())
                    ->firstOrFail();

        if (!$invoice->invoice_path || !Storage::exists($invoice->invoice_path)) {
            return redirect()->back()->with('error', 'Invoice file not found.');
        }

        return Storage::download($invoice->invoice_path, "invoice_{$invoice->id}.pdf");
    }

    public function change($id)
    {
        $subscription = Subscription::findOrFail($id);

        $subscription->status = $subscription->status === 'active' ? 'inactive' : 'active';
        $subscription->save();

        return redirect()->route('subscription.upgrade')
                         ->with('success', 'Subscription updated successfully.');
    }

    public function changeSubscription(Request $request, $id)
    {
        $subscription = Subscription::where('id', $id)
                        ->where('user_id', auth()->id())
                        ->firstOrFail();

        $subscription->plan = $request->plan;
        $subscription->price = $request->price;
        $subscription->save();

        return redirect()->back()->with('success', 'Subscription updated successfully!');
    }

    // --------------------- ADD PAYMENT METHODS ---------------------

    // Add Payment Method
    public function addPaymentMethod(Request $request)
    {
        // Validate the request
        $request->validate([
            'method' => 'required|string',
            'payment_amount' => 'required|numeric|min:1',
            'mtn_phone' => 'sometimes|required_if:method,mtn_momo',
            'airtel_phone' => 'sometimes|required_if:method,airtel_money',
            'card_bank' => 'sometimes|required_if:method,card',
            'bank_account' => 'sometimes|required_if:method,card',
            'last_four' => 'sometimes|required_if:method,card|max:4',
        ]);

        // Create payment record
        $payment = new PaymentMethod();
        $payment->craftsperson_id = auth()->user()->id; // Assuming craftspersons are logged in
        $payment->method = $request->method;
        $payment->amount = $request->payment_amount;

        // Optional fields
        $payment->mtn_phone = $request->mtn_phone ?? null;
        $payment->airtel_phone = $request->airtel_phone ?? null;
        $payment->card_bank = $request->card_bank ?? null;
        $payment->bank_account = $request->bank_account ?? null;
        $payment->last_four = $request->last_four ?? null;

        $payment->save();

        return redirect()->route('craftsperson.subscription_billing')->with('success', 'Payment added successfully.');
    }

    // Show the add payment method form
    public function showAddPaymentForm()
    {
        $availableMethods = [
            'cash' => 'Cash',
            'mtn_momo' => 'MTN MoMo',
            'airtel_money' => 'Airtel Money',
            'card' => 'Card / Bank',
            'bank' => 'Bank Transfer',
        ];

        return view('craftsperson.payment_add', compact('availableMethods'));
    }

    // --------------------- EXISTING METHODS CONTINUE ---------------------

    // Remove Payment Method
    public function removePaymentMethod($id)
    {
        $payment = PaymentMethod::where('id', $id)
                    ->where('craftsperson_id', auth()->id())
                    ->firstOrFail();

        $payment->delete();

        return redirect()->back()->with('success', 'Payment method removed successfully!');
    }

    // Process subscription payment
    public function paySubscription(Request $request, $subscriptionId)
    {
        $subscription = Subscription::where('id', $subscriptionId)
                        ->where('user_id', auth()->id())
                        ->firstOrFail();

        $request->validate([
            'payment_method' => 'required|in:mtn_momo,airtel_money',
        ]);

        $amount = $subscription->price;

        switch($request->payment_method) {
            case 'mtn_momo':
                $paymentUrl = $this->payWithMtnMoMo($subscription, $amount);
                break;

            case 'airtel_money':
                $paymentUrl = $this->payWithAirtelMoney($subscription, $amount);
                break;
        }

        return redirect()->to($paymentUrl);
    }

    private function payWithMtnMoMo($subscription, $amount)
    {
        $apiUrl = 'https://sandbox.momodeveloper.mtn.com/collection/v1_0/requesttopay';
        $apiKey = env('MTN_MOMO_API_KEY');
        $subscriptionId = $subscription->id;

        $response = Http::withHeaders([
            'Ocp-Apim-Subscription-Key' => $apiKey,
            'X-Reference-Id' => $subscriptionId,
            'X-Target-Environment' => 'sandbox',
            'Content-Type' => 'application/json'
        ])->post($apiUrl, [
            'amount' => $amount,
            'currency' => 'RWF',
            'payer' => [
                'partyIdType' => 'MSISDN',
                'partyId' => auth()->user()->phone
            ],
            'externalId' => "sub_$subscriptionId",
            'payerMessage' => 'Subscription Payment',
            'payeeNote' => 'Subscription Payment'
        ]);

        return route('craftsperson.subscription_billing')->with('success', 'MTN MoMo payment initiated. Check your phone to confirm.');
    }

    private function payWithAirtelMoney($subscription, $amount)
    {
        $apiUrl = 'https://sandbox.airtel.com/africa/momo/1.0.0/transactions';
        $apiKey = env('AIRTEL_API_KEY');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json'
        ])->post($apiUrl, [
            'amount' => $amount,
            'currency' => 'RWF',
            'recipient' => auth()->user()->phone,
            'reference' => "sub_{$subscription->id}",
            'reason' => 'Subscription Payment'
        ]);

        return route('craftsperson.subscription_billing')->with('success', 'Airtel Money payment initiated. Check your phone to confirm.');
    }

   public function storePayment(Request $request)
{
    $method = $request->input('method');

    // Base validation
    $rules = [
        'method' => 'required|in:cash,mtn_momo,airtel_money,card,bank',
        'payment_amount' => 'required|numeric|min:100', // Now required for all
    ];

    // Method-specific validation
    switch ($method) {
        case 'mtn_momo':
            $rules['mtn_phone'] = 'required|string|regex:/^07[0-9]{8}$/';
            break;

        case 'airtel_money':
            $rules['airtel_phone'] = 'required|string|regex:/^07[0-9]{8}$/';
            break;

        case 'card':
            $rules['card_bank'] = 'required|string|max:100';
            $rules['last_four'] = 'required|digits:4';
            break;

        case 'bank':
            $rules['bank_name'] = 'required|string|max:100';
            $rules['account_number'] = 'required|string|max:50';
            $rules['account_holder'] = 'required|string|max:100';
            break;
    }

    $validated = $request->validate($rules);

    // Save payment into DB
    $payment = \App\Models\Payment::create([
        'invoice_id' => null,
        'craftsperson_id' => auth()->id(),
        'plan' => 1, // default plan, adjust if needed
        'method' => $method,
        'transaction_id' => 'TXN-' . strtoupper(\Illuminate\Support\Str::random(10)),
        'payment_amount' => $request->payment_amount,
        'invoice_path' => '',
        'status' => 'pending', // pending by default
        'paid_at' => null,
        'meta' => json_encode($request->except('_token','payment_amount')),
    ]);

    return back()->with('success', ucfirst($method) . ' payment processed and saved successfully!');
}


}
