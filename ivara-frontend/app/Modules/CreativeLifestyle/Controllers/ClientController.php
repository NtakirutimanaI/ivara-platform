<?php

namespace App\Modules\CreativeLifestyle\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\CreativeLifestyle\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::latest()->paginate(10);
        return view('admin.categories.creative-lifestyle.clients', compact('clients'));
    }

    public function create()
    {
        return view('admin.categories.creative-lifestyle.clients_create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|string|in:active,inactive',
        ]);

        Client::create($validated);

        return redirect()->route('admin.creative-lifestyle.clients')
            ->with('success', 'Client created successfully.');
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('admin.categories.creative-lifestyle.clients_edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|string|in:active,inactive',
        ]);

        $client->update($validated);

        return redirect()->route('admin.creative-lifestyle.clients')
            ->with('success', 'Client updated successfully.');
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('admin.creative-lifestyle.clients')
            ->with('success', 'Client deleted successfully.');
    }
}
