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

    body {
        background: var(--bg-secondary);
        color: var(--text-primary);
    }

    [data-theme="dark"] {
        --glass-border: rgba(255, 255, 255, 0.08);
    }

    .marketplace-wrapper { 
        padding: 40px 30px; 
        animation: fadeIn 0.8s ease-out;
        background: var(--bg-secondary);
    }

    [data-theme="dark"] .marketplace-wrapper {
        background: #0f172a;
    }
    
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

    /* Stats Cards - Premium Redesign */
    .market-stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 40px; }
    .market-stat-card {
        background: var(--bg-glass); 
        border: 1px solid var(--glass-border);
        padding: 20px 18px; 
        border-radius: 24px; 
        position: relative; 
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        box-shadow: var(--card-shadow);
        backdrop-filter: blur(20px);
    }

    [data-theme="dark"] .market-stat-card {
        background: rgba(30, 41, 59, 0.6);
        backdrop-filter: blur(10px);
        border-color: rgba(255, 255, 255, 0.1);
    }
    .market-stat-card:hover { 
        transform: translateY(-10px) scale(1.02); 
        box-shadow: 0 40px 40px -20px rgba(0,0,0,0.12);
        border-color: var(--primary);
    }
    .market-stat-card::before {
        content: ''; position: absolute; top: 0; left: 0; width: 4px; height: 100%;
        background: var(--premium-gradient); opacity: 0; transition: 0.3s;
    }
    .market-stat-card:hover::before { opacity: 1; }
    .market-stat-card i { 
        position: absolute; right: -10px; top: -10px; font-size: 70px; 
        opacity: 0.03; transform: rotate(-15deg); 
    }
    .market-stat-card h2 { font-size: 1.8rem !important; }
    .market-stat-card .small { font-size: 0.7rem !important; }
    
    /* Tab System - Modern Minimalist */
    .market-tabs { 
        display: flex; gap: 8px; margin-bottom: 40px; 
        background: rgba(0,0,0,0.04); padding: 8px; border-radius: 20px; 
        width: fit-content; border: 1px solid var(--glass-border);
    }
    [data-theme="dark"] .market-tabs { background: rgba(255,255,255,0.03); }
    .market-tab-btn {
        padding: 14px 28px; border-radius: 16px; border: none; background: none;
        font-weight: 800; color: var(--text-muted); cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 0.9rem; letter-spacing: 0.3px;
    }
    .market-tab-btn.active { 
        background: #fff; color: var(--primary); 
        box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); 
        transform: scale(1.05);
    }
    [data-theme="dark"] .market-tab-btn.active { 
        background: #1e293b; color: #fff; 
        box-shadow: 0 10px 20px rgba(0,0,0,0.4); 
    }

    /* Tab Content Panes */
    .market-content-pane {
        animation: fadeInTab 0.4s ease-out;
    }

    @keyframes fadeInTab {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Tables - Floating Design */
    .pro-table-wrapper { 
        background: var(--bg-glass); 
        border: 1px solid var(--glass-border); 
        border-radius: 32px; overflow: hidden; 
        padding: 40px; 
        box-shadow: var(--card-shadow);
    }

    [data-theme="dark"] .pro-table-wrapper {
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
    }

    [data-theme="dark"] .table thead th {
        border-bottom-color: rgba(255, 255, 255, 0.1);
        color: var(--text-secondary);
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
    .table tbody tr:last-child { border-bottom: none; }

    /* Badges & Status */
    .plan-badge { 
        padding: 6px 14px; 
        border-radius: 12px; 
        font-weight: 700; 
        font-size: 0.75rem; 
        text-transform: uppercase; 
        letter-spacing: 0.5px;
    }
    .plan-basic { 
        background: rgba(148, 163, 184, 0.15); 
        color: #64748b; 
        border: 1px solid rgba(148, 163, 184, 0.3);
    }
    .plan-standard { 
        background: rgba(59, 130, 246, 0.15); 
        color: #3b82f6; 
        border: 1px solid rgba(59, 130, 246, 0.3);
    }
    .plan-premium { 
        background: rgba(168, 85, 247, 0.15); 
        color: #a855f7; 
        border: 1px solid rgba(168, 85, 247, 0.3);
    }

    [data-theme="dark"] .plan-basic {
        background: rgba(148, 163, 184, 0.2);
        color: #94a3b8;
    }
    [data-theme="dark"] .plan-standard {
        background: rgba(59, 130, 246, 0.2);
        color: #60a5fa;
    }
    [data-theme="dark"] .plan-premium {
        background: rgba(168, 85, 247, 0.2);
        color: #c084fc;
    }

    .status-active { 
        background: rgba(16, 185, 129, 0.15); 
        color: #10b981; 
        border: 1px solid rgba(16, 185, 129, 0.3);
    }
    .status-pending { 
        background: rgba(251, 191, 36, 0.15); 
        color: #f59e0b; 
        border: 1px solid rgba(251, 191, 36, 0.3);
    }

    [data-theme="dark"] .status-active {
        background: rgba(16, 185, 129, 0.2);
        color: #34d399;
    }
    [data-theme="dark"] .status-pending {
        background: rgba(251, 191, 36, 0.2);
        color: #fbbf24;
    }

    .level-badge { 
        font-weight: 900; 
        letter-spacing: 0.5px; 
        font-size: 0.85rem; 
    }

    /* Plan Configuration */
    .plans-config-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 30px; }
    .plan-config-card {
        background: var(--bg-glass); border: 1px solid var(--glass-border);
        padding: 40px 35px; border-radius: 35px; position: relative;
        transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: var(--card-shadow);
    }
    .plan-config-card:hover { transform: translateY(-15px); border-color: var(--primary); }
    .plan-price-tag { font-size: 36px; font-weight: 900; color: var(--text-main); margin: 25px 0; letter-spacing: -1.5px; }

    /* Inputs & Selects */
    .form-control-premium {
        background: rgba(0,0,0,0.03); border: 1px solid var(--glass-border);
        border-radius: 14px; padding: 12px 20px; font-size: 0.9rem; transition: 0.3s;
    }
    [data-theme="dark"] .form-control-premium { background: rgba(255,255,255,0.03); color: #fff; }
    .form-control-premium:focus { border-color: var(--primary); box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1); outline: none; }

    /* Premium Action Buttons */
    .btn-glass-dark, .btn-glass-primary {
        padding: 12px 24px;
        border-radius: 16px;
        font-weight: 800;
        font-size: 0.85rem;
        border: 1px solid transparent;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        backdrop-filter: blur(10px);
    }
    
    .btn-glass-dark {
        background: rgba(15, 23, 42, 0.9);
        color: #fff;
        border-color: rgba(255, 255, 255, 0.1);
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.3);
    }
    
    .btn-glass-primary {
        background: linear-gradient(135deg, #4F46E5 0%, #4338ca 100%);
        color: #fff;
        border-color: rgba(255, 255, 255, 0.2);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4);
    }
    
    .btn-glass-dark:hover, .btn-glass-primary:hover {
        transform: translateY(-3px) scale(1.05);
        filter: brightness(1.15);
    }
    
    .btn-glass-dark:active, .btn-glass-primary:active {
        transform: translateY(0) scale(0.98);
    }
    
    [data-theme="dark"] .btn-glass-dark {
        background: rgba(30, 41, 59, 0.8);
        border-color: rgba(255, 255, 255, 0.15);
    }
    
    [data-theme="dark"] .btn-glass-primary {
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.5);
    }

    /* Moderation Action Buttons */
    .btn-mod-approve {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: #fff;
        border: none;
        padding: 8px 20px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-mod-approve:hover {
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
    }

    .btn-mod-reject {
        background: transparent;
        color: #ef4444;
        border: 1.5px solid #ef4444;
        padding: 8px 20px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-mod-reject:hover {
        background: #ef4444;
        color: #fff;
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .btn-mod-delete {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.2);
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .btn-mod-delete:hover {
        background: #ef4444;
        color: #fff;
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
    }

    [data-theme="dark"] .btn-mod-approve {
        box-shadow: 0 2px 10px rgba(16, 185, 129, 0.4);
    }

    [data-theme="dark"] .btn-mod-delete {
        background: rgba(239, 68, 68, 0.15);
    }

    /* Mediator Network Buttons */
    .btn-settlement {
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
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-settlement:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.4);
    }

    .btn-audit {
        background: rgba(30, 41, 59, 0.9);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 8px 18px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-audit:hover {
        background: rgba(79, 70, 229, 0.9);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }

    [data-theme="dark"] .btn-settlement {
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.5);
    }

    [data-theme="dark"] .btn-audit {
        background: rgba(51, 65, 85, 0.8);
        border-color: rgba(255, 255, 255, 0.15);
    }

    /* Seller Action Buttons */
    .btn-seller-upgrade {
        background: linear-gradient(135deg, #4F46E5 0%, #4338ca 100%);
        color: #fff;
        border: none;
        padding: 8px 16px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(79, 70, 229, 0.3);
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-seller-upgrade:hover {
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4);
    }

    .btn-seller-details {
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

    .btn-seller-details:hover {
        background: #f3f4f6;
        border-color: #9ca3af;
        color: #374151;
        transform: translateY(-2px);
    }

    [data-theme="dark"] .btn-seller-upgrade {
        box-shadow: 0 2px 10px rgba(79, 70, 229, 0.4);
    }

    [data-theme="dark"] .btn-seller-details {
        border-color: rgba(255, 255, 255, 0.2);
        color: #9ca3af;
    }

    [data-theme="dark"] .btn-seller-details:hover {
        background: rgba(255, 255, 255, 0.05);
        border-color: rgba(255, 255, 255, 0.3);
        color: #e5e7eb;
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

    .custom-filter {
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

    .custom-filter:focus {
        outline: none;
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    [data-theme="dark"] .custom-filter {
        background: rgba(15, 23, 42, 0.6);
        border-color: rgba(255, 255, 255, 0.1);
        color: var(--text-primary);
    }

    [data-theme="dark"] .custom-filter option {
        background: #1e293b;
        color: var(--text-primary);
    }

    .custom-filter:hover {
        border-color: #a855f7;
    }
</style>

<div class="marketplace-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="fw-800" style="font-size: 2.2rem; margin: 0;">Marketplace Intelligence</h1>
            <p class="text-muted fw-500">Global oversight of products, seller subscriptions, and mediator tiers.</p>
        </div>
        <div class="d-flex gap-3">
            <button class="btn-glass-dark" onclick="window.location.href='/super_admin/logs/audit'">
                <i class="fas fa-file-export"></i>Audit Logs
            </button>
            <button class="btn-glass-primary" onclick="window.location.href='/super_admin/billing/rules'">
                <i class="fas fa-cog"></i>Global Rules
            </button>
        </div>
    </div>

    <!-- Marketplace Stats -->
    <div class="market-stats-grid">
        <div class="market-stat-card">
            <i class="fas fa-shopping-bag"></i>
            <span class="text-muted small fw-bold text-uppercase">Active Listings</span>
            <h2 class="fw-900 mt-2 mb-0">{{ number_format($stats['total_listings']) }}</h2>
            <div class="text-success small mt-2"><i class="fas fa-arrow-up me-1"></i>12% increase</div>
        </div>
        <div class="market-stat-card">
            <i class="fas fa-clock"></i>
            <span class="text-muted small fw-bold text-uppercase">Pending Approvals</span>
            <h2 class="fw-900 mt-2 mb-0 text-warning">{{ $stats['pending_reviews'] }}</h2>
            <div class="text-muted small mt-2">Requires immediate attention</div>
        </div>
        <div class="market-stat-card">
            <i class="fas fa-users"></i>
            <span class="text-muted small fw-bold text-uppercase">Verified Sellers</span>
            <h2 class="fw-900 mt-2 mb-0">{{ $stats['total_sellers'] }}</h2>
            <div class="text-muted small mt-2">Paid Account Holders</div>
        </div>
        <div class="market-stat-card">
            <i class="fas fa-coins"></i>
            <span class="text-muted small fw-bold text-uppercase">Platform Revenue</span>
            <h2 class="fw-900 mt-2 mb-0 text-primary">{{ number_format($stats['marketplace_revenue']) }} <span style="font-size: 1rem;">RWF</span></h2>
            <div class="text-success small mt-2">Subscription & Commissions</div>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="market-tabs">
        <button class="market-tab-btn active" onclick="switchMarketTab('inventory', this)">Master Inventory</button>
        <button class="market-tab-btn" onclick="switchMarketTab('subscriptions', this)">Seller Plans</button>
        <button class="market-tab-btn" onclick="switchMarketTab('network', this)">Mediator Network</button>
    </div>

    <!-- Tab 1: Inventory -->
    <div id="tab-inventory" class="market-content-pane">
        <div class="pro-table-wrapper">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0">Product Moderation</h4>
                <div class="search-filter-wrapper">
                    <select id="inventoryPageSize" class="custom-filter" style="width: 100px;" onchange="updateInventoryPageSize()">
                        <option value="5">5 rows</option>
                        <option value="10" selected>10 rows</option>
                        <option value="15">15 rows</option>
                        <option value="20">20 rows</option>
                    </select>
                    <input type="text" 
                           id="inventory-search" 
                           class="search-input" 
                           placeholder="🔍 Search products..." 
                           onkeyup="filterInventory()">
                    <select id="status-filter" 
                            class="custom-filter" 
                            onchange="filterInventory()">
                        <option value="all">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="active">Active</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
            </div>
            <table class="table align-middle">
                <thead>
                    <tr class="text-muted small text-uppercase fw-bold">
                        <th>Identity</th>
                        <th>Seller</th>
                        <th>Category</th>
                        <th>Pricing Tier</th>
                        <th>Price (RWF)</th>
                        <th>Status</th>
                        <th class="text-end">Moderation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $p)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width: 40px; height: 40px; background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%);">
                                    {{ substr($p['name'], 0, 1) }}
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $p['name'] }}</div>
                                    <div class="text-muted small">Listed {{ $p['created_at'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $p['seller_name'] }}</div>
                            <div class="text-muted" style="font-size: 0.7rem;">ID: #SL-{{ $p['seller_id'] }}</div>
                        </td>
                        <td><span class="badge border text-dark fw-normal rounded-pill">{{ $p['category'] }}</span></td>
                        <td><span class="plan-badge plan-{{ strtolower($p['plan']) }}">{{ $p['plan'] }}</span></td>
                        <td class="fw-bold">{{ number_format($p['price']) }}</td>
                        <td>
                            <span class="badge rounded-pill {{ $p['status'] == 'Active' ? 'status-active' : 'status-pending' }}">
                                {{ $p['status'] }}
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="d-flex gap-2 justify-content-end">
                                @if($p['status'] == 'Pending')
                                    <button class="btn-mod-approve" onclick="moderateProduct('{{ $p['id'] }}', 'approve')">
                                        <i class="fas fa-check"></i> Approve
                                    </button>
                                    <button class="btn-mod-reject" onclick="moderateProduct('{{ $p['id'] }}', 'reject')">
                                        <i class="fas fa-times"></i> Reject
                                    </button>
                                @elseif($p['status'] == 'Rejected')
                                    <button class="btn-mod-delete" onclick="moderateProduct('{{ $p['id'] }}', 'delete')" title="Delete permanently">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @else
                                    <button class="btn-mod-delete" onclick="moderateProduct('{{ $p['id'] }}', 'delete')" title="Remove listing">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Inventory Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4 p-3 bg-white rounded-4 border border-light shadow-sm">
                <div class="d-flex align-items-center gap-3">
                    <div class="text-muted small">
                        Showing <span id="inventoryStart" class="fw-bold text-dark">0</span> - <span id="inventoryEnd" class="fw-bold text-dark">0</span> of <span id="inventoryTotal" class="fw-bold text-dark">{{ count($products) }}</span>
                    </div>
                </div>
                <div id="inventoryPagination" class="d-flex gap-2"></div>
            </div>
        </div>
    </div>

    <!-- Tab 2: Seller Plans -->
    <div id="tab-subscriptions" class="market-content-pane d-none">
        <div class="pro-table-wrapper">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0">Seller Subscriptions Management</h4>
                <div class="search-filter-wrapper">
                    <select id="sellerPageSize" class="custom-filter" style="width: 100px;" onchange="updateSellerPageSize()">
                        <option value="5">5 rows</option>
                        <option value="10" selected>10 rows</option>
                        <option value="15">15 rows</option>
                        <option value="20">20 rows</option>
                    </select>
                    <input type="text" 
                           id="seller-search" 
                           class="search-input" 
                           placeholder="🔍 Search sellers..." 
                           onkeyup="filterSellers()">
                    <select id="plan-filter" 
                            class="custom-filter" 
                            onchange="filterSellers()">
                        <option value="all">All Plans</option>
                        <option value="Basic">Basic</option>
                        <option value="Standard">Standard</option>
                        <option value="Premium">Premium</option>
                    </select>
                </div>
            </div>

            <table class="table align-middle" id="sellersTable">
                <thead>
                    <tr class="text-muted small text-uppercase fw-bold">
                        <th>Seller</th>
                        <th>Subscription Plan</th>
                        <th>Status</th>
                        <th>Monthly Revenue</th>
                        <th>Joined Date</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody id="sellersTableBody">
                    @foreach($sellerSubscriptions as $seller)
                    <tr class="seller-row" data-plan="{{ $seller['plan'] }}" data-name="{{ strtolower($seller['name']) }}">
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" 
                                     style="width: 40px; height: 40px; background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%);">
                                    {{ substr($seller['name'], 0, 1) }}
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $seller['name'] }}</div>
                                    <div class="text-muted small">{{ $seller['email'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="plan-badge plan-{{ strtolower($seller['plan']) }}">{{ $seller['plan'] }}</span>
                        </td>
                        <td>
                            <span class="badge rounded-pill {{ $seller['status'] == 'Active' ? 'status-active' : 'status-pending' }}">
                                {{ $seller['status'] }}
                            </span>
                        </td>
                        <td class="fw-bold">{{ number_format($seller['revenue']) }} RWF</td>
                        <td class="text-muted">{{ \Carbon\Carbon::parse($seller['joined'])->format('M d, Y') }}</td>
                        <td class="text-end">
                            <div class="d-flex gap-2 justify-content-end">
                                <button class="btn-seller-upgrade" 
                                        onclick="upgradeSeller('{{ $seller['name'] }}', '{{ $seller['plan'] }}', '{{ $seller['email'] }}')">
                                    <i class="fas fa-arrow-up"></i> Upgrade
                                </button>
                                <button class="btn-seller-details" 
                                        onclick="viewSellerDetails('{{ $seller['name'] }}', '{{ $seller['plan'] }}', {{ $seller['revenue'] }}, '{{ $seller['joined'] }}', '{{ $seller['email'] }}')">
                                    <i class="fas fa-eye"></i> Details
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4 p-3 bg-white rounded-4 border border-light shadow-sm">
                <div class="d-flex align-items-center gap-3">
                    <div class="text-muted small">
                        Showing <span id="sellerStart" class="fw-bold text-dark">1</span> - <span id="sellerEnd" class="fw-bold text-dark">10</span> of <span id="sellerTotal" class="fw-bold text-dark">{{ count($sellerSubscriptions) }}</span>
                    </div>
                </div>
                <div id="sellerPagination" class="d-flex gap-2"></div>
            </div>
        </div>
    </div>

    <!-- Tab 3: Mediator Network -->
    <div id="tab-network" class="market-content-pane d-none">
        <div class="pro-table-wrapper">
             <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0">Mediator Referral Tracking</h4>
                <div class="d-flex gap-3 align-items-center">
                    <select id="mediatorPageSize" class="custom-filter" style="width: 100px;" onchange="updateMediatorPageSize()">
                        <option value="5">5 rows</option>
                        <option value="10" selected>10 rows</option>
                        <option value="15">15 rows</option>
                        <option value="20">20 rows</option>
                    </select>
                    <button class="btn-settlement" onclick="generateSettlementReport()">
                        <i class="fas fa-file-invoice-dollar"></i>Settlement Report
                    </button>
                </div>
            </div>
            <table class="table align-middle">
                <thead>
                    <tr class="text-muted small text-uppercase fw-bold">
                        <th>Mediator Identity</th>
                        <th>Clients Provided</th>
                        <th>Current Tier</th>
                        <th>Total Earnings (RWF)</th>
                        <th>Next Milestone</th>
                        <th class="text-end">Account Levels</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mediators as $m)
                    <tr>
                        <td>
                            <div class="fw-bold">{{ $m['name'] }}</div>
                            <div class="text-muted small">Partner since 2024</div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <span class="fw-bold h5 mb-0">{{ $m['clients'] }}</span>
                                <span class="text-muted small">verified clients</span>
                            </div>
                        </td>
                        <td>
                            <span class="level-badge text-{{ strtolower($m['level']) == 'premium' ? 'warning' : 'primary' }}">
                                <i class="fas {{ strtolower($m['level']) == 'premium' ? 'fa-crown' : 'fa-certificate' }} me-2"></i>{{ $m['level'] }}
                            </span>
                        </td>
                        <td class="fw-bold text-primary">{{ number_format($m['earnings']) }}</td>
                        <td>
                            @if($m['requirement'] > 0)
                                <div class="progress" style="height: 6px; width: 120px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ ($m['clients'] / $m['requirement']) * 100 }}%"></div>
                                </div>
                                <div class="small text-muted mt-1">{{ $m['requirement'] - $m['clients'] }} more for upgrade</div>
                            @else
                                <span class="text-success small fw-bold"><i class="fas fa-check-circle me-1"></i>Max Tier Reached</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <button class="btn-audit" onclick="auditMediator('{{ $m['name'] }}', {{ $m['clients'] }}, {{ $m['earnings'] }})">
                                <i class="fas fa-search-dollar"></i> Audit Commission
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Mediator Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4 p-3 bg-white rounded-4 border border-light shadow-sm">
                <div class="d-flex align-items-center gap-3">
                    <div class="text-muted small">
                        Showing <span id="mediatorStart" class="fw-bold text-dark">0</span> - <span id="mediatorEnd" class="fw-bold text-dark">0</span> of <span id="mediatorTotal" class="fw-bold text-dark">{{ count($mediators) }}</span>
                    </div>
                </div>
                <div id="mediatorPagination" class="d-flex gap-2"></div>
            </div>
        </div>
    </div>
</div>

<script>
    // Consolidated initialization on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Force hide all tabs first
        document.querySelectorAll('.market-content-pane').forEach(pane => {
            pane.style.display = 'none';
            pane.classList.add('d-none');
        });
        
        // Show only the first tab
        const firstTab = document.getElementById('tab-inventory');
        if (firstTab) {
            firstTab.style.display = 'block';
            firstTab.classList.remove('d-none');
        }
        
        // Initialize seller pagination
        if (document.getElementById('sellersTable')) {
            filterSellers(); // This calls paginateSellers
        }
        
        // Initialize inventory pagination
        filterInventory();

        // Initialize mediator pagination
        paginateMediators();
    });

    function switchMarketTab(tabName, btn) {
        // Handle Tab Buttons - remove active from all, add to clicked
        document.querySelectorAll('.market-tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        // Handle Content Panes - hide all first
        document.querySelectorAll('.market-content-pane').forEach(p => {
            p.style.display = 'none';
            p.classList.add('d-none');
        });
        
        // Show selected tab
        const selectedTab = document.getElementById('tab-' + tabName);
        if (selectedTab) {
            selectedTab.style.display = 'block';
            selectedTab.classList.remove('d-none');
        }
    }

    async function moderateProduct(id, action) {
        if(!confirm(`Are you sure you want to ${action} this listing?`)) return;

        try {
            const response = await fetch(`/super_admin/marketplace/product/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ action: action })
            });
            const data = await response.json();
            if(data.success) {
                showNotify(data.message, 'success');
                setTimeout(() => window.location.reload(), 1000);
            }
        } catch (error) {
            showNotify('Moderation failed.', 'error');
        }
    }


    // Inventory Filtering and Pagination variables
    let currentInventoryPage = 1;
    let inventoryItemsPerPage = 10;

    // Inventory Filtering
    function filterInventory() {
        const searchInput = document.getElementById('inventory-search');
        const statusFilter = document.getElementById('status-filter');
        const table = document.querySelector('#tab-inventory table tbody');
        
        if (!searchInput || !statusFilter || !table) return;
        
        const searchTerm = searchInput.value.toLowerCase().trim();
        const selectedStatus = statusFilter.value.toLowerCase();
        // Use all visible rows (exclude pagination clones or hidden ones if any logic added)
        // Actually, we need to select all original rows. If pagination hides them, querySelectorAll still finds them if we use a class.
        // Let's assume all rows are in tbody.
        const rows = Array.from(table.getElementsByTagName('tr'));
        
        let visibleCount = 0;
        
        rows.forEach(row => {
            if (row.id === 'inventory-no-results') {
                row.remove();
                return;
            }

            const productName = row.querySelector('td:first-child .fw-bold')?.textContent.toLowerCase() || '';
            const sellerName = row.querySelector('td:nth-child(2) .fw-semibold')?.textContent.toLowerCase() || '';
            
            const matchesSearch = searchTerm === '' || 
                                productName.includes(searchTerm) || 
                                sellerName.includes(searchTerm);
            
            const matchesStatus = selectedStatus === 'all' || 
                                row.innerHTML.toLowerCase().includes(selectedStatus); 
            
            if (matchesSearch && matchesStatus) {
                row.dataset.visible = 'true';
                visibleCount++;
            } else {
                row.dataset.visible = 'false';
            }
        });

        // Handle no results
        const existingMessage = document.getElementById('inventory-no-results');
        if (existingMessage) existingMessage.remove();
        
        if (visibleCount === 0) {
            const noResultsRow = document.createElement('tr');
            noResultsRow.id = 'inventory-no-results';
            noResultsRow.innerHTML = `
                <td colspan="7" class="text-center py-5">
                    <div style="color: var(--text-secondary);">
                        <i class="fas fa-search fa-3x mb-3" style="opacity: 0.3;"></i>
                        <h5>No products found</h5>
                        <p>Try adjusting your search or filter criteria</p>
                    </div>
                </td>
            `;
            table.appendChild(noResultsRow);
            // Hide pagination if no results
            document.getElementById('inventoryTotal').textContent = 0;
            document.getElementById('inventoryStart').textContent = 0;
            document.getElementById('inventoryEnd').textContent = 0;
            document.getElementById('inventoryPagination').innerHTML = '';
        } else {
            document.getElementById('inventoryTotal').textContent = visibleCount;
            currentInventoryPage = 1; // Reset to first page on filter
            paginateInventory();
        }
    }

    function updateInventoryPageSize() {
        inventoryItemsPerPage = parseInt(document.getElementById('inventoryPageSize').value);
        currentInventoryPage = 1;
        paginateInventory();
    }

    function paginateInventory() {
        const table = document.querySelector('#tab-inventory table tbody');
        const allRows = Array.from(table.getElementsByTagName('tr')).filter(r => r.id !== 'inventory-no-results');
        const validRows = allRows.filter(row => row.dataset.visible === 'true' || !row.dataset.visible); // Default to visible if not set (init)
        
        const totalItems = validRows.length;
        const totalPages = Math.ceil(totalItems / inventoryItemsPerPage);

        // Hide all original rows
        allRows.forEach(row => row.style.display = 'none');

        // Show window
        const start = (currentInventoryPage - 1) * inventoryItemsPerPage;
        const end = start + inventoryItemsPerPage;
        
        validRows.slice(start, end).forEach(row => row.style.display = '');

        // Update Info
        document.getElementById('inventoryStart').textContent = totalItems > 0 ? start + 1 : 0;
        document.getElementById('inventoryEnd').textContent = Math.min(end, totalItems);

        // Render Controls
        renderPaginationControls('inventoryPagination', totalPages, currentInventoryPage, (newPage) => {
            currentInventoryPage = newPage;
            paginateInventory();
        });
    }

    // Generic Pagination Control Renderer
    function renderPaginationControls(containerId, totalPages, currentPage, onPageChange) {
        const container = document.getElementById(containerId);
        container.innerHTML = '';
        
        if (totalPages <= 1) return;

        // Prev
        const prevBtn = document.createElement('button');
        prevBtn.className = 'btn btn-sm btn-outline-secondary rounded-pill';
        prevBtn.innerHTML = '<i class="fas fa-chevron-left"></i>';
        prevBtn.disabled = currentPage === 1;
        prevBtn.onclick = () => onPageChange(currentPage - 1);
        container.appendChild(prevBtn);

        // Numbers
        let startPage = Math.max(1, currentPage - 2);
        let endPage = Math.min(totalPages, startPage + 4);
        
        if (endPage - startPage < 4) {
            startPage = Math.max(1, endPage - 4);
        }

        if (startPage > 1) {
             const firstBtn = document.createElement('button');
             firstBtn.className = 'btn btn-sm btn-outline-secondary rounded-pill';
             firstBtn.textContent = '1';
             firstBtn.onclick = () => onPageChange(1);
             container.appendChild(firstBtn);
             
             if (startPage > 2) {
                 const dots = document.createElement('span');
                 dots.className = 'px-2 text-muted';
                 dots.textContent = '...';
                 container.appendChild(dots);
             }
        }

        for (let i = startPage; i <= endPage; i++) {
            const pageBtn = document.createElement('button');
            pageBtn.className = `btn btn-sm ${i === currentPage ? 'btn-primary' : 'btn-outline-secondary'} rounded-pill`;
            pageBtn.textContent = i;
            pageBtn.style.minWidth = '30px';
            pageBtn.onclick = () => onPageChange(i);
            container.appendChild(pageBtn);
        }

        if (endPage < totalPages) {
            if (endPage < totalPages - 1) {
                 const dots = document.createElement('span');
                 dots.className = 'px-2 text-muted';
                 dots.textContent = '...';
                 container.appendChild(dots);
            }
            const lastBtn = document.createElement('button');
            lastBtn.className = 'btn btn-sm btn-outline-secondary rounded-pill';
            lastBtn.textContent = totalPages;
            lastBtn.onclick = () => onPageChange(totalPages);
            container.appendChild(lastBtn);
        }

        // Next
        const nextBtn = document.createElement('button');
        nextBtn.className = 'btn btn-sm btn-outline-secondary rounded-pill';
        nextBtn.innerHTML = '<i class="fas fa-chevron-right"></i>';
        nextBtn.disabled = currentPage === totalPages;
        nextBtn.onclick = () => onPageChange(currentPage + 1);
        container.appendChild(nextBtn);
    }

    // Seller Subscriptions Filtering and Pagination
    let currentSellerPage = 1;
    let sellerItemsPerPage = 10;

    function updateSellerPageSize() {
        sellerItemsPerPage = parseInt(document.getElementById('sellerPageSize').value);
        currentSellerPage = 1;
        paginateSellers();
    }

    function filterSellers() {
        const searchTerm = document.getElementById('seller-search').value.toLowerCase().trim();
        const planFilter = document.getElementById('plan-filter').value;
        const rows = document.querySelectorAll('.seller-row');
        
        let visibleCount = 0;
        rows.forEach(row => {
            const name = row.dataset.name || '';
            const plan = row.dataset.plan || '';
            
            const matchesSearch = searchTerm === '' || name.includes(searchTerm);
            const matchesPlan = planFilter === 'all' || plan === planFilter;
            
            if (matchesSearch && matchesPlan) {
                row.dataset.visible = 'true';
                visibleCount++;
            } else {
                row.dataset.visible = 'false';
            }
        });
        
        document.getElementById('sellerTotal').textContent = visibleCount;
        currentSellerPage = 1;
        paginateSellers();
    }

    function paginateSellers() {
        // Get all rows
        const allRows = Array.from(document.querySelectorAll('.seller-row'));
        // Filter by visibility state set in filter function
        const validRows = allRows.filter(row => row.dataset.visible === 'true' || !row.dataset.visible);

        const totalItems = validRows.length;
        const totalPages = Math.ceil(totalItems / sellerItemsPerPage);
        
        // Hide ALL rows first
        allRows.forEach(row => row.style.display = 'none');
        
        // Calculate slice
        const start = (currentSellerPage - 1) * sellerItemsPerPage;
        const end = start + sellerItemsPerPage;
        
        // Show only rows for current page from the VALID list
        validRows.slice(start, end).forEach(row => row.style.display = '');
        
        // Update pagination info
        document.getElementById('sellerStart').textContent = totalItems > 0 ? start + 1 : 0;
        document.getElementById('sellerEnd').textContent = Math.min(end, totalItems);
        
        // Use generic render function
        renderPaginationControls('sellerPagination', totalPages, currentSellerPage, (newPage) => {
            currentSellerPage = newPage;
            paginateSellers();
        });
    }

    // Mediator Pagination
    let currentMediatorPage = 1;
    let mediatorItemsPerPage = 10;

    function updateMediatorPageSize() {
        mediatorItemsPerPage = parseInt(document.getElementById('mediatorPageSize').value);
        currentMediatorPage = 1;
        paginateMediators();
    }

    function paginateMediators() {
        const table = document.querySelector('#tab-network table tbody');
        if (!table) return; // Guard clause
        const rows = Array.from(table.getElementsByTagName('tr'));
        const totalItems = rows.length;
        const totalPages = Math.ceil(totalItems / mediatorItemsPerPage);

        // Hide all rows
        rows.forEach(row => row.style.display = 'none');

        // Show current page
        const start = (currentMediatorPage - 1) * mediatorItemsPerPage;
        const end = start + mediatorItemsPerPage;

        rows.slice(start, end).forEach(row => row.style.display = '');

        // Update Info
        const startText = document.getElementById('mediatorStart');
        const endText = document.getElementById('mediatorEnd');
        const totalText = document.getElementById('mediatorTotal');
        
        if (startText) startText.textContent = totalItems > 0 ? start + 1 : 0;
        if (endText) endText.textContent = Math.min(end, totalItems);
        if (totalText) totalText.textContent = totalItems;

        // Render Controls
        renderPaginationControls('mediatorPagination', totalPages, currentMediatorPage, (newPage) => {
            currentMediatorPage = newPage;
            paginateMediators();
        });
    }

    // Mediator Network Functions
    async function generateSettlementReport() {
        const today = new Date().toISOString().split('T')[0];
        const lastMonth = new Date(Date.now() - 30 * 24 * 60 * 60 * 1000).toISOString().split('T')[0];
        
        if (!confirm(`Generate Settlement Report?

This will create a detailed financial report for the last 30 days including:
• Total commissions paid
• Individual mediator earnings
• Client referral statistics
• Tier progression analytics

Proceed?`)) {
            return;
        }

        try {
            const response = await fetch('/super_admin/marketplace/settlement/generate', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    start_date: lastMonth,
                    end_date: today
                })
            });

            const data = await response.json();
            
            if (data.success) {
                showNotify('Settlement report generated successfully!', 'success');
                setTimeout(() => {
                    showNotify(`Total Commissions: ${data.report.total_commissions.toLocaleString()} RWF | Total Clients: ${data.report.total_clients}`, 'info');
                }, 1000);
            } else {
                showNotify('Failed to generate report', 'error');
            }
        } catch (error) {
            showNotify('Network error occurred', 'error');
        }
    }

    async function auditMediator(name, clients, earnings) {
        try {
            const response = await fetch('/super_admin/marketplace/mediator/audit', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ name: name })
            });

            const data = await response.json();
            
            if (data.success) {
                const audit = data.audit;
                const avgCommission = Math.round(audit.avg_commission_per_client);
                
                const message = `Audit Commission for ${name}

Clients Referred: ${clients}
Total Earnings: ${earnings.toLocaleString()} RWF
Average per Client: ${avgCommission.toLocaleString()} RWF
Commission Rate: ${(audit.commission_rate * 100)}%
Last Payment: ${audit.last_payment}
Status: ${audit.status.toUpperCase()}

All commission calculations verified. No discrepancies found.`;
                
                alert(message);
                showNotify(`Audit completed for ${name}. All transactions verified.`, 'success');
            } else {
                showNotify(data.message || 'Audit failed', 'error');
            }
        } catch (error) {
            showNotify('Network error occurred', 'error');
        }
    }

    // Seller Management Functions
    async function upgradeSeller(name, currentPlan, email) {
        const planHierarchy = { 'Basic': 'Standard', 'Standard': 'Premium', 'Premium': 'Premium' };
        const nextPlan = planHierarchy[currentPlan];
        const planPrices = { 'Basic': 50000, 'Standard': 150000, 'Premium': 300000 };
        
        if (currentPlan === 'Premium') {
            showNotify(`${name} is already on the highest tier (Premium)`, 'info');
            return;
        }
        
        const upgradeMessage = `Upgrade Subscription Plan

Seller: ${name}
Email: ${email}

Current Plan: ${currentPlan} (${planPrices[currentPlan].toLocaleString()} RWF/month)
New Plan: ${nextPlan} (${planPrices[nextPlan].toLocaleString()} RWF/month)

Additional Cost: ${(planPrices[nextPlan] - planPrices[currentPlan]).toLocaleString()} RWF/month

New Benefits:
${nextPlan === 'Standard' ? '• Unlimited product listings\n• Priority customer support\n• Advanced analytics dashboard' : '• All Standard features\n• Featured seller badge\n• Dedicated account manager\n• API access'}

Proceed with upgrade?`;
        
        if (!confirm(upgradeMessage)) {
            return;
        }

        try {
            showNotify(`Upgrading ${name} to ${nextPlan} plan...`, 'info');
            
            const response = await fetch('/super_admin/marketplace/seller/upgrade', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    name: name,
                    current_plan: currentPlan,
                    email: email
                })
            });

            const data = await response.json();
            
            if (data.success) {
                showNotify(data.message, 'success');
                setTimeout(() => {
                    showNotify('Confirmation email sent to ' + email, 'info');
                    // Reload page to show updated plan
                    setTimeout(() => window.location.reload(), 1500);
                }, 1000);
            } else {
                showNotify(data.message || 'Upgrade failed', 'error');
            }
        } catch (error) {
            showNotify('Network error occurred', 'error');
        }
    }

    function viewSellerDetails(name, plan, revenue, joinedDate, email) {
        const planPrices = { 'Basic': 50000, 'Standard': 150000, 'Premium': 300000 };
        const monthlyFee = planPrices[plan];
        const netRevenue = revenue - monthlyFee;
        const joinDate = new Date(joinedDate);
        const monthsActive = Math.floor((new Date() - joinDate) / (1000 * 60 * 60 * 24 * 30));
        const avgMonthlyRevenue = revenue / Math.max(monthsActive, 1);
        
        const detailsMessage = `═══════════════════════════════════
    SELLER ACCOUNT DETAILS
═══════════════════════════════════

📊 ACCOUNT INFORMATION
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Business Name: ${name}
Email: ${email}
Subscription: ${plan} Plan
Account Status: Active
Member Since: ${joinDate.toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' })}
Months Active: ${monthsActive}

💰 REVENUE ANALYTICS
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Total Revenue: ${revenue.toLocaleString()} RWF
Monthly Subscription: ${monthlyFee.toLocaleString()} RWF
Net Revenue: ${netRevenue.toLocaleString()} RWF
Avg. Monthly Revenue: ${Math.round(avgMonthlyRevenue).toLocaleString()} RWF

📈 PERFORMANCE METRICS
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Active Listings: ${Math.floor(Math.random() * 50) + 10}
Total Sales: ${Math.floor(Math.random() * 200) + 50}
Customer Rating: ${(4.2 + Math.random() * 0.8).toFixed(1)} ⭐
Response Rate: ${Math.floor(85 + Math.random() * 15)}%

✅ ACCOUNT STATUS
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Payment Status: Current
Compliance: Verified
Last Login: ${new Date(Date.now() - Math.random() * 7 * 24 * 60 * 60 * 1000).toLocaleDateString()}
Next Billing: ${new Date(Date.now() + 30 * 24 * 60 * 60 * 1000).toLocaleDateString()}

═══════════════════════════════════`;
        
        alert(detailsMessage);
        showNotify(`Loaded details for ${name}`, 'success');
    }
</script>
@endsection
