

<div class="container">
    <h1>My Orders</h1>

    @if(session('success'))
        <div style="background: #d4edda; padding: 6px; margin-bottom: 10px; border-radius:5px; font-size: 13px;">
            {{ session('success') }}
        </div>
    @endif

    @if($orders->isEmpty())
        <p style="text-align:center; font-size:14px;">You have no orders yet.</p>
    @else
        @php $totalPrice = 0; @endphp
        <div style="overflow-x:auto; display:flex; justify-content:center;">
            <table style="width:auto; font-size:13px;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product ID</th>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Ordered At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $index => $order)
                        @php
                            $orderTotal = ($order->product->price ?? 0) * $order->quantity;
                            $totalPrice += $orderTotal;
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->product->name ?? 'N/A' }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>${{ number_format($orderTotal, 2) }}</td>
                            <td>{{ ucfirst($order->payment_method) }}</td>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <button type="button" class="btn btn-edit" 
                                    onclick="openEditModal({{ $order->id }}, '{{ $order->quantity }}', '{{ $order->payment_method }}', '{{ $order->status }}')">
                                    Edit
                                </button>
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this order?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top:10px; font-weight:bold; text-align:center;">
            Total Price: ${{ number_format($totalPrice, 2) }}
        </div>

        <form action="{{ route('orders.confirmAll') }}" method="POST" style="margin-top:10px; text-align:center;">
            @csrf
            <button type="submit" class="btn btn-edit" onclick="return confirm('Confirm all orders?')">Confirm Orders</button>
        </form>
    @endif

    <div style="margin-top:10px; text-align:center;">
        <a href="{{ url()->previous() }}" class="btn btn-delete" style="margin-right:5px;">Back</a>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-delete">Logout</button>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEditModal()">&times;</span>
        <h2 style="font-size:16px;">Edit Order</h2>
        <form id="editForm" method="POST" style="font-size:13px;">
            @csrf
            @method('PUT')
            <input type="hidden" name="order_id" id="editOrderId">

            <label for="quantity">Qty:</label>
            <input type="number" name="quantity" id="editQuantity" min="1" required>

            <label for="payment_method">Payment:</label>
            <select name="payment_method" id="editPaymentMethod" required>
                <option value="cash">Cash</option>
                <option value="card">Card</option>
            </select>

            <label for="status">Status:</label>
            <select name="status" id="editStatus" required>
                <option value="Pending">Pending</option>
                <option value="Approved">Approved</option>
                <option value="Delivered">Delivered</option>
            </select>

            <button type="submit" class="btn btn-edit" style="margin-top:5px;">Save</button>
            <button type="button" class="btn btn-delete" onclick="closeEditModal()">Cancel</button>
        </form>
    </div>
</div>

<style>
body { font-family: Arial, sans-serif; background: #f9f9f9; padding: 10px; margin: 0; }
.container { background: #fff; padding: 10px; border-radius: 8px; box-shadow: 0 1px 6px rgba(0,0,0,0.1); max-width: 100%; overflow-x: auto; }
h1 { text-align: center; color: #333; margin-bottom: 10px; font-size:18px; }
table { border-collapse: collapse; font-size:12px; min-width: 700px; }
thead { background: #007bff; color: white; }
th, td { padding: 6px 8px; text-align: left; white-space: nowrap; }
tr:nth-child(even) { background: #f2f2f2; }
.btn { padding: 4px 8px; border-radius: 4px; font-size:11px; display: inline-block; cursor: pointer; border: none; }
.btn-edit { background: #ffc107; color: black; }
.btn-edit:hover { background: #e0a800; }
.btn-delete { background: #dc3545; color: white; }
.btn-delete:hover { background: #c82333; }
.modal { display: none; position: fixed; z-index: 999; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); justify-content: center; align-items: center; }
.modal-content { background: #fff; padding: 15px; border-radius: 6px; max-width: 350px; width: 90%; position: relative; }
.close { position: absolute; right: 8px; top: 8px; font-size: 16px; cursor: pointer; }
.modal label { display: block; margin-top: 6px; }
.modal input, .modal select { width: 100%; padding: 6px; margin-top: 3px; border: 1px solid #ccc; border-radius: 4px; }
@media screen and (max-width: 768px) {
    table { font-size: 11px; }
    .btn { font-size: 10px; padding: 3px 6px; }
}
</style>

<script>
function openEditModal(id, quantity, paymentMethod, status) {
    document.getElementById('editOrderId').value = id;
    document.getElementById('editQuantity').value = quantity;
    document.getElementById('editPaymentMethod').value = paymentMethod;
    document.getElementById('editStatus').value = status;

    const form = document.getElementById('editForm');
    form.action = `/orders/${id}`;

    document.getElementById('editModal').style.display = 'flex';
}

function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}

window.onclick = function(event) {
    if (event.target === document.getElementById('editModal')) {
        closeEditModal();
    }
}
</script>
