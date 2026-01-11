@include('layouts.header')
@include('layouts.sidebar')
@include('craftsperson.connect')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

<style>
    body { font-family:'Segoe UI', sans-serif; background:#f0f2f8; color:#333; }
    h2 { color:#4f46e5; text-align:center; margin-bottom:20px; }
    .profile-form-container {
        background:#fff; padding:20px; border-radius:12px;
        max-width:100%; margin-left:270px; margin-top:50px;
        box-shadow:0 6px 20px rgba(0,0,0,0.08);
    }
    table thead { background:#4f46e5; color:#fff; }
    table tbody tr:hover { background:#f9f9f9; }
    .btn-sm { padding:4px 10px; font-size:13px; }
    .pagination { justify-content:center; margin-top:20px; }

    /* Responsive */
    @media(max-width: 991px){
        .profile-form-container { margin:100px auto; width:95%; }
        table { font-size: 13px; }
        .btn-sm { font-size:12px; padding:3px 8px; }
    }
    @media(max-width: 576px){
        h2 { font-size:18px; }
        table { font-size:12px; }
    }

    /* Payment Method Styles */
    .payment-box { padding:15px; border-radius:8px; background:#f9f9f9; margin-top:10px; display:none; }
    .cash-box { border:2px dashed #28a745; color:#155724; background:#e6ffed; }
    .card-box { border:2px solid #0d6efd; background:#eaf2ff; }
    .momo-box { border:2px solid #924FC2; background:#fff7e6; }
    .airtel-box { border:2px solid #e60000; background:#ffe6e6; }
    .bank-box { border:2px solid #6c757d; background:#f8f9fa; }
    .credit-card-input { width:100%; padding:10px; margin-bottom:10px; border-radius:6px; border:1px solid #ccc; }
</style>

<div class="profile-form-container">
    <h2><i class="fa-solid fa-screwdriver-wrench"></i> Craftsperson Repairs</h2>

    <!-- Register Craft Button -->
    <div class="mb-3 text-end">
        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addRepairModal">
            <i class="fa fa-plus"></i> Register Craft
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Craftsperson</th>
                    <th>Craft Type</th>
                    <th>Repair Item</th>
                    <th>Description</th>
                    <th>Repair Date</th>
                    <th>Cost</th>
                    <th>Status</th>
                    <th>Client</th>
                    <th>Contact</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($repairs as $repair)
                <tr>
                    <td>{{ $repair->id }}</td>
                    <td>{{ $repair->craftsperson_name }}</td>
                    <td>{{ $repair->craft_type }}</td>
                    <td>{{ $repair->repair_item }}</td>
                    <td>{{ $repair->repair_description ?? '—' }}</td>
                    <td>{{ \Carbon\Carbon::parse($repair->repair_date)->format('d M Y') }}</td>
                    <td>
                        @if($repair->repair_cost)
                            ${{ number_format($repair->repair_cost, 2) }}
                        @else
                            —
                        @endif
                    </td>
                    <td>
                        @if($repair->status === 'Pending')
                            <span class="badge bg-warning text-dark"><i class="fa-solid fa-hourglass-half"></i> Pending</span>
                        @elseif($repair->status === 'In Progress')
                            <span class="badge bg-primary"><i class="fa-solid fa-spinner fa-spin"></i> In Progress</span>
                        @else
                            <span class="badge bg-success"><i class="fa-solid fa-check-circle"></i> Completed</span>
                        @endif
                    </td>
                    <td>{{ $repair->client_name ?? '—' }}</td>
                    <td>{{ $repair->client_contact ?? '—' }}</td>
                    <td>
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewRepairModal{{ $repair->id }}"><i class="fa fa-eye"></i></button>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editRepairModal{{ $repair->id }}"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteRepairModal{{ $repair->id }}"><i class="fa fa-trash"></i></button>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#paymentModal{{ $repair->id }}"><i class="fa fa-credit-card"></i> Pay</button>
                    </td>
                </tr>

                <!-- View Modal -->
                <div class="modal fade" id="viewRepairModal{{ $repair->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header bg-info text-white">
                                <h5 class="modal-title"><i class="fa fa-eye"></i> View Repair</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body small">
                                <p><strong>Craftsperson:</strong> {{ $repair->craftsperson_name }}</p>
                                <p><strong>Craft Type:</strong> {{ $repair->craft_type }}</p>
                                <p><strong>Repair Item:</strong> {{ $repair->repair_item }}</p>
                                <p><strong>Description:</strong> {{ $repair->repair_description }}</p>
                                <p><strong>Date:</strong> {{ $repair->repair_date }}</p>
                                <p><strong>Cost:</strong> ${{ number_format($repair->repair_cost,2) }}</p>
                                <p><strong>Status:</strong> {{ $repair->status }}</p>
                                <p><strong>Client:</strong> {{ $repair->client_name }}</p>
                                <p><strong>Contact:</strong> {{ $repair->client_contact }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Modal -->
                <div class="modal fade" id="editRepairModal{{ $repair->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <form method="POST" action="{{ route('craftsperson.repairs.update', $repair->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header bg-warning">
                                    <h5 class="modal-title"><i class="fa fa-edit"></i> Edit Repair</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body small">
                                    <div class="mb-2"><input type="text" name="craftsperson_name" class="form-control form-control-sm" value="{{ $repair->craftsperson_name }}" required></div>
                                    <div class="mb-2"><input type="text" name="craft_type" class="form-control form-control-sm" value="{{ $repair->craft_type }}" required></div>
                                    <div class="mb-2"><input type="text" name="repair_item" class="form-control form-control-sm" value="{{ $repair->repair_item }}" required></div>
                                    <div class="mb-2"><textarea name="repair_description" class="form-control form-control-sm">{{ $repair->repair_description }}</textarea></div>
                                    <div class="mb-2"><input type="date" name="repair_date" class="form-control form-control-sm" value="{{ $repair->repair_date }}" required></div>
                                    <div class="mb-2"><input type="number" step="0.01" name="repair_cost" class="form-control form-control-sm" value="{{ $repair->repair_cost }}"></div>
                                    <div class="mb-2">
                                        <select name="status" class="form-select form-select-sm">
                                            <option {{ $repair->status=='Pending'?'selected':'' }}>Pending</option>
                                            <option {{ $repair->status=='In Progress'?'selected':'' }}>In Progress</option>
                                            <option {{ $repair->status=='Completed'?'selected':'' }}>Completed</option>
                                        </select>
                                    </div>
                                    <div class="mb-2"><input type="text" name="client_name" class="form-control form-control-sm" value="{{ $repair->client_name }}"></div>
                                    <div class="mb-2"><input type="text" name="client_contact" class="form-control form-control-sm" value="{{ $repair->client_contact }}"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-warning btn-sm">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteRepairModal{{ $repair->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <form method="POST" action="{{ route('craftsperson.repairs.destroy', $repair->id) }}">
                            @csrf
                            @method('DELETE')
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title"><i class="fa fa-trash"></i> Delete Repair</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body small">
                                    Are you sure you want to delete repair <strong>#{{ $repair->id }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Payment Modal (same as you already have) -->
                <div class="modal fade" id="paymentModal{{ $repair->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <form method="POST" action="{{ route('craftsperson.repairs.pay', $repair->id) }}">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title"><i class="fa fa-credit-card"></i> Make Payment</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body small">
                                    <p><strong>Repair ID:</strong> #{{ $repair->id }}</p>
                                    <p><strong>Amount Due:</strong> ${{ number_format($repair->repair_cost, 2) }}</p>
                                    <hr>
                                    <div class="mb-2">
                                        <label class="form-label">Payment Method</label>
                                        <select name="payment_method" class="form-select form-select-sm payment-method" data-id="{{ $repair->id }}" required>
                                            <option value="">Select Method</option>
                                            <option value="cash">Cash</option>
                                            <option value="card">Credit/Debit Card</option>
                                            <option value="mtn">MTN Mobile Money</option>
                                            <option value="airtel">Airtel Money</option>
                                            <option value="bank">Bank Transfer</option>
                                        </select>
                                    </div>

                                    <!-- Dynamic Payment Boxes -->
                                    <div id="cash-box-{{ $repair->id }}" class="payment-box cash-box">
                                        <p><i class="fa fa-money-bill-wave"></i> Pay the full amount in <strong>Cash</strong>.</p>
                                    </div>

                                    <div id="card-box-{{ $repair->id }}" class="payment-box card-box">
                                        <input type="text" name="card_number" class="credit-card-input" placeholder="Card Number">
                                        <div class="row">
                                            <div class="col"><input type="text" name="expiry" class="credit-card-input" placeholder="MM/YY"></div>
                                            <div class="col"><input type="text" name="cvv" class="credit-card-input" placeholder="CVV"></div>
                                        </div>
                                        <input type="text" name="card_name" class="credit-card-input" placeholder="Cardholder Name">
                                    </div>

                                    <div id="mtn-box-{{ $repair->id }}" class="payment-box momo-box">
                                        <label>MTN Phone Number</label>
                                        <input type="text" name="mtn_number" class="form-control form-control-sm" placeholder="e.g. 2507xxxxxxx">
                                        <label>Transaction ID</label>
                                        <input type="text" name="mtn_txn" class="form-control form-control-sm" placeholder="Txn ID">
                                    </div>

                                    <div id="airtel-box-{{ $repair->id }}" class="payment-box airtel-box">
                                        <label>Airtel Phone Number</label>
                                        <input type="text" name="airtel_number" class="form-control form-control-sm" placeholder="e.g. 2507xxxxxxx">
                                        <label>Transaction ID</label>
                                        <input type="text" name="airtel_txn" class="form-control form-control-sm" placeholder="Txn ID">
                                    </div>

                                    <div id="bank-box-{{ $repair->id }}" class="payment-box bank-box">
                                        <label>Bank Name</label>
                                        <input type="text" name="bank_name" class="form-control form-control-sm">
                                        <label>Reference / Transaction ID</label>
                                        <input type="text" name="bank_txn" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn-sm">Confirm Payment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                @empty
                <tr><td colspan="11" class="text-center text-muted">No repairs found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div>{{ $repairs->links('pagination::bootstrap-5') }}</div>
</div>

<!-- Add Repair Modal (existing) -->
<div class="modal fade" id="addRepairModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form method="POST" action="{{ route('craftsperson.repairs.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title"><i class="fa fa-plus"></i> Register Craft</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body small">
                    <div class="mb-2"><input type="text" name="craftsperson_name" class="form-control form-control-sm" placeholder="Craftsperson Name" required></div>
                    <div class="mb-2"><input type="text" name="craft_type" class="form-control form-control-sm" placeholder="Craft Type" required></div>
                    <div class="mb-2"><input type="text" name="repair_item" class="form-control form-control-sm" placeholder="Repair Item" required></div>
                    <div class="mb-2"><textarea name="repair_description" class="form-control form-control-sm" placeholder="Description"></textarea></div>
                    <div class="mb-2"><input type="date" name="repair_date" class="form-control form-control-sm" required></div>
                    <div class="mb-2"><input type="number" step="0.01" name="repair_cost" class="form-control form-control-sm" placeholder="Repair Cost"></div>
                    <div class="mb-2">
                        <select name="status" class="form-select form-select-sm">
                            <option>Pending</option>
                            <option>In Progress</option>
                            <option>Completed</option>
                        </select>
                    </div>
                    <div class="mb-2"><input type="text" name="client_name" class="form-control form-control-sm" placeholder="Client Name"></div>
                    <div class="mb-2"><input type="text" name="client_contact" class="form-control form-control-sm" placeholder="Client Contact"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-sm">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

@include('layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Dynamic payment method UI toggle
    document.querySelectorAll('.payment-method').forEach(select => {
        select.addEventListener('change', function() {
            let id = this.dataset.id;
            document.querySelectorAll(`#paymentModal${id} .payment-box`).forEach(box => box.style.display = 'none');
            if(this.value === 'cash') document.getElementById(`cash-box-${id}`).style.display = 'block';
            if(this.value === 'card') document.getElementById(`card-box-${id}`).style.display = 'block';
            if(this.value === 'mtn') document.getElementById(`mtn-box-${id}`).style.display = 'block';
            if(this.value === 'airtel') document.getElementById(`airtel-box-${id}`).style.display = 'block';
            if(this.value === 'bank') document.getElementById(`bank-box-${id}`).style.display = 'block';
        });
    });
</script>
@include('layouts.footer')