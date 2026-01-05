<?php

namespace App\Modules\Core\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Google Login failed. Please try again.');
        }

        // Check if user already exists
        $user = User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            // Log in the existing user
            Auth::login($user);
        } else {
            // Create a new user
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'username' => Str::slug($googleUser->getName()) . rand(100, 999), // Generate unique username
                'password' => Hash::make(Str::random(16)), // Random password
                'google_id' => $googleUser->getId(),
                'role' => 'client', // Default role
                'phone' => '', // Phone might be missing, handle accordingly
                'country_code' => '250',
            ]);

            event(new Registered($user));
            Auth::login($user);
        }

        return redirect()->intended('/dashboard');
    }
}
