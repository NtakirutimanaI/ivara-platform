<?php

namespace App\Modules\Core\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
{
    private function getBaseUrl(): string
    {
        $baseUrl = env('BACKEND_API_URL', 'http://localhost:5001');
        $baseUrl = rtrim($baseUrl, '/');
        if (str_ends_with($baseUrl, '/api')) {
            $baseUrl = substr($baseUrl, 0, -4);
        }
        return $baseUrl;
    }

    private function getAuthHeader(): array
    {
        $token = Session::get('auth_token');
        return [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ];
    }

    /**
     * Show settings page
     */
    public function index()
    {
        try {
            $response = Http::withHeaders($this->getAuthHeader())
                ->get($this->getBaseUrl() . '/api/settings');

            $settingsData = $response->successful() ? $response->json() : [];
            
            // Transform settings to key => value array if it's an array of objects
            $settings = [];
            if (isset($settingsData['settings']) && is_array($settingsData['settings'])) {
                foreach ($settingsData['settings'] as $item) {
                    if (isset($item['key']) && isset($item['value'])) {
                        $settings[$item['key']] = $item['value'];
                    }
                }
            } elseif (is_array($settingsData)) {
                // If it's already an object/key-value pair
                $settings = $settingsData;
            }

            // Create activity/notification via API
            try {
                Http::withHeaders($this->getAuthHeader())
                    ->post($this->getBaseUrl() . '/api/notifications', [
                        'message' => 'Accessed settings page.',
                        'type' => 'info',
                        'icon' => 'fas fa-cogs',
                    ]);
            } catch (\Exception $e) {
                Log::warning('Failed to create settings access notification: ' . $e->getMessage());
            }

            return view('admin.settings', compact('settings'));
            
        } catch (\Exception $e) {
            Log::error('Settings API Error (Index): ' . $e->getMessage());
            $settings = [];
            return view('admin.settings', compact('settings'))->with('error', 'Unable to load settings from server.');
        }
    }

    /**
     * Update settings
     */
    public function update(Request $request)
    {
        // Common validation
        $request->validate([
            'language'  => 'nullable|string',
            'direction' => 'nullable|string',
        ]);

        // Filter and collect settings
        $settingsToUpdate = $request->except(['_token', '_method']);

        try {
            $response = Http::withHeaders($this->getAuthHeader())
                ->post($this->getBaseUrl() . '/api/settings', [
                    'settings' => $settingsToUpdate
                ]);

            if ($response->successful()) {
                // Create activity notification
                try {
                    Http::withHeaders($this->getAuthHeader())
                        ->post($this->getBaseUrl() . '/api/notifications', [
                            'message' => 'Settings updated successfully.',
                            'type' => 'success',
                            'icon' => 'fas fa-check-circle',
                        ]);
                } catch (\Exception $e) {
                    Log::warning('Failed to create settings update notification: ' . $e->getMessage());
                }

                if ($request->ajax()) {
                    return response()->json([
                        'status'  => 'success',
                        'message' => 'Settings updated successfully!',
                    ]);
                }

                return redirect()->back()->with('success', 'Settings saved successfully!');
            } else {
                $errorMsg = $response->json()['message'] ?? 'Failed to update settings on server.';
                if ($request->ajax()) {
                    return response()->json(['status' => 'error', 'message' => $errorMsg], 422);
                }
                return redirect()->back()->with('error', $errorMsg);
            }
        } catch (\Exception $e) {
            Log::error('Settings API Error (Update): ' . $e->getMessage());
            if ($request->ajax()) {
                return response()->json(['status' => 'error', 'message' => 'Connection to settings server failed.'], 500);
            }
            return redirect()->back()->with('error', 'Unable to connect to the settings server.');
        }
    }

    /**
     * Edit settings page (Alias for index or separate view)
     */
    public function edit()
    {
        return $this->index();
    }
}
