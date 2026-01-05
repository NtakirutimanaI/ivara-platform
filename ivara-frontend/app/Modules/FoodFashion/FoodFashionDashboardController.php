<?php

namespace App\Modules\FoodFashion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FoodFashionDashboardController extends Controller
{
    public function customer() { return view('food_fashion.customer.index'); }
    public function vendor() { return view('food_fashion.vendor.index'); }
    public function organizer() { return view('food_fashion.organizer.index'); }
    public function fashion() { return view('food_fashion.fashion.index'); }
    public function delivery() { return view('food_fashion.delivery.index'); }
    public function admin() { return view('food_fashion.admin.index'); }

    // Generic placeholder if needed
    public function generic() { return view('food_fashion.generic'); }
}
