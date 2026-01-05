<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SalesController extends Controller
{
    // Display sales page
    public function index()
    {
        return view('admin.sales'); 
    }

    public function managerSales()
    {
        return view('manager.sales');
    }
}
