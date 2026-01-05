<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Mediator;

class CraftspersonConnectionsController extends Controller
{
    public function index(Request $request)
    {
        // Get unique locations from mediators table
        $locations = Mediator::select('location')->distinct()->pluck('location');

        // Items per page
        $perPage = $request->get('per_page', 10); // default 10
        if (!in_array($perPage, [5, 10, 25])) {
            $perPage = 10;
        }

        // Filter mediators by location if provided
        $query = Mediator::query()->whereNotNull('location')->where('location', '!=', '');

        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        // Highlight most active mediators: order by total_clients + total_transactions
        $query->orderByRaw('(total_clients + total_transactions) DESC')
              ->orderBy('fullname');

        $mediators = $query->paginate($perPage);

        return view('craftsperson.connections.index', compact('mediators', 'locations', 'perPage'));
    }
}
