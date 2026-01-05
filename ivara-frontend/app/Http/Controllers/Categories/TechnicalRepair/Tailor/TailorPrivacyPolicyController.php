<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class TailorPrivacyPolicyController extends Controller
{
    public function index()
    {
        // Load privacy & security page for the tailor
        return view('tailor.privacy_security');
    }
}
