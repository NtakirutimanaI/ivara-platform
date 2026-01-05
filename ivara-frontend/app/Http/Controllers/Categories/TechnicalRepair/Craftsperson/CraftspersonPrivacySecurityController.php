<?php
namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Otp;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;
use Carbon\Carbon;

class CraftspersonPrivacySecurityController extends Controller
{
    public function privacySecurity()
    {
        return view('craftsperson.privacy.privacy_security');
    }

    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        $user = User::where('email', $username)
                    ->orWhere('phone', $username)
                    ->first();

        if(!$user || !Hash::check($password, $user->password)){
            return response()->json(['status'=>'error','message'=>'Invalid credentials']);
        }

        // Generate OTP
        $otpCode = rand(100000, 999999);

        Otp::create([
            'user_id' => $user->id,
            'code' => $otpCode,
            'expires_at' => Carbon::now()->addMinutes(5),
            'used' => 0
        ]);

        // Send OTP via email
        Mail::to($user->email)->send(new SendOtpMail($otpCode));

        // Store user temporarily in session for OTP verification
        session(['privacy_user_id' => $user->id]);

        return response()->json(['status'=>'success','message'=>'OTP sent successfully']);
    }

    public function verifyOtp(Request $request)
    {
        $otpCode = $request->otp;
        $userId = session('privacy_user_id');

        if(!$userId){
            return response()->json(['status'=>'error','message'=>'Session expired. Please login again.']);
        }

        $otp = Otp::where('user_id', $userId)
                  ->where('code', $otpCode)
                  ->where('used', 0)
                  ->where('expires_at', '>', Carbon::now())
                  ->latest()
                  ->first();

        if(!$otp){
            return response()->json(['status'=>'error','message'=>'Invalid or expired OTP']);
        }

        $otp->used = 1;
        $otp->save();

        // Log user in
        auth()->loginUsingId($userId);
        session()->forget('privacy_user_id');

        return response()->json(['status'=>'success','message'=>'OTP verified']);
    }

    public function resendOtp(Request $request)
    {
        $userId = session('privacy_user_id');

        if(!$userId){
            return response()->json(['status'=>'error','message'=>'Session expired. Please login again.']);
        }

        $user = User::find($userId);
        if(!$user){
            return response()->json(['status'=>'error','message'=>'User not found']);
        }

        $otpCode = rand(100000, 999999);

        Otp::create([
            'user_id' => $userId,
            'code' => $otpCode,
            'expires_at' => Carbon::now()->addMinutes(5),
            'used' => 0
        ]);

        // Send OTP via email
        Mail::to($user->email)->send(new SendOtpMail($otpCode));

        return response()->json(['status'=>'success','message'=>'OTP resent successfully']);
    }
}
