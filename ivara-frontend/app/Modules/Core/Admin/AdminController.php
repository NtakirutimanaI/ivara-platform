<?php

namespace App\Modules\Core\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Repair;
use App\Models\Technician;
use App\Models\Transaction;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Product;
use App\Models\Activity; // Activity model
use App\Models\Message;   // Messaging model
use App\Models\Connection; // Connection model for adminConnections
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use App\Services\OrderService;

class AdminController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    // --- Dashboard Method ---
    public function dashboard()
    {
        try {
            // === System-Wide Stats ===
            // 1. Total Earnings
            $totalEarnings = $this->orderService->calculateTotalEarnings();
            
            // 2. Total Users Count
            $totalUsers = 0;
            try { $totalUsers = User::count(); } catch (\Exception $e) {}
            
            // 3. User Distributions (For Pie Chart)
            $userLabels = [];
            $userData = [];
            try {
                $userDistribution = User::selectRaw('role, COUNT(*) as total')
                    ->groupBy('role')
                    ->get();
                $userLabels = $userDistribution->pluck('role')->map(fn($role) => ucfirst($role))->toArray();
                $userData   = $userDistribution->pluck('total')->toArray();
            } catch (\Exception $e) {}

            // 4. Total Active Repairs/Devices
            $activeRepairs = 0;
            try {
                // Pending orders often represent active workload
                $activeRepairs = $this->orderService->getActiveOrdersCount();
                // Or check repairs table if it exists
                if (\Illuminate\Support\Facades\Schema::hasTable('repairs')) {
                    $activeRepairs += \Illuminate\Support\Facades\DB::table('repairs')->where('status', 'Pending')->count();
                }
            } catch (\Exception $e) {}
            
            // 5. Total Products in Catalog
            $totalProducts = 0;
            try {
                if (\Illuminate\Support\Facades\Schema::hasTable('products')) {
                    $totalProducts = Product::count();
                }
            } catch (\Exception $e) {}

            // Attempt to fetch from Backend API if MySQL fails or for real-time data
            try {
                 $baseUrl = env('BACKEND_API_URL', 'http://localhost:5001/api');
                 $token = session('auth_token');
                 $response = Http::withHeaders(['Authorization' => "Bearer $token"])->get("$baseUrl/super-admin/overview");
                 if ($response->successful()) {
                     $apiStats = $response->json();
                     $stats = [
                        'earnings' => $apiStats['platformStats']['totalRevenue'] ?? $totalEarnings,
                        'users'    => $apiStats['platformStats']['totalUsers'] ?? $totalUsers,
                        'orders'   => $apiStats['platformStats']['totalOrders'] ?? 0,
                        'repairs'  => $activeRepairs,
                        'products' => $totalProducts
                     ];
                 } else {
                     $stats = [
                        'earnings' => $totalEarnings,
                        'users'    => $totalUsers,
                        'orders'   => $this->orderService->getTotalOrdersCount(),
                        'repairs'  => $activeRepairs,
                        'products' => $totalProducts
                    ];
                 }
            } catch (\Exception $e) {
                $stats = [
                    'earnings' => $totalEarnings,
                    'users'    => $totalUsers,
                    'orders'   => 0,
                    'repairs'  => $activeRepairs,
                    'products' => $totalProducts
                ];
            }

            // --- Monthly Revenue Data (Last 6 Months) ---
            $monthlyDataArray = [];
            try { $monthlyDataArray = $this->orderService->getMonthlyEarningsData(); } catch (\Exception $e) {}
            
            $chartData = [
                'months' => array_keys($monthlyDataArray),
                'earnings' => array_values($monthlyDataArray),
                'customers' => [
                    'labels' => $userLabels,
                    'data'   => $userData
                ]
            ];

            // --- Recent Global Activities ---
            $activities = collect([]);
            try {
                if (\Illuminate\Support\Facades\Schema::hasTable('activities')) {
                    $activities = Activity::latest()->take(10)->get();
                }
            } catch (\Exception $e) {}

            
            $products = collect([]);
            try {
                if (\Illuminate\Support\Facades\Schema::hasTable('products')) {
                    $products = Product::latest()->take(5)->get();
                }
            } catch (\Exception $e) {}

            return view('admin.dashboard', compact('stats','chartData','products','activities'));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Dashboard Error: ' . $e->getMessage());
            // Fallback dashboard
            return view('admin.dashboard', [
                'stats' => ['earnings'=>0,'users'=>0,'orders'=>0,'repairs'=>0,'products'=>0],
                'chartData' => ['months'=>[],'earnings'=>[],'customers'=>['labels'=>[],'data'=>[]]],
                'products' => collect([]),
                'activities' => collect([])
            ]);
        }
    }

    // --- User Management ---
    public function users()
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized');
        }

        $users = User::with('roles')->get();
        $roles = Role::all();

        return view('admin.users', compact('users', 'roles'));
    }

    // --- Send Message & Notification to a User ---
    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'message'      => 'required|string|min:5',
        ]);

        // Create Message
        $message = Message::create([
            'user_id'      => auth()->id(),
            'recipient_id' => $validated['recipient_id'],
            'message'      => $validated['message'],
        ]);

        // Create Notification
        if (function_exists('createNotification')) {
            createNotification(
                'message',
                'You have received a new message from ' . auth()->user()->name,
                $validated['recipient_id'],
                $message->id,
                'App\Models\Message'
            );
        }

        // Log Activity
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('activities')) {
                Activity::create([
                    'message' => 'Sent a message to user ID: ' . $validated['recipient_id'],
                    'icon'    => 'fas fa-envelope',
                ]);
            }
        } catch (\Exception $e) {}

        return redirect()->back()->with('success', 'Message sent successfully!');
    }

    // --- Approve Order & Send Notification ---
    public function approveOrder($id)
    {
        // Use service to update
        $order = $this->orderService->updateOrder($id, ['status' => 'approved']);

        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        // Send notification to the user
        if (function_exists('createNotification')) {
            createNotification(
                'order',
                'Your order #' . $order->id . ' has been ' . $order->status,
                $order->user_id,
                $order->id,
                'App\Models\Order'
            );
        }

        // Log Activity
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('activities')) {
                Activity::create([
                    'message' => 'Order #' . $order->id . ' approved by admin.',
                    'icon'    => 'fas fa-check-circle',
                ]);
            }
        } catch (\Exception $e) {}

        return redirect()->back()->with('success', 'Order approved and user notified.');
    }

    // --- Admin Connections Page ---
    public function adminConnections()
    {
        $connections = Connection::with(['mediator','client'])->get();
        return view('admin.connections', compact('connections'));
    }
}
