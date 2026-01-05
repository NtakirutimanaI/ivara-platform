<?php

namespace App\Modules\Core\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    private function getApiUrl(): string
    {
        $baseUrl = env('BACKEND_API_URL', 'http://localhost:5001');
        $baseUrl = rtrim($baseUrl, '/');
        if (str_ends_with($baseUrl, '/api')) {
            $baseUrl = substr($baseUrl, 0, -4);
        }
        return $baseUrl . '/api/profile/password';
    }

    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validateWithBag('updatePassword', [
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        try {
            $token = \Illuminate\Support\Facades\Session::get('auth_token');
            if (!$token) {
                return back()->with('error', 'Session expired.');
            }

            $response = \Illuminate\Support\Facades\Http::withToken($token)
                ->put($this->getApiUrl(), [
                    'currentPassword' => $request->current_password,
                    'newPassword' => $request->password
                ]);

            if ($response->successful()) {
                return back()->with('status', 'password-updated');
            } else {
                $error = $response->json()['error'] ?? 'Failed to update password';
                return back()->withErrors(['current_password' => $error], 'updatePassword');
            }
        } catch (\Exception $e) {
            return back()->withErrors(['current_password' => 'Connection to server failed.'], 'updatePassword');
        }
    }
}
