<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\ProductService;
use App\Models\ClientService;
use App\Models\User; // Technicians & Clients

class ManagerBookingServiceController extends Controller
{
    /**
     * Manager Dashboard view
     */
    public function index()
    {
        $bookings = Booking::with(['client', 'service', 'technician'])->get();
        $technicians = User::role('technician')->get();
        $clients = User::role('client')->get(); // Needed for assigning client_id

        $productsServices = ProductService::all();
        $clientServices = ClientService::with(['client', 'service'])->get();

        return view('manager.bookings.index', compact(
            'bookings',
            'technicians',
            'productsServices',
            'clientServices',
            'clients'
        ));
    }

    // ===== BOOKINGS =====
    public function assignTechnician(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'technician_id' => 'required|exists:users,id'
        ]);

        $booking = Booking::find($request->booking_id);
        $booking->technician_id = $request->technician_id;
        $booking->status = 'in_progress';
        $booking->save();

        return redirect()->route('manager.bookings.index')->with('success', 'Technician assigned!');
    }

    public function updateBookingStatus(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'status' => 'required|string'
        ]);

        $booking = Booking::find($request->booking_id);
        $booking->status = $request->status;
        $booking->save();

        return redirect()->route('manager.bookings.index')->with('success', 'Booking status updated!');
    }

    // ===== PRODUCTS/SERVICES =====
    public function storeProductService(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'type' => 'required|in:product,service',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'client_id' => 'required|exists:users,id' // NEW: validate client
        ]);

        ProductService::create([
            'title' => $request->title,
            'type' => $request->type,
            'price' => $request->price,
            'description' => $request->description,
            'client_id' => $request->client_id, // MUST provide client_id
            'published' => 0, // default
            'status' => 'Active'
        ]);

        return redirect()->route('manager.bookings.index')->with('success', 'Product/Service created!');
    }

    public function updateProductService(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products_services,id',
            'title' => 'required|string',
            'price' => 'required|numeric'
        ]);

        $product = ProductService::find($request->id);
        $product->update($request->only('title','price','description','status'));
        return redirect()->route('manager.bookings.index')->with('success', 'Product/Service updated!');
    }

    public function togglePublish(Request $request)
    {
        $request->validate(['id' => 'required|exists:products_services,id']);

        $product = ProductService::find($request->id);
        $product->published = !$product->published;
        $product->save();

        return redirect()->route('manager.bookings.index')->with('success','Publish status updated!');
    }

    public function deleteProductService(Request $request)
    {
        $request->validate(['id' => 'required|exists:products_services,id']);

        ProductService::find($request->id)->delete();
        return redirect()->route('manager.bookings.index')->with('success','Deleted successfully!');
    }

    // ===== CLIENT SERVICES =====
    public function updateClientServiceStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:client_services,id',
            'status' => 'required|in:pending,in_progress,completed,canceled'
        ]);

        $cs = ClientService::find($request->id);
        $cs->status = $request->status;
        $cs->save();

        return redirect()->route('manager.bookings.index')->with('success','Client Service status updated!');
    }
}
