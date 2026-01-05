<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use App\Models\Client;
use App\Models\Repair;
use App\Models\Purchase;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class HistoryClientController extends Controller
{

    /**
     * Show client history page
     */
    public function clientIndex(Request $request, $clientId = null)
{
    if (!$clientId) {
        abort(404, 'Client ID is required.');
    }

    $client = Client::with([
        'repairs' => fn($q) => $q->latest()->limit(200),
        'purchases' => fn($q) => $q->latest()->limit(200),
        'bookings' => fn($q) => $q->latest()->limit(200),
        'payments' => fn($q) => $q->latest()->limit(200),
        'notifications' => fn($q) => $q->latest()->limit(200),
    ])->findOrFail($clientId);

    $dateFrom = $request->query('from');
    $dateTo = $request->query('to');

    return view('client.history', compact('client', 'dateFrom', 'dateTo'))
        ->with('success', 'Client history loaded successfully.');
}

    public function index(Request $request, $clientId)
    {
        $client = Client::with([
            'repairs'        => fn($q) => $q->latest()->limit(200),
            'purchases'      => fn($q) => $q->latest()->limit(200),
            'bookings'       => fn($q) => $q->latest()->limit(200),
            'payments'       => fn($q) => $q->latest()->limit(200),
            'notifications'  => fn($q) => $q->latest()->limit(200),
        ])->findOrFail($clientId);

        $dateFrom = $request->query('from');
        $dateTo   = $request->query('to');

        return view('client.history', compact('client', 'dateFrom', 'dateTo'))
            ->with('success', 'Client history loaded successfully.');
    }

    /**
     * Repairs JSON endpoint
     */
    public function repairsJson(Request $request, $clientId)
    {
        try {
            $q = Repair::where('client_id', $clientId);

            if ($request->filled('status')) {
                $q->where('repair_status', $request->status);
            }
            if ($request->filled('from')) {
                $q->whereDate('received_date', '>=', $request->from);
            }
            if ($request->filled('to')) {
                $q->whereDate('received_date', '<=', $request->to);
            }

            $repairs = $q->orderBy('received_date', 'desc')->paginate(10);

            return response()->json([
                'success' => true,
                'message' => 'Repairs fetched successfully.',
                'data'    => $repairs
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch repairs.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Purchases JSON endpoint
     */
    public function purchasesJson(Request $request, $clientId)
    {
        try {
            $q = Purchase::with('product')->where('client_id', $clientId);

            if ($request->filled('from')) {
                $q->whereDate('purchase_date', '>=', $request->from);
            }
            if ($request->filled('to')) {
                $q->whereDate('purchase_date', '<=', $request->to);
            }

            $purchases = $q->orderBy('purchase_date', 'desc')->paginate(10);

            return response()->json([
                'success' => true,
                'message' => 'Purchases fetched successfully.',
                'data'    => $purchases
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch purchases.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bookings JSON endpoint
     */
    public function bookingsJson(Request $request, $clientId)
    {
        try {
            $q = Booking::where('client_id', $clientId);

            if ($request->filled('status')) {
                $q->where('status', $request->status);
            }

            $bookings = $q->orderBy('preferred_date', 'desc')->paginate(10);

            return response()->json([
                'success' => true,
                'message' => 'Bookings fetched successfully.',
                'data'    => $bookings
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch bookings.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Payments JSON endpoint
     */
    public function paymentsJson(Request $request, $clientId)
    {
        try {
            $q = Payment::where('client_id', $clientId);

            if ($request->filled('status')) {
                $q->where('status', $request->status);
            }

            $payments = $q->orderBy('paid_at', 'desc')->paginate(10);

            return response()->json([
                'success' => true,
                'message' => 'Payments fetched successfully.',
                'data'    => $payments
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch payments.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mark notifications as read
     */
    public function notificationsMarkRead(Request $request, $clientId)
    {
        try {
            $ids = $request->input('ids', []);
            Notification::where('client_id', $clientId)
                ->whereIn('id', $ids)
                ->update(['is_read' => 1]);

            return response()->json([
                'success' => true,
                'message' => 'Notifications marked as read.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update notifications.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Export history to PDF or Excel
     */
    public function exportHistory(Request $request, $clientId, $format = 'pdf')
    {
        try {
            $client = Client::with([
                'repairs', 'purchases', 'bookings', 'payments', 'notifications'
            ])->findOrFail($clientId);

            if ($format === 'excel') {
                return Excel::download(
                    new \App\Exports\ClientHistoryExport($client),
                    "client-{$clientId}-history.xlsx"
                );
            }

            if ($format === 'pdf') {
                $pdf = PDF::loadView('client.exports.history_pdf', compact('client'));
                return $pdf->download("client-{$clientId}-history.pdf");
            }

            return back()->with('error', 'Unsupported export format.');
        } catch (\Exception $e) {
            return back()->with('error', 'Export failed: ' . $e->getMessage());
        }
    }
}
