<?php

namespace App\Modules\Core\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\User;
use App\Models\Inventory;
use App\Models\Subscription;
use App\Models\Client;
use App\Models\Transaction;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;
use App\Exports\DevicesExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    /** Admin dashboard */
    public function index()
    {
        $totalRevenue        = Subscription::where('status', 'active')->sum('price');
        $totalOrders         = DB::table('orders')->count();
        $tasksCompleted      = DB::table('tasks')->where('status', 'completed')->count();
        $activeSubscriptions = Subscription::where('status', 'active')->count();
        $totalSales          = DB::table('sales')->sum('units_sold');

        $devices       = Device::with(['client', 'technician'])->latest()->take(10)->get();
        $employees     = User::all();
        $inventory     = Inventory::all();
        $subscriptions = Subscription::with('user')->get();

        return view('admin.reports', compact(
            'totalRevenue','totalOrders','tasksCompleted','activeSubscriptions',
            'totalSales','devices','employees','inventory','subscriptions'
        ));
    }

    /** Supervisor reports */
    public function supervisorReports()
    {
        $totalRevenue        = Subscription::where('status', 'active')->sum('price');
        $totalOrders         = DB::table('orders')->count();
        $tasksCompleted      = DB::table('tasks')->where('status', 'completed')->count();
        $activeSubscriptions = Subscription::where('status', 'active')->count();
        $totalSales          = DB::table('sales')->sum('units_sold');

        $devices       = Device::with(['client', 'technician'])->get();
        $employees     = User::all();
        $inventory     = Inventory::all();
        $subscriptions = Subscription::with('user')->get();

        return view('supervisor.reports', compact(
            'totalRevenue','totalOrders','tasksCompleted','activeSubscriptions',
            'totalSales','devices','employees','inventory','subscriptions'
        ));
    }

    /** PDF generation */
    public function generatePdf(Request $request)
    {
        $data = [
            'totalRevenue'        => $request->input('totalRevenue'),
            'totalOrders'         => $request->input('totalOrders'),
            'tasksCompleted'      => $request->input('tasksCompleted'),
            'activeSubscriptions' => $request->input('activeSubscriptions'),
            'totalProfits'        => $request->input('totalProfits'),
            'totalLosses'         => $request->input('totalLosses'),
            'devices'             => $request->input('devices', []),
            'employees'           => $request->input('employees', []),
            'inventory'           => $request->input('inventory', []),
            'subscriptions'       => $request->input('subscriptions', []),
            'chartImage'          => $request->input('chartImage'),
        ];

        $pdf = Pdf::loadView('admin.pdf_report', $data);

        if (function_exists('createNotification') && auth()->check()) {
            createNotification('system', 'Daily report generated successfully.', auth()->id());
        }

        return $pdf->download('dashboard_full_report.pdf');
    }

    /** Download sample PDF */
    public function downloadPdf()
    {
        $file = public_path('files/example.pdf');
        abort_unless(file_exists($file), 404, 'File not found.');
        return response()->download($file);
    }

    /** Excel download */
    public function downloadExcel(Request $request)
    {
        $startDate = $request->input('start_date', '2000-01-01');
        $endDate   = $request->input('end_date', now()->toDateString());
        return Excel::download(new DevicesExport($startDate, $endDate), 'devices_report.xlsx');
    }

    /** Manager view clients */
    public function registerViewData()
    {
        $clients = Client::all();
        return view('manager.view_data', compact('clients'));
    }

    /** Supervisor filter reports */
    public function filter(Request $request)
    {
        $interval = $request->input('interval', 'all');

        $devicesQuery       = Device::with(['client','technician']);
        $employeesQuery     = User::query();
        $inventoryQuery     = Inventory::query();
        $subscriptionsQuery = Subscription::with('user');
        $ordersQuery        = DB::table('orders');
        $tasksQuery         = DB::table('tasks');

        if ($interval !== 'all') {
            $dateColumn = 'created_at';
            if ($interval === 'daily') {
                foreach ([$devicesQuery,$employeesQuery,$inventoryQuery,$subscriptionsQuery,$ordersQuery,$tasksQuery] as $q) {
                    $q->whereDate($dateColumn, today());
                }
            } elseif ($interval === 'weekly') {
                $range = [now()->startOfWeek(), now()->endOfWeek()];
                foreach ([$devicesQuery,$employeesQuery,$inventoryQuery,$subscriptionsQuery,$ordersQuery,$tasksQuery] as $q) {
                    $q->whereBetween($dateColumn, $range);
                }
            } elseif ($interval === 'monthly') {
                foreach ([$devicesQuery,$employeesQuery,$inventoryQuery,$subscriptionsQuery,$ordersQuery,$tasksQuery] as $q) {
                    $q->whereMonth($dateColumn, now()->month);
                }
            } elseif ($interval === 'yearly') {
                foreach ([$devicesQuery,$employeesQuery,$inventoryQuery,$subscriptionsQuery,$ordersQuery,$tasksQuery] as $q) {
                    $q->whereYear($dateColumn, now()->year);
                }
            }
        }

        $devices       = $devicesQuery->get();
        $employees     = $employeesQuery->get();
        $inventory     = $inventoryQuery->get();
        $subscriptions = $subscriptionsQuery->get();
        $orders        = $ordersQuery->get();
        $tasksCompleted = $tasksQuery->where('status', 'completed')->count();

        $totalRevenue        = $subscriptions->where('status','active')->sum('price');
        $totalOrders         = $orders->count();
        $activeSubscriptions = $subscriptions->where('status','active')->count();
        $totalSales          = $devices->count();

        return view('supervisor.reports', compact(
            'totalRevenue','totalOrders','tasksCompleted','activeSubscriptions',
            'totalSales','devices','employees','inventory','subscriptions'
        ));
    }

    /** AJAX filter for client transactions */
    public function filterTransactions(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['html' => '<p class="text-danger">Unauthorized</p>'], 401);
        }

        $request->validate([
            'start_date' => ['nullable','date'],
            'end_date'   => ['nullable','date','after_or_equal:start_date'],
            'type'       => ['nullable','in:payment,refund'],
        ]);

        $client = auth()->user();

        $query = Transaction::where('client_id', $client->id);

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $transactions = $query->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        $html = view('client.partials.transactions_table', compact('transactions'))->render();

        return response()->json(['html' => $html]);
    }
}
