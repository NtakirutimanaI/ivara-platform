<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Technician;
use App\Models\RegisterRepair;
use App\Models\Order;
use App\Models\User;
use App\Models\Activity;
use App\Models\Product;
use App\Models\Client;
use App\Models\Notification;
use App\Models\Invoice;
use App\Models\Connection;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\DevicesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    // ================= Dashboard =================
    public function index()
    {
        // --- Manager Stats ---
        $earnings = Order::whereIn('status', ['completed', 'Delivered', 'Confirmed'])->sum('total_amount') ?? 0;
        $balance  = Order::whereIn('status', ['paid', 'Approved'])->sum('total_amount') ?? 0;
        $sales    = Order::count() ?? 0;
        $totalUsers = User::count() ?? 0;
        $repairsCount = \App\Models\RegisterRepair::count() ?? 0;

        $stats = [
            'earnings' => $earnings,
            'balance'  => $balance,
            'sales'    => $sales,
            'users'    => $totalUsers,
            'repairs'  => $repairsCount,
        ];

        $activities = Activity::latest()->take(8)->get();
        $products = Product::latest()->take(5)->get();

        // Chart Data (Keeping existing logic but ensuring counts match)
        $rawChartData = Order::selectRaw('MONTH(created_at) as month, SUM(total_amount) as total')
            ->groupBy('month')->orderBy('month')->get()->toArray();
        $months = array_column($rawChartData,'month') ?: ['Jan', 'Feb', 'Mar'];
        $totals = array_column($rawChartData,'total') ?: [0, 0, 0];

        $customerDataRaw = Order::selectRaw('user_id, COUNT(*) as total')->groupBy('user_id')->get();
        $customerLabels = $customerDataRaw->pluck('user_id')->map(fn($id) => User::find($id)?->name ?? 'Unknown')->toArray();
        $customerValues = $customerDataRaw->pluck('total')->toArray();

        // Updates for the slider/feed
        $updates = \App\Models\Update::whereNotNull('image')->latest()->take(4)->get();

        return view('manager.index', compact(
            'stats', 'activities', 'products', 'updates',
            'months', 'totals', 'customerLabels', 'customerValues'
        ));
    }

    // ================= Repairs =================
    public function registerRepair()
    {
        return view('manager.register_repair');
    }

    public function registerViewData()
    {
        $clients = Client::all();
        return view('manager.view_data', compact('clients'));
    }

    // ================= Devices =================
    public function device()
    {
        $devices = Device::all();
        return view('manager.device', compact('devices'));
    }

    public function technicians()
    {
        $technicians = Technician::all();
        return view('manager.technicians', compact('technicians'));
    }

    public function registerDevice()
    {
        return view('manager.register_device');
    }

    public function repairDevice()
    {
        return view('manager.repair_device');
    }

    // ================= Reports =================
    public function reports()
    {
        $devices = Device::with(['client','technician'])->get();
        return view('manager.reports', compact('devices'));
    }

    public function downloadPdf()
    {
        $devices = Device::with(['client','technician'])->get();
        $pdf = Pdf::loadView('manager.reports_pdf', compact('devices'));
        return $pdf->download('devices_report.pdf');
    }

    public function downloadExcel(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate   = $request->input('end_date');
        return Excel::download(new DevicesExport($startDate,$endDate),'devices_report.xlsx');
    }

    // ================= Clients =================
    public function clients(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $perPage = $request->input('per_page', 10);

        $clients = Client::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%")
                      ->orWhere('email', 'like', "%$search%")
                      ->orWhere('phone', 'like', "%$search%");
                });
            })
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage)
            ->withQueryString();

        return view('manager.clients', compact('clients', 'search', 'status', 'perPage'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'required|string|max:20',
            'subscription' => 'required|string',
            'status' => 'nullable|string'
        ]);

        Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subscription' => $request->subscription,
            'status' => $request->status ?? 'active',
        ]);

        return redirect()->route('manager.clients')->with('success', 'Client created successfully.');
    }

    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>"required|email|unique:clients,email,{$id}",
            'phone'=>'required|string|max:20',
            'subscription'=>'required|string'
        ]);

        $client->update($request->only(['name','email','phone','subscription']));
        return redirect()->route('manager.clients')->with('success','Client updated successfully');
    }

    public function changeStatus($id)
    {
        $client = Client::findOrFail($id);
        $client->status = $client->status === 'active' ? 'inactive' : 'active';
        $client->save();
        return redirect()->route('manager.clients')->with('success','Client status updated');
    }

    public function sendNotification(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        $request->validate(['message'=>'required|string|max:500']);

        Notification::create([
            'type'=>'manager_message',
            'message'=>$request->message,
            'client_id'=>$client->id,
            'sent_at'=>now(),
        ]);

        return redirect()->route('manager.clients')->with('success','Notification sent to client');
    }

    public function generateInvoice(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        $request->validate([
            'amount'=>'required|numeric|min:1',
            'description'=>'required|string|max:255'
        ]);

        $invoice = Invoice::create([
            'client_id'=>$client->id,
            'amount'=>$request->amount,
            'description'=>$request->description,
            'status'=>'unpaid',
        ]);

        $invoice->number = 'INV-'.str_pad($invoice->id,6,'0',STR_PAD_LEFT);
        $invoice->issued_at = now();
        $invoice->save();

        return redirect()->route('manager.clients')->with('success','Invoice generated successfully');
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('manager.clients')
                         ->with('success', 'Client deleted successfully.');
    }

    // ================= Stock & Sales =================
    public function stock()
    {
        return view('manager.stock'); 
    }

    public function managerSales()
    {
        return view('manager.sales'); 
    }

    // ================= Updates, Team & Products =================
    public function createUpdates()
    {
        return view('manager.updates.create');
    }

    public function createTeam()
    {
        return view('manager.team.create');
    }

    public function createProducts()
    {
        return view('manager.products.create');
    }

    // ================= Notifications & Communication =================
    public function notifications()
    {
        $user = Auth::user();

        $notifications = Notification::where('user_id', $user->id)
            ->latest()
            ->paginate(15); 

        return view('manager.notifications', compact('notifications'));
    }

    // ================= Mediator Activities / Connections =================
    public function connections(Request $request)
    {
        $perPage = $request->input('per_page', 15);

        $connections = Connection::with(['mediator','client'])
            ->latest()
            ->paginate($perPage);
            

        return view('manager.connections', compact('connections'));
    }

    // ================= Reports & Feedback =================
    public function report()
    {
        return view('manager.reports'); 
    }

    public function feedback()
    {
        return view('manager.feedback'); 
    }

    public function meetings()
    {
        return view('manager.meetings');
    }

    public function eLearning()
    {
        return view('manager.e-learning');
    }
}
