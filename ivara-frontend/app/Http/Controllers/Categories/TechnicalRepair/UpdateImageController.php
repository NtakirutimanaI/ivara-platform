<?php

namespace App\Modules\TechnicalRepair\Web;

use App\Http\Controllers\Controller;
use App\Models\Update;

class HomeController extends Controller
{
    public function index()
    {
        // Only updates with images
        $updates = Update::whereNotNull('image')
                         ->orderBy('date', 'desc')
                         ->get();

        // Pass $updates to the root index view
        return view('web.index', compact('updates'));
    }
}
