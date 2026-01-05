<?php

namespace App\Modules\Core\User;

use App\Http\Controllers\Controller;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\Payment;
use App\Models\User;
use App\Models\Profile;
use App\Models\Subscription;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    private function getApiUrl(): string
    {
        $baseUrl = env('BACKEND_API_URL', 'http://localhost:5001');
        $baseUrl = rtrim($baseUrl, '/');
        if (str_ends_with($baseUrl, '/api')) {
            $baseUrl = substr($baseUrl, 0, -4);
        }
        return $baseUrl . '/api/profile';
    }

    /**
     * Show the user's profile.
     */
    public function show(): View
    {
        $profile = auth()->user();
        $baseUrl = rtrim(env('BACKEND_API_URL', 'http://localhost:5001'), '/');
        if (str_ends_with($baseUrl, '/api')) { $baseUrl = substr($baseUrl, 0, -4); }

        return view('profile.show', [
            'profile' => $profile,
            'backendUrl' => $baseUrl
        ]);
    }

    /**
     * Display the user's profile edit form.
     */
    public function edit(Request $request): View
    {
        $baseUrl = rtrim(env('BACKEND_API_URL', 'http://localhost:5001'), '/');
        if (str_ends_with($baseUrl, '/api')) { $baseUrl = substr($baseUrl, 0, -4); }

        return view('profile.edit', [
            'user' => $request->user(),
            'backendUrl' => $baseUrl
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        try {
            $token = Session::get('auth_token');
            if (!$token) {
                return Redirect::route('login')->with('error', 'Session expired. Please login again.');
            }

            // Prepare data for the API
            $formData = [
                'name' => $request->name,
                'email' => $request->email,
            ];

            // If there's a file, we need a multipart request
            $response = null;
            if ($request->hasFile('profile_photo')) {
                $file = $request->file('profile_photo');
                $response = Http::withToken($token)
                    ->attach('profilePhoto', file_get_contents($file->getRealPath()), $file->getClientOriginalName())
                    ->post($this->getApiUrl(), $formData); // Note: Backend uses PATCH, but Laravel Http::attach often works better with POST or we can try PATCH
                
                // If PATCH is strictly required:
                if ($response->status() == 404 || $response->status() == 405) {
                     $response = Http::withToken($token)
                        ->attach('profilePhoto', file_get_contents($file->getRealPath()), $file->getClientOriginalName())
                        ->patch($this->getApiUrl(), $formData);
                }
            } else {
                $response = Http::withToken($token)->patch($this->getApiUrl(), $formData);
            }

            if ($response->successful()) {
                $updatedUser = $response->json();
                
                // Update the normalized user data in session
                $sessionUser = Session::get('user', []);
                $sessionUser['name'] = $updatedUser['name'] ?? $sessionUser['name'];
                $sessionUser['email'] = $updatedUser['email'] ?? $sessionUser['email'];
                $sessionUser['profile_photo'] = $updatedUser['profilePhoto'] ?? ($updatedUser['profile_photo'] ?? $sessionUser['profile_photo']);
                
                Session::put('user', $sessionUser);
                
                // Update the GenericUser in the auth guard
                $genericUser = new \Illuminate\Auth\GenericUser($sessionUser);
                auth()->login($genericUser);

                return Redirect::route('profile.edit')->with('status', 'profile-updated');
            } else {
                $error = $response->json()['error'] ?? 'Failed to update profile';
                return back()->withErrors(['email' => $error])->withInput();
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Profile Update API Error: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Unable to connect to profile server.'])->withInput();
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required'],
        ]);

        try {
            $token = Session::get('auth_token');
            if (!$token) {
                return Redirect::route('login')->with('error', 'Session expired.');
            }

            $response = Http::withToken($token)->delete($this->getApiUrl(), [
                'password' => $request->password
            ]);

            if ($response->successful()) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return Redirect::to('/');
            } else {
                $error = $response->json()['error'] ?? 'Failed to delete account';
                return back()->withErrors(['password' => $error], 'userDeletion');
            }
        } catch (\Exception $e) {
            return back()->withErrors(['password' => 'Connection to server failed.'], 'userDeletion');
        }
    }

    /**
     * Display the client's profile settings page.
     */
    public function profileSettings(): View
    {
        $user = auth()->user();

        $payments = Payment::where('client_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('client.profile_settings', compact('user', 'payments'));
    }

    /**
     * Update the client's profile via AJAX.
     */
    public function profileUpdateAjax(Request $request)
    {
        try {
            $token = Session::get('auth_token');
            if (!$token) {
                return response()->json(['message' => 'Session expired'], 401);
            }

            $formData = [
                'name'    => $request->name,
                'email'   => $request->email,
                'phone'   => $request->phone,
                'address' => $request->address,
            ];

            if ($request->filled('password')) {
                $formData['password'] = $request->password;
            }

            $response = null;
            if ($request->hasFile('profile_photo')) {
                $file = $request->file('profile_photo');
                $response = Http::withToken($token)
                    ->attach('profilePhoto', file_get_contents($file->getRealPath()), $file->getClientOriginalName())
                    ->patch($this->getApiUrl(), $formData);
            } else {
                $response = Http::withToken($token)->patch($this->getApiUrl(), $formData);
            }

            if ($response->successful()) {
                $updatedUser = $response->json();
                
                // Sync session
                $sessionUser = Session::get('user', []);
                $sessionUser['name'] = $updatedUser['name'] ?? $sessionUser['name'];
                $sessionUser['email'] = $updatedUser['email'] ?? $sessionUser['email'];
                $sessionUser['phone'] = $updatedUser['phone'] ?? ($sessionUser['phone'] ?? null);
                $sessionUser['address'] = $updatedUser['address'] ?? ($sessionUser['address'] ?? null);
                $sessionUser['profile_photo'] = $updatedUser['profilePhoto'] ?? ($updatedUser['profile_photo'] ?? $sessionUser['profile_photo']);
                
                Session::put('user', $sessionUser);
                
                $genericUser = new \Illuminate\Auth\GenericUser($sessionUser);
                auth()->login($genericUser);

                $photoUrl = $sessionUser['profile_photo'];
                if ($photoUrl && !str_starts_with($photoUrl, 'http')) {
                    $baseUrl = rtrim(env('BACKEND_API_URL', 'http://localhost:5001'), '/');
                    if (str_ends_with($baseUrl, '/api')) { $baseUrl = substr($baseUrl, 0, -4); }
                    $photoUrl = rtrim($baseUrl, '/') . '/' . ltrim($photoUrl, '/');
                }

                return response()->json([
                    'message'       => 'Profile updated successfully!',
                    'profile_photo' => $photoUrl,
                ]);
            } else {
                return response()->json(['message' => $response->json()['error'] ?? 'Update failed'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Connection error: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Upgrade client's subscription plan via AJAX.
     */
    public function upgradeSubscription(Request $request)
    {
        $request->validate([
            'plan'           => 'required|string|in:basic,pro,enterprise',
            'payment_method' => 'required|string|in:card,paypal',
        ]);

        $user = auth()->user();

        $plans = [
            'basic'      => 10,
            'pro'        => 25,
            'enterprise' => 50,
        ];
        $amount = $plans[$request->plan];

        $subscription = Subscription::updateOrCreate(
            ['user_id' => $user->id],
            [
                'client_id'  => $user->id,
                'plan'       => $request->plan,
                'price'      => $amount,
                'start_date' => now(),
                'end_date'   => now()->addMonth(),
                'status'     => 'active',
            ]
        );

        Payment::create([
            'client_id'      => $user->id,
            'plan'           => $request->plan,
            'payment_method' => $request->payment_method,
            'amount'         => $amount,
            'transaction_id' => 'TXN' . strtoupper(uniqid()),
            'status'         => 'success',
            'paid_at'        => now(),
        ]);

        Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'subscription_plan' => $request->plan,
                'next_billing_date' => now()->addMonth(),
            ]
        );

        return response()->json([
            'message'  => 'Subscription upgraded successfully',
            'new_plan' => ucfirst($request->plan),
        ]);
    }

    /**
     * Client profile edit view.
     */
    public function clientEdit()
    {
        return view('client.profile');
    }

    /**
     * Client profile update (with Profile table support).
     */
    public function clientUpdate(Request $request)
    {
        return $this->profileUpdateAjax($request);
    }
}
