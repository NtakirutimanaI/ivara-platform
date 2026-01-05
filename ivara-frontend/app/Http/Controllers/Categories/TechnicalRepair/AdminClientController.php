<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class AdminClientController extends Controller
{
    public function index()
    {
        $clients = Client::orderBy('id', 'desc')->paginate(10);
        return view('admin.clients', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'required|string|unique:clients,phone',
            'email' => 'nullable|email|unique:clients,email',
            'city'  => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'national_id' => 'nullable|string|unique:clients,national_id',
        ], [
            'phone.unique' => 'A client with this phone number already exists.',
            'email.unique' => 'A client with this email address already exists.',
            'national_id.unique' => 'A client with this national ID already exists.',
        ]);

        Client::create($validated);
        
        return redirect()->back()->with('success', 'Client added successfully!');
    }

    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'required|string|unique:clients,phone,' . $id,
            'email' => 'nullable|email|unique:clients,email,' . $id,
            'city'  => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'national_id' => 'nullable|string|unique:clients,national_id,' . $id,
        ], [
            'phone.unique' => 'A client with this phone number already exists.',
            'email.unique' => 'A client with this email address already exists.',
            'national_id.unique' => 'A client with this national ID already exists.',
        ]);
        
        $client->update($validated);
        return redirect()->back()->with('success', 'Client updated successfully!');
    }

    public function destroy($id)
    {
        Client::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Client deleted successfully!');
    }
    
    public function checkEmail(Request $request)
    {
        $exists = Client::where('email', $request->email)->exists();
        return response()->json(['exists' => $exists]);
    }

    public function activate($id)
    {
        $client = Client::findOrFail($id);
        $client->status = 'active';
        $client->save();
        return redirect()->back()->with('success', 'Client activated successfully.');
    }

    public function deactivate($id)
    {
        $client = Client::findOrFail($id);
        $client->status = 'inactive';
        $client->save();
        return redirect()->back()->with('success', 'Client deactivated successfully.');
    }
}
