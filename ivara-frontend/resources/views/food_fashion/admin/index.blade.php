@extends('layouts.app')

@section('title', 'Food & Fashion Admin Dashboard')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold display-5 mb-1 text-primary">Food & Fashion Admin</h1>
            <p class="text-muted lead mb-0" style="font-size: 1rem;">Oversight & Management of Culinary and Style Services</p>
        </div>
        <div class="status-pill online">
            <span class="dot"></span> Platform Active
        </div>
    </div>

    <!-- Bento Grid for Admin -->
    <div class="bento-grid">
        <!-- 1. Key Metrics -->
        <div class="bento-card bg-glass">
            <div class="card-icon bg-soft-primary text-primary"><i class="fas fa-store"></i></div>
            <h3 class="metric-value">{{ number_format(rand(50, 150)) }}</h3>
            <span class="metric-label">Active Vendors</span>
            <div class="trend up"><i class="fas fa-arrow-up"></i> 12% growth</div>
        </div>

        <div class="bento-card bg-glass">
            <div class="card-icon bg-soft-warning text-warning"><i class="fas fa-shopping-basket"></i></div>
            <h3 class="metric-value">{{ number_format(rand(120, 500)) }}</h3>
            <span class="metric-label">Pending Orders</span>
            <div class="trend up"><i class="fas fa-concierge-bell"></i> High Demand</div>
        </div>

        <div class="bento-card bg-glass">
            <div class="card-icon bg-soft-success text-success"><i class="fas fa-wallet"></i></div>
            <h3 class="metric-value">{{ number_format(rand(500000, 2000000)) }} FRW</h3>
            <span class="metric-label">Category Revenue</span>
            <div class="trend up"><i class="fas fa-trending-up"></i> 5% target match</div>
        </div>

        <div class="bento-card bg-glass">
            <div class="card-icon bg-soft-danger text-danger"><i class="fas fa-user-shield"></i></div>
            <h3 class="metric-value">0</h3>
            <span class="metric-label">Security Alerts</span>
            <div class="trend down text-success"><i class="fas fa-shield-alt"></i> Secure</div>
        </div>

        <!-- 2. Recent Food/Fashion Activity -->
        <div class="bento-card bg-glass span-2">
            <h5 class="card-title mb-3"><i class="fas fa-history text-info me-2"></i>Recent Sales Activity</h5>
            <div class="table-responsive">
                <table class="table table-sm table-borderless align-middle mb-0">
                    <thead>
                        <tr class="text-muted small">
                            <th>TIME</th>
                            <th>TYPE</th>
                            <th>VENDOR</th>
                            <th class="text-end">AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach([['10:15', 'Culinary', 'Kigali Eats', '45,000'], ['09:42', 'Fashion', 'TrendSetters', '120,000'], ['08:20', 'Events', 'Gala Pros', '300,000']] as $sale)
                        <tr>
                            <td><span class="badge bg-soft-secondary text-secondary">{{ $sale[0] }}</span></td>
                            <td><i class="fas fa-circle text-primary fs-xs me-2" style="font-size: 0.5rem;"></i> {{ $sale[1] }}</td>
                            <td class="fw-bold">{{ $sale[2] }}</td>
                            <td class="text-end fw-bold text-success">{{ $sale[3] }} FRW</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 3. Quick Actions -->
        <div class="bento-card bg-glass span-2">
            <h5 class="card-title mb-3">Management Shortcuts</h5>
            <div class="row g-3">
                <div class="col-6">
                    <a href="#" class="action-btn">
                        <i class="fas fa-plus-circle"></i>
                        <span>Register Vendor</span>
                    </a>
                </div>
                <div class="col-6">
                    <a href="#" class="action-btn">
                        <i class="fas fa-file-invoice-dollar"></i>
                        <span>Financial Reports</span>
                    </a>
                </div>
                <div class="col-6">
                    <a href="#" class="action-btn">
                        <i class="fas fa-bullhorn"></i>
                        <span>Promotion Hub</span>
                    </a>
                </div>
                <div class="col-6">
                    <a href="#" class="action-btn">
                        <i class="fas fa-users-cog"></i>
                        <span>Role Permissions</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --grid-gap: 20px;
        --card-radius: 20px;
        --card-bg: rgba(255,255,255,0.85);
    }

    .bento-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-auto-rows: minmax(180px, auto);
        gap: var(--grid-gap);
    }

    .bento-card {
        background: var(--card-bg);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: var(--card-radius);
        padding: 24px;
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease;
        display: flex;
        flex-direction: column;
        backdrop-filter: blur(10px);
    }
    .bento-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); }
    
    .span-2 { grid-column: span 2; }

    .metric-value { font-size: 2.2rem; font-weight: 800; margin-bottom: 5px; color: #1e1b4b; }
    .metric-label { font-size: 0.85rem; text-transform: uppercase; font-weight: 700; color: #64748b; letter-spacing: 0.5px; }

    .card-icon { width: 45px; height: 45px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; margin-bottom: 15px; }
    
    .bg-soft-primary { background: rgba(59, 130, 246, 0.1); }
    .bg-soft-success { background: rgba(16, 185, 129, 0.1); }
    .bg-soft-warning { background: rgba(245, 158, 11, 0.1); }
    .bg-soft-danger { background: rgba(239, 68, 68, 0.1); }
    .bg-soft-secondary { background: rgba(148, 163, 184, 0.1); }

    .action-btn {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 15px;
        background: rgba(0,0,0,0.03);
        border-radius: 12px;
        text-decoration: none;
        color: #1e1b4b;
        font-weight: 600;
        transition: 0.2s;
    }
    .action-btn:hover { background: #ffb700; color: #000; transform: translateX(5px); }
    .action-btn i { font-size: 1.2rem; opacity: 0.8; }

    .status-pill { 
        background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 5px 12px; 
        border-radius: 20px; font-weight: 700; font-size: 0.85rem; display: flex; align-items: center; 
    }
    .status-pill .dot { width: 8px; height: 8px; background: #10b981; border-radius: 50%; margin-right: 8px; }

    @media (max-width: 992px) {
        .bento-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 576px) {
        .bento-grid { grid-template-columns: 1fr; }
        .span-2 { grid-column: auto; }
    }
</style>
@endsection
