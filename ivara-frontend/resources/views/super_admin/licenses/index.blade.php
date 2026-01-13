@extends('layouts.app')

@section('title', 'License & Compliance Management')

@section('content')
<div class="unique-licenses-wrapper">
    <div class="container-fluid p-0">
        <!-- Header -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3 text-dynamic">
            <div>
                <h1 class="sub-page-title mb-1">License & Compliance</h1>
                <p class="sub-page-subtitle mb-0">Global management of professional certifications and platform access permits.</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                <!-- Search Bar -->
                <div class="premium-search-wrapper d-none d-md-block">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" id="licSearch" class="premium-search-input" placeholder="Search Key, User or Email..." oninput="debounceLicSearch(this.value)" value="{{ request('search') }}">
                </div>

                <div class="d-flex align-items-center gap-2 bg-dark-transparent px-3 py-2 rounded-pill border border-white-10">
                    <span class="text-dynamic-muted small">Rows:</span>
                    <select class="form-select form-select-sm bg-transparent border-0 text-dynamic cursor-pointer" style="width: auto;" id="rowsPerPage" onchange="changeLimit(this.value)">
                        <option value="5" {{ $pagination['limit'] == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ $pagination['limit'] == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ $pagination['limit'] == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ $pagination['limit'] == 50 ? 'selected' : '' }}>50</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Stats Overview -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="stat-glass-card p-3 rounded-4 border-gold-pulse">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-dynamic-muted small text-uppercase fw-bold mb-1" style="font-size: 0.65rem; letter-spacing: 1px;">Total Licenses</div>
                            <div class="h3 mb-0 text-dynamic fw-bold">{{ number_format($stats['total']) }}</div>
                        </div>
                        <div class="stat-icon-circle bg-gold-transparent">
                            <i class="fas fa-certificate text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-glass-card p-3 rounded-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-dynamic-muted small text-uppercase fw-bold mb-1" style="font-size: 0.65rem; letter-spacing: 1px;">Active Permits</div>
                            <div class="h3 mb-0 text-dynamic fw-bold text-success">{{ number_format($stats['active']) }}</div>
                        </div>
                        <div class="stat-icon-circle bg-success-transparent">
                            <i class="fas fa-check-circle text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-glass-card p-3 rounded-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-dynamic-muted small text-uppercase fw-bold mb-1" style="font-size: 0.65rem; letter-spacing: 1px;">Expiring Soon</div>
                            <div class="h3 mb-0 text-dynamic fw-bold text-warning">{{ number_format($stats['expiringSoon']) }}</div>
                        </div>
                        <div class="stat-icon-circle bg-warning-transparent">
                            <i class="fas fa-hourglass-half text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-glass-card p-3 rounded-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-dynamic-muted small text-uppercase fw-bold mb-1" style="font-size: 0.65rem; letter-spacing: 1px;">Pending Verification</div>
                            <div class="h3 mb-0 text-dynamic fw-bold text-info">{{ number_format($stats['pending']) }}</div>
                        </div>
                        <div class="stat-icon-circle bg-info-transparent">
                            <i class="fas fa-clock text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Licenses Table -->
        <div class="sub-card p-0">
            <div class="table-responsive">
                <table class="table table-borderless align-middle mb-0">
                    <thead class="bg-light-transparent border-bottom border-white-10">
                        <tr class="text-dynamic-muted text-uppercase small fw-bold">
                            <th class="ps-4 py-4">License Key</th>
                            <th class="py-4">Holder</th>
                            <th class="py-4">Category</th>
                            <th class="py-4">Type</th>
                            <th class="py-4">Expiration</th>
                            <th class="pe-4 py-4 text-end">Status / Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($licenses as $lic)
                        <tr class="hover-row border-bottom border-white-05 transition-all">
                            <td class="ps-4 py-3">
                                <code class="text-warning small fw-bold">{{ $lic->licenseKey }}</code>
                            </td>
                            <td class="py-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-circle-sm d-flex align-items-center justify-content-center border border-white-10">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dynamic small">{{ $lic->userName }}</div>
                                        <div class="small text-dynamic-muted" style="font-size: 0.75rem;">{{ $lic->userEmail }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3">
                                <span class="badge bg-dark-transparent text-dynamic border border-white-10 rounded-pill px-3 py-1 small">
                                    {{ ucfirst(str_replace('-', ' ', $lic->category)) }}
                                </span>
                            </td>
                            <td class="py-3">
                                <div class="text-dynamic small fw-bold">{{ $lic->type }}</div>
                            </td>
                            <td class="py-3">
                                @php 
                                    $endDate = \Carbon\Carbon::parse($lic->endDate);
                                    $isExpiring = $endDate->isFuture() && $endDate->diffInDays() < 30;
                                    $isExpired = $endDate->isPast();
                                @endphp
                                <div class="text-dynamic small {{ $isExpired ? 'text-danger fw-bold' : ($isExpiring ? 'text-warning fw-bold' : '') }}">
                                    {{ $endDate->format('M d, Y') }}<br>
                                    <span style="font-size: 0.7rem;" class="opacity-75">
                                        @if($isExpired) 
                                            Expired {{ $endDate->diffForHumans() }}
                                        @else
                                            Expires {{ $endDate->diffForHumans() }}
                                        @endif
                                    </span>
                                </div>
                            </td>
                            <td class="pe-4 py-3 text-end">
                                <div class="d-flex justify-content-end gap-2 align-items-center">
                                    @php
                                        $statusClass = match($lic->status) {
                                            'active' => 'success',
                                            'pending' => 'info',
                                            'expired' => 'danger',
                                            'revoked' => 'secondary',
                                            default => 'warning'
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $statusClass }}-subtle text-{{ $statusClass }} border border-{{ $statusClass }}-subtle rounded-pill px-3 me-2">
                                        {{ ucfirst($lic->status) }}
                                    </span>
                                    
                                    <button class="btn-action-icon" title="View Certificate" onclick='openViewLicModal(@json($lic))'>
                                        <i class="fas fa-id-card"></i>
                                    </button>
                                    <button class="btn-action-icon" title="Edit Content" onclick='openEditLicModal(@json($lic))'>
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn-action-icon text-danger" title="Revoke License" onclick="deleteLicenseRecord('{{ $lic->_id }}')">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center justify-content-center opacity-50">
                                    <i class="fas fa-scroll fa-3x mb-3 text-dynamic-muted"></i>
                                    <h5 class="text-dynamic">No License Records Found</h5>
                                    <p class="text-dynamic-muted">Verification data will appear here once users submit certificates.</p>
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
                        <a class="page-link bg-dark-transparent border-white-10 text-dynamic px-3" href="?page={{ $pagination['page']-1 }}&limit={{ $pagination['limit'] }}&search={{ request('search') }}"><i class="fas fa-chevron-left me-1"></i> Prev</a>
                    </li>
                    @for($i = 1; $i <= $pagination['pages']; $i++)
                    <li class="page-item {{ $i == $pagination['page'] ? 'active' : '' }}">
                        <a class="page-link {{ $i == $pagination['page'] ? 'bg-primary border-primary text-white' : 'bg-dark-transparent border-white-10 text-dynamic' }}" href="?page={{ $i }}&limit={{ $pagination['limit'] }}&search={{ request('search') }}">{{ $i }}</a>
                    </li>
                    @endfor
                    <li class="page-item {{ $pagination['page'] >= $pagination['pages'] ? 'disabled' : '' }}">
                        <a class="page-link bg-dark-transparent border-white-10 text-dynamic px-3" href="?page={{ $pagination['page']+1 }}&limit={{ $pagination['limit'] }}&search={{ request('search') }}">Next <i class="fas fa-chevron-right ms-1"></i></a>
                    </li>
                </ul>
            </nav>
        </div>
        @endif
    </div>

    <!-- View License Modal -->
    <div class="sub-modal-box" id="viewLicModal">
        <div class="modal-glass-card">
            <div class="d-flex justify-content-between align-items-center p-4 border-bottom border-white-10">
                <div>
                    <h5 class="text-dynamic mb-1">Verify Credentials</h5>
                    <p class="small text-dynamic-muted mb-0">Professional certification review</p>
                </div>
                <button class="btn-close-custom" onclick="closeViewLicModal()"><i class="fas fa-times"></i></button>
            </div>
            <div class="px-4 py-4 text-center">
                <div class="d-flex flex-column gap-3">
                    <div class="bg-dark-transparent px-4 py-3 rounded-4 mx-1">
                        <div class="small text-dynamic-muted text-uppercase ls-1 fw-bold mb-2" style="font-size: 0.65rem;">Permit Holder</div>
                        <div class="text-dynamic fw-bold h6 mb-1" id="viewLicUser">--</div>
                        <div class="small text-dynamic-muted" id="viewLicEmail">--</div>
                    </div>

                    <div class="row g-2 mx-0">
                        <div class="col-6">
                            <div class="bg-dark-transparent px-3 py-3 rounded-4 h-100">
                                <div class="small text-dynamic-muted text-uppercase ls-1 fw-bold mb-2" style="font-size: 0.6rem;">Status</div>
                                <div id="viewLicStatusBadge">--</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-dark-transparent px-3 py-3 rounded-4 h-100">
                                <div class="small text-dynamic-muted text-uppercase ls-1 fw-bold mb-2" style="font-size: 0.6rem;">Category</div>
                                <div class="text-dynamic fw-bold small text-capitalize" id="viewLicCategory">--</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-dark-transparent px-4 py-3 rounded-4 mx-1 text-start">
                        <div class="small text-dynamic-muted text-uppercase ls-1 fw-bold mb-2" style="font-size: 0.65rem;">Compliance Data</div>
                        <div class="small text-dynamic opacity-75 mb-1">Key: <code id="viewLicKey" class="text-warning">--</code></div>
                        <div class="small text-dynamic-muted">Valid From: <span id="viewLicStart">--</span></div>
                        <div class="small text-dynamic-muted">Valid To: <span id="viewLicEnd">--</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit License Modal -->
    <div class="sub-modal-box" id="editLicModal">
        <div class="modal-glass-card">
            <div class="d-flex justify-content-between align-items-center p-4 border-bottom border-white-10">
                <div>
                    <h5 class="text-dynamic mb-1">Modify License</h5>
                    <p class="small text-dynamic-muted mb-0">Update permit status and dates</p>
                </div>
                <button class="btn-close-custom" onclick="closeEditLicModal()"><i class="fas fa-times"></i></button>
            </div>
            <form id="editLicForm" onsubmit="handleEditLicense(event)" class="p-4">
                <input type="hidden" id="editLicId">
                <div class="mb-3">
                    <label class="premium-form-label d-block mb-2">Operational Status</label>
                    <select id="editLicStatus" class="premium-select-dark">
                        <option value="active">Active</option>
                        <option value="pending">Pending Verification</option>
                        <option value="expired">Expired</option>
                        <option value="revoked">Revoked / Suspended</option>
                    </select>
                </div>
                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <label class="premium-form-label d-block mb-2">New Expiration Date</label>
                        <input type="date" id="editLicEndDate" class="premium-select-dark" required>
                    </div>
                </div>
                <button type="submit" class="modal-submit-btn" id="editLicSubmitBtn">
                    Confirm Compliance Updates
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

    .unique-licenses-wrapper { font-family: 'Outfit', sans-serif; padding: 2rem 0; }
    .sub-page-title { font-weight: 800; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-size: 2.2rem; }
    .sub-page-subtitle { color: var(--text-sub); font-size: 1rem; }

    .stat-glass-card { background: var(--panel-bg); backdrop-filter: blur(10px); border: 1px solid var(--panel-border); transition: transform 0.3s ease; }
    .stat-glass-card:hover { transform: translateY(-5px); background: var(--panel-bg); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
    
    .border-gold-pulse { border-color: rgba(245, 158, 11, 0.3) !important; }
    
    .stat-icon-circle { width: 45px; height: 45px; border-radius: 12px; display: grid; place-items: center; font-size: 1.2rem; }
    .bg-gold-transparent { background: rgba(245, 158, 11, 0.1); }
    .bg-success-transparent { background: rgba(16, 185, 129, 0.1); }
    .bg-warning-transparent { background: rgba(245, 158, 11, 0.1); }
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

    .avatar-circle-sm { width: 32px; height: 32px; border-radius: 8px; font-size: 0.9rem; background: var(--panel-bg); color: var(--text-sub); }
    .text-dynamic { color: var(--text-heading); }
    .text-dynamic-muted { color: var(--text-sub); }
    code { font-family: 'Fira Code', monospace; background: rgba(245, 158, 11, 0.1); padding: 2px 6px; border-radius: 4px; }

    /* Action Icons */
    .btn-action-icon {
        width: 32px; height: 32px;
        background: var(--panel-bg); border: 1px solid var(--panel-border);
        border-radius: 8px; color: var(--text-heading);
        display: grid; place-items: center; cursor: pointer;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 0.85rem;
    }
    .btn-action-icon:hover { background: var(--primary-gold); color: #0f172a; transform: translateY(-2px); border-color: var(--primary-gold); }
    .btn-action-icon.text-danger:hover { color: white; background: #ef4444; border-color: #ef4444; }

    /* Modal Styling */
    .sub-modal-box {
        display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.4); backdrop-filter: blur(8px);
        z-index: 9999; place-items: center; padding: 1rem;
    }
    .sub-modal-box.active { display: grid; }
    .modal-glass-card {
        background: var(--white, #fff); border: 1px solid var(--panel-border);
        width: 100%; max-width: 380px; border-radius: 28px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15); overflow: hidden;
        animation: modalScale 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    [data-theme="dark"] .modal-glass-card { background: #1e293b; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); }
    @keyframes modalScale { from { transform: scale(0.9); opacity: 0; } to { transform: scale(1); opacity: 1; } }

    .btn-close-custom {
        background: var(--panel-bg); border: none; width: 32px; height: 32px;
        border-radius: 50%; color: var(--text-heading); transition: all 0.2s;
    }
    .btn-close-custom:hover { background: #ef4444; color: white; }
    
    .ls-1 { letter-spacing: 1px; }
    .bg-dark-transparent { background: rgba(0,0,0,0.04); }
    [data-theme="dark"] .bg-dark-transparent { background: rgba(0,0,0,0.25); }

    .premium-form-label { font-size: 0.75rem; color: var(--text-sub); text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px; }
    .premium-select-dark { background: var(--panel-bg); border: 1px solid var(--panel-border); color: var(--text-heading); border-radius: 12px; padding: 0.6rem 1rem; font-size: 0.9rem; width: 100%; transition: all 0.2s; }
    .premium-select-dark:focus { outline: none; border-color: var(--primary-gold); }
    
    /* Fix for date input icon color */
    input[type="date"]::-webkit-calendar-picker-indicator { filter: invert(0.5); }
    [data-theme="dark"] input[type="date"]::-webkit-calendar-picker-indicator { filter: invert(1); }

    .modal-submit-btn { width: 100%; background: var(--primary-gold); color: #0f172a; border: none; padding: 0.8rem; border-radius: 16px; font-weight: 700; transition: all 0.2s; }
    .modal-submit-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 20px -5px rgba(245, 158, 11, 0.4); }
</style>

<script>
function changeLimit(limit) {
    const url = new URL(window.location.href);
    url.searchParams.set('limit', limit);
    url.searchParams.set('page', 1);
    window.location.href = url.toString();
}

let licTimeout;
function debounceLicSearch(val) {
    clearTimeout(licTimeout);
    licTimeout = setTimeout(() => {
        const url = new URL(window.location.href);
        url.searchParams.set('search', val);
        url.searchParams.set('page', 1);
        window.location.href = url.toString();
    }, 600);
}

window.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('licSearch');
    if (searchInput && searchInput.value) {
        searchInput.focus();
        searchInput.setSelectionRange(searchInput.value.length, searchInput.value.length);
    }
});

function openViewLicModal(lic) {
    document.getElementById('viewLicUser').innerText = lic.userName;
    document.getElementById('viewLicEmail').innerText = lic.userEmail;
    document.getElementById('viewLicCategory').innerText = lic.category.replace(/-/g, ' ');
    document.getElementById('viewLicKey').innerText = lic.licenseKey;
    document.getElementById('viewLicStart').innerText = new Date(lic.startDate).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
    document.getElementById('viewLicEnd').innerText = new Date(lic.endDate).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });

    const statusMap = { 'active': 'success', 'pending': 'info', 'expired': 'danger', 'revoked': 'secondary' };
    const statusClass = statusMap[lic.status] || 'warning';
    document.getElementById('viewLicStatusBadge').innerHTML = `<span class="badge bg-${statusClass}-subtle text-${statusClass} border border-${statusClass}-subtle rounded-pill px-3 py-1 small">${lic.status.charAt(0).toUpperCase() + lic.status.slice(1)}</span>`;

    document.getElementById('viewLicModal').classList.add('active');
}
function closeViewLicModal() { document.getElementById('viewLicModal').classList.remove('active'); }

function openEditLicModal(lic) {
    document.getElementById('editLicId').value = lic._id;
    document.getElementById('editLicStatus').value = lic.status;
    document.getElementById('editLicEndDate').value = new Date(lic.endDate).toISOString().split('T')[0];
    document.getElementById('editLicModal').classList.add('active');
}
function closeEditLicModal() { document.getElementById('editLicModal').classList.remove('active'); }

async function handleEditLicense(e) {
    e.preventDefault();
    const id = document.getElementById('editLicId').value;
    const status = document.getElementById('editLicStatus').value;
    const endDate = document.getElementById('editLicEndDate').value;
    const btn = document.getElementById('editLicSubmitBtn');

    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Saving Updates...';

    try {
        const response = await fetch(`/super_admin/licenses/${id}`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ status, endDate })
        });
        const result = await response.json();
        if (result.success) {
            window.showNotify('success', 'License verification updated successfully!');
            setTimeout(() => location.reload(), 1000);
        } else {
            window.showNotify('error', 'Update Failed.');
            btn.disabled = false;
            btn.innerText = 'Confirm Compliance Updates';
        }
    } catch (err) {
        window.showNotify('error', 'Connection Error.');
        btn.disabled = false;
        btn.innerText = 'Confirm Compliance Updates';
    }
}

async function deleteLicenseRecord(id) {
    if (!confirm('Are you sure you want to REVOKE this license? This will immediately disable service access.')) return;
    try {
        const response = await fetch(`/super_admin/licenses/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        });
        const result = await response.json();
        if (result.success) {
            window.showNotify('success', 'License revoked successfully.');
            setTimeout(() => location.reload(), 1000);
        } else {
            window.showNotify('error', 'Revocation Failed.');
        }
    } catch (err) {
        window.showNotify('error', 'Connection Error.');
    }
}
</script>
@endsection
