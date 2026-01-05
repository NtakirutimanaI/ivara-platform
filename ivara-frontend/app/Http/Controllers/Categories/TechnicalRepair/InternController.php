<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InternController extends Controller
{
    public function index()
    {
        return view('intern.index'); 
    }

    public function tasks()
    {
        return view('intern.tasks');
    }

    public function learning()
    {
        return view('intern.learning');
    }

    public function meetings()
    {
        return view('intern.meetings');
    }

    public function connections()
    {
        return view('intern.connections');
    }
}
