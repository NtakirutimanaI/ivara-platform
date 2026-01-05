@include('layouts.header')
@include('layouts.sidebar')
@include('admin.connect')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

<div class="container modern-container">
    <h2 class="text-center mb-4 text-primary">All Subscriptions / Upgrades</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm" role="alert">
            <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Bulk Actions -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <div class="d-flex gap-2">
            <select id="bulk-action" class="form-select form-select-sm modern-select">
                <option value="">Bulk Actions</option>
                <option value="activate">Activate Selected</option>
                <option value="deactivate">Deactivate Selected</option>
                <option value="cancel">Cancel Selected</option>
            </select>
            <button class="btn btn-sm btn-primary modern-btn" id="apply-bulk">Apply</button>
        </div>
    </div>

    <!-- Search -->
    <div class="mb-3">
        <input type="text" class="form-control form-control-sm modern-input" id="search-input" placeholder="Search subscriptions...">
    </div>

    <div class="table-responsive table-shadow">
        <table class="table table-modern align-middle" id="subscriptions-table">
            <thead class="table-modern-head text-center sticky-top">
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>#</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Plan</th>
                    <th>Price (FRW)</th>
                    <th>Status</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subscriptions as $index => $subscription)
                    <tr class="text-center">
                        <td><input type="checkbox" class="select-subscription" value="{{ $subscription->id }}"></td>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $subscription->user->name ?? '-' }}</td>
                        <td>{{ $subscription->email ?? '-' }}</td>
                        <td>{{ $subscription->plan ?? 'No Plan' }}</td>
                        <td>{{ number_format($subscription->price, 0) }} FRW</td>
                        <td>
                            @if($subscription->status === 'active')
                                <span class="badge bg-success modern-badge">Active</span>
                            @elseif($subscription->status === 'inactive')
                                <span class="badge bg-secondary modern-badge">Inactive</span>
                            @else
                                <span class="badge bg-danger modern-badge">Cancelled</span>
                            @endif
                        </td>
                        <td>{{ $subscription->start_date ?? '-' }}</td>
                        <td>{{ $subscription->end_date ?? '-' }}</td>
                        <td>
                            <form action="{{ route('subscription.change', $subscription->id) }}" method="POST" class="d-flex flex-column gap-1">
                                @csrf
                                <select name="plan" class="form-select form-select-sm modern-select" required onchange="updatePrice(this, {{ $index }})">
                                    <option value="">Select Plan</option>
                                    @foreach($availablePlans as $plan)
                                        <option value="{{ $plan['name'] }}" data-price="{{ $plan['price'] }}" {{ $subscription->plan === $plan['name'] ? 'selected' : '' }}>
                                            {{ $plan['name'] }} ({{ number_format($plan['price'], 0) }} FRW)
                                        </option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="price" id="price-{{ $index }}" value="{{ $subscription->price }}">
                                <button type="submit" class="btn btn-sm btn-primary modern-btn">
                                    <i class="fa fa-edit me-1"></i>Update Plan
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
function updatePrice(selectObj, index) {
    const price = selectObj.selectedOptions[0].dataset.price;
    document.getElementById('price-' + index).value = price;
}

// Select/Deselect all checkboxes
document.getElementById('select-all').addEventListener('change', function(){
    const checked = this.checked;
    document.querySelectorAll('.select-subscription').forEach(cb => cb.checked = checked);
});

// Search filter
document.getElementById('search-input').addEventListener('keyup', function(){
    const term = this.value.toLowerCase();
    document.querySelectorAll('#subscriptions-table tbody tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(term) ? '' : 'none';
    });
});

// Bulk action button
document.getElementById('apply-bulk').addEventListener('click', function(){
    const action = document.getElementById('bulk-action').value;
    if(!action) return alert('Please select a bulk action');
    const ids = Array.from(document.querySelectorAll('.select-subscription:checked')).map(cb => cb.value);
    if(ids.length === 0) return alert('Please select subscriptions first');
    alert('Bulk action: '+action+' on IDs: '+ids.join(', '));
});
</script>

<style>
/* Modern container */
.modern-container {
    width: 80%;
    margin-left: 270px;
    margin-top: 80px;
    margin-right: auto;
    font-family: 'Inter', sans-serif;
}

/* Search input */
.modern-input {
    border-radius: 0.5rem;
    border: 1px solid #d1d5db;
    padding: 0.4rem 0.8rem;
    transition: all 0.3s;
}
.modern-input:focus {
    border-color: #924FC2;
    box-shadow: 0 0 8px rgba(79,70,229,0.3);
    outline: none;
}

/* Modern selects */
.modern-select {
    border-radius: 0.5rem;
    border: 1px solid #d1d5db;
    transition: all 0.3s;
}
.modern-select:focus {
    border-color: #924FC2;
    box-shadow: 0 0 6px rgba(79,70,229,0.2);
    outline: none;
}

/* Buttons */
.modern-btn {
    border-radius: 0.5rem;
    background: linear-gradient(90deg, #924FC2, #6366f1);
    color: #fff;
    transition: all 0.3s;
}
.modern-btn:hover {
    background: linear-gradient(90deg, #6366f1, #924FC2);
}

/* Table styling */
.table-modern {
    border-collapse: separate;
    border-spacing: 0;
    width: 100%;
}
.table-modern th, .table-modern td {
    border: none;
    padding: 0.75rem 0.5rem;
    vertical-align: middle;
    transition: background 0.2s;
}
.table-modern tbody tr:hover {
    background: rgba(79,70,229,0.05);
}
.table-modern-head {
    background: linear-gradient(to right, #924FC2, #6366f1);
    color: #fff;
    font-weight: 600;
}
.modern-badge {
    padding: 0.4em 0.7em;
    font-size: 0.8rem;
    border-radius: 0.5rem;
}

/* Table wrapper shadow */
.table-shadow {
    background: #fff;
    border-radius: 0.6rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    overflow: hidden;
}
</style>

@include('layouts.footer')
