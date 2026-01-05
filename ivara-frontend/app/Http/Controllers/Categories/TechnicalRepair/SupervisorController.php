<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use App\Models\Device;
use App\Models\Repair;
use App\Models\Technician;
use App\Models\Booking;
use App\Models\Team;
use App\Models\Transaction;
use App\Models\Notification;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BookingsExport;

class SupervisorController extends Controller
{
    // ================= Dashboard =================
    public function task_oversight()
    {
        $tasks = Task::with('user')->orderBy('created_at', 'desc')->get();
        $devices = Device::with('technician')->orderBy('created_at', 'desc')->get();
        $repairs = Repair::with('technician')->orderBy('received_date', 'desc')->get();
        $users = User::all();
        $technicians = Technician::all();

        return view('supervisor.task_oversight', compact('tasks', 'devices', 'repairs', 'users', 'technicians'));
    }

    // ================= Tasks =================
    public function storeTask(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Task assigned successfully!');
    }

    public function updateTask(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Task updated successfully!');
    }

    public function destroyTask($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->back()->with('success', 'Task deleted successfully!');
    }

    // ================= Devices =================
    public function storeDevice(Request $request)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'serial_number' => 'required|string|max:255|unique:devices,serial_number',
            'technician_id' => 'nullable|exists:technicians,id',
        ]);

        Device::create([
            'brand' => $request->brand,
            'model' => $request->model,
            'serial_number' => $request->serial_number,
            'technician_id' => $request->technician_id,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Device added successfully!');
    }

    public function updateDevice(Request $request, $id)
    {
        $device = Device::findOrFail($id);

        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'serial_number' => 'required|string|max:255|unique:devices,serial_number,' . $device->id,
            'technician_id' => 'nullable|exists:technicians,id',
        ]);

        $device->update([
            'brand' => $request->brand,
            'model' => $request->model,
            'serial_number' => $request->serial_number,
            'technician_id' => $request->technician_id,
        ]);

        return redirect()->back()->with('success', 'Device updated successfully!');
    }

    public function destroyDevice($id)
    {
        $device = Device::findOrFail($id);
        $device->delete();

        return redirect()->back()->with('success', 'Device deleted successfully!');
    }

    // ================= Repairs =================
    public function storeRepair(Request $request)
    {
        $request->validate([
            'device_id' => 'required|exists:devices,id',
            'problem_description' => 'required|string',
            'technician_id' => 'nullable|exists:technicians,id',
        ]);

        $device = Device::findOrFail($request->device_id);

        Repair::create([
            'device_id' => $device->id,
            'device_name' => $device->brand . ' ' . $device->model,
            'problem_description' => $request->problem_description,
            'technician_id' => $request->technician_id,
            'repair_status' => 'pending',
            'received_date' => now(),
        ]);

        return redirect()->back()->with('success', 'Repair added successfully!');
    }

    public function updateRepair(Request $request, $id)
    {
        $repair = Repair::findOrFail($id);

        $request->validate([
            'problem_description' => 'required|string',
            'repair_status' => 'required|in:pending,in_progress,completed',
            'technician_id' => 'nullable|exists:technicians,id',
        ]);

        $repair->update([
            'problem_description' => $request->problem_description,
            'repair_status' => $request->repair_status,
            'technician_id' => $request->technician_id,
        ]);

        return redirect()->back()->with('success', 'Repair updated successfully!');
    }

    public function destroyRepair($id)
    {
        $repair = Repair::findOrFail($id);
        $repair->delete();

        return redirect()->back()->with('success', 'Repair deleted successfully!');
    }

    // ================= Transactions =================
    public function supervisorTransactions()
    {
        $transactions = Transaction::latest()->paginate(10);

        return view('supervisor.transactions', compact('transactions'));
    }

    // ================= Bookings =================
    public function viewBookings(Request $request)
    {
        // Rows per page (5, 10, 15)
        $perPage = $request->get('perPage', 10);

        $query = Booking::with(['client', 'service', 'technician']);

        // Filter by status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->from) {
            $query->whereDate('created_at', '>=', $request->from);
        }
        if ($request->to) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        $bookings = $query->orderBy('created_at', 'desc')->paginate($perPage);

        // Get all technicians for dropdown
        $technicians = Technician::all();

        return view('supervisor.view_bookings', compact('bookings', 'technicians'));
    }

    // SupervisorBookingController.php
public function assignTechnician(Request $request, $id)
{
    $booking = Booking::findOrFail($id);

    [$type, $assignedId] = explode('-', $request->assigned_id);

    $booking->assigned_type = $type;
    $booking->assigned_id = $assignedId;
    $booking->assigned_name = $type === 'technician'
        ? User::find($assignedId)->name
        : Team::find($assignedId)->full_name;

    $booking->save();

    return response()->json([
        'success' => true,
        'assigned_name' => $booking->assigned_name,
        'message' => 'Assigned successfully!'
    ]);
}


    public function sendNotification(Request $request, Booking $booking)
{
    $request->validate([
        'message' => 'required|string|max:255',
    ]);

    // Example: save notification in database
    $booking->notifications()->create([
        'message' => $request->message,
        'sent_at' => now(),
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Notification sent successfully'
    ]);
}
    public function deleteBooking(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('supervisor.view_bookings')->with('success', 'Booking deleted successfully!');
    }

    public function updateBookingStatus(Request $request, Booking $booking)
    {
        $request->validate(['status' => 'required|in:Pending,Confirmed,Cancelled']);
        $booking->update(['status' => $request->status]);

        return redirect()->route('supervisor.view_bookings')->with('success', 'Booking status updated!');
    }

    public function exportPdf()
    {
        $bookings = Booking::with('client', 'service', 'technician')->get();
        $pdf = Pdf::loadView('supervisor.view_bookings_pdf', compact('bookings'));

        return $pdf->download('bookings.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new BookingsExport, 'bookings.xlsx');
    }

public function supervisorBookings(Request $request)
{
    // Fetch all bookings with relationships
    $query = Booking::with(['client', 'service', 'technician'])->orderBy('id', 'desc');

    // Apply filters if provided
    if ($request->status) {
        $query->where('status', $request->status);
    }
    if ($request->from) {
        $query->whereDate('created_at', '>=', $request->from);
    }
    if ($request->to) {
        $query->whereDate('created_at', '<=', $request->to);
    }

    // Get all results as a Collection
    $bookings = $query->get(); // ✅ No paginator, no appends()

    // Get technicians and teams
    $technicians = User::where('role', 'Technician')->get();
    $teams = Team::all();

    // Return partial for AJAX
    if ($request->ajax()) {
        return view('supervisor.partials.bookings_table', compact('bookings', 'technicians', 'teams'))->render();
    }

    // Return full page view
    return view('supervisor.view_bookings', compact('bookings', 'technicians', 'teams'));
}

public function updateStatus(Request $request, Booking $booking)
{
    $request->validate([
        'status' => 'required|in:Pending,Confirmed,Cancelled',
    ]);

    $booking->status = $request->status;
    $booking->save();

    return response()->json([
        'success' => true,
        'message' => 'Booking status updated successfully'
    ]);
}

    public function clients()
    {
        return view('supervisor.clients');
    }

    public function meetings()
    {
        return view('supervisor.meetings');
    }

    public function stock()
    {
        return view('supervisor.stock');
    }

    public function reports()
    {
        return view('supervisor.reports');
    }
}
