@extends('layouts.app')

@section('title', 'Active Subscriptions')

@section('content')
<div class="unique-subscriptions-wrapper">
    <div class="container-fluid p-0">
        <!-- Header -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
            <div>
                <h1 class="sub-page-title mb-1">Active Subscriptions</h1>
                <p class="sub-page-subtitle mb-0">Real-time monitoring of all active platform subscriptions.</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                <!-- Search Bar -->
                <div class="premium-search-wrapper d-none d-md-block">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" id="subSearch" class="premium-search-input" placeholder="Search users, email or plan..." oninput="debounceSearch(this.value)" value="{{ request('search') }}">
                </div>

                <!-- Pagination Control -->
                <div class="d-flex align-items-center gap-2 bg-dark-transparent px-3 py-2 rounded-pill border border-white-10">
                    <span class="text-white-50 small">Rows:</span>
                    <select class="form-select form-select-sm bg-transparent border-0 text-white cursor-pointer" style="width: auto;" id="rowsPerPage" onchange="changeLimit(this.value)">
                        <option value="5" {{ $pagination['limit'] == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ $pagination['limit'] == 10 ? 'selected' : '' }}>10</option>
                        <option value="15" {{ $pagination['limit'] == 15 ? 'selected' : '' }}>15</option>
                        <option value="20" {{ $pagination['limit'] == 20 ? 'selected' : '' }}>20</option>
                    </select>
                </div>

                <button class="premium-add-btn" onclick="openAddModal()">
                    <i class="fas fa-plus"></i> Add Subscription
                </button>
            </div>
        </div>

        <!-- Stats Overview -->
        <div class="row g-4 mb-4">
            <div class="col-md-2">
                <div class="stat-glass-card p-3 rounded-4">
                    <div class="text-white-50 small text-uppercase fw-bold mb-1" style="font-size: 0.65rem; letter-spacing: 0.5px;">Total Active</div>
                    <div class="h4 mb-0 text-white fw-bold">{{ $pagination['total'] }}</div>
                </div>
            </div>
        </div>

        <!-- Active Subs Table Card -->
        <div class="sub-card p-0">
            <div class="table-responsive">
                <table class="table table-borderless align-middle mb-0">
                    <thead class="bg-light-transparent border-bottom border-white-10">
                        <tr class="text-white-50 text-uppercase small fw-bold">
                            <th class="ps-4 py-4">User / Provider</th>
                            <th class="py-4">Plan Details</th>
                            <th class="py-4">Amount</th>
                            <th class="py-4">Start Date</th>
                            <th class="py-4">Expires</th>
                            <th class="py-4">Status</th>
                            <th class="pe-4 py-4 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($activeSubscriptions as $sub)
                        <tr class="hover-row border-bottom border-white-05 transition-all">
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-circle bg-gradient-primary text-white fw-bold d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; border-radius: 50%;">
                                        {{ substr($sub->user->name ?? 'U', 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-white">{{ $sub->user->name ?? 'Unknown User' }}</div>
                                        <div class="small text-white-50">{{ $sub->user->email ?? '--' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3">
                                <span class="badge rounded-pill bg-light text-dark fw-bold px-3 py-2">
                                    {{ $sub->plan }}
                                </span>
                            </td>
                            <td class="py-3">
                                <div class="fw-bold text-white">{{ number_format($sub->price) }} RWF</div>
                            </td>
                            <td class="py-3 text-white-70">
                                {{ $sub->start_date ? $sub->start_date->format('M d, Y') : '--' }}
                            </td>
                            <td class="py-3 text-white-70">
                                {{ $sub->end_date ? $sub->end_date->format('M d, Y') : '--' }}
                            </td>
                            <td class="py-3">
                                @php
                                    $statusClass = match($sub->status) {
                                        'active' => 'success',
                                        'inactive' => 'warning',
                                        'expired' => 'danger',
                                        default => 'secondary'
                                    };
                                @endphp
                                <span class="badge bg-{{ $statusClass }}-subtle text-{{ $statusClass }} border border-{{ $statusClass }}-subtle rounded-pill px-3">
                                    <i class="fas fa-{{ $sub->status == 'active' ? 'check-circle' : 'exclamation-circle' }} me-1"></i> 
                                    {{ ucfirst($sub->status) }}
                                </span>
                            </td>
                            <td class="pe-4 py-3 text-end">
                                <div class="d-flex justify-content-end gap-1">
                                    <button class="btn-action-icon" onclick="openViewModal('{{ $sub->id }}', '{{ $sub->user->name }}', '{{ $sub->user->email }}', '{{ $sub->plan }}', '{{ $sub->price }}', '{{ $sub->start_date->format('Y-m-d') }}', '{{ $sub->end_date->format('Y-m-d') }}', '{{ $sub->status }}')" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn-action-icon" onclick="openEditModal('{{ $sub->id }}', '{{ $sub->user->email }}', '{{ $sub->plan }}', '{{ $sub->price }}', '{{ $sub->end_date->format('Y-m-d') }}')" title="Edit Subscription">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn-action-icon" onclick="openStatusModal('{{ $sub->id }}', '{{ $sub->status }}')" title="Change Status">
                                        <i class="fas fa-toggle-on"></i>
                                    </button>
                                    <button class="btn-action-icon text-danger" onclick="confirmDelete('{{ $sub->id }}')" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center justify-content-center opacity-50">
                                    <i class="fas fa-satellite-dish fa-3x mb-3 text-white-50"></i>
                                    <h5 class="text-white">No Active Subscriptions Found</h5>
                                    <p class="text-white-50">Once users subscribe, they will appear here.</p>
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
                        <a class="page-link bg-dark border-white-10 text-white" href="?page={{ $pagination['page']-1 }}&limit={{ $pagination['limit'] }}"><i class="fas fa-chevron-left"></i></a>
                    </li>
                    @for($i = 1; $i <= $pagination['pages']; $i++)
                    <li class="page-item {{ $i == $pagination['page'] ? 'active' : '' }}">
                        <a class="page-link {{ $i == $pagination['page'] ? 'bg-primary border-primary' : 'bg-dark border-white-10' }} text-white" href="?page={{ $i }}&limit={{ $pagination['limit'] }}">{{ $i }}</a>
                    </li>
                    @endfor
                    <li class="page-item {{ $pagination['page'] >= $pagination['pages'] ? 'disabled' : '' }}">
                        <a class="page-link bg-dark border-white-10 text-white" href="?page={{ $pagination['page']+1 }}&limit={{ $pagination['limit'] }}"><i class="fas fa-chevron-right"></i></a>
                    </li>
                </ul>
            </nav>
        </div>
        @endif
    </div>
</div>

<!-- ADD SUBSCRIPTION MODAL -->
<div id="addSubModal" class="sub-modal-box">
    <div class="sub-glass-card">
        <div class="modal-header-custom">
            <div>
                <h5 class="mb-0 fw-bold text-white">Add New Subscription</h5>
                <p class="small text-white-50 mb-0">Manually provision a plan for a user.</p>
            </div>
            <button class="btn-close-custom" onclick="closeAddModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-3">
            <form id="addSubForm">
                @csrf
                <div class="mb-3">
                    <label class="premium-label">User Email</label>
                    <div class="premium-input-wrapper">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" name="userEmail" class="premium-input" placeholder="e.g. user@example.com" required>
                    </div>
                </div>
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <label class="premium-label">Plan Name</label>
                        <div class="premium-input-wrapper">
                            <i class="fas fa-gem input-icon"></i>
                            <select name="plan" class="premium-input ps-5" id="planSelector" onchange="updatePrice(this.value)">
                                <option value="Basic">Basic</option>
                                <option value="Standard">Standard</option>
                                <option value="Premium">Premium</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="premium-label">Price</label>
                        <div class="premium-input-wrapper">
                            <i class="fas fa-money-bill-wave input-icon"></i>
                            <input type="number" name="price" id="planPrice" class="premium-input ps-5" value="10000" required>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="premium-label">End Date</label>
                    <div class="premium-input-wrapper">
                        <i class="fas fa-calendar-alt input-icon"></i>
                        <input type="date" name="endDate" class="premium-input ps-5" required>
                    </div>
                </div>
                <button type="submit" class="premium-submit-btn">
                    Create Subscription
                </button>
            </form>
        </div>
    </div>
</div>

<!-- VIEW SUBSCRIPTION MODAL -->
<div id="viewSubModal" class="sub-modal-box">
    <div class="sub-glass-card" style="max-width: 380px;">
        <div class="modal-header-custom">
            <div class="flex-grow-1 text-center">
                <h5 class="mb-0 fw-bold text-white">Subscription Details</h5>
                <p class="small text-white-50 mb-0">Full record overview</p>
            </div>
            <button class="btn-close-custom" onclick="closeViewModal()"><i class="fas fa-times"></i></button>
        </div>
        <div class="px-4 py-4 text-center">
            <div class="d-flex flex-column gap-3">
                <div class="bg-dark-transparent px-4 py-3 rounded-4 mx-1">
                    <div class="small text-white-50 text-uppercase ls-1 fw-bold mb-2" style="font-size: 0.65rem;">User Information</div>
                    <div class="text-white fw-bold h6 mb-1 px-3 pe-4" id="viewUserName">--</div>
                    <div class="small text-white-50 px-3 pe-4" id="viewUserEmail">--</div>
                </div>
                
                <div class="row g-2 mx-0">
                    <div class="col-6">
                        <div class="bg-dark-transparent px-3 py-3 rounded-4 h-100">
                            <div class="small text-white-50 text-uppercase ls-1 fw-bold mb-2" style="font-size: 0.6rem;">Plan</div>
                            <div class="text-white fw-bold px-2 pe-3" id="viewPlan">--</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bg-dark-transparent px-3 py-3 rounded-4 h-100">
                            <div class="small text-white-50 text-uppercase ls-1 fw-bold mb-2" style="font-size: 0.6rem;">Price</div>
                            <div class="text-white fw-bold px-2 pe-3" id="viewPrice">--</div>
                        </div>
                    </div>
                </div>

                <div class="row g-2 mx-0">
                    <div class="col-6">
                        <div class="bg-dark-transparent px-3 py-3 rounded-4 h-100">
                            <div class="small text-white-50 text-uppercase ls-1 fw-bold mb-2" style="font-size: 0.6rem;">Start Date</div>
                            <div class="text-white small fw-bold px-2 pe-3" id="viewStart">--</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bg-dark-transparent px-3 py-3 rounded-4 h-100">
                            <div class="small text-white-50 text-uppercase ls-1 fw-bold mb-2" style="font-size: 0.6rem;">Expires</div>
                            <div class="text-white small fw-bold px-2 pe-3" id="viewEnd">--</div>
                        </div>
                    </div>
                </div>

                <div class="bg-dark-transparent px-4 py-3 rounded-4 mx-1">
                    <div class="small text-white-50 text-uppercase ls-1 fw-bold mb-2" style="font-size: 0.65rem;">Current Status</div>
                    <div id="viewStatusBadge" class="d-flex justify-content-center px-3 pe-4">--</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- EDIT SUBSCRIPTION MODAL -->
<div id="editSubModal" class="sub-modal-box">
    <div class="sub-glass-card">
        <div class="modal-header-custom">
            <div>
                <h5 class="mb-0 fw-bold text-white">Edit Subscription</h5>
                <p class="small text-white-50 mb-0">Update plan settings for this user.</p>
            </div>
            <button class="btn-close-custom" onclick="closeEditModal()"><i class="fas fa-times"></i></button>
        </div>
        <div class="p-3">
            <form id="editSubForm">
                @csrf
                @method('PUT')
                <input type="hidden" id="editSubId">
                <div class="mb-3">
                    <label class="premium-label">User Email (Read-only)</label>
                    <div class="premium-input-wrapper opacity-50">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" id="editUserEmail" class="premium-input" readonly>
                    </div>
                </div>
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <label class="premium-label">Plan Name</label>
                        <div class="premium-input-wrapper">
                            <i class="fas fa-gem input-icon"></i>
                            <select name="plan" class="premium-input ps-5" id="editPlanSelector" onchange="updateEditPrice(this.value)">
                                <option value="Basic">Basic</option>
                                <option value="Standard">Standard</option>
                                <option value="Premium">Premium</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="premium-label">Price</label>
                        <div class="premium-input-wrapper">
                            <i class="fas fa-money-bill-wave input-icon"></i>
                            <input type="number" name="price" id="editPlanPrice" class="premium-input ps-5" required>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="premium-label">End Date</label>
                    <div class="premium-input-wrapper">
                        <i class="fas fa-calendar-alt input-icon"></i>
                        <input type="date" name="endDate" id="editEndDate" class="premium-input ps-5" required>
                    </div>
                </div>
                <button type="submit" class="premium-submit-btn">
                    Update Subscription
                </button>
            </form>
        </div>
    </div>
</div>

<!-- CHANGE STATUS MODAL -->
<div id="statusModal" class="sub-modal-box">
    <div class="sub-glass-card shadow-lg" style="max-width: 400px;">
        <div class="modal-header-custom">
            <div>
                <h5 class="mb-0 fw-bold text-white">Update Status</h5>
                <p class="small text-white-50 mb-0">Modify current subscription state.</p>
            </div>
            <button class="btn-close-custom" onclick="closeStatusModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-4">
            <input type="hidden" id="statusSubId">
            <div class="mb-4">
                <label class="premium-label">New Status</label>
                <div class="premium-input-wrapper">
                    <i class="fas fa-stream input-icon"></i>
                    <select id="newStatus" class="premium-input ps-5">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="expired">Expired</option>
                    </select>
                </div>
            </div>
            <button class="premium-submit-btn" onclick="saveStatus()">
                <i class="fas fa-save me-2"></i> Save Changes
            </button>
        </div>
    </div>
</div>

<style>
    /* Premium Root Variables */
    :root {
        --primary-gradient: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
        --dark-glass: rgba(15, 23, 42, 0.9);
        --glass-border: rgba(255, 255, 255, 0.1);
        --highlight: #f59e0b;
        --text-muted: #94a3b8;
    }

    /* Core Layout */
    .unique-subscriptions-wrapper { font-family: 'Inter', sans-serif; padding: 2rem 0; }
    .sub-page-title { font-weight: 800; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-size: 2.2rem; }
    .sub-page-subtitle { color: var(--text-muted); font-size: 1rem; }
    
    /* Stats and Cards */
    .stat-glass-card { background: rgba(255, 255, 255, 0.05); border: 1px solid var(--glass-border); }
    .sub-card {
        background: rgba(30, 41, 59, 0.5);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: 24px;
        box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);
        overflow: hidden;
    }

    .bg-light-transparent { background: rgba(255,255,255,0.03); }
    .border-white-10 { border-color: rgba(255,255,255,0.1) !important; }
    .border-white-05 { border-color: rgba(255,255,255,0.05) !important; }
    .bg-dark-transparent { background: rgba(0,0,0,0.3); }
    .text-white-70 { color: rgba(255,255,255,0.7); }
    .hover-row:hover { background: rgba(255,255,255,0.02); }
    .bg-gradient-primary { background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); }

    /* Enhanced Button Styles */
    .premium-add-btn {
        background: var(--primary-gradient);
        color: #0f172a;
        font-weight: 700;
        padding: 0.5rem 1.25rem;
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 12px -2px rgba(245, 158, 11, 0.3);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
        cursor: pointer;
        text-transform: none;
        font-size: 0.85rem;
    }

    .premium-add-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px -4px rgba(245, 158, 11, 0.4);
    }

    /* Premium Search bar */
    .premium-search-wrapper { position: relative; width: 280px; }
    .premium-search-wrapper .search-icon { position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 0.85rem; pointer-events: none; opacity: 0.6; }
    .premium-search-input {
        width: 100%;
        background: rgba(0, 0, 0, 0.2);
        border: 1px solid var(--glass-border);
        border-radius: 100px;
        padding: 0.5rem 1rem 0.5rem 2.8rem;
        color: white;
        font-size: 0.85rem;
        transition: all 0.2s;
    }
    .premium-search-input:focus { outline: none; border-color: var(--highlight); background: rgba(0, 0, 0, 0.4); box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1); }

    /* Compact Modal Styles */
    .sub-modal-box {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(2, 6, 23, 0.8);
        backdrop-filter: blur(6px);
        z-index: 10000;
        place-items: center;
        padding: 1rem;
    }

    .sub-modal-box.active { display: grid; }

    .sub-glass-card {
        background: var(--dark-glass);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        width: 100%;
        max-width: 350px;
        overflow: hidden;
        box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.7);
        animation: premiumIn 0.3s ease-out;
    }

    @keyframes premiumIn {
        from { transform: translateY(15px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .modal-header-custom {
        padding: 1.25rem 1.5rem;
        background: rgba(255, 255, 255, 0.02);
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-close-custom {
        background: rgba(255, 255, 255, 0.05);
        border: none;
        color: rgba(255, 255, 255, 0.5);
        width: 28px; height: 28px;
        border-radius: 8px;
        display: grid;
        place-items: center;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-close-custom:hover {
        background: rgba(239, 68, 68, 0.15);
        color: #ef4444;
    }

    /* Improved Compact Inputs */
    .premium-label {
        font-size: 0.7rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.4);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
        display: block;
    }

    .premium-input-wrapper {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--highlight);
        font-size: 0.9rem;
        opacity: 0.7;
    }

    .premium-input {
        width: 100%;
        background: rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        padding: 0.6rem 1rem 0.6rem 2.8rem;
        color: white;
        font-size: 0.85rem;
        transition: all 0.2s;
    }

    .premium-input:focus {
        outline: none;
        border-color: var(--highlight);
        background: rgba(0, 0, 0, 0.3);
    }

    .premium-submit-btn {
        width: 100%;
        background: var(--primary-gradient);
        color: #0f172a;
        font-weight: 700;
        padding: 0.8rem;
        border-radius: 12px;
        border: none;
        cursor: pointer;
        font-size: 0.9rem;
        transition: all 0.2s;
        box-shadow: 0 4px 12px -2px rgba(245, 158, 11, 0.3);
    }

    .premium-submit-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px -4px rgba(245, 158, 11, 0.4);
    }

    /* Table Actions */
    .btn-action-icon {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: rgba(255, 255, 255, 0.6);
        width: 32px; height: 32px;
        border-radius: 8px;
        display: grid;
        place-items: center;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 0.85rem;
    }
    .btn-action-icon:hover {
        background: rgba(255, 255, 255, 0.1);
        color: var(--highlight);
        transform: translateY(-2px);
    }
    .btn-action-icon.text-danger:hover {
        color: #ef4444;
        background: rgba(239, 68, 68, 0.1);
    }

    .bg-glass { background: rgba(15, 23, 42, 0.95) !important; backdrop-filter: blur(10px); }
    .btn-dark-transparent { background: rgba(255, 255, 255, 0.05); border: none; width: 32px; height: 32px; display: grid; place-items: center; border-radius: 50%; }
    .cursor-pointer { cursor: pointer; }
</style>

<script>
function changeLimit(limit) {
    const url = new URL(window.location.href);
    url.searchParams.set('limit', limit);
    url.searchParams.set('page', 1);
    window.location.href = url.toString();
}

let searchTimeout;
function debounceSearch(val) {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        const url = new URL(window.location.href);
        url.searchParams.set('search', val);
        url.searchParams.set('page', 1);
        window.location.href = url.toString();
    }, 600);
}

