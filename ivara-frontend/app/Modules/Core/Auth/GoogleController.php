<?php

namespace App\Modules\Core\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;

class GoogleController extends Controller
{
    /**
     * Alias method - can be used for older routes referencing redirect()
     */
    public function redirect(): RedirectResponse
    {
        return $this->redirectToGoogle();
    }

    /**
     * Redirect the user to Google's OAuth page.
     */
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle callback from Google after authentication.
     */
    public function handleGoogleCallback(): RedirectResponse
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Attempt to find existing user
        $user = User::where('email', $googleUser->getEmail())->first();

        // If user doesn't exist, create a new one
        if (!$user) {
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => bcrypt(Str::random(24)), // Secure random password
                'email_verified_at' => now(),
            ]);
        }

        // Log the user in
        Auth::login($user);

        return redirect()->intended('/dashboard');
    }
}
