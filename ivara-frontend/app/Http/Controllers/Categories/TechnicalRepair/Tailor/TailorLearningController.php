<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class TailorLearningController extends Controller
{
    public function index()
    {
        // Load e-learning content for the tailor
        return view('tailor.e_learning');
    }
}
