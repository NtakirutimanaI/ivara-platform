<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Mediator;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ClientMediatorController extends Controller
{
    // Show mediators page with merged location dropdown
    public function mediators()
    {
        $mediatorLocations = Mediator::select('location')
            ->distinct()
            ->pluck('location')
            ->filter()
            ->toArray();

        $userLocations = User::where('role', 'mediator')
            ->select('location')
            ->distinct()
            ->pluck('location')
            ->filter()
            ->toArray();

        $locations = array_unique(array_merge($mediatorLocations, $userLocations));

        return view('client.mediators', compact('locations'));
    }

    // AJAX: search mediators by location
    public function search(Request $request)
    {
        $location = $request->query('location');
        if (!$location) return response()->json([]);

        // Mediators table
        $mediators = Mediator::where('location', $location)
            ->get(['id','fullname','email','phone','location','level'])
            ->map(fn($m) => [
                'id' => $m->id,
                'fullname' => $m->fullname,
                'email' => $m->email ?? 'N/A',
                'phone' => $m->phone ?? 'N/A',
                'location' => $m->location ?? 'N/A',
                'level' => $m->level ?? 'basic',
                'source' => 'mediators'
            ]);

        // Users table
        $users = User::where('role', 'mediator')
            ->where('location', $location)
            ->get(['id','name','email','phone','location'])
            ->map(fn($u) => [
                'id' => $u->id,
                'fullname' => $u->name,
                'email' => $u->email ?? 'N/A',
                'phone' => $u->phone ?? 'N/A',
                'location' => $u->location ?? 'N/A',
                'level' => 'basic',
                'source' => 'users'
            ]);

        // Merge both sources
        $allMediators = $mediators->concat($users)->values();

        return response()->json($allMediators);
    }

    // Connect mediator
    public function connect(Request $request)
    {
        $mediatorId = $request->mediator_id;
        $source = $request->source;

        try {
            DB::table('connections')->insert([
                'client_id' => auth()->id(),
                'mediator_id' => $mediatorId,
                'source' => $source,
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now()
            ]);
            return response()->json(['success'=>true]);
        } catch (\Exception $e) {
            return response()->json(['success'=>false]);
        }
    }
}
