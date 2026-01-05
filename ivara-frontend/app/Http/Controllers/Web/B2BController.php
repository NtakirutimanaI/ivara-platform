<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class B2BController extends Controller
{
    /**
     * Handle B2B registration interest form submission
     */
    public function registerInterest(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'business_type' => 'required|in:manufacturer,distributor,wholesaler,retailer',
            'contact_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20'
        ]);

        try {
            // For now, log the registration interest locally
            // TODO: Send to backend API when endpoint is ready
            
            $data = [
                'company_name' => $request->company_name,
                'business_type' => $request->business_type,
                'contact_name' => $request->contact_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'submitted_at' => now()->toDateTimeString()
            ];
            
            // Log to Laravel log file
            \Log::info('B2B Registration Interest Received:', $data);
            
            // Save to a simple JSON file for now
            $filePath = storage_path('app/b2b_registrations.json');
            $registrations = [];
            
            if (file_exists($filePath)) {
                $registrations = json_decode(file_get_contents($filePath), true) ?? [];
            }
            
            $registrations[] = $data;
            file_put_contents($filePath, json_encode($registrations, JSON_PRETTY_PRINT));

            return redirect()->route('b2b.index')
                ->with('success', 'Thank you! We\'ve received your registration interest. Our team will contact you within 24 hours.');

        } catch (\Exception $e) {
            \Log::error('B2B Registration Interest Error:', ['error' => $e->getMessage()]);
            
            return redirect()->route('b2b.index')
                ->with('error', 'Unable to process your request. Please try again later or contact support.');
        }
    }
}
