<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Service;
use App\Models\User;
use App\Models\Mediator;
use Illuminate\Support\Facades\Auth;

class MediatorClientController extends Controller
{
    /**
     * Display mediator dashboard
     */
    public function dashboard()
    {
        $mediator = $this->getMediator(Auth::id());

        $clients = Client::where('mediator_id', $mediator->id)->get();
        $services = Service::where('is_active', 1)->get();

        // Optional: determine user level based on clients/commissions
        $user = Auth::user();
        $totalClients = $clients->count();
        if ($totalClients >= 50) $user->level = 'Legendary';
        elseif ($totalClients >= 35) $user->level = 'Elite';
        elseif ($totalClients >= 25) $user->level = 'Diamond';
        elseif ($totalClients >= 15) $user->level = 'Platinum';
        elseif ($totalClients >= 10) $user->level = 'Gold';
        elseif ($totalClients >= 5) $user->level = 'Silver';
        else $user->level = 'Bronze';

        return view('mediator.dashboard', compact('clients', 'services', 'user'));
    }

    /**
     * Display mediator clients list
     */
    public function clients()
{
    $user = auth()->user();

    // Get the mediator
    $mediator = Mediator::where('user_id', $user->id)->first();

    // Get all clients for this mediator
    $clients = Client::where('mediator_id', $mediator->id)->get();

    // Get all services to populate the dropdown
    $services = Service::all();

    return view('mediator.clients', compact('clients', 'services'));
}

    /**
     * Show add client form
     */
    public function showAddClientForm()
    {
        return view('mediator.addClient');
    }

    /**
     * Add a new client
     */
    public function addClient(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'city' => 'nullable|string|max:100',
        ]);

        $mediator = $this->getMediator(Auth::id());

        $client = new Client();
        $client->mediator_id = $mediator->id;
        $client->name = $request->name;
        $client->phone = $request->phone;
        $client->email = $request->email;
        $client->city = $request->city;
        $client->status = 'active';
        $client->save();

        return redirect()->route('mediator.clients')->with('success', 'Client added successfully!');
    }

    /**
     * Record a service for a client
     */
    public function recordService(Request $request, $clientId)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
        ]);

        $client = Client::findOrFail($clientId);
        $serviceId = $request->service_id;

        // Assuming you have a pivot table client_service
        $client->services()->attach($serviceId, ['status' => 'pending']);

        return redirect()->back()->with('success', 'Service recorded successfully.');
    }

    /**
     * Helper: get mediator record or create from users table if missing
     */
    private function getMediator($userId)
    {
        $mediator = Mediator::where('user_id', $userId)->first();

        if (!$mediator) {
            $user = User::where('id', $userId)
                        ->where('role', 'mediator')
                        ->firstOrFail(); // fail if not a mediator

            $mediator = Mediator::create([
                'user_id' => $user->id,
                'name' => $user->name,
            ]);
        }

        return $mediator;
    }

    public function recordServicePayment(Request $request){
    $request->validate([
        'client_id'=>'required|exists:clients,id',
        'service_id'=>'required|exists:services,id',
        'method'=>'required',
        'payment_amount'=>'required|numeric',
        'transaction_id'=>'required|string',
    ]);

    $client = Client::find($request->client_id);
    $serviceId = $request->service_id;

    // Attach service
    $client->services()->attach($serviceId, ['status'=>'pending']);

    // Record payment
    \DB::table('payments')->insert([
        'client_id'=>$client->id,
        'plan'=> $serviceId,
        'method'=>$request->method,
        'payment_amount'=>$request->payment_amount,
        'transaction_id'=>$request->transaction_id,
        'status'=>'success',
        'created_at'=>now(),
        'updated_at'=>now(),
    ]);

    return response()->json(['success'=>'Service & Payment recorded successfully!']);
}
public function deleteClient($id)
{
    $client = Client::find($id);
    if($client){
        $client->delete();
        return response()->json(['success' => 'Client deleted successfully']);
    }
    return response()->json(['error' => 'Client not found'], 404);
}

}
