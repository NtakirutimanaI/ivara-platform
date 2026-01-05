<!-- ===== Client Modals Partial ===== -->
<!-- $client variable must be passed when including this partial -->

<!-- View Modal -->
<div id="viewModal-{{ $client->id }}" class="modal hidden">
    <div class="modal-content">
        <h3>Client Details</h3>
        <p><strong>Name:</strong> {{ $client->name }}</p>
        <p><strong>Email:</strong> {{ $client->email }}</p>
        <p><strong>Phone:</strong> {{ $client->phone }}</p>
        <p><strong>Subscription:</strong> {{ ucfirst($client->subscription) }}</p>
        <p><strong>Status:</strong> {{ ucfirst($client->status) }}</p>

        <!-- Client Transactions -->
        <h4>Products</h4>
        <ul>
            @foreach($client->products as $product)
                <li>{{ $product->name }} - Qty: {{ $product->pivot->quantity }} - Price: {{ $product->pivot->price }}</li>
            @endforeach
            @if($client->products->isEmpty()) <li>No products found.</li> @endif
        </ul>

        <h4>Orders</h4>
        <ul>
            @foreach($client->orders as $order)
                <li>Order #{{ $order->id }} - Status: {{ $order->status }} - Total: {{ $order->total_amount }}</li>
            @endforeach
            @if($client->orders->isEmpty()) <li>No orders found.</li> @endif
        </ul>

        <h4>Payments</h4>
        <ul>
            @foreach($client->payments as $payment)
                <li>Payment #{{ $payment->id }} - Amount: {{ $payment->amount }} - Method: {{ $payment->method }}</li>
            @endforeach
            @if($client->payments->isEmpty()) <li>No payments found.</li> @endif
        </ul>

        <h4>Bookings</h4>
        <ul>
            @foreach($client->bookings as $booking)
                <li>Booking #{{ $booking->id }} - Date: {{ $booking->date }} - Status: {{ $booking->status }}</li>
            @endforeach
            @if($client->bookings->isEmpty()) <li>No bookings found.</li> @endif
        </ul>

        <button class="close-btn" onclick="closeModal('viewModal-{{ $client->id }}')">Close</button>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal-{{ $client->id }}" class="modal hidden">
    <div class="modal-content">
        <h3>Edit Client</h3>
        <form method="POST" action="{{ route('manager.clients.update', $client->id) }}">
            @csrf
            @method('PUT')
            <input type="text" name="name" value="{{ $client->name }}">
            <input type="email" name="email" value="{{ $client->email }}">
            <input type="text" name="phone" value="{{ $client->phone }}">
            <select name="subscription">
                <option {{ $client->subscription=='monthly' ? 'selected':'' }}>Monthly</option>
                <option {{ $client->subscription=='yearly' ? 'selected':'' }}>Yearly</option>
            </select>
            <button type="submit" class="btn-save">Save</button>
            <button type="button" class="close-btn" onclick="closeModal('editModal-{{ $client->id }}')">Cancel</button>
        </form>
    </div>
</div>

<!-- Status Modal -->
<div id="statusModal-{{ $client->id }}" class="modal hidden">
    <div class="modal-content">
        <h3>Change Status</h3>
        <p>Are you sure you want to {{ $client->status=='active' ? 'deactivate' : 'activate' }} this client?</p>
        <form method="POST" action="{{ route('manager.clients.status', $client->id) }}">
            @csrf
            <button type="submit" class="btn-status-action">Yes</button>
            <button type="button" class="close-btn" onclick="closeModal('statusModal-{{ $client->id }}')">Cancel</button>
        </form>
    </div>
</div>

<!-- Notify Modal -->
<div id="notifyModal-{{ $client->id }}" class="modal hidden">
    <div class="modal-content">
        <h3>Send Notification</h3>
        <form method="POST" action="{{ route('manager.clients.notify', $client->id) }}">
            @csrf
            <textarea name="message" placeholder="Enter your message"></textarea>
            <button type="submit" class="btn-notify-send">Send</button>
            <button type="button" class="close-btn" onclick="closeModal('notifyModal-{{ $client->id }}')">Cancel</button>
        </form>
    </div>
</div>

<!-- Invoice Modal -->
<div id="invoiceModal-{{ $client->id }}" class="modal hidden">
    <div class="modal-content">
        <h3>Generate Invoice</h3>
        <form method="POST" action="{{ route('manager.clients.invoice', $client->id) }}">
            @csrf
            <input type="number" name="amount" placeholder="Amount">
            <input type="text" name="description" placeholder="Description">
            <button type="submit" class="btn-invoice-generate">Generate</button>
            <button type="button" class="close-btn" onclick="closeModal('invoiceModal-{{ $client->id }}')">Cancel</button>
        </form>
    </div>
</div>
