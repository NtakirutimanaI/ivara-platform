<?php

namespace App\Modules\Core\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    private function getApiUrl(): string
    {
        $baseUrl = env('BACKEND_API_URL', 'http://localhost:5001');
        $baseUrl = rtrim($baseUrl, '/');
        if (str_ends_with($baseUrl, '/api')) {
            $baseUrl = substr($baseUrl, 0, -4);
        }
        return $baseUrl . '/api/auth';
    }

    public function create(): View|RedirectResponse
    {
        // Check if user is already logged in via native auth
        if (auth()->check()) {
            return $this->redirectBasedOnRole();
        }

        return view('auth.login');
    }

    public function showLogin(): View|RedirectResponse
    {
        return $this->create();
    }

    public function store(Request $request): RedirectResponse
    {
        // Validate the request
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        try {
            // Call MongoDB backend API for authentication
            $response = Http::post($this->getApiUrl() . '/login', [
                'email' => $request->email,
                'username' => $request->email, // Also send as username in case it's a username
                'password' => $request->password,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                $userData = $data['user'];
                $userData['profile_photo'] = $userData['profile_photo'] ?? $userData['profilePhoto'] ?? null;
                $userData['role'] = $userData['role'] ?? 'user';
                $userData['name'] = $userData['name'] ?? $userData['username'] ?? 'User';
                $userData['id'] = $userData['id'] ?? $userData['_id'] ?? null;
                
                // Store normalized user data in session (Legacy support)
                Session::put('user', $userData);
                Session::put('auth_token', $data['token']);
                Session::put('user_id', $userData['id']);
                Session::put('user_role', $userData['role']);
                Session::put('user_category', $userData['category'] ?? null);

                // Removed MySQL Sync to rely on Session/API Provider
                
                // Natively log in the user using the GenericUser object via SessionUserProvider
                // Note: We create a GenericUser here just to satisfy the login call, 
                // but standard SessionUserProvider will fetch from Session on next request.
                $genericUser = new \Illuminate\Auth\GenericUser($userData);
                auth()->login($genericUser, $request->has('remember'));

                return $this->redirectBasedOnRole();
            } else {
                // Authentication failed
                $error = $response->json()['error'] ?? 'Invalid credentials';
                return back()->withErrors(['email' => $error])->withInput();
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Auth Connection Error: ' . $e->getMessage(), [
                'exception' => $e,
                'url' => $this->getApiUrl() . '/login'
            ]);
            return back()->withErrors([
                'email' => 'Unable to connect to authentication server: ' . $e->getMessage()
            ])->withInput();
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        // Clear all session data
        Session::flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('status', 'You have been logged out successfully.');
    }

    /**
     * Redirect user based on their role
     */
    private function redirectBasedOnRole(): RedirectResponse
    {
        $user = Session::get('user');
        $role = strtolower($user['role'] ?? 'user');

        // Special roles go directly to their dashboards
        if (in_array($role, ['super_admin', 'super-admin'])) {
            return redirect()->route('super_admin.index');
        }

        // Admin, Manager, Supervisor and others go to Category Selection first
        return redirect()->route('auth.select-category');
    }
}
