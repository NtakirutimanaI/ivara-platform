<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Events\ActivityCreated;

class InventoryController extends Controller
{
    /**
     * Display the inventory page.
     */
    public function index()
    {
        // Example activity for demonstration
        $activity = Activity::create([
            'message' => 'Inventory page viewed',
            'icon'    => 'fas fa-boxes',
        ]);

        // Broadcast activity to others
        broadcast(new ActivityCreated($activity))->toOthers();

        return view('admin.inventory'); 
    }

     public function managerInventory()
    {
        return view('manager.inventory');
    }
}
