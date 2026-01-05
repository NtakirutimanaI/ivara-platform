<?php

namespace App\Modules\CreativeLifestyle\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\CreativeLifestyle\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index()
    {
        $providers = Provider::latest()->paginate(10);
        return view('admin.categories.creative-lifestyle.providers', compact('providers'));
    }

    public function create()
    {
        return view('admin.categories.creative-lifestyle.providers_create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|string|in:active,inactive',
        ]);

        Provider::create($validated);

        return redirect()->route('admin.creative-lifestyle.providers')
            ->with('success', 'Provider created successfully.');
    }

    public function edit($id)
    {
        $provider = Provider::findOrFail($id);
        return view('admin.categories.creative-lifestyle.providers_edit', compact('provider'));
    }

    public function update(Request $request, $id)
    {
        $provider = Provider::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|string|in:active,inactive',
        ]);

        $provider->update($validated);

        return redirect()->route('admin.creative-lifestyle.providers')
            ->with('success', 'Provider updated successfully.');
    }

    public function destroy($id)
    {
        $provider = Provider::findOrFail($id);
        $provider->delete();

        return redirect()->route('admin.creative-lifestyle.providers')
            ->with('success', 'Provider deleted successfully.');
    }
}
