<?php

namespace App\Modules\Core\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client; 

use Illuminate\Http\Request;

class ActivityReportController extends Controller
{
    public function index()
{
    
    $clients = Client::all(); 
    return view('technician.register_view_data', compact('clients'));
}

 public function showClient($id)
    {
        $client = Client::findOrFail($id);

        return view('mediator.clients.show', compact('client'));
    }
}
