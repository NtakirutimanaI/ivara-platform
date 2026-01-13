@extends('layouts.app')

@section('title', 'Subscription Payments')

@section('content')
<div class="unique-payments-wrapper">
    <div class="container-fluid p-0">
        <!-- Header -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
            <div>
                <h1 class="sub-page-title mb-1">Subscription Payments</h1>
                <p class="sub-page-subtitle mb-0">Full transaction history for Individual and Business accounts.</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                <!-- Search Bar -->
                <div class="premium-search-wrapper d-none d-md-block">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" id="paySearch" class="premium-search-input" placeholder="Search TRX, users or email..." oninput="debouncePaySearch(this.value)" value="{{ request('search') }}">
                </div>

                <button class="premium-export-btn" onclick="openExportModal()">
                    <i class="fas fa-file-export"></i> Export CSV
                </button>
            </div>
        </div>

        <!-- Stats Overview -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="stat-glass-card p-3 rounded-4 border-gold-pulse">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-dynamic-muted small text-uppercase fw-bold mb-1" style="font-size: 0.65rem; letter-spacing: 1px;">Total Revenue</div>
                            <div class="h3 mb-0 text-dynamic fw-bold">{{ number_format($stats['total']) }} <span class="small text-dynamic-muted">RWF</span></div>
                        </div>
                        <div class="stat-icon-circle bg-gold-transparent">
                            <i class="fas fa-wallet text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-glass-card p-3 rounded-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-dynamic-muted small text-uppercase fw-bold mb-1" style="font-size: 0.65rem; letter-spacing: 1px;">Business Accounts</div>
                            <div class="h3 mb-0 text-dynamic fw-bold">{{ number_format($stats['business']) }} <span class="small text-dynamic-muted">RWF</span></div>
                        </div>
                        <div class="stat-icon-circle bg-primary-transparent">
                            <i class="fas fa-building text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-glass-card p-3 rounded-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-dynamic-muted small text-uppercase fw-bold mb-1" style="font-size: 0.65rem; letter-spacing: 1px;">Individual Accounts</div>
                            <div class="h3 mb-0 text-dynamic fw-bold">{{ number_format($stats['individual']) }} <span class="small text-dynamic-muted">RWF</span></div>
                        </div>
                        <div class="stat-icon-circle bg-info-transparent">
                            <i class="fas fa-user text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payments Table -->
        <div class="sub-card p-0">
            <div class="table-responsive">
                <table class="table table-borderless align-middle mb-0">
                    <thead class="bg-light-transparent border-bottom border-white-10">
                        <tr class="text-dynamic-muted text-uppercase small fw-bold">
                            <th class="ps-4 py-4">Transaction ID</th>
                            <th class="py-4">User / Account</th>
                            <th class="py-4">Type</th>
                            <th class="py-4">Amount</th>
                            <th class="py-4">Method</th>
                            <th class="py-4">Date</th>
                            <th class="pe-4 py-4 text-end">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $pay)
                        <tr class="hover-row border-bottom border-white-05 transition-all">
                            <td class="ps-4 py-3">
                                <code class="text-warning small fw-bold">{{ $pay->transaction_id }}</code>
                            </td>
                            <td class="py-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-circle-sm d-flex align-items-center justify-content-center border border-white-10">
                                        <i class="fas fa-user-circle"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dynamic small">{{ $pay->user_name }}</div>
                                        <div class="small text-dynamic-muted" style="font-size: 0.75rem;">{{ $pay->user_email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3">
                                <span class="badge rounded-pill {{ $pay->account_type == 'business' ? 'bg-primary-subtle text-primary border-primary-subtle' : 'bg-info-subtle text-info border-info-subtle' }} px-3 border py-1 small">
                                    {{ ucfirst($pay->account_type) }}
                                </span>
                            </td>
                            <td class="py-3">
                                <div class="fw-bold text-dynamic">{{ number_format($pay->amount) }} RWF</div>
                            </td>
                            <td class="py-3">
                                <div class="d-flex align-items-center gap-2 text-dynamic-muted small">
                                    <i class="fas {{ $pay->method == 'Mobile Money' ? 'fa-mobile-alt' : 'fa-university' }} opacity-50"></i>
                                    {{ $pay->method }}
                                </div>
                            </td>
                            <td class="py-3 text-dynamic-muted small">
                                {{ $pay->created_at->format('M d, Y') }}<br>
                                <span style="font-size: 0.7rem;">{{ $pay->created_at->format('H:i') }}</span>
                            </td>
                            <td class="pe-4 py-3 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    @php
                                        $statusClass = match($pay->status) {
                                            'completed' => 'success',
                                            'pending' => 'warning',
                                            'failed' => 'danger',
                                            default => 'secondary'
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $statusClass }}-subtle text-{{ $statusClass }} border border-{{ $statusClass }}-subtle rounded-pill px-3 me-2">
                                        {{ ucfirst($pay->status) }}
                                    </span>
                                    
                                    <button class="btn-action-icon" title="View Details" onclick='openViewPayModal(@json($pay))'>
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn-action-icon" title="Update Status" onclick='openStatusPayModal("{{ $pay->id }}", "{{ $pay->status }}")'>
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn-action-icon text-danger" title="Delete Record" onclick="deletePayRecord('{{ $pay->id }}')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center justify-content-center opacity-50">
                                    <i class="fas fa-receipt fa-3x mb-3 text-dynamic-muted"></i>
                                    <h5 class="text-dynamic">No Payment Records Found</h5>
                                    <p class="text-dynamic-muted">Transaction history will appear here once users pay.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($pagination['pages'] > 1)
        <div class="d-flex justify-content-center mt-4">
            <nav>
                <ul class="pagination pagination-rounded gap-2">
                    <li class="page-item {{ $pagination['page'] <= 1 ? 'disabled' : '' }}">
                        <a class="page-link bg-dark border-white-10 text-white px-3" href="?page={{ $pagination['page']-1 }}&limit={{ $pagination['limit'] }}&search={{ request('search') }}"><i class="fas fa-chevron-left me-1"></i> Prev</a>
                    </li>
                    @for($i = 1; $i <= $pagination['pages']; $i++)
                    <li class="page-item {{ $i == $pagination['page'] ? 'active' : '' }}">
                        <a class="page-link {{ $i == $pagination['page'] ? 'bg-primary border-primary' : 'bg-dark border-white-10' }} text-white" href="?page={{ $i }}&limit={{ $pagination['limit'] }}&search={{ request('search') }}">{{ $i }}</a>
                    </li>
                    @endfor
                    <li class="page-item {{ $pagination['page'] >= $pagination['pages'] ? 'disabled' : '' }}">
                        <a class="page-link bg-dark border-white-10 text-white px-3" href="?page={{ $pagination['page']+1 }}&limit={{ $pagination['limit'] }}&search={{ request('search') }}">Next <i class="fas fa-chevron-right ms-1"></i></a>
                    </li>
                </ul>
            </nav>
        </div>
        @endif
    </div>

    <!-- View Payment Modal -->
    <div class="sub-modal-box" id="viewPayModal">
        <div class="modal-glass-card">
            <div class="d-flex justify-content-between align-items-center p-4 border-bottom border-white-10">
                <div>
                    <h5 class="text-dynamic mb-1">Payment Receipt</h5>
                    <p class="small text-dynamic-muted mb-0">Record of subscription settlement</p>
                </div>
                <button class="btn-close-custom" onclick="closeViewPayModal()"><i class="fas fa-times"></i></button>
            </div>
            <div class="px-4 py-4 text-center">
                <div class="d-flex flex-column gap-3">
                    <div class="bg-dark-transparent px-4 py-3 rounded-4 mx-1">
                        <div class="small text-dynamic-muted text-uppercase ls-1 fw-bold mb-2" style="font-size: 0.65rem;">Customer Information</div>
                        <div class="text-dynamic fw-bold h6 mb-1 px-3 pe-4" id="viewPayUser">--</div>
                        <div class="small text-dynamic-muted px-3 pe-4" id="viewPayEmail">--</div>
                    </div>

                    <div class="row g-2 mx-0">
                        <div class="col-6">
                            <div class="bg-dark-transparent px-3 py-3 rounded-4 h-100">
                                <div class="small text-dynamic-muted text-uppercase ls-1 fw-bold mb-2" style="font-size: 0.6rem;">Amount</div>
                                <div class="text-dynamic fw-bold px-2 pe-3" id="viewPayAmount">--</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-dark-transparent px-3 py-3 rounded-4 h-100">
                                <div class="small text-dynamic-muted text-uppercase ls-1 fw-bold mb-2" style="font-size: 0.6rem;">Account Type</div>
                                <div class="text-dynamic fw-bold px-2 pe-3 text-capitalize" id="viewPayAccount">--</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-dark-transparent px-4 py-3 rounded-4 mx-1">
                        <div class="small text-dynamic-muted text-uppercase ls-1 fw-bold mb-2" style="font-size: 0.65rem;">Transaction Context</div>
                        <div class="small text-dynamic opacity-75 mb-1">TRX: <code id="viewPayTrx" class="text-warning">--</code></div>
                        <div class="small text-dynamic-muted">Method: <span id="viewPayMethod">--</span></div>
                    </div>

                    <div class="bg-dark-transparent px-4 py-3 rounded-4 mx-1">
                        <div class="small text-dynamic-muted text-uppercase ls-1 fw-bold mb-2" style="font-size: 0.65rem;">Processing Status</div>
                        <div id="viewPayStatusBadge" class="d-flex justify-content-center px-3 pe-4">--</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Status Modal -->
    <div class="sub-modal-box" id="statusPayModal">
        <div class="modal-glass-card">
            <div class="d-flex justify-content-between align-items-center p-4 border-bottom border-white-10">
                <div>
                    <h5 class="text-dynamic mb-1">Update Status</h5>
                    <p class="small text-dynamic-muted mb-0">Modify transaction processing state</p>
                </div>
                <button class="btn-close-custom" onclick="closeStatusPayModal()"><i class="fas fa-times"></i></button>
            </div>
            <form id="statusPayForm" onsubmit="handleStatusUpdate(event)" class="p-4">
                <input type="hidden" id="statusPayId">
                <div class="mb-4">
                    <label class="premium-form-label d-block mb-2">Processing State</label>
                    <select id="statusPaySelect" class="premium-select-dark">
                        <option value="completed">Completed</option>
                        <option value="pending">Pending</option>
                        <option value="failed">Failed</option>
                        <option value="refunded">Refunded</option>
                    </select>
                </div>
                <button type="submit" class="modal-submit-btn" id="statusSubmitBtn">
                    Save Transaction Changes
                </button>
            </form>
        </div>
    </div>

    <!-- Export Report Modal -->
    <div class="sub-modal-box" id="exportPayModal">
        <div class="modal-glass-card">
            <div class="d-flex justify-content-between align-items-center p-4 border-bottom border-white-10">
                <div>
                    <h5 class="text-dynamic mb-1">Export Report</h5>
                    <p class="small text-dynamic-muted mb-0">Select date range for CSV export</p>
                </div>
                <button class="btn-close-custom" onclick="closeExportModal()"><i class="fas fa-times"></i></button>
            </div>
            <form action="{{ route('super_admin.subscriptions.payments.export') }}" method="GET" class="p-4">
                <div class="row g-3 mb-4">
                    <div class="col-6">
                        <label class="premium-form-label d-block mb-2">Start Date</label>
                        <input type="date" name="start_date" class="premium-select-dark" required>
                    </div>
                    <div class="col-6">
                        <label class="premium-form-label d-block mb-2">End Date</label>
                        <input type="date" name="end_date" class="premium-select-dark" required>
                    </div>
                </div>
                <div class="bg-dark-transparent p-3 rounded-4 mb-4">
                    <div class="d-flex align-items-center gap-2 text-dynamic-muted small">
                        <i class="fas fa-info-circle"></i>
                        <span>Export will only include <b>completed</b> transactions.</span>
                    </div>
                </div>
                <button type="submit" class="modal-submit-btn">
                    <i class="fas fa-download me-2"></i> Generate CSV Report
                </button>
            </form>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-gold: #f59e0b;
        --panel-bg: rgba(255, 255, 255, 0.7);
        --panel-border: rgba(0, 0, 0, 0.08);
        --text-heading: #1e293b;
        --text-sub: #64748b;
        --card-bg: rgba(255, 255, 255, 0.9);
        --row-hover: rgba(0, 0, 0, 0.02);
    }

    [data-theme="dark"] {
        --panel-bg: rgba(30, 41, 59, 0.4);
        --panel-border: rgba(255, 255, 255, 0.1);
        --text-heading: #f8fafc;
        --text-sub: #94a3b8;
        --card-bg: rgba(30, 41, 59, 0.5);
        --row-hover: rgba(255, 255, 255, 0.02);
    }

    .unique-payments-wrapper { font-family: 'Outfit', sans-serif; padding: 2rem 0; }
    .sub-page-title { font-weight: 800; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-size: 2.2rem; }
    .sub-page-subtitle { color: var(--text-sub); font-size: 1rem; }

    .stat-glass-card { background: var(--panel-bg); backdrop-filter: blur(10px); border: 1px solid var(--panel-border); transition: transform 0.3s ease; }
    .stat-glass-card:hover { transform: translateY(-5px); background: var(--panel-bg); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
    
    .border-gold-pulse { border-color: rgba(245, 158, 11, 0.3) !important; }
    
    .stat-icon-circle { width: 45px; height: 45px; border-radius: 12px; display: grid; place-items: center; font-size: 1.2rem; }
    .bg-gold-transparent { background: rgba(245, 158, 11, 0.1); }
    .bg-primary-transparent { background: rgba(99, 102, 241, 0.1); }
    .bg-info-transparent { background: rgba(6, 182, 212, 0.1); }

    .sub-card { background: var(--card-bg); backdrop-filter: blur(20px); border: 1px solid var(--panel-border); border-radius: 24px; overflow: hidden; }
    .bg-light-transparent { background: rgba(0,0,0,0.02); }
    [data-theme="dark"] .bg-light-transparent { background: rgba(255,255,255,0.03); }
    
    .border-white-10 { border-color: var(--panel-border) !important; }
    .border-white-05 { border-color: var(--panel-border) !important; }
    .hover-row:hover { background: var(--row-hover); }

    .premium-search-wrapper { position: relative; width: 300px; }
    .search-icon { position: absolute; left: 1.2rem; top: 50%; transform: translateY(-50%); color: var(--text-sub); opacity: 0.5; }
    .premium-search-input { width: 100%; background: var(--panel-bg); border: 1px solid var(--panel-border); border-radius: 100px; padding: 0.6rem 1rem 0.6rem 3rem; color: var(--text-heading); font-size: 0.85rem; transition: all 0.2s; }
    .premium-search-input:focus { outline: none; border-color: var(--primary-gold); background: var(--card-bg); }

    .premium-export-btn { background: var(--panel-bg); color: var(--text-heading); border: 1px solid var(--panel-border); padding: 0.6rem 1.5rem; border-radius: 100px; font-weight: 600; font-size: 0.85rem; transition: all 0.2s; cursor: pointer; }
    .premium-export-btn:hover { background: var(--primary-gold); color: #0f172a; border-color: var(--primary-gold); transform: translateY(-2px); }

    .avatar-circle-sm { width: 32px; height: 32px; border-radius: 8px; font-size: 0.9rem; background: var(--panel-bg); color: var(--text-sub); }
    .text-dynamic { color: var(--text-heading); }
    .text-dynamic-muted { color: var(--text-sub); }
    code { font-family: 'Fira Code', monospace; background: rgba(245, 158, 11, 0.1); padding: 2px 6px; border-radius: 4px; }

    /* Action Icons */
    .btn-action-icon {
        width: 32px;
        height: 32px;
        background: var(--panel-bg);
        border: 1px solid var(--panel-border);
        border-radius: 8px;
        color: var(--text-heading);
        display: grid;
        place-items: center;
        cursor: pointer;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 0.85rem;
    }
    .btn-action-icon:hover {
        background: var(--primary-gold);
        color: #0f172a;
        transform: translateY(-2px);
        border-color: var(--primary-gold);
    }
    .btn-action-icon.text-danger:hover {
        color: white;
        background: #ef4444;
        border-color: #ef4444;
    }

    /* Modal Styling */
    .sub-modal-box {
        display: none;
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(8px);
        z-index: 9999;
        place-items: center;
        padding: 1rem;
    }
    .sub-modal-box.active { display: grid; }
    .modal-glass-card {
        background: var(--white, #fff);
        border: 1px solid var(--panel-border);
        width: 100%;
        max-width: 380px;
        border-radius: 28px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        animation: modalScale 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    [data-theme="dark"] .modal-glass-card {
        background: #1e293b;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    }
    @keyframes modalScale { from { transform: scale(0.9); opacity: 0; } to { transform: scale(1); opacity: 1; } }

    .btn-close-custom {
        background: var(--panel-bg);
        border: none;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        color: var(--text-heading);
        transition: all 0.2s;
    }
    .btn-close-custom:hover { background: #ef4444; color: white; }
    
    .ls-1 { letter-spacing: 1px; }
    .bg-dark-transparent { background: rgba(0,0,0,0.04); }
    [data-theme="dark"] .bg-dark-transparent { background: rgba(0,0,0,0.25); }

    .premium-form-label { font-size: 0.75rem; color: var(--text-sub); text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px; }
    .premium-select-dark { background: var(--panel-bg); border: 1px solid var(--panel-border); color: var(--text-heading); border-radius: 12px; padding: 0.6rem 1rem; font-size: 0.9rem; width: 100%; transition: all 0.2s; }
    .premium-select-dark:focus { outline: none; border-color: var(--primary-gold); box-shadow: 0 0 10px rgba(245, 158, 11, 0.1); }
    
    /* Fix for date input icon color */
    input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(0.5);
    }
    [data-theme="dark"] input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(1);
    }

    .modal-submit-btn { width: 100%; background: var(--primary-gold); color: #0f172a; border: none; padding: 0.8rem; border-radius: 16px; font-weight: 700; transition: all 0.2s; }
    .modal-submit-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 20px -5px rgba(245, 158, 11, 0.4); }
</style>

<script>
let payTimeout;
function debouncePaySearch(val) {
    clearTimeout(payTimeout);
    payTimeout = setTimeout(() => {
        const url = new URL(window.location.href);
        url.searchParams.set('search', val);
        url.searchParams.set('page', 1);
        window.location.href = url.toString();
    }, 600);
}

window.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('paySearch');
    if (searchInput && searchInput.value) {
        searchInput.focus();
        searchInput.setSelectionRange(searchInput.value.length, searchInput.value.length);
    }
});

// Modal Handlers
function openExportModal() { document.getElementById('exportPayModal').classList.add('active'); }
function closeExportModal() { document.getElementById('exportPayModal').classList.remove('active'); }
function openViewPayModal(pay) {
    document.getElementById('viewPayUser').innerText = pay.user_name;
    document.getElementById('viewPayEmail').innerText = pay.user_email;
    document.getElementById('viewPayAmount').innerText = new Intl.NumberFormat().format(pay.amount) + ' RWF';
    document.getElementById('viewPayAccount').innerText = pay.account_type;
    document.getElementById('viewPayTrx').innerText = pay.transaction_id;
    document.getElementById('viewPayMethod').innerText = pay.method;
    
    // Status Badge
    const statusMap = { 'completed': 'success', 'pending': 'warning', 'failed': 'danger', 'refunded': 'secondary' };
    const statusClass = statusMap[pay.status] || 'secondary';
    document.getElementById('viewPayStatusBadge').innerHTML = `<span class="badge bg-${statusClass}-subtle text-${statusClass} border border-${statusClass}-subtle rounded-pill px-4 py-2">${pay.status.charAt(0).toUpperCase() + pay.status.slice(1)}</span>`;
    
    document.getElementById('viewPayModal').classList.add('active');
}

function closeViewPayModal() { document.getElementById('viewPayModal').classList.remove('active'); }

function openStatusPayModal(id, currentStatus) {
    document.getElementById('statusPayId').value = id;
    document.getElementById('statusPaySelect').value = currentStatus;
    document.getElementById('statusPayModal').classList.add('active');
}

function closeStatusPayModal() { document.getElementById('statusPayModal').classList.remove('active'); }

async function handleStatusUpdate(e) {
    e.preventDefault();
    const id = document.getElementById('statusPayId').value;
    const status = document.getElementById('statusPaySelect').value;
    const btn = document.getElementById('statusSubmitBtn');
    
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Saving...';
    
    try {
        const response = await fetch(`/super_admin/subscriptions/payments/${id}/status`, {
            method: 'PATCH',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ status })
        });
        const result = await response.json();
        
        if (result.success) {
            window.showNotify('success', 'Transaction status updated successfully!');
            setTimeout(() => location.reload(), 1000);
        } else {
            window.showNotify('error', 'Failed to update transaction status.');
            btn.disabled = false;
            btn.innerText = 'Save Transaction Changes';
        }
    } catch (err) {
        window.showNotify('error', 'A connection error occurred.');
        btn.disabled = false;
        btn.innerText = 'Save Transaction Changes';
    }
}

async function deletePayRecord(id) {
    if (!confirm('Are you absolutely sure you want to delete this payment record? This action cannot be undone.')) return;
    
    try {
        const response = await fetch(`/super_admin/subscriptions/payments/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        });
        const result = await response.json();
        
        if (result.success) {
            window.showNotify('success', 'Payment record deleted successfully!');
            setTimeout(() => location.reload(), 1000);
        } else {
            window.showNotify('error', 'Failed to delete record.');
        }
    } catch (err) {
        window.showNotify('error', 'A connection error occurred.');
    }
}
</script>
@endsection
