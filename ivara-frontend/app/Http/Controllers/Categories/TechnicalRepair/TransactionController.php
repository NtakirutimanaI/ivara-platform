<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Activity;
use App\Events\ActivityCreated;

class TransactionController extends Controller
{
    // -------------------- Transaction Methods --------------------

    /**
     * Display daily transactions page for admin
     */
    public function index()
    {
        // Log activity
        $activity = Activity::create([
            'message' => 'Daily transactions page viewed by admin',
            'icon' => 'fas fa-box',
        ]);

        broadcast(new ActivityCreated($activity))->toOthers();

        return view('admin.daily-transactions');
    }

    /**
     * Display daily transactions page for manager
     */
    public function daily()
    {
        $activity = Activity::create([
            'message' => 'Daily transactions page viewed by manager',
            'icon' => 'fas fa-box',
        ]);

        broadcast(new ActivityCreated($activity))->toOthers();

        return view('manager.daily-transactions');
    }

    /**
     * Display daily transactions page for supervisor
     */
    public function supervisorTransactions()
    {
        $activity = Activity::create([
            'message' => 'Daily transactions page viewed by supervisor',
            'icon' => 'fas fa-box',
        ]);

        broadcast(new ActivityCreated($activity))->toOthers();

        return view('supervisor.daily-transactions');
    }

    /**
     * Store a new transaction
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'type'      => 'required|in:payment,refund',
            'amount'    => 'required|numeric|min:0',
            'status'    => 'required|in:pending,completed',
        ]);

        $transaction = Transaction::create($request->only(['client_id', 'type', 'amount', 'status']));

        // Log activity
        $activity = Activity::create([
            'message' => 'New transaction added: ' . $transaction->type . ' for client ID ' . $transaction->client_id,
            'icon'    => 'fas fa-credit-card',
        ]);

        broadcast(new ActivityCreated($activity))->toOthers();

        return redirect()->back()->with('success', 'Transaction added successfully.');
    }
}
