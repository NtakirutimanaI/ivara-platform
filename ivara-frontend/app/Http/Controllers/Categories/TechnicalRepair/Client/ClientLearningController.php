<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ClientLearningController extends Controller
{
    public function eLearning()
    {
        // Fetch any necessary data here
        return view('client.e_learning'); // your Blade view
    }
}
