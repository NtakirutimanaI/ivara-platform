<?php

namespace App\Http\Controllers\Categories\TechnicalRepair\Craftsperson;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CraftsPersonController extends Controller
{
    public function index()
    {
        return view('craftsperson.index');  
    }

    public function registerRepair()
    {
        return view('craftsperson.register_repair');
    }

    public function products()
    {
        return view('craftsperson.products.index');
    }

    public function meetings()
    {
        return view('craftsperson.meetings');
    }

    public function connections()
    {
        return view('craftsperson.connections.index');
    }

    public function subscriptionBilling()
    {
        return view('craftsperson.subscription_billing');
    }

    public function eLearning()
    {
        return view('craftsperson.e-learning');
    }

    public function privacySecurity()
    {
        return view('craftsperson.privacy_security');
    }
}
