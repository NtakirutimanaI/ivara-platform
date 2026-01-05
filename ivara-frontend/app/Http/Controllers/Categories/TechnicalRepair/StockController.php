<?php
namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class StockController extends Controller
{
    

    public function displayStock()
    {
        return view('admin.stock'); // Your stock page
    }

     public function supervisorStock()
    {
        return view('supervisor.stock');
    }
}