// Restore focus to search bar after reload
window.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('subSearch');
    if (searchInput && searchInput.value) {
        searchInput.focus();
        searchInput.setSelectionRange(searchInput.value.length, searchInput.value.length);
    }
});

function openAddModal() { document.getElementById('addSubModal').classList.add('active'); }
function closeAddModal() { document.getElementById('addSubModal').classList.remove('active'); }

function openViewModal(id, name, email, plan, price, start, end, status) {
    document.getElementById('viewUserName').innerText = name;
    document.getElementById('viewUserEmail').innerText = email;
    document.getElementById('viewPlan').innerText = plan;
    document.getElementById('viewPrice').innerText = Number(price).toLocaleString() + ' RWF';
    document.getElementById('viewStart').innerText = start;
    document.getElementById('viewEnd').innerText = end;
    
    const statusClass = status === 'active' ? 'success' : (status === 'inactive' ? 'warning' : 'danger');
    document.getElementById('viewStatusBadge').innerHTML = `<span class="badge bg-${statusClass}-subtle text-${statusClass} border border-${statusClass}-subtle rounded-pill px-3">${status.toUpperCase()}</span>`;
    
    document.getElementById('viewSubModal').classList.add('active');
}
function closeViewModal() { document.getElementById('viewSubModal').classList.remove('active'); }

