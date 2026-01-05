@include('layouts.header')
@include('layouts.sidebar')

<div class="mechanic-payments-body">
    <h2>Payments & Invoices</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <!-- Create Invoice Button -->
    <button class="btn-primary" onclick="openServiceModal()">+ Create Invoice</button>
</div>

<!-- Service Modal -->
<div id="serviceModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeServiceModal()">&times;</span>
        <h3>Create Invoice - Service Details</h3>
        <form id="serviceForm" action="{{ route('mechanic.services.store') }}" method="POST" onsubmit="nextToPayment(event)">
            @csrf
            <input type="text" name="name" placeholder="Service Name" required>
            <textarea name="description" placeholder="Description"></textarea>
            <input type="number" step="0.01" name="price" placeholder="Price" required>
            <input type="text" name="duration" placeholder="Duration">
            <input type="text" name="available_time" placeholder="Available Time">
            <input type="text" name="category" placeholder="Category">
            <button type="submit" class="btn-primary">Save & Continue</button>
        </form>
    </div>
</div>

<!-- Payment Modal -->
<div id="paymentModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closePaymentModal()">&times;</span>
        <h3>Make Payment</h3>
        <form action="{{ route('mechanic.payments.make') }}" method="POST">
            @csrf
            <input type="number" step="0.01" name="payment_amount" placeholder="Enter Amount" required>
            <select name="method" required>
                <option value="">Select Payment Method</option>
                <option value="cash">Cash</option>
                <option value="mtn_momo">MTN Momo</option>
                <option value="airtel_money">Airtel Money</option>
                <option value="card">Card</option>
                <option value="bank">Bank Transfer</option>
            </select>
            <button type="submit" class="btn-primary">Pay</button>
        </form>
    </div>
</div>

<style>
.mechanic-payments-body {
    width: 80%;
    margin-left: 240px;
    margin-top: 40px;
    font-family: 'Segoe UI', sans-serif;
}
.mechanic-payments-body h2 { margin-bottom: 20px; color: #2c3e50; }
.btn-primary { background: #3498db; color: #fff; padding: 10px 18px; border: none; border-radius: 6px; cursor: pointer; margin-bottom: 10px; }
.btn-primary:hover { background: #2980b9; }
.modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); }
.modal-content { background: #fff; margin: 10% auto; padding: 20px; border-radius: 10px; width: 90%; max-width: 500px; }
.close { float: right; font-size: 20px; cursor: pointer; color: #aaa; }
.close:hover { color: #000; }
.alert-success { background: #d4edda; color: #155724; padding: 10px; border-radius: 6px; margin-bottom: 20px; }
@media (max-width: 768px) {
    .mechanic-payments-body { width: 95%; margin: 20px auto; }
}
</style>

<script>
function openServiceModal() { document.getElementById('serviceModal').style.display = 'block'; }
function closeServiceModal() { document.getElementById('serviceModal').style.display = 'none'; }
function openPaymentModal() { document.getElementById('paymentModal').style.display = 'block'; }
function closePaymentModal() { document.getElementById('paymentModal').style.display = 'none'; }

// After service form is submitted, close service modal and open payment modal
function nextToPayment(event) {
    event.preventDefault();
    const form = document.getElementById('serviceForm');
    form.submit();
    closeServiceModal();
    setTimeout(() => openPaymentModal(), 500); // open payment modal shortly after saving service
}
</script>
