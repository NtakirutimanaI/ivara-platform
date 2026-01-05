<?php
namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function dashboard()
    {
        return view('business.index');
    }
     public function index()
    {
        return view('business.index');
    }
}
