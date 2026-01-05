<?php

namespace App\Http\Controllers\Categories\TechnicalRepair\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BusinessPersonController extends Controller
{
    public function index()
    {
        return view('business.index'); 
    }

    public function registerRepair()
    {
        return view('business.register_repair');
    }

    public function myProducts()
    {
        return view('business.my_products');
    }

    public function meetings()
    {
        return view('business.meetings');
    }

    public function connections()
    {
        return view('business.connections.index');
    }

    public function subscriptionBilling()
    {
        return view('business.subscription_billing');
    }

    public function eLearning()
    {
        return view('business.e-learning');
    }

    public function privacySecurity()
    {
        return view('business.privacy_security');
    }
}
