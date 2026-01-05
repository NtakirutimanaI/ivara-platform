@extends('layouts.app')

@section('title', 'Delivery Driver Dashboard')

@section('content')
<div class="transport-dashboard-container">
    <div class="container-fluid p-3">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold display-5 mb-1 text-primary">Logistics Console</h1>
                <p class="text-muted lead mb-0">Track orders, manage routes, and deliver smiles.</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="status-pill available">
                    <span class="dot"></span> Active Session: 4h 20m
                </div>
                <div class="text-end ms-4 border-start ps-3 border-secondary">
                    <h5 class="mb-0 fw-bold">{{ now()->format('H:i') }}</h5>
                    <small class="text-muted">{{ now()->format('D, M d') }}</small>
                </div>
            </div>
        </div>

        <!-- Bento Grid -->
        <div class="bento-grid">
            
            <div class="bento-card bg-glass">
                <div class="card-icon bg-soft-primary text-primary"><i class="fas fa-box"></i></div>
                <h3 class="metric-value">24</h3>
                <span class="metric-label">Packages Delivered</span>
            </div>
            
            <div class="bento-card bg-glass">
                <div class="card-icon bg-soft-warning text-warning"><i class="fas fa-shipping-fast"></i></div>
                <h3 class="metric-value">8</h3>
                <span class="metric-label">Orders in Transit</span>
            </div>

            <div class="bento-card bg-glass">
                <div class="card-icon bg-soft-success text-success"><i class="fas fa-hand-holding-usd"></i></div>
                <h3 class="metric-value">5,200</h3>
                <span class="metric-label">Tips (RWF)</span>
            </div>

            <div class="bento-card bg-glass">
                <div class="card-icon bg-soft-info text-info"><i class="fas fa-tachometer-alt"></i></div>
                <h3 class="metric-value">12.5km</h3>
                <span class="metric-label">Distance Covered</span>
            </div>

            <!-- Current Deliveries -->
            <div class="bento-card bg-glass span-2 row-2">
                <h5 class="card-title mb-3">Live Orders</h5>
                <div class="list-group list-group-flush bg-transparent">
                    <div class="list-group-item bg-transparent d-flex justify-content-between align-items-center">
                        <div>
                            <strong>#99201 - Food Delivery</strong>
                            <div class="small text-muted">Avenue de la Justice - 02:30 ETA</div>
                        </div>
                        <button class="btn btn-sm btn-primary">Navigate</button>
                    </div>
                    <div class="list-group-item bg-transparent d-flex justify-content-between align-items-center">
                        <div>
                            <strong>#99185 - E-commerce</strong>
                            <div class="small text-muted">Kacyiru - Next in Queue</div>
                        </div>
                        <button class="btn btn-sm btn-outline-primary">Details</button>
                    </div>
                </div>
            </div>

            <!-- Route Info -->
            <div class="bento-card bg-glass span-2">
                <h5 class="card-title mb-3">Route Optimization</h5>
                <div class="p-3 border rounded border-primary bg-soft-primary" style="border-style: dashed !important;">
                    <p class="mb-0 small fw-bold">Traffic Alert: Congestion on KN 3 Rd. Rerouted via KN 14 Av.</p>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    :root { --grid-gap: 20px; --card-radius: 20px; --card-bg: rgba(255,255,255,0.9); }
    .transport-dashboard-container { width: 96%; margin-left: 15px; }
    .bento-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: var(--grid-gap); }
    .bento-card { background: var(--card-bg); border-radius: var(--card-radius); padding: 20px; border: 1px solid rgba(0,0,0,0.05); box-shadow: 0 4px 6px rgba(0,0,0,0.02); transition: transform 0.2s; }
    .bento-card:hover { transform: translateY(-3px); box-shadow: 0 10px 15px rgba(0,0,0,0.05); }
    .span-2 { grid-column: span 2; } .row-2 { grid-row: span 2; }
    .metric-value { font-size: 1.8rem; font-weight: 800; color: #1e293b; }
    .metric-label { font-size: 0.8rem; text-transform: uppercase; font-weight: 600; color: #64748b; }
    .card-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 10px; font-size: 1.2rem; }
    .bg-soft-primary { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
    .bg-soft-warning { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }
    .bg-soft-success { background: rgba(16, 185, 129, 0.1); color: #10b981; }
    .bg-soft-info { background: rgba(6, 182, 212, 0.1); color: #06b6d4; }
    .status-pill.available { background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 5px 12px; border-radius: 20px; font-weight: 700; display: flex; align-items: center; }
    .status-pill .dot { width: 8px; height: 8px; background: #10b981; border-radius: 50%; margin-right: 8px; animation: blink 2s infinite; }
    @keyframes blink { 50% { opacity: 0.5; } }
    @media (max-width: 1200px) { .bento-grid { grid-template-columns: 1fr 1fr; } }
</style>
@endsection
