<?php

namespace App\Http\Controllers\Categories\TechnicalRepair\Shared;

use App\Http\Controllers\BaseApiController;
use Illuminate\Http\Request;

class AssetController extends BaseApiController
{
    protected $apiEndpoint = '/devices';

    // Show Device Registration Form
    public function register()
    {
        return view('web.technical_repair.assets.register');
    }

    // Submit Device Registration
    public function store(Request $request)
    {
        $validated = $request->validate([
            'serial_number' => 'required|string',
            'device_type' => 'required|string',
            'brand' => 'required|string',
            'device_model' => 'required|string',
            'owner_name' => 'required|string',
            'contact_phone' => 'required|string',
        ]);

        $data = $validated;
        $data['user_id'] = auth()->id(); // Registrant
        // If logged in as client, owner_id is self. If technician, could be different (handled in form hidden field or backend logic)
        
        $response = $this->apiPost($this->apiEndpoint . '/register', $data);

        return $this->handleApiRedirect(
            $response,
            back()->getTargetUrl(), // Stay on page or go to list
            'Device registered successfully. Unique ID generated.',
            'Failed to register device'
        );
    }

    // Show Tracking Page
    public function tracking()
    {
        return view('web.technical_repair.assets.tracking');
    }
}
