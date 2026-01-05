@include('layouts.header')
@include('layouts.sidebar')
@include('mechanic.connect')
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Vehicle Repairs Management</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background: #f9fafb; font-size: 0.9rem; }
.page-container { width: 84%; margin-left: 230px;margin-top: 100px; padding: 10px; }
@media (max-width: 1024px) { .page-container { width: 100%; margin-left: 0; } }

/* Badges */
.badge-status-Pending { background-color: #6c757d; }
.badge-status-InProgress { background-color: #ffc107; color: #000; }
.badge-status-Completed { background-color: #4f46e5; }

/* Table */
.table td, .table th { vertical-align: middle; }
.table-responsive { overflow-x:auto; }

/* Search */
.search-input { border:none; border-bottom:1px solid #4f46e5; outline:none; padding:4px 8px; width:40%; }
.search-input:focus { box-shadow:none; border-bottom:2px solid #4f46e5; }

/* Payment Modal */
.payment-modal .modal-content { border-radius: 10px; color:#4f46e5; padding:15px; }
.payment-modal .modal-header { border-bottom:none; }
.payment-modal .modal-footer { border-top:none; }
.cash { background:#198754; }
.mtn_momo { background:#FFCC00; color:#000; }
.airtel_money { background:#FF0000; }
.card { background:#0d6efd; }
.payment-field { margin-bottom:10px; }
</style>
</head>
<body>
<div class="page-container">

    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <h2 class="mb-2">Vehicle Repairs</h2>
        <button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addRepairModal">+ Add Repair</button>
    </div>

    {{-- Search --}}
    <input type="text" id="searchInput" class="search-input mb-3" placeholder="Search by column or date">

    {{-- Messages --}}
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

    {{-- Table --}}
    <div class="table-responsive bg-white p-2 shadow-sm rounded">
        <table class="table table-bordered table-hover align-middle text-nowrap" id="repairsTable">
            <thead class="table-dark">
                <tr>
                    <th>#</th><th>Vehicle</th><th>Tech</th><th>Problem</th><th>Solved</th>
                    <th>Rec.</th><th>Status</th><th>Price</th><th>Updated</th><th>Action</th><th>Payment</th>
                </tr>
            </thead>
            <tbody>
            @forelse($repairs as $index => $repair)
                @php 
                    $payment = \App\Models\Payment::where('invoice_id',$repair->id)->where('status','success')->first(); 
                    $rowNumber = ($repairs->currentPage() - 1) * $repairs->perPage() + $index + 1;
                @endphp
                <tr>
                    <td>{{ $rowNumber }}</td>
                    <td>{{ $repair->vehicle->registration_number ?? '-' }}<br><small>{{ $repair->vehicle->make ?? '' }} {{ $repair->vehicle->model ?? '' }}</small></td>
                    <td>{{ $repair->technician ?? '-' }}</td>
                    <td>{{ Str::limit($repair->problem_description ?? '-',50) }}</td>
                    <td>{{ Str::limit($repair->solved_problems ?? '-',50) }}</td>
                    <td>{{ Str::limit($repair->recommendations ?? '-',50) }}</td>
                    <td><span class="badge @if($repair->repair_status=='Completed') badge-status-Completed @elseif($repair->repair_status=='In Progress') badge-status-InProgress @else badge-status-Pending @endif">{{ $repair->repair_status }}</span></td>
                    <td>{{ $repair->repair_price ? number_format($repair->repair_price,2) : '-' }}</td>
                    <td>{{ $repair->updated_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $repair->id }}">Edit</button>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $repair->id }}">Delete</button>
                    </td>
                    <td>
                        @if($payment)
                            <button class="btn btn-sm btn-success w-100" disabled>Paid</button>
                        @elseif($repair->repair_price)
                            <select class="form-select mb-1 payment-select" data-id="{{ $repair->id }}" data-amount="{{ $repair->repair_price }}">
                                <option value="">Select Method</option>
                                <option value="cash">Cash</option>
                                <option value="mtn_momo">MTN MoMo</option>
                                <option value="airtel_money">Airtel Money</option>
                                <option value="card">Card</option>
                            </select>
                        @else - @endif
                    </td>
                </tr>

                {{-- Edit Modal --}}
                <div class="modal fade" id="editModal{{ $repair->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form action="{{ route('mechanic.repairs.update',$repair->id) }}" method="POST">
                                @csrf @method('PUT')
                                <div class="modal-header"><h5 class="modal-title">Update Repair</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                <div class="modal-body">
                                    <input class="form-control mb-1" name="technician" value="{{ $repair->technician }}" placeholder="Technician">
                                    <textarea class="form-control mb-1" name="problem_description" placeholder="Problem Description">{{ $repair->problem_description }}</textarea>
                                    <textarea class="form-control mb-1" name="solved_problems" placeholder="Solved Problems">{{ $repair->solved_problems }}</textarea>
                                    <textarea class="form-control mb-1" name="recommendations" placeholder="Recommendations">{{ $repair->recommendations }}</textarea>
                                    <select name="repair_status" class="form-select mb-1">
                                        <option value="Pending" {{ $repair->repair_status=='Pending'?'selected':'' }}>Pending</option>
                                        <option value="In Progress" {{ $repair->repair_status=='In Progress'?'selected':'' }}>In Progress</option>
                                        <option value="Completed" {{ $repair->repair_status=='Completed'?'selected':'' }}>Completed</option>
                                    </select>
                                    <input type="number" step="0.01" min="0" class="form-control" name="repair_price" value="{{ $repair->repair_price }}" placeholder="Repair Price">
                                </div>
                                <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button><button type="submit" class="btn btn-success">Save</button></div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Delete Modal --}}
                <div class="modal fade" id="deleteModal{{ $repair->id }}" tabindex="-1">
                    <div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('mechanic.repairs.destroy',$repair->id) }}" method="POST">@csrf @method('DELETE')
                        <div class="modal-body">Delete repair for <strong>{{ $repair->vehicle->registration_number ?? '-' }}</strong>?</div>
                        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn btn-danger">Delete</button></div>
                        </form>
                    </div></div>
                </div>

            @empty
                <tr><td colspan="11" class="text-center">No repairs found.</td></tr>
            @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-2">{{ $repairs->links() }}</div>
    </div>
</div>

{{-- Add Repair Modal --}}
<div class="modal fade" id="addRepairModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('mechanic.repairs.store') }}" method="POST">
                @csrf
                <div class="modal-header"><h5 class="modal-title">Add Repair</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <select name="vehicle_id" class="form-select mb-1" required>
                        <option value="">-- Choose Vehicle --</option>
                        @foreach($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}">{{ $vehicle->registration_number }} - {{ $vehicle->make }} {{ $vehicle->model }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="technician" class="form-control mb-1" placeholder="Technician">
                    <textarea name="problem_description" class="form-control mb-1" placeholder="Problem Description"></textarea>
                    <select name="repair_status" class="form-select mb-1">
                        <option value="Pending" selected>Pending</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Completed">Completed</option>
                    </select>
                    <input type="number" name="repair_price" class="form-control" placeholder="Repair Price (RWF)" step="0.01" min="0">
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button><button type="submit" class="btn btn-success">Add Repair</button></div>
            </form>
        </div>
    </div>
</div>

{{-- Payment Modal --}}
<div class="modal fade payment-modal" id="paymentMethodModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title" id="paymentTitle">Payment</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <form method="POST" id="paymentForm">@csrf
                <div class="modal-body">
                    <div id="paymentFields">
                        <input type="hidden" name="method" id="paymentMethodInput">
                        <div class="mb-2">Amount: <strong>RWF <span id="paymentAmount">0</span></strong></div>
                        <div id="extraFields"></div>
                    </div>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-light w-100" id="processPaymentBtn">Process Payment</button></div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Live search
document.getElementById('searchInput').addEventListener('input', function(){
    let filter = this.value.toLowerCase();
    document.querySelectorAll('#repairsTable tbody tr').forEach(row=>{
        let text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? '' : 'none';
    });
});

// Payment modal logic
document.querySelectorAll('.payment-select').forEach(select=>{
    select.addEventListener('change', function(){
        if(!this.value) return;
        let repairId = this.dataset.id;
        let amount = this.dataset.amount;
        let modal = new bootstrap.Modal(document.getElementById('paymentMethodModal'));
        let title = document.getElementById('paymentTitle');
        let form = document.getElementById('paymentForm');
        let methodInput = document.getElementById('paymentMethodInput');
        let amountSpan = document.getElementById('paymentAmount');
        let extraFields = document.getElementById('extraFields');

        title.textContent = this.value.replace('_',' ').toUpperCase() + ' Payment';
        form.action = '/mechanic/repairs/pay/' + repairId;
        methodInput.value = this.value;
        amountSpan.textContent = parseFloat(amount).toFixed(2);

        // Clear previous extra fields
        extraFields.innerHTML = '';

        if(this.value == 'mtn_momo' || this.value == 'airtel_money'){
            extraFields.innerHTML = '<input type="text" name="phone" class="form-control payment-field" placeholder="Enter Phone Number" required>';
        }
        if(this.value == 'card'){
            extraFields.innerHTML = `
                <input type="text" name="card_owner" class="form-control payment-field" placeholder="Card Owner Name" required>
                <input type="text" name="card_number" class="form-control payment-field" placeholder="Card Number" required>
                <input type="text" name="expiry" class="form-control payment-field" placeholder="MM/YY" required>
                <input type="text" name="cvv" class="form-control payment-field" placeholder="CVV" required>
            `;
        }

        // Change modal color
        let modalContent = document.querySelector('.payment-modal .modal-content');
        modalContent.className = 'modal-content payment-modal ' + this.value;

        modal.show();
    });
});
</script>
</body>
</html>
@include('layouts.footer')
