<?php

namespace App\Http\Controllers\Categories\TechnicalRepair\Tailor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TailorController extends Controller
{
    public function index()
    {
        return view('tailor.index'); 
    }

    public function registerRepair()
    {
        return view('tailor.register_repair');
    }

    public function myProducts()
    {
        return view('tailor.my_products');
    }

    public function meetings()
    {
        return view('tailor.meetings');
    }

    public function connections()
    {
        return view('tailor.connections');
    }

    public function subscriptionBilling()
    {
        return view('tailor.subscription_billing');
    }

    public function eLearning()
    {
        return view('tailor.e-learning');
    }

    public function privacySecurity()
    {
        return view('tailor.privacy_security');
    }
}
