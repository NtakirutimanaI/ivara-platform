@include('layouts.header')
@include('layouts.sidebar')
@include('client.connect')

<style>
/* Container */
.updates-report-body {
    font-family: 'DejaVu Sans', sans-serif;
    font-size: 14px;
    margin-top: 100px;
    margin-left: 240px;
    width: 80%;
    padding: 20px;
    background-color: #f8fafc;
    color: #333;
    box-sizing: border-box;
}

/* Header */
.updates-report-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 3px solid #4f46e5;
    padding-bottom: 10px;
    margin-bottom: 20px;
}

.updates-report-title {
    font-size: 28px;
    font-weight: bold;
    color: #4f46e5;
}

.back-button {
    background-color: #10b981;
    color: #fff;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    text-decoration: none;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.back-button:hover {
    background-color: #059669;
}

/* Table */
.updates-report-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.updates-report-table th,
.updates-report-table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #ccc;
}

.updates-report-table th {
    background-color: #4f46e5;
    color: #fff;
    font-weight: 600;
    text-align: left;
}

.updates-report-table tbody tr:hover {
    background-color: #f1f5f9;
}

.updates-report-table tfoot th {
    font-size: 1.2rem;
    font-weight: 600;
    text-align: right;
    padding-top: 15px;
}

/* Manage buttons */
.btn-manage {
    margin-right: 5px;
    padding: 5px 10px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    color: #fff;
    font-weight: 500;
}

