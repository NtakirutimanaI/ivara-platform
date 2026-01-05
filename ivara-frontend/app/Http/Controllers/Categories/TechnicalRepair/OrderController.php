<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Models\Product;
use App\Models\Activity;
use App\Events\ActivityCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the authenticated user's orders.
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('product')
            ->latest()
            ->get();

        // Broadcast activity
        $activity = Activity::create([
            'message' => 'User viewed their orders page.',
            'icon' => 'fas fa-shopping-cart',
        ]);
        broadcast(new ActivityCreated($activity))->toOthers();

        return view('web.orders', compact('orders'));
    }

    /**
     * Store a newly created order.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id'     => 'required|exists:products,id',
            'quantity'       => 'required|integer|min:1',
            'payment_method' => 'required|string|in:cash,card',
        ]);

        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;
        $totalAmount = $product->price * $quantity;

        // Create order with total and amount
        $order = Order::create([
            'user_id'        => Auth::id(),
            'product_id'     => $product->id,
            'quantity'       => $quantity,
            'payment_method' => $request->payment_method,
            'status'         => 'Pending',
            'total'          => $totalAmount,
            'amount'         => $totalAmount,
            'total_amount'   => $totalAmount,
        ]);

        // Broadcast activity
        $activity = Activity::create([
            'message' => 'New order placed: ' . $product->name,
            'icon' => 'fas fa-box',
        ]);
        broadcast(new ActivityCreated($activity))->toOthers();

        if ($request->ajax()) {
            return response()->json([
                'success'      => true,
                'order_id'     => $order->id,
                'product_name' => $product->name,
                'quantity'     => $quantity,
                'total'        => $totalAmount,
                'amount'       => $totalAmount,
            ]);
        }

        return redirect()->back()->with('success', 'Order placed successfully.');
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit($id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity'       => 'required|integer|min:1',
            'payment_method' => 'required|in:cash,card',
            'status'         => 'required|in:Pending,Approved,Delivered',
        ]);

        $order = Order::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $totalAmount = $order->product->price * $request->quantity;

        $order->update([
            'quantity'       => $request->quantity,
            'payment_method' => $request->payment_method,
            'status'         => $request->status,
            'total'          => $totalAmount,
            'amount'         => $totalAmount,
            'total_amount'   => $totalAmount,
        ]);

        // Broadcast activity
        $activity = Activity::create([
            'message' => 'Order #' . $order->id . ' updated by user.',
            'icon' => 'fas fa-edit',
        ]);
        broadcast(new ActivityCreated($activity))->toOthers();

        if ($request->ajax()) {
            return response()->json(['success' => true, 'order' => $order]);
        }

        return redirect()->route('web.orders')->with('success', 'All orders confirmed successfully!');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy($id, Request $request)
    {
        $order = Order::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $order->delete();

        // Broadcast activity
        $activity = Activity::create([
            'message' => 'Order #' . $id . ' deleted by user.',
            'icon' => 'fas fa-trash',
        ]);
        broadcast(new ActivityCreated($activity))->toOthers();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('web.orders')->with('success', 'All orders confirmed successfully!');

    }

    /**
     * Mark an order as delivered.
     */
    public function confirmDelivery($id, Request $request)
    {
        $order = Order::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($order->status !== 'Approved') {
            if ($request->ajax()) {
                return response()->json(['error' => 'Order not approved yet'], 400);
            }
            return back()->with('error', 'Order not approved yet.');
        }

        $order->status = 'Delivered';
        $order->save();

        // Broadcast activity
        $activity = Activity::create([
            'message' => 'Order #' . $order->id . ' marked as delivered.',
            'icon' => 'fas fa-truck',
        ]);
        broadcast(new ActivityCreated($activity))->toOthers();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('web.orders')->with('success', 'All orders confirmed successfully!');
    }

    /**
     * Confirm all user orders and delete them.
     */
    public function confirmAll()
    {
        $userOrders = Order::where('user_id', Auth::id())->get();

        foreach ($userOrders as $order) {
            $order->status = 'Confirmed';
            $order->save();

            // Broadcast each confirmed order
            $activity = Activity::create([
                'message' => 'Order #' . $order->id . ' confirmed by user.',
                'icon' => 'fas fa-check',
            ]);
            broadcast(new ActivityCreated($activity))->toOthers();
        }

        // Delete all orders after confirmation
        Order::where('user_id', Auth::id())->delete();

        return redirect()->route('web.orders')->with('success', 'All orders confirmed successfully!');
    }
}
