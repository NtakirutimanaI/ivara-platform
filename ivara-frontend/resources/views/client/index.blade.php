@include('layouts.header')
@include('layouts.sidebar')
@include('client.connect')
<div class="history-page container-fluid py-4">
    <!-- Flash messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>{{ $client->name ?? 'Your' }} — History</h3>
        <div>
            <a href="{{ route('clients.history.export', ['clientId' => $client->id, 'format' => 'pdf']) }}" class="btn btn-outline-secondary btn-sm">Export PDF</a>
            <a href="{{ route('clients.history.export', ['clientId' => $client->id, 'format' => 'excel']) }}" class="btn btn-outline-secondary btn-sm">Export Excel</a>
        </div>
    </div>

    <!-- Filters -->
    <div class="card mb-3 p-3">
        <form id="filterForm" class="row gx-2 gy-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label">From</label>
                <input type="date" name="from" id="filter_from" class="form-control" value="{{ $dateFrom ?? '' }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">To</label>
                <input type="date" name="to" id="filter_to" class="form-control" value="{{ $dateTo ?? '' }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Search</label>
                <input type="text" id="globalSearch" class="form-control" placeholder="search device, product, invoice...">
            </div>
            <div class="col-md-3">
                <button type="button" id="applyFilters" class="btn btn-primary w-100">Apply</button>
            </div>
        </form>
    </div>

    <!-- Tabs -->
    <ul class="nav nav-tabs" id="historyTabs" role="tablist">
        <li class="nav-item"><a class="nav-link active" id="repairs-tab" data-bs-toggle="tab" href="#repairs">Repairs</a></li>
        <li class="nav-item"><a class="nav-link" id="purchases-tab" data-bs-toggle="tab" href="#purchases">Purchases</a></li>
        <li class="nav-item"><a class="nav-link" id="bookings-tab" data-bs-toggle="tab" href="#bookings">Bookings</a></li>
        <li class="nav-item"><a class="nav-link" id="payments-tab" data-bs-toggle="tab" href="#payments">Payments</a></li>
        <li class="nav-item"><a class="nav-link" id="notifications-tab" data-bs-toggle="tab" href="#notifications">Notifications</a></li>
    </ul>

    <div class="tab-content mt-3">
        <div class="tab-pane fade show active position-relative" id="repairs">
            <div id="repairsContainer"></div>
            <div class="overlay-spinner d-none" id="repairsSpinner"><div class="spinner-border text-primary"></div></div>
        </div>

        <div class="tab-pane fade position-relative" id="purchases">
            <div id="purchasesContainer"></div>
            <div class="overlay-spinner d-none" id="purchasesSpinner"><div class="spinner-border text-primary"></div></div>
        </div>

        <div class="tab-pane fade position-relative" id="bookings">
            <div id="bookingsContainer"></div>
            <div class="overlay-spinner d-none" id="bookingsSpinner"><div class="spinner-border text-primary"></div></div>
        </div>

        <div class="tab-pane fade position-relative" id="payments">
            <div id="paymentsContainer"></div>
            <div class="overlay-spinner d-none" id="paymentsSpinner"><div class="spinner-border text-primary"></div></div>
        </div>

        <div class="tab-pane fade" id="notifications">
            <div class="mb-2 d-flex justify-content-between">
                <div>
                    <button id="markReadBtn" class="btn btn-sm btn-outline-success">Mark selected as read</button>
                </div>
                <div><small>Unread messages are bold</small></div>
            </div>
            <div id="notificationsContainer">
                <ul class="list-group">
                    @foreach($client->notifications as $note)
                        <li class="list-group-item d-flex align-items-start">
                            <input class="form-check-input me-2 note-checkbox" data-id="{{ $note->id }}" type="checkbox">
                            <div class="{{ $note->is_read ? '' : 'fw-bold' }}">
                                <div>{{ $note->type ? "[$note->type]" : '' }} {{ \Illuminate\Support\Str::limit($note->message, 150) }}</div>
                                <small class="text-muted">{{ optional($note->sent_at ?? $note->created_at)->diffForHumans() }}</small>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<style>
/* Page layout */
.history-page {
    width: 80%;
    margin-top: 100px;
    margin-left: 260px;
    max-width: 1400px;
}

