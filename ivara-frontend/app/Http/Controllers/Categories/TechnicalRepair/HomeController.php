<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Technician;
use App\Models\RegisterRepair;
use App\Models\Order;
use App\Models\User;
use App\Models\Update;
use App\Models\Activity;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $role = strtolower(auth()->user()->role);

        // Smart Redirection based on Role
        if (in_array($role, ['admin', 'manager', 'supervisor'])) {
            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($role === 'manager') {
                // Managers stay here
            } elseif ($role === 'supervisor') {
                return redirect()->route('supervisor.index');
            }
        } else {
            // For all other users, go through the microservice selection flow as requested
            return redirect()->route('auth.select-category');
        }

        // --- Manager Stats (Only reached if role is manager) ---
        $earnings = Order::whereIn('status', ['completed', 'Delivered', 'Confirmed'])->sum('total_amount') ?? 0;
        $balance  = Order::whereIn('status', ['paid', 'Approved'])->sum('total_amount') ?? 0;
        $sales    = Order::count() ?? 0;
        $totalUsers = User::count() ?? 0;
        $repairsCount = RegisterRepair::count() ?? 0;

        $activities = Activity::latest()->take(8)->get();
        $products = Product::latest()->take(5)->get();

        $updates = Update::whereNotNull('image')
                        ->orderBy('date', 'desc')
                        ->take(4)
                        ->get();

        $stats = [
            'earnings' => $earnings,
            'balance'  => $balance,
            'sales'    => $sales,
            'users'    => $totalUsers,
            'repairs'  => $repairsCount,
        ];

        return view('manager.index', compact('stats', 'updates', 'activities', 'products'));
    }

    /**
     * Show Register Repair form
     */
    public function registerRepair()
    {
        $devices = Device::all();
        $technicians = Technician::all();

        return view('manager.register_repair', compact('devices', 'technicians'));
    }

    /**
     * View all registered repairs with relations
     */
    public function registerViewData()
    {
        $repairs = RegisterRepair::with(['client', 'device', 'technician'])->get();

        return view('manager.view_data', compact('repairs'));
    }

    /**
     * Show all devices
     */
    public function device()
    {
        $devices = Device::all();
        return view('manager.device', compact('devices'));
    }

    /**
     * Show all technicians
     */
    public function technicians()
    {
        $technicians = Technician::all();
        return view('manager.technicians', compact('technicians'));
    }
}
