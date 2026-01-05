<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Client;
use App\Models\Activity;
use App\Events\ActivityCreated;
use Illuminate\Http\Request;

class LearningController extends Controller
{
    /**
     * Display the learning page with products and clients.
     */
    public function index()
    {
        $products = Product::all();
        $clients = Client::all();

        // -------------------------------
        // Broadcast activity
        // -------------------------------
        if ($products->count() > 0) {
            $activity = Activity::create([
                'message' => 'Accessed learning page with ' . $products->count() . ' products',
                'icon'    => 'fas fa-book',
            ]);

            broadcast(new ActivityCreated($activity))->toOthers();
        }

        return view('admin.learning', compact('products', 'clients'));
    }

    public function eLearning()  
    {
        return view('manager.e-learning'); 
    }
}