function openEditModal(id, email, plan, price, end) {
    document.getElementById('editSubId').value = id;
    document.getElementById('editUserEmail').value = email;
    document.getElementById('editPlanSelector').value = plan;
    document.getElementById('editPlanPrice').value = price;
    document.getElementById('editEndDate').value = end;
    document.getElementById('editSubModal').classList.add('active');
}
function closeEditModal() { document.getElementById('editSubModal').classList.remove('active'); }

function openStatusModal(id, currentStatus) {
    document.getElementById('statusSubId').value = id;
    document.getElementById('newStatus').value = currentStatus;
    document.getElementById('statusModal').classList.add('active');
}
function closeStatusModal() { document.getElementById('statusModal').classList.remove('active'); }

function updatePrice(plan) {
    const priceMap = { 'Basic': 10000, 'Standard': 25000, 'Premium': 50000 };
    document.getElementById('planPrice').value = priceMap[plan];
}
function updateEditPrice(plan) {
    const priceMap = { 'Basic': 10000, 'Standard': 25000, 'Premium': 50000 };
    document.getElementById('editPlanPrice').value = priceMap[plan];
}

document.getElementById('addSubForm').onsubmit = async (e) => {
    e.preventDefault();
    const btn = e.target.querySelector('button[type="submit"]');
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Creating...';
    btn.disabled = true;

    try {
        const formData = new FormData(e.target);
        const response = await fetch("{{ route('super_admin.subscriptions.active.store') }}", {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify(Object.fromEntries(formData))
        });
        const result = await response.json();
        
        if(result.success) {
            window.showNotify("Subscription created successfully!", "success");
            setTimeout(() => window.location.reload(), 1000);
        } else {
            window.showNotify(result.data?.error || "Failed to create subscription", "error");
            btn.innerHTML = originalText;
            btn.disabled = false;
        }
    } catch (err) {
        window.showNotify("Network error occurred", "error");
        btn.innerHTML = originalText;
        btn.disabled = false;
    }
};

