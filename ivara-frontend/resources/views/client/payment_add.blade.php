@include('layouts.header')
@include('layouts.sidebar')
@include('client.connect')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

<div class="container client-container">
    <h2 class="text-center mb-5 text-primary">Add Payment Method / Process Payment</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)<li><i class="fa fa-exclamation-circle me-1"></i>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('subscription.payment.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="form-label fw-bold">Select Payment Method</label>
            <select name="method" id="payment-method" class="form-select form-select-lg" required>
                <option value="">-- Choose Method --</option>
                <option value="cash">Cash</option>
                <option value="mtn_momo">MTN MoMo</option>
                <option value="airtel_money">Airtel Money</option>
                <option value="card">Card Payment</option>
                <option value="bank">Bank Transfer</option>
            </select>
        </div>

        <div id="payment-details">

            <!-- Cash -->
            <div class="payment-cash d-none payment-card cash-card p-4 mb-4">
                <div class="d-flex align-items-center mb-3">
                    <i class="fa-solid fa-money-bill-wave fa-2x me-3"></i>
                    <h5 class="mb-0">Cash Payment</h5>
                </div>
                <p class="text-light">Pay directly at our office. Bring the exact amount to complete the transaction.</p>
                <div class="mb-3">
                    <label class="form-label fw-bold text-light">Amount (FRW)</label>
                    <input type="number" name="payment_amount" class="form-control form-control-lg" placeholder="Enter Amount" required>
                </div>
            </div>

            <!-- MTN MoMo -->
            <div class="payment-mtn_momo d-none payment-card mtn-card p-4 mb-4">
                <div class="d-flex align-items-center mb-3">
                    <i class="fa-solid fa-mobile-screen fa-2x me-3"></i>
                    <h5 class="mb-0 text-light">MTN Mobile Money</h5>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold text-light">Phone Number</label>
                    <input type="text" name="mtn_phone" class="form-control form-control-lg" placeholder="07XXXXXXXX" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold text-light">Amount (FRW)</label>
                    <input type="number" name="payment_amount" class="form-control form-control-lg" placeholder="Enter Amount" required>
                </div>
            </div>

            <!-- Airtel Money -->
            <div class="payment-airtel_money d-none payment-card airtel-card p-4 mb-4">
                <div class="d-flex align-items-center mb-3">
                    <i class="fa-solid fa-mobile-screen fa-2x me-3"></i>
                    <h5 class="mb-0 text-light">Airtel Money</h5>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold text-light">Phone Number</label>
                    <input type="text" name="airtel_phone" class="form-control form-control-lg" placeholder="07XXXXXXXX" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold text-light">Amount (FRW)</label>
                    <input type="number" name="payment_amount" class="form-control form-control-lg" placeholder="Enter Amount" required>
                </div>
            </div>

            <!-- Card -->
            <div class="payment-card d-none payment-card bank-card p-4 mb-4">
                <div class="d-flex align-items-center mb-3">
                    <i class="fa-solid fa-credit-card fa-2x me-3"></i>
                    <h5 class="mb-0 text-light">Card Payment</h5>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold text-light">Card / Bank Name</label>
                    <input type="text" name="card_bank" class="form-control form-control-lg" placeholder="Bank or Card Name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold text-light">Last 4 Digits</label>
                    <input type="text" name="last_four" class="form-control form-control-lg" maxlength="4" placeholder="XXXX" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold text-light">Amount (FRW)</label>
                    <input type="number" name="payment_amount" class="form-control form-control-lg" placeholder="Enter Amount" required>
                </div>
            </div>

            <!-- Bank Transfer -->
            <div class="payment-bank d-none payment-card transfer-card p-4 mb-4">
                <div class="d-flex align-items-center mb-3">
                    <i class="fa-solid fa-university fa-2x me-3"></i>
                    <h5 class="mb-0 text-light">Bank Transfer</h5>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold text-light">Bank Name</label>
                    <input type="text" name="bank_name" class="form-control form-control-lg" placeholder="Enter Bank Name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold text-light">Account Number</label>
                    <input type="text" name="account_number" class="form-control form-control-lg" placeholder="Enter Account Number" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold text-light">Account Holder Name</label>
                    <input type="text" name="account_holder" class="form-control form-control-lg" placeholder="Enter Account Holder Name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold text-light">Amount (FRW)</label>
                    <input type="number" name="payment_amount" class="form-control form-control-lg" placeholder="Enter Amount" required>
                </div>
            </div>

        </div>

        <div class="d-flex gap-3 mt-4 flex-wrap">
            <button type="submit" class="btn btn-success btn-lg flex-grow-1">
                <i class="fa fa-credit-card me-2"></i>Process Payment
            </button>
            <a href="{{ route('client.subscription_billing') }}" class="btn btn-secondary btn-lg flex-grow-1">
                <i class="fa fa-arrow-left me-2"></i>Back
            </a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
const paymentSelect = document.getElementById('payment-method');
const paymentDetails = document.getElementById('payment-details');

paymentSelect.addEventListener('change', function() {
    const selected = this.value;

    paymentDetails.querySelectorAll('div[class^="payment-"]').forEach(div => {
        div.classList.add('d-none');
        div.querySelectorAll('input').forEach(input => input.removeAttribute('required'));
    });

    if(selected) {
        const activeDiv = paymentDetails.querySelector('.payment-' + selected);
        if(activeDiv) {
            activeDiv.classList.remove('d-none');
            activeDiv.querySelectorAll('input').forEach(input => {
                input.setAttribute('required','required');
            });
        }
    }
});
</script>

<style>
.client-container { width: 80%; margin-left: 240px; margin-top: 40px; font-family: 'Inter', sans-serif; }
h2 { font-weight: 700; }

/* Card styles */
.payment-card { border-radius: 1rem; box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15); }
.payment-card input { border-radius: 0.5rem; }

/* MTN MoMo */
.mtn-card { background: linear-gradient(135deg, #924FC2, #924FC2); color: #fff; }
/* Airtel Money */
.airtel-card { background: linear-gradient(135deg, #ff0033, #ff6666); color: #fff; }
/* Bank card */
.bank-card { background: linear-gradient(135deg, #003366, #336699); color: #fff; }
/* Bank transfer */
.transfer-card { background: linear-gradient(135deg, #6c757d, #495057); color: #fff; }
/* Cash */
.cash-card { background: linear-gradient(135deg, #28a745, #218838); color: #fff; }

/* Buttons */
.btn { border-radius: 0.5rem; transition: all 0.3s; }
.btn-success:hover { background-color: #218838cc; }
.btn-secondary:hover { background-color: #6c757dcc; }

@media (max-width: 992px) { .client-container { width: 95%; margin-left: auto; margin-top: 20px; } }
</style>

@include('layouts.footer')
