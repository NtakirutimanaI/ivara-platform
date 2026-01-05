<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class BusinessLearningController extends Controller
{
    /**
     * Display the e-learning page for business users.
     */
    public function index()
    {
        // Fetch any data if needed for the e-learning page
        return view('business.e_learning'); // Make sure this Blade view exists
    }
}