/* overlay spinner */
.overlay-spinner {
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(255,255,255,0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
    transition: opacity 0.3s ease-in-out;
}
.overlay-spinner.d-none { display: none; }
.overlay-spinner .spinner-border { width: 3rem; height: 3rem; }

/* Responsive adjustments */
@media (max-width: 992px) {
    .history-page { width: 95%; margin-left: 10px; }
    .nav-tabs .nav-link { font-size: 0.85rem; }
    .table { font-size: 0.85rem; }
    .alert { font-size: 0.85rem; }
}

@media (max-width: 576px) {
    .history-page { margin-left: 0; }
    .nav-tabs { overflow-x: auto; white-space: nowrap; }
    .nav-tabs .nav-item { display: inline-block; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const clientId = {{ $client->id }};
    const apiBase = '/api/client/' + clientId;

    function showSpinner(tab) { document.getElementById(tab+'Spinner').classList.remove('d-none'); }
    function hideSpinner(tab) { document.getElementById(tab+'Spinner').classList.add('d-none'); }

    function fetchAndRender(url, containerId, spinnerId, renderRow) {
        showSpinner(spinnerId);
        fetch(url, { headers: { 'Accept': 'application/json' } })
            .then(r => r.json())
            .then(payload => {
                hideSpinner(spinnerId);
                if(payload.data && payload.data.length) {
                    const rows = payload.data.map(renderRow).join('');
                    const tableHtml = '<table class="table table-sm table-bordered"><thead><tr>' +
                        (containerId === 'repairsContainer' ? '<th>Device</th><th>Serial</th><th>Problem</th><th>Technician</th><th>Status</th><th>Received</th><th>Cost</th>' :
                         containerId === 'purchasesContainer' ? '<th>Product</th><th>Qty</th><th>Amount</th><th>Status</th><th>Date</th>' :
                         containerId === 'bookingsContainer' ? '<th>Service</th><th>Date</th><th>Assigned</th><th>Status</th>' :
                         '<th>Txn</th><th>Amount</th><th>Method</th><th>Status</th><th>Date</th>') +
                        '</tr></thead><tbody>' + rows + '</tbody></table>' +
                        makePager(payload);
                    document.getElementById(containerId).innerHTML = tableHtml;
                } else {
                    document.getElementById(containerId).innerHTML = 'No records found.';
                }
            })
            .catch(e => { hideSpinner(spinnerId); document.getElementById(containerId).innerHTML = 'Error loading data'; console.error(e); });
    }

    function makePager(payload) {
        if(!payload?.meta) return '';
        const meta = payload.meta;
        let html = '<nav><ul class="pagination pagination-sm justify-content-center">';
        if(meta.current_page > 1) html += `<li class="page-item"><a class="page-link" href="#" data-page="${meta.current_page-1}">Prev</a></li>`;
        for(let p=1; p<=Math.min(meta.last_page,7); p++) html += `<li class="page-item ${p===meta.current_page ? 'active' : ''}"><a class="page-link" href="#" data-page="${p}">${p}</a></li>`;
        if(meta.current_page < meta.last_page) html += `<li class="page-item"><a class="page-link" href="#" data-page="${meta.current_page+1}">Next</a></li>`;
        html += '</ul></nav>';
        return html;
    }

    const loadHistory = () => {
        const from = document.getElementById('filter_from').value;
        const to = document.getElementById('filter_to').value;
        const q = document.getElementById('globalSearch').value;
        const query = `?from=${from}&to=${to}&q=${encodeURIComponent(q)}`;

        fetchAndRender(apiBase+'/repairs'+query,'repairsContainer','repairs', r => `
            <tr><td>${r.device_name}</td><td>${r.serial_number}</td><td>${r.problem_description?.substring(0,80)}</td>
            <td>${r.technician}</td><td>${r.repair_status}</td><td>${r.received_date}</td><td>${r.estimated_cost}</td></tr>
        `);
        fetchAndRender(apiBase+'/purchases'+query,'purchasesContainer','purchases', p => `
            <tr><td>${p.product?.name||'—'}</td><td>${p.quantity}</td><td>${p.amount}</td><td>${p.payment_status}</td><td>${p.purchase_date}</td></tr>
        `);
        fetchAndRender(apiBase+'/bookings'+query,'bookingsContainer','bookings', b => `
            <tr><td>${b.service_type}</td><td>${b.preferred_date}</td><td>${b.assigned_name||''}</td><td>${b.status}</td></tr>
        `);
        fetchAndRender(apiBase+'/payments'+query,'paymentsContainer','payments', p => `
            <tr><td>${p.transaction_id||p.invoice_id||p.id}</td><td>${p.payment_amount}</td><td>${p.method}</td><td>${p.status}</td><td>${p.paid_at}</td></tr>
        `);
    };

    document.getElementById('applyFilters').addEventListener('click', loadHistory);
    loadHistory();

    document.getElementById('markReadBtn')?.addEventListener('click', function () {
        const ids = Array.from(document.querySelectorAll('.note-checkbox:checked')).map(cb => cb.getAttribute('data-id'));
        if (!ids.length) return alert('Select at least one notification');
        fetch('/api/client/'+clientId+'/notifications/read', {
            method:'POST', headers:{ 'Content-Type':'application/json','Accept':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}' },
            body: JSON.stringify({ ids })
        }).then(()=>loadHistory());
    });
});
</script>
@include('layouts.footer')
