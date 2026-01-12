@extends('layouts.app')

@section('content')
<style>
    :root {
        --accent: #924FC2;
        --card-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
        --glass-border: rgba(255, 255, 255, 0.12);
        --premium-gradient: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        --bg-primary: #ffffff;
        --bg-secondary: #f8fafc;
        --text-primary: #1e293b;
        --text-secondary: #64748b;
        --border-color: #e2e8f0;
    }

    [data-theme="dark"] {
        --bg-primary: #0f172a;
        --bg-secondary: #1e293b;
        --text-primary: #f1f5f9;
        --text-secondary: #94a3b8;
        --border-color: #334155;
        --card-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
        --glass-border: rgba(255, 255, 255, 0.08);
    }

    .b2b-wrapper {
        padding: 40px 30px;
        background: var(--bg-secondary);
        animation: fadeIn 0.8s ease-out;
    }

    [data-theme="dark"] .b2b-wrapper {
        background: #0f172a;
    }

    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

    /* Stats Cards */
    .b2b-stats-grid { 
        display: grid; 
        grid-template-columns: repeat(4, 1fr); 
        gap: 12px; 
        margin-bottom: 30px; 
    }
    
    .b2b-stat-card {
        background: var(--bg-glass);
        border: 1px solid var(--glass-border);
        padding: 12px 14px;
        border-radius: 16px;
        position: relative;
        overflow: hidden;
        box-shadow: var(--card-shadow);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    [data-theme="dark"] .b2b-stat-card {
        background: rgba(30, 41, 59, 0.6);
        backdrop-filter: blur(10px);
        border-color: rgba(255, 255, 255, 0.1);
    }

    .b2b-stat-card:hover {
        transform: translateY(-4px) scale(1.01);
        box-shadow: 0 20px 20px -10px rgba(0,0,0,0.15);
    }

    .stat-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        margin-bottom: 8px;
    }

    .stat-value {
        font-size: 20px;
        font-weight: 800;
        color: var(--text-primary);
        margin: 4px 0;
        line-height: 1.2;
    }

    .stat-label {
        font-size: 0.7rem;
        color: var(--text-secondary);
        font-weight: 600;
        line-height: 1.3;
    }

    /* Tabs */
    .b2b-tabs {
        display: flex;
        gap: 12px;
        margin-bottom: 30px;
        border-bottom: 2px solid var(--border-color);
        padding-bottom: 0;
    }

    .b2b-tab-btn {
        background: transparent;
        border: none;
        padding: 14px 24px;
        font-weight: 700;
        font-size: 0.95rem;
        color: var(--text-secondary);
        cursor: pointer;
        transition: all 0.3s ease;
        border-bottom: 3px solid transparent;
        margin-bottom: -2px;
    }

    .b2b-tab-btn.active {
        color: #6366f1;
        border-bottom-color: #6366f1;
    }

    .b2b-tab-btn:hover {
        color: var(--text-primary);
    }

    /* Table Wrapper */
    .b2b-table-wrapper {
        background: var(--bg-glass);
        border: 1px solid var(--glass-border);
        border-radius: 32px;
        overflow: hidden;
        padding: 40px;
        box-shadow: var(--card-shadow);
    }

    [data-theme="dark"] .b2b-table-wrapper {
        background: rgba(30, 41, 59, 0.5);
        backdrop-filter: blur(10px);
        border-color: rgba(255, 255, 255, 0.1);
    }

    .table {
        margin: 0;
        color: var(--text-primary);
    }

    .table thead th {
        border-bottom: 2px solid var(--border-color);
        padding: 16px 12px;
        font-weight: 700;
        letter-spacing: 0.5px;
        color: var(--text-secondary);
    }

    [data-theme="dark"] .table thead th {
        border-bottom-color: rgba(255, 255, 255, 0.1);
    }

    .table tbody tr {
        border-bottom: 1px solid var(--border-color);
        transition: all 0.3s ease;
    }

    [data-theme="dark"] .table tbody tr {
        border-bottom-color: rgba(255, 255, 255, 0.05);
    }

    .table tbody tr:hover {
        background: rgba(99, 102, 241, 0.05);
        transform: scale(1.005);
    }

    [data-theme="dark"] .table tbody tr:hover {
        background: rgba(99, 102, 241, 0.1);
    }

    /* Badges */
    .tier-badge {
        padding: 6px 14px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.75rem;
        text-transform: uppercase;
    }

    .tier-starter { background: rgba(148, 163, 184, 0.15); color: #64748b; border: 1px solid rgba(148, 163, 184, 0.3); }
    .tier-growth { background: rgba(59, 130, 246, 0.15); color: #3b82f6; border: 1px solid rgba(59, 130, 246, 0.3); }
    .tier-enterprise { background: rgba(168, 85, 247, 0.15); color: #a855f7; border: 1px solid rgba(168, 85, 247, 0.3); }

    [data-theme="dark"] .tier-starter { background: rgba(148, 163, 184, 0.2); color: #94a3b8; }
    [data-theme="dark"] .tier-growth { background: rgba(59, 130, 246, 0.2); color: #60a5fa; }
    [data-theme="dark"] .tier-enterprise { background: rgba(168, 85, 247, 0.2); color: #c084fc; }

    .status-verified { background: rgba(16, 185, 129, 0.15); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3); }
    .status-pending { background: rgba(251, 191, 36, 0.15); color: #f59e0b; border: 1px solid rgba(251, 191, 36, 0.3); }
    .status-suspended { background: rgba(239, 68, 68, 0.15); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3); }

    [data-theme="dark"] .status-verified { background: rgba(16, 185, 129, 0.2); color: #34d399; }
    [data-theme="dark"] .status-pending { background: rgba(251, 191, 36, 0.2); color: #fbbf24; }
    [data-theme="dark"] .status-suspended { background: rgba(239, 68, 68, 0.2); color: #f87171; }

    /* Action Buttons */
    .btn-b2b-action {
        background: transparent;
        color: #6b7280;
        border: 1.5px solid #d1d5db;
        padding: 8px 16px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-b2b-action:hover {
        background: #f3f4f6;
        border-color: #9ca3af;
        color: #374151;
        transform: translateY(-2px);
    }

    .btn-b2b-primary {
        background: linear-gradient(135deg, #4F46E5 0%, #4338ca 100%);
        color: #fff;
        border: none;
        padding: 10px 24px;
        border-radius: 14px;
        font-weight: 800;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }

    .btn-b2b-primary:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.4);
    }

    /* Fee Update Buttons */
    .btn-update-fee {
        background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        color: #fff;
        border: none;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 14px rgba(99, 102, 241, 0.35);
        position: relative;
        overflow: hidden;
    }

    .btn-update-fee::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .btn-update-fee:hover::before {
        left: 100%;
    }

    .btn-update-fee:hover {
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 8px 20px rgba(99, 102, 241, 0.45);
    }

    .btn-update-fee:active {
        transform: translateY(0) scale(0.98);
    }

    .btn-update-fee i {
        margin-right: 6px;
    }

    /* Fee Card Styling */
    .fee-config-card {
        background: var(--bg-primary);
        border: 2px solid var(--border-color);
        border-radius: 20px;
        padding: 24px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    [data-theme="dark"] .fee-config-card {
        background: rgba(30, 41, 59, 0.4);
        border-color: rgba(255, 255, 255, 0.1);
    }

    .fee-config-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #6366f1, #a855f7);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .fee-config-card:hover::before {
        opacity: 1;
    }

    .fee-config-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        border-color: #a855f7;
    }

    [data-theme="dark"] .fee-config-card:hover {
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
    }

    .fee-config-card h5 {
        color: var(--text-primary);
        margin-bottom: 20px;
        font-size: 1.1rem;
    }

    .fee-config-card .form-label {
        color: var(--text-secondary);
        font-size: 0.85rem;
        margin-bottom: 8px;
    }

    .fee-config-card .form-control {
        border: 2px solid var(--border-color);
        border-radius: 10px;
        padding: 10px 14px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .fee-config-card .form-control:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    [data-theme="dark"] .fee-config-card .form-control {
        background: rgba(15, 23, 42, 0.5);
        border-color: rgba(255, 255, 255, 0.1);
        color: var(--text-primary);
    }

    /* Search and Filter Styling */
    .search-filter-wrapper {
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .search-input {
        background: var(--bg-primary);
        border: 2px solid var(--border-color);
        border-radius: 24px;
        padding: 10px 18px;
        font-size: 0.9rem;
        color: var(--text-primary);
        transition: all 0.3s ease;
        width: 280px;
    }

    .search-input:focus {
        outline: none;
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        background: var(--bg-primary);
    }

    .search-input::placeholder {
        color: var(--text-secondary);
        opacity: 0.7;
    }

    [data-theme="dark"] .search-input {
        background: rgba(15, 23, 42, 0.6);
        border-color: rgba(255, 255, 255, 0.1);
        color: var(--text-primary);
    }

    [data-theme="dark"] .search-input:focus {
        background: rgba(15, 23, 42, 0.8);
        border-color: #6366f1;
    }

    .tier-filter {
        background: var(--bg-primary);
        border: 2px solid var(--border-color);
        border-radius: 24px;
        padding: 10px 16px;
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text-primary);
        cursor: pointer;
        transition: all 0.3s ease;
        width: 160px;
    }

    .tier-filter:focus {
        outline: none;
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    [data-theme="dark"] .tier-filter {
        background: rgba(15, 23, 42, 0.6);
        border-color: rgba(255, 255, 255, 0.1);
        color: var(--text-primary);
    }

    [data-theme="dark"] .tier-filter option {
        background: #1e293b;
        color: var(--text-primary);
    }

    .tier-filter:hover {
        border-color: #a855f7;
    }
</style>

<div class="b2b-wrapper">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="color: var(--text-primary);">B2B Marketplace Control</h2>
            <p class="text-muted mb-0">Manage business-to-business transactions, fees, and enterprise accounts</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn-b2b-action" onclick="exportB2BReport()">
                <i class="fas fa-download"></i> Export Report
            </button>
            <button class="btn-b2b-primary" onclick="showPlatformFees()">
                <i class="fas fa-cog"></i> Platform Fees
            </button>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="b2b-stats-grid">
        <div class="b2b-stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%); color: #fff;">
                <i class="fas fa-building"></i>
            </div>
            <div class="stat-value">{{ count($businesses) }}</div>
            <div class="stat-label">Active Businesses</div>
        </div>

        <div class="b2b-stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: #fff;">
                <i class="fas fa-handshake"></i>
            </div>
            <div class="stat-value">{{ $totalTransactions }}</div>
            <div class="stat-label">B2B Transactions</div>
        </div>

        <div class="b2b-stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: #fff;">
                <i class="fas fa-coins"></i>
            </div>
            <div class="stat-value">{{ number_format($platformRevenue) }} RWF</div>
            <div class="stat-label">Platform Revenue</div>
        </div>

        <div class="b2b-stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #a855f7 0%, #7c3aed 100%); color: #fff;">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="stat-value">{{ $pendingVerifications }}</div>
            <div class="stat-label">Pending Verifications</div>
        </div>
    </div>

    <!-- Tabs -->
    <div class="b2b-tabs">
        <button class="b2b-tab-btn active" onclick="switchB2BTab('businesses', this)">Business Accounts</button>
        <button class="b2b-tab-btn" onclick="switchB2BTab('transactions', this)">Transactions</button>
        <button class="b2b-tab-btn" onclick="switchB2BTab('fees', this)">Platform Fees</button>
        <button class="b2b-tab-btn" onclick="switchB2BTab('analytics', this)">Analytics</button>
    </div>

    <!-- Tab 1: Business Accounts -->
    <div id="tab-businesses" class="b2b-content-pane">
        <div class="b2b-table-wrapper">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0" style="color: var(--text-primary);">Registered Business Accounts</h4>
                <div class="search-filter-wrapper">
                    <input type="text" 
                           id="business-search" 
                           class="search-input" 
                           placeholder="🔍 Search businesses..." 
                           onkeyup="filterBusinesses()">
                    <select id="tier-filter" 
                            class="tier-filter" 
                            onchange="filterBusinesses()">
                        <option value="all">All Tiers</option>
                        <option value="starter">Starter</option>
                        <option value="growth">Growth</option>
                        <option value="enterprise">Enterprise</option>
                    </select>
                </div>
            </div>

            <table class="table align-middle">
                <thead>
                    <tr class="text-muted small text-uppercase fw-bold">
                        <th>Business</th>
                        <th>Tier</th>
                        <th>Products</th>
                        <th>Revenue (RWF)</th>
                        <th>Platform Fee</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($businesses as $business)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
                                     style="width: 40px; height: 40px; background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%);">
                                    {{ substr($business['name'], 0, 1) }}
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $business['name'] }}</div>
                                    <div class="text-muted small">{{ $business['email'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="tier-badge tier-{{ strtolower($business['tier']) }}">{{ $business['tier'] }}</span></td>
                        <td class="fw-bold">{{ $business['products_count'] }}</td>
                        <td class="fw-bold text-primary">{{ number_format($business['revenue']) }}</td>
                        <td class="text-success fw-bold">{{ number_format($business['platform_fee']) }}</td>
                        <td><span class="tier-badge status-{{ strtolower($business['status']) }}">{{ $business['status'] }}</span></td>
                        <td class="text-end">
                            <div class="d-flex gap-2 justify-content-end">
                                <button class="btn-b2b-action" onclick="viewBusinessDetails('{{ $business['id'] }}', '{{ $business['name'] }}')">
                                    <i class="fas fa-eye"></i> View
                                </button>
                                <button class="btn-b2b-action" onclick="manageFees('{{ $business['id'] }}', '{{ $business['name'] }}')">
                                    <i class="fas fa-dollar-sign"></i> Fees
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tab 2: Transactions -->
    <div id="tab-transactions" class="b2b-content-pane d-none">
        <div class="b2b-table-wrapper">
            <h4 class="fw-bold mb-4">B2B Transaction History</h4>
            <table class="table align-middle">
                <thead>
                    <tr class="text-muted small text-uppercase fw-bold">
                        <th>Transaction ID</th>
                        <th>Buyer</th>
                        <th>Seller</th>
                        <th>Amount (RWF)</th>
                        <th>Platform Fee</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $txn)
                    <tr>
                        <td class="fw-bold text-primary">#{{ $txn['id'] }}</td>
                        <td>{{ $txn['buyer'] }}</td>
                        <td>{{ $txn['seller'] }}</td>
                        <td class="fw-bold">{{ number_format($txn['amount']) }}</td>
                        <td class="text-success fw-bold">{{ number_format($txn['fee']) }}</td>
                        <td class="text-muted">{{ \Carbon\Carbon::parse($txn['date'])->format('M d, Y') }}</td>
                        <td><span class="tier-badge status-{{ strtolower($txn['status']) }}">{{ $txn['status'] }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tab 3: Platform Fees -->
    <div id="tab-fees" class="b2b-content-pane d-none">
        <div class="b2b-table-wrapper">
            <h4 class="fw-bold mb-4">Platform Fee Configuration</h4>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="fee-config-card">
                        <h5 class="fw-bold mb-3"><i class="fas fa-star text-muted"></i> Starter Tier</h5>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Transaction Fee (%)</label>
                            <input type="number" id="starter-txn-fee" class="form-control" value="5" step="0.1" min="0" max="100">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Monthly Fee (RWF)</label>
                            <input type="number" id="starter-monthly-fee" class="form-control" value="50000" step="1000" min="0">
                        </div>
                        <button class="btn-update-fee w-100" onclick="updateTierFees('starter')">
                            <i class="fas fa-save"></i> Update Fees
                        </button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="fee-config-card">
                        <h5 class="fw-bold mb-3"><i class="fas fa-chart-line text-primary"></i> Growth Tier</h5>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Transaction Fee (%)</label>
                            <input type="number" id="growth-txn-fee" class="form-control" value="3.5" step="0.1" min="0" max="100">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Monthly Fee (RWF)</label>
                            <input type="number" id="growth-monthly-fee" class="form-control" value="150000" step="1000" min="0">
                        </div>
                        <button class="btn-update-fee w-100" onclick="updateTierFees('growth')">
                            <i class="fas fa-save"></i> Update Fees
                        </button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="fee-config-card">
                        <h5 class="fw-bold mb-3"><i class="fas fa-crown" style="color: #a855f7;"></i> Enterprise Tier</h5>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Transaction Fee (%)</label>
                            <input type="number" id="enterprise-txn-fee" class="form-control" value="2" step="0.1" min="0" max="100">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Monthly Fee (RWF)</label>
                            <input type="number" id="enterprise-monthly-fee" class="form-control" value="500000" step="1000" min="0">
                        </div>
                        <button class="btn-update-fee w-100" onclick="updateTierFees('enterprise')">
                            <i class="fas fa-save"></i> Update Fees
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab 4: Analytics -->
    <div id="tab-analytics" class="b2b-content-pane d-none">
        <div class="b2b-table-wrapper">
            <h4 class="fw-bold mb-4">B2B Analytics Dashboard</h4>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-4 border rounded-3">
                        <h6 class="fw-bold mb-3">Revenue by Tier</h6>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Starter</span>
                            <span class="fw-bold">2,500,000 RWF</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Growth</span>
                            <span class="fw-bold">8,750,000 RWF</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Enterprise</span>
                            <span class="fw-bold">15,000,000 RWF</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 border rounded-3">
                        <h6 class="fw-bold mb-3">Top Performing Businesses</h6>
                        <div class="d-flex justify-content-between mb-2">
                            <span>AgriGrow Supplies Ltd</span>
                            <span class="fw-bold">5,200,000 RWF</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>BuildRight Contractors</span>
                            <span class="fw-bold">4,800,000 RWF</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>TechSolutions Rwanda</span>
                            <span class="fw-bold">3,900,000 RWF</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function switchB2BTab(tabName, btn) {
        document.querySelectorAll('.b2b-tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        document.querySelectorAll('.b2b-content-pane').forEach(p => {
            p.style.display = 'none';
            p.classList.add('d-none');
        });

        const selectedTab = document.getElementById('tab-' + tabName);
        if (selectedTab) {
            selectedTab.style.display = 'block';
            selectedTab.classList.remove('d-none');
        }
    }

    function viewBusinessDetails(id, name) {
        alert(`Viewing details for: ${name}\n\nBusiness ID: ${id}\n\nThis will show:\n• Complete business profile\n• Product catalog\n• Transaction history\n• Revenue analytics\n• Compliance status`);
        showNotify(`Loading details for ${name}...`, 'info');
    }

    function manageFees(id, name) {
        alert(`Manage Platform Fees for: ${name}\n\nCurrent Configuration:\n• Transaction Fee: 3.5%\n• Monthly Subscription: 150,000 RWF\n• Total Fees Collected: 2,450,000 RWF\n\nYou can adjust fees based on business tier and performance.`);
        showNotify(`Fee management opened for ${name}`, 'info');
    }

    function exportB2BReport() {
        showNotify('Generating B2B comprehensive report...', 'info');
        setTimeout(() => {
            showNotify('Report exported successfully! Check your downloads.', 'success');
        }, 1500);
    }

    function showPlatformFees() {
        switchB2BTab('fees', document.querySelectorAll('.b2b-tab-btn')[2]);
    }

    function updateTierFees(tier) {
        const txnFee = document.getElementById(`${tier}-txn-fee`).value;
        const monthlyFee = document.getElementById(`${tier}-monthly-fee`).value;
        
        // Validate inputs
        if (!txnFee || !monthlyFee) {
            showNotify('Please fill in all fee fields', 'error');
            return;
        }

        if (parseFloat(txnFee) < 0 || parseFloat(txnFee) > 100) {
            showNotify('Transaction fee must be between 0% and 100%', 'error');
            return;
        }

        if (parseFloat(monthlyFee) < 0) {
            showNotify('Monthly fee cannot be negative', 'error');
            return;
        }

        // Show loading state
        const btn = event.target;
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Updating...';
        btn.disabled = true;

        // Simulate API call
        setTimeout(() => {
            // Here you would make an actual API call to update the fees
            // Example: fetch('/api/super-admin/update-tier-fees', { method: 'POST', body: JSON.stringify({ tier, txnFee, monthlyFee }) })
            
            btn.innerHTML = '<i class="fas fa-check"></i> Updated!';
            btn.style.background = 'linear-gradient(135deg, #10b981 0%, #059669 100%)';
            
            showNotify(`${tier.charAt(0).toUpperCase() + tier.slice(1)} Tier fees updated successfully!`, 'success');
            
            // Reset button after 2 seconds
            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.style.background = '';
                btn.disabled = false;
            }, 2000);
        }, 1000);
    }

    // Helper function for notifications (if not already defined)
    function showNotify(message, type) {
        // Check if a notification system exists
        if (typeof window.showNotification === 'function') {
            window.showNotification(message, type);
        } else {
            // Fallback to alert if no notification system
            const icon = type === 'success' ? '✓' : type === 'error' ? '✗' : 'ℹ';
            alert(`${icon} ${message}`);
        }
    }

    // Filter businesses by search term and tier
    function filterBusinesses() {
        const searchInput = document.getElementById('business-search');
        const tierFilter = document.getElementById('tier-filter');
        const table = document.querySelector('#tab-businesses table tbody');
        
        if (!searchInput || !tierFilter || !table) return;
        
        const searchTerm = searchInput.value.toLowerCase().trim();
        const selectedTier = tierFilter.value.toLowerCase();
        const rows = table.getElementsByTagName('tr');
        
        let visibleCount = 0;
        
        for (let i = 0; i < rows.length; i++) {
            const row = rows[i];
            const businessName = row.querySelector('td:first-child .fw-bold')?.textContent.toLowerCase() || '';
            const businessEmail = row.querySelector('td:first-child .text-muted')?.textContent.toLowerCase() || '';
            const tierBadge = row.querySelector('.tier-badge')?.textContent.toLowerCase().trim() || '';
            
            // Check if row matches search term
            const matchesSearch = searchTerm === '' || 
                                businessName.includes(searchTerm) || 
                                businessEmail.includes(searchTerm);
            
            // Check if row matches tier filter
            const matchesTier = selectedTier === 'all' || tierBadge === selectedTier;
            
            // Show or hide row based on filters
            if (matchesSearch && matchesTier) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        }
        
        // Show message if no results
        const existingMessage = document.getElementById('no-results-message');
        if (existingMessage) {
            existingMessage.remove();
        }
        
        if (visibleCount === 0) {
            const noResultsRow = document.createElement('tr');
            noResultsRow.id = 'no-results-message';
            noResultsRow.innerHTML = `
                <td colspan="7" class="text-center py-5">
                    <div style="color: var(--text-secondary);">
                        <i class="fas fa-search fa-3x mb-3" style="opacity: 0.3;"></i>
                        <h5>No businesses found</h5>
                        <p>Try adjusting your search or filter criteria</p>
                    </div>
                </td>
            `;
            table.appendChild(noResultsRow);
        }
    }
</script>
@endsection