.btn-view { background-color: #3b82f6; }
.btn-view:hover { background-color: #1e40af; }

.btn-edit { background-color: #f59e0b; }
.btn-edit:hover { background-color: #b45309; }

.btn-delete { background-color: #ef4444; }
.btn-delete:hover { background-color: #b91c1c; }

/* Modal */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.5);
}

.modal-content {
    background-color: #fff;
    margin: 10% auto;
    padding: 20px;
    border-radius: 8px;
    width: 400px;
    max-width: 90%;
    position: relative;
}

.modal-close {
    position: absolute;
    right: 15px;
    top: 10px;
    font-size: 20px;
    cursor: pointer;
    font-weight: bold;
}

/* Form */
form.updates-form {
    display: flex;
    flex-direction: column;
    gap: 10px;
    max-width: 300px;
    margin-top: 15px;
}

form.updates-form label {
    font-weight: 600;
    margin-bottom: 5px;
}

form.updates-form select.form-select {
    padding: 0.5rem 0.75rem;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 6px;
    outline: none;
    transition: border-color 0.3s ease;
}

form.updates-form select.form-select:focus {
    border-color: #4f46e5;
}

form.updates-form button {
    background-color: #4f46e5;
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 0.5rem 1.5rem;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

form.updates-form button:hover {
    background-color: #0A1128;
    transform: scale(1.05);
}

/* Empty cart message */
.updates-report-body p {
    font-size: 1rem;
    color: #6b7280;
}

.updates-report-body a {
    color: #4f46e5;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease;
}

.updates-report-body a:hover {
    color: #0A1128;
}

/* Responsive adjustments */
@media (max-width: 767px) {
    .updates-report-body {
        margin-left: 10px;
        width: 95%;
    }

    .updates-report-table th,
    .updates-report-table td {
        padding: 10px;
        font-size: 0.9rem;
    }

    form.updates-form {
        max-width: 100%;
    }
}
</style>

<div class="updates-report-body">
    <div class="updates-report-header">
        <div class="updates-report-title">Checkout</div>
        <a href="{{ route('client.checkout') }}" class="back-button">Back to Products</a>
    </div>

    @if(session('cart') && count(session('cart')) > 0)
    <table class="updates-report-table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price (FRW)</th>
                <th>Quantity</th>
                <th>Subtotal (FRW)</th>
                <th>Manage</th>
            </tr>
        </thead>
        <tbody>
            @php 
                $total = 0; 
            @endphp
            @foreach(session('cart') as $id => $details)
                @php 
                    $subtotal = $details['price'] * $details['quantity']; 
                @endphp
                <tr>
                    <td>{{ $details['name'] }}</td>
                    <td>{{ number_format($details['price'],2) }}</td>
                    <td>{{ $details['quantity'] }}</td>
                    <td>{{ number_format($subtotal,2) }}</td>
                    <td>
                        <button class="btn-manage btn-view" onclick="openModal('view-{{ $id }}')">View</button>
                        <button class="btn-manage btn-edit" onclick="openModal('edit-{{ $id }}')">Edit</button>
                        <button class="btn-manage btn-delete" onclick="openModal('delete-{{ $id }}')">Delete</button>
                    </td>
                </tr>

                {{-- View Modal --}}
                <div id="view-{{ $id }}" class="modal">
                    <div class="modal-content">
                        <span class="modal-close" onclick="closeModal('view-{{ $id }}')">&times;</span>
                        <h3>View Product</h3>
                        <p><strong>Name:</strong> {{ $details['name'] }}</p>
                        <p><strong>Price:</strong> {{ number_format($details['price'],2) }} FRW</p>
                        <p><strong>Quantity:</strong> {{ $details['quantity'] }}</p>
                        <p><strong>Subtotal:</strong> {{ number_format($subtotal,2) }} FRW</p>
                    </div>
                </div>

                {{-- Edit Modal --}}
                <div id="edit-{{ $id }}" class="modal">
                    <div class="modal-content">
                        <span class="modal-close" onclick="closeModal('edit-{{ $id }}')">&times;</span>
                        <h3>Edit Product Quantity</h3>
                        <form action="{{ route('client.update_cart', $id) }}" method="POST" class="updates-form">
                            @csrf
                            <label>Quantity</label>
                            <input type="number" name="quantity" min="1" value="{{ $details['quantity'] }}" class="form-control" required>
                            <button type="submit">Update</button>
                        </form>
                    </div>
                </div>

                {{-- Delete Modal --}}
                <div id="delete-{{ $id }}" class="modal">
                    <div class="modal-content">
                        <span class="modal-close" onclick="closeModal('delete-{{ $id }}')">&times;</span>
                        <h3>Delete Product</h3>
                        <p>Are you sure you want to remove <strong>{{ $details['name'] }}</strong> from the cart?</p>
                        <form action="{{ route('client.remove_cart', $id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Yes, Delete</button>
                        </form>
                    </div>
                </div>

                @php $total += $subtotal; @endphp
            @endforeach
        </tbody>
        <tfoot>
            @php
                $tax = $total * 0.18; // 18% tax
                $net = $total + $tax;
            @endphp
            <tr>
                <th colspan="4" class="text-end">Net Amount:</th>
                <th>{{ number_format($total,2) }} FRW</th>
            </tr>
            <tr>
                <th colspan="4" class="text-end">Tax (18%):</th>
                <th>{{ number_format($tax,2) }} FRW</th>
            </tr>
            <tr>
                <th colspan="4" class="text-end">Total Amount:</th>
                <th>{{ number_format($net,2) }} FRW</th>
            </tr>
        </tfoot>
    </table>

    <form action="{{ route('client.confirm_payment') }}" method="POST" class="updates-form">
        @csrf
        <label>Choose Payment Method</label>
        <select name="method" class="form-select" required>
            <option value="">-- Select Payment Method --</option>
            <option value="cash">Cash</option>
            <option value="mtn_momo">MTN MoMo</option>
            <option value="airtel_money">Airtel Money</option>
            <option value="card">Bank/Card</option>
            <option value="bank_transfer">Bank Transfer</option>
        </select>
        <button type="submit" class="btn btn-success">Confirm Payment</button>
    </form>

    @else
        <p>Your cart is empty. <a href="{{ route('client.checkout') }}">Go back to products</a></p>
    @endif
</div>

<script>
function openModal(id) {
    document.getElementById(id).style.display = 'block';
}

function closeModal(id) {
    document.getElementById(id).style.display = 'none';
}

// Close modal on outside click
window.onclick = function(event) {
    let modals = document.querySelectorAll('.modal');
    modals.forEach(function(modal){
        if(event.target == modal){
            modal.style.display = "none";
        }
    });
}
</script>

@include('layouts.footer')
