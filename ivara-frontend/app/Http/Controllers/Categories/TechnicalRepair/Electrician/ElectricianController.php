<?php

namespace App\Http\Controllers\Categories\TechnicalRepair\Electrician;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ElectricianController extends Controller
{
    public function index()
    {
        return view('electrician.index'); 
    }

    public function jobs()
    {
        return view('electrician.jobs');
    }

    public function schedule()
    {
        return view('electrician.schedule');
    }
}
