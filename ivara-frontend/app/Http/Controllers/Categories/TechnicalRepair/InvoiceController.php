<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Client;
use App\Models\Activity;
use App\Events\ActivityCreated;
use Illuminate\Support\Facades\DB;
use PDF; // Make sure barryvdh/laravel-dompdf is installed

class InvoiceController extends Controller
{
    /**
     * Show invoice creation page
     */
    public function index()
    {
        $products = Product::all();
        $clients = Client::all(); // Fetch clients for dropdown
        return view('admin.invoices_payments', compact('products', 'clients'));
    }

    /**
     * Optional: Show invoice creation form (alias to index)
     */
    public function create()
    {
        $products = Product::all();
        $clients = Client::all();
        return view('admin.invoices_payments', compact('products', 'clients'));
    }

    /**
     * Store invoice, items, and payment
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'nullable|exists:clients,id',
            'products' => 'required|array|min:1',
            'qty' => 'required|array|min:1',
            'price' => 'required|array|min:1',
            'payment_method' => 'required|in:cash,mtn_momo,airtel_money,card,bank,other',
        ]);

        DB::beginTransaction();

        try {
            // Calculate totals
            $subtotal = 0;
            foreach ($request->qty as $index => $qty) {
                $subtotal += $qty * $request->price[$index];
            }
            $tax = $subtotal * 0.18;
            $grandTotal = $subtotal + $tax;

            // Generate unique invoice number
            $invoiceNumber = 'INV-' . date('Ymd') . '-' . str_pad(Invoice::count() + 1, 4, '0', STR_PAD_LEFT);

            // Create Invoice
            $invoice = Invoice::create([
                'client_id' => $request->client_id ?? null,
                'number' => $invoiceNumber,
                'status' => 'issued',
                'subtotal' => $subtotal,
                'discount_total' => 0,
                'tax_total' => $tax,
                'grand_total' => $grandTotal,
                'amount_due' => $grandTotal,
                'due_date' => $request->due_date ?? null,
            ]);

            // Create Invoice Items
            foreach ($request->products as $index => $productId) {
                $qty = $request->qty[$index];
                $price = $request->price[$index];
                $productName = Product::find($productId)->name ?? 'Product';

                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'product_id' => $productId,
                    'description' => $productName,
                    'qty' => $qty,
                    'unit_price' => $price,
                    'line_total' => $qty * $price,
                ]);
            }

            // Create Payment
            Payment::create([
                'invoice_id' => $invoice->id,
                'method' => $request->payment_method,
                'amount' => $grandTotal,
                'status' => 'success',
                'paid_at' => now(),
                'meta' => null,
            ]);

            // -------------------------------
            // Broadcast activity
            // -------------------------------
            $activity = Activity::create([
                'message' => 'New invoice created: ' . $invoiceNumber,
                'icon'    => 'fas fa-file-invoice',
            ]);

            broadcast(new ActivityCreated($activity))->toOthers();

            DB::commit();

            return redirect()->route('invoices.index')
                             ->with('success', "Invoice #$invoiceNumber created successfully.");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Print / Download Invoice PDF
     */
    public function print(Invoice $invoice)
    {
        $invoice->load('invoiceItems.product', 'client');

        $pdf = PDF::loadView('admin.invoices_pdf', compact('invoice'));
        return $pdf->download($invoice->number . '.pdf');
    }
}
