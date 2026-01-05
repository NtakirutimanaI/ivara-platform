<?php

namespace App\Http\Controllers\Categories\TechnicalRepair\Mechanic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MechanicController extends Controller
{
    public function index()
    {
        return view('mechanic.index'); 
    }

    public function registerDevice()
    {
        return view('mechanic.register_device');
    }

    public function productsServices()
    {
        return view('mechanic.products_services');
    }

    public function meetings()
    {
        return view('mechanic.meetings');
    }

    public function paymentsInvoices()
    {
        return view('mechanic.payments_invoices');
    }

    public function mediator()
    {
        return view('mechanic.mediator');
    }

    public function learning()
    {
        return view('mechanic.learning');
    }
}