document.getElementById('editSubForm').onsubmit = async (e) => {
    e.preventDefault();
    const id = document.getElementById('editSubId').value;
    const btn = e.target.querySelector('button[type="submit"]');
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Updating...';
    btn.disabled = true;

    try {
        const formData = new FormData(e.target);
        const response = await fetch(`{{ url('/super_admin/subscriptions/active') }}/${id}`, {
            method: 'POST', 
            headers: { 
                'Content-Type': 'application/json', 
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-HTTP-Method-Override': 'PUT' 
            },
            body: JSON.stringify(Object.fromEntries(formData))
        });
        const result = await response.json();
        
        if(result.success) {
            window.showNotify("Subscription updated successfully!", "success");
            setTimeout(() => window.location.reload(), 1000);
        } else {
            window.showNotify("Failed to update subscription", "error");
            btn.innerHTML = 'Update Subscription';
            btn.disabled = false;
        }
    } catch (err) {
        window.showNotify("Connection error", "error");
        btn.innerHTML = 'Update Subscription';
        btn.disabled = false;
    }
};

async function saveStatus() {
    const id = document.getElementById('statusSubId').value;
    const status = document.getElementById('newStatus').value;
    const btn = document.querySelector('#statusModal .premium-submit-btn');
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Saving...';
    btn.disabled = true;

    try {
        const response = await fetch(`{{ url('/super_admin/subscriptions/active') }}/${id}/status`, {
            method: 'PATCH',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ status })
        });
        const result = await response.json();
        
        if(result.success) {
            window.showNotify("Status updated successfully!", "success");
            setTimeout(() => window.location.reload(), 800);
        } else {
            window.showNotify("Failed to update status", "error");
            btn.innerHTML = '<i class="fas fa-save me-2"></i> Save Changes';
            btn.disabled = false;
        }
    } catch (err) {
        window.showNotify("Error occurred", "error");
        btn.innerHTML = '<i class="fas fa-save me-2"></i> Save Changes';
        btn.disabled = false;
    }
}

async function confirmDelete(id) {
    if(confirm("Are you sure you want to delete this subscription?")) {
        try {
            const response = await fetch(`{{ url('/super_admin/subscriptions/active') }}/${id}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            });
            const result = await response.json();
            
            if(result.success) {
                window.showNotify("Subscription deleted properly", "warning");
                setTimeout(() => window.location.reload(), 800);
            } else {
                window.showNotify("Action failed", "error");
            }
        } catch (err) {
            window.showNotify("Backend unreachable", "error");
        }
    }
}
</script>
@endsection
