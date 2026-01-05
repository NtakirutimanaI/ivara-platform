<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Show the contact form page (frontend).
     */
    public function index()
    {
        return view('web.contact'); 
    }

    /**
     * Handle contact form submission.
     */
    public function send(Request $request)
    {
        // 1. Validate on Laravel side for quick feedback
        $validated = $request->validate([
            'name'         => 'required|string|min:3|max:255',
            'email'        => 'required|email|max:255',
            'country_code' => 'nullable|string|max:10',
            'phone'        => 'nullable|string|max:20',
            'subject'      => 'required|string|min:3|max:255',
            'message'      => 'required|string|min:10',
        ]);

        try {
            // 2. Prepare data for API
            $baseUrl = env('BACKEND_API_URL', 'http://localhost:5001');
            $baseUrl = rtrim($baseUrl, '/');
            if (str_ends_with($baseUrl, '/api')) {
                $baseUrl = substr($baseUrl, 0, -4);
            }
            $apiUrl = $baseUrl . '/api/contact';
            Log::info("Sending contact to API: " . $apiUrl, ['data' => $validated]);

            // 3. Send to Microservice
            $response = Http::post($apiUrl, [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'subject' => $validated['subject'],
                'message' => $validated['message'],
                'phone' => $request->input('phone'),
                'country_code' => $request->input('country_code'),
            ]);

            if ($response->successful()) {
                Log::info('Contact API Success');
                return redirect()->back()->with('success', 'Your message has been sent successfully!');
            } else {
                Log::error('Contact API Error', [
                    'url' => $apiUrl,
                    'status' => $response->status(), 
                    'body' => $response->body()
                ]);
                return redirect()->back()->with('error', 'Unable to send message at this time. Please try again. Status: ' . $response->status());
            }

        } catch (\Exception $e) {
            Log::error('Contact Submission Exception', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'System error. Please try again later.');
        }
    }
}
