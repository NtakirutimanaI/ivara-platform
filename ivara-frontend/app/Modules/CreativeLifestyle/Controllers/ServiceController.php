<?php

namespace App\Modules\CreativeLifestyle\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\CreativeLifestyle\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->paginate(10);
        return view('admin.categories.creative-lifestyle.services', compact('services'));
    }

    public function create()
    {
        return view('admin.categories.creative-lifestyle.services_create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|string|in:active,inactive',
        ]);

        Service::create($validated);

        return redirect()->route('admin.creative-lifestyle.services')
            ->with('success', 'Service created successfully.');
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.categories.creative-lifestyle.services_edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|string|in:active,inactive',
        ]);

        $service->update($validated);

        return redirect()->route('admin.creative-lifestyle.services')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('admin.creative-lifestyle.services')
            ->with('success', 'Service deleted successfully.');
    }
}
