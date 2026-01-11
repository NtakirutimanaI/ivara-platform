<?php

namespace App\Http\Controllers\Categories\TechnicalRepair\Admin;

use App\Http\Controllers\BaseApiController;
use Illuminate\Http\Request;

class ServiceController extends BaseApiController
{
    protected $apiEndpoint = '/technical-repair/services';

    /**
     * Display the category dashboard
     */
    public function dashboard()
    {
        // In a real scenario, you would fetch stats from the API here
        $overview = [
            'total_providers' => 145, 
            'active_jobs' => 32, 
            'revenue' => 45200
        ];
        
        return view('admin.categories.technical-repair.index', ['overview' => $overview]);
    }

    /**
     * Display a listing of services
     */
    public function index(Request $request)
    {
        $params = [
            'search' => $request->query('search'),
            'status' => $request->query('status'),
            'limit' => $request->query('limit', 10),
            'page' => $request->query('page', 1)
        ];

        $result = $this->apiGet($this->apiEndpoint, $params);
        
        $services = collect([]);
        $pagination = null;

        if ($result['success']) {
            $response = $result['response'];
            
            // Handle paginated response
            if (isset($response['data']) && isset($response['pagination'])) {
                $services = collect($response['data'])->map(fn($item) => (object)$item);
                $pagination = (object)$response['pagination'];
            } 
            // Handle simple array response
            else {
                $services = collect($response)->map(fn($item) => (object)$item);
            }
        }

        return view('admin.categories.technical-repair.services', [
            'services' => $services,
            'pagination' => $pagination
        ]);
    }

    /**
     * Show the form for creating a new service
     */
    public function create()
    {
        return view('admin.categories.technical-repair.services_create');
    }

    /**
     * Store a newly created service
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,inactive'
        ]);

        $result = $this->apiPost($this->apiEndpoint, $validated);
        return $this->handleApiRedirect(
            $result,
            'admin.technical-repair.services',
            'Service created successfully',
            'Failed to create service'
        );
    }

    /**
     * Show the form for editing the specified service
     */
    public function edit($id)
    {
        $result = $this->apiGet($this->apiEndpoint . '/' . $id);
        
        if ($result['success']) {
            return view('admin.categories.technical-repair.services_edit', ['service' => (object)$result['data']]);
        }
        
        return redirect()->route('admin.technical-repair.services')
            ->with('error', 'Service not found');
    }

    /**
     * Update the specified service
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,inactive'
        ]);

        $result = $this->apiPut($this->apiEndpoint . '/' . $id, $validated);
        return $this->handleApiRedirect(
            $result,
            'admin.technical-repair.services',
            'Service updated successfully',
            'Failed to update service'
        );
    }

    /**
     * Remove the specified service
     */
    public function destroy($id)
    {
        $result = $this->apiDelete($this->apiEndpoint . '/' . $id);
        return $this->handleApiRedirect(
            $result,
            'admin.technical-repair.services',
            'Service deleted successfully',
            'Failed to delete service'
        );
    }
}
