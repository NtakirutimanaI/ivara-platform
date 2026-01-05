<?php

namespace App\Modules\Core\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;

class RegisteredUserController extends Controller
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

    /**
     * Show the registration form
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle user registration
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50'],
            'country_code' => ['nullable', 'string', 'max:10'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        try {
            // Call MongoDB backend API for registration
            $response = Http::post($this->getApiUrl() . '/register', [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password,
                'role' => 'user', // default role on registration
                'phone' => $request->country_code . $request->phone,
            ]);

            if ($response->successful()) {
                // Registration successful
                return redirect()->route('login')->with('success', 'Account created successfully! Please log in.');
            } else {
                // Registration failed
                $error = $response->json()['error'] ?? 'Registration failed';
                return back()->withErrors(['email' => $error])->withInput();
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Registration Connection Error: ' . $e->getMessage(), [
                'exception' => $e,
                'url' => $this->getApiUrl() . '/register'
            ]);
            return back()->withErrors([
                'email' => 'Unable to connect to registration server: ' . $e->getMessage()
            ])->withInput();
        }
    }

    /**
     * Show the second registration step (business type selection)
     */
    public function showRegister2()
    {
        return view('auth.register2');
    }

    /**
     * Show the business type selection page if user is client.
     */
    public function selectBusinessType()
    {
        $user = Auth::user();

        // If user already selected a role, go directly to their dashboard
        if ($user->role !== 'client') {
            $role = strtolower($user->role);
            if (Route::has($role . '.dashboard')) {
                return redirect()->route($role . '.dashboard');
            }
            return redirect('/dashboard');
        }

        // Show the select business type page
        return view('auth.select-business-type');
    }

    /**
     * Save selected business type permanently (only first time)
     */
    public function saveBusinessType(Request $request)
    {
        $request->validate([
            'business_type' => 'required|string',
        ]);

        $user = auth()->user();

        // Update only if the user is still client (first time)
        if ($user->role === 'client') {
            $user->role = $request->business_type;
            
            // Only save if it's an Eloquent model
            if ($user instanceof \Illuminate\Database\Eloquent\Model) {
                $user->save();
            }
            
            // Sync session if using session-based auth
            if (Session::has('user')) {
                $uData = Session::get('user');
                $uData['role'] = $request->business_type;
                Session::put('user', $uData);
            }
        }

        // Redirect automatically to their dashboard
        $role = strtolower($user->role);

        if (Route::has($role . '.dashboard')) {
            return redirect()->route($role . '.dashboard');
        }

        // Fallback route
        return redirect('/dashboard');
    }
}
