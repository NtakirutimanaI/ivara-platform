<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BusinessPrivacyPolicyController extends Controller
{
    /**
     * Display the Privacy & Security page for business users.
     */
    public function index()
    {
        return view('business.privacy_security');
    }

    /**
     * Handle business login (Step 1)
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Replace with your actual business authentication logic
        $credentials = [
            'email' => $request->username, // or phone
            'password' => $request->password,
        ];

        if (Auth::guard('business')->attempt($credentials)) {
            // Generate OTP (store in session for demo)
            $otp = rand(100000, 999999);
            Session::put('business_otp', $otp);

            // TODO: Send OTP to business email/phone
            // For demo purposes, we'll just log it
            \Log::info("Business OTP for user {$request->username}: $otp");

            return response()->json(['status' => 'success', 'message' => 'OTP sent successfully']);
        }

        return response()->json(['status' => 'error', 'message' => 'Invalid credentials']);
    }

    /**
     * Verify OTP (Step 2)
     */
    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);

        $sessionOtp = Session::get('business_otp');

        if ($request->otp == $sessionOtp) {
            // OTP is correct, clear it
            Session::forget('business_otp');

            // Log the user in fully if needed
            return response()->json(['status' => 'success', 'message' => 'OTP verified successfully']);
        }

        return response()->json(['status' => 'error', 'message' => 'Invalid OTP']);
    }

    /**
     * Resend OTP (Step 2)
     */
    public function resendOtp(Request $request)
    {
        // Generate new OTP
        $otp = rand(100000, 999999);
        Session::put('business_otp', $otp);

        // TODO: Send OTP to business email/phone
        \Log::info("Business OTP resent: $otp");

        return response()->json(['status' => 'success', 'message' => 'OTP resent successfully']);
    }
}
