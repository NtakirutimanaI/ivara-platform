@include('layouts.header')
@include('layouts.sidebar')
@include('business.connect')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

<div class="container-fluid businessperson-container">

    <h2 class="text-center mb-4 text-primary">Subscription & Billing</h2>

    <!-- Subscriptions Table -->
    <div class="table-wrapper mb-4">
        <h3>My Subscriptions</h3>
        <div class="table-responsive">
            <table class="table table-modern table-hover align-middle">
                <thead class="table-modern-head text-center">
                    <tr>
                        <th>#</th>
                        <th>Plan</th>
                        <th>Price ($)</th>
                        <th>Status</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subscriptions as $index => $sub)
                        <tr class="text-center">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $sub['plan'] }}</td>
                            <td>{{ number_format($sub['price'],2) }}</td>
                            <td>
                                @if(strtolower($sub['status']) === 'active')
                                    <span class="badge bg-success">Active</span>
                                @elseif(strtolower($sub['status']) === 'inactive')
                                    <span class="badge bg-secondary">Inactive</span>
                                @else
                                    <span class="badge bg-danger">Cancelled</span>
                                @endif
                            </td>
                            <td>{{ $sub['start_date'] ?? '-' }}</td>
                            <td>{{ $sub['end_date'] ?? '-' }}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#upgradeModal{{ $sub['id'] }}">
                                    <i class="fa fa-edit me-1"></i>Upgrade
                                </button>
                            </td>
                        </tr>

                        <!-- Upgrade Modal -->
                        <div class="modal fade" id="upgradeModal{{ $sub['id'] }}" tabindex="-1" aria-labelledby="upgradeModalLabel{{ $sub['id'] }}" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="upgradeModalLabel{{ $sub['id'] }}">Upgrade / Change Plan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <form action="{{ route('business.subscription.pay', $sub['id']) }}" method="POST">
                                  @csrf
                                  <div class="modal-body">
                                      <div class="mb-3">
                                          <label class="form-label">Select New Plan</label>
                                          <select name="plan" class="form-select" required onchange="updatePriceModal(this, {{ $sub['id'] }})">
                                              <option value="">Select Plan</option>
                                              @foreach($availablePlans as $plan)
                                                  <option value="{{ $plan['name'] }}" data-price="{{ $plan['price'] }}" {{ $sub['plan'] === $plan['name'] ? 'selected' : '' }}>
                                                      {{ $plan['name'] }} (${{ $plan['price'] }})
                                                  </option>
                                              @endforeach
                                          </select>
                                      </div>

                                      <input type="hidden" name="price" id="modal-price-{{ $sub['id'] }}" value="{{ $sub['price'] }}">
                                      <p class="text-muted">Selected Plan Price: $<span id="modal-price-display-{{ $sub['id'] }}">{{ $sub['price'] }}</span></p>
                                  </div>
                                  <div class="modal-footer flex-column flex-sm-row justify-content-between">
                                      <button type="button" class="btn btn-secondary mb-2 mb-sm-0" data-bs-dismiss="modal">Cancel</button>
                                      <a href="{{ route('subscription.payment.add') }}" class="btn btn-success">Add Payment Method</a>
                                  </div>
                              </form>
                            </div>
                          </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Billing History -->
    <div class="table-wrapper">
        <h3>Billing History</h3>
        <div class="table-responsive">
            @if(count($invoices))
                <table class="table table-modern table-hover align-middle">
                    <thead class="table-modern-head text-center">
                        <tr>
                            <th>#</th>
                            <th>Invoice #</th>
                            <th>Date</th>
                            <th>Amount ($)</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoices as $index => $invoice)
                            <tr class="text-center">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $invoice['id'] }}</td>
                                <td>{{ $invoice['paid_at'] ?? 'N/A' }}</td>
                                <td>{{ number_format($invoice['payment_amount'],2) }}</td>
                                <td>
                                    @if($invoice['status'] === 'success')
                                        <span class="badge bg-success">Paid</span>
                                    @elseif($invoice['status'] === 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @else
                                        <span class="badge bg-danger">Failed</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('subscription.invoice.download', $invoice['id']) }}" class="btn btn-sm btn-info">
                                        <i class="fa fa-download me-1"></i>Download PDF
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No invoices found.</p>
            @endif
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
function updatePriceModal(selectObj, id) {
    const price = selectObj.selectedOptions[0].dataset.price;
    document.getElementById('modal-price-' + id).value = price;
    document.getElementById('modal-price-display-' + id).textContent = price;
}
</script>

<style>
.businessperson-container {
    width: 80%;
    margin-left: 260px;
    margin-top: 80px;
    font-family: 'Inter', sans-serif;
}

.table-wrapper {
    background: #fff;
    padding: 20px;
    border-radius: 0.6rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    margin-bottom: 30px;
}

.table-modern {
    border-collapse: separate;
    border-spacing: 0;
    width: 100%;
}

.table-modern th, .table-modern td {
    border: none;
    padding: 0.75rem 0.5rem;
    vertical-align: middle;
}

.table-modern-head {
    background: linear-gradient(to right, #4f46e5, #6366f1);
    color: #fff;
    font-weight: 600;
}

.table-modern tbody tr:hover {
    background: rgba(79,70,229,0.05);
}

.badge {
    border-radius: 0.5rem;
    padding: 0.4em 0.7em;
}

.btn {
    border-radius: 0.5rem;
    transition: all 0.3s;
}

.btn-primary:hover { background: #6366f1; }
.btn-success:hover { background: #28a745cc; }
.btn-danger:hover { background: #dc3545cc; }

/* Responsive adjustments */
@media (max-width: 1200px) {
    .businessperson-container { width: 95%; margin-left: auto; }
}
@media (max-width: 768px) {
    .businessperson-container { margin-left: auto; margin-top: 60px; }
    .table-modern th, .table-modern td { font-size: 0.9rem; padding: 0.5rem; }
}
@media (max-width: 576px) {
    .table-modern th, .table-modern td { font-size: 0.8rem; padding: 0.3rem; }
    .btn { font-size: 0.8rem; padding: 0.3rem 0.5rem; }
    .modal-footer { flex-direction: column; gap: 0.5rem; }
}
</style>

@include('layouts.footer')
