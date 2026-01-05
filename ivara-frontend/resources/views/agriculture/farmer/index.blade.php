@extends('layouts.app')

@section('title', 'Farmer Dashboard')

@section('content')
<div class="agri-dashboard-container p-4">
    <!-- Header -->
    <div class="row align-items-center mb-5">
        <div class="col-md-8">
            <h1 class="fw-bold display-5 mb-1 text-success">Farmer Workspace</h1>
            <p class="text-muted lead mb-0">Monitor your crops, livestock, and soil health with real-time data.</p>
        </div>
        <div class="col-md-4 text-md-end">
            <div class="bg-glass d-inline-block p-3 rounded-pill shadow-sm border border-success-subtle">
                <span class="me-3"><i class="fas fa-sun text-warning me-2"></i> 28°C Kigali</span>
                <span class="badge bg-success rounded-pill px-3">Yield High</span>
            </div>
        </div>
    </div>

    <!-- Bento Grid -->
    <div class="bento-grid">
        <!-- Crop Health -->
        <div class="bento-card span-2 bg-glass border-soft-success">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">Crop Health Index</h5>
                <span class="text-success fw-bold"><i class="fas fa-arrow-up me-1"></i> 92% Good</span>
            </div>
            <div class="row g-3">
                <div class="col-6">
                    <div class="p-3 bg-light rounded-4">
                        <small class="text-muted text-uppercase d-block mb-1">Maize Plot A</small>
                        <h6 class="fw-bold mb-0">Strong Growth</h6>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 bg-light rounded-4">
                        <small class="text-muted text-uppercase d-block mb-1">Beans Plot B</small>
                        <h6 class="fw-bold mb-0">Needs Water</h6>
                    </div>
                </div>
            </div>
        </div>

        <!-- Weather Alerts -->
        <div class="bento-card bg-glass border-soft-warning">
            <div class="card-icon bg-soft-warning text-warning mb-3"><i class="fas fa-cloud-rain"></i></div>
            <h6 class="fw-bold mb-1">Rain Forecast</h6>
            <p class="small text-muted mb-3">Heavy rain expected in 24h.</p>
            <span class="badge bg-soft-warning text-warning rounded-pill">Alert: Prepare Drainage</span>
        </div>

        <!-- Market Prices -->
        <div class="bento-card bg-glass border-soft-info">
            <div class="card-icon bg-soft-info text-info mb-3"><i class="fas fa-chart-line"></i></div>
            <h6 class="fw-bold mb-1">Current Prices</h6>
            <p class="small text-muted mb-1">Maize: 450 RWF/kg</p>
            <p class="small text-muted mb-0">Beans: 820 RWF/kg</p>
        </div>

        <!-- Inventory -->
        <div class="bento-card span-2 row-2 bg-glass">
            <h5 class="fw-bold mb-4">Input Inventory</h5>
            <div class="table-responsive">
                <table class="table table-borderless align-middle">
                    <thead>
                        <tr class="small text-muted text-uppercase">
                            <th>Item</th>
                            <th>Status</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><div class="d-flex align-items-center"><div class="avatar-xs bg-soft-success text-success rounded me-2 p-2"><i class="fas fa-seedling"></i></div>Hybrid Maize Seeds</div></td>
                            <td><span class="badge bg-soft-success text-success rounded-pill">In Stock</span></td>
                            <td class="fw-bold">50 kg</td>
                        </tr>
                        <tr>
                            <td><div class="d-flex align-items-center"><div class="avatar-xs bg-soft-danger text-danger rounded me-2 p-2"><i class="fas fa-vial"></i></div>NPK Fertilizer</div></td>
                            <td><span class="badge bg-soft-danger text-danger rounded-pill">Low Stock</span></td>
                            <td class="fw-bold">5 kg</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bento-card span-2 bg-glass">
            <h5 class="fw-bold mb-3">Farm Management Tools</h5>
            <div class="d-flex gap-2">
                <button class="btn btn-soft-success flex-grow-1 py-3 rounded-4">
                    <i class="fas fa-plus mb-2 d-block"></i> Log Activity
                </button>
                <button class="btn btn-soft-primary flex-grow-1 py-3 rounded-4">
                    <i class="fas fa-headset mb-2 d-block"></i> Ask Expert
                </button>
                <button class="btn btn-soft-warning flex-grow-1 py-3 rounded-4">
                    <i class="fas fa-calendar-alt mb-2 d-block"></i> Schedule
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .bento-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
    .bento-card { background: rgba(255, 255, 255, 0.8); border-radius: 28px; padding: 24px; border: 1px solid rgba(0,0,0,0.03); }
    .span-2 { grid-column: span 2; }
    .row-2 { grid-row: span 2; }
    .card-icon { width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; border-radius: 14px; font-size: 1.2rem; }
    .bg-soft-success { background: rgba(16, 185, 129, 0.1); color: #10b981; }
    .bg-soft-primary { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
    .bg-soft-warning { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }
    .bg-soft-info { background: rgba(6, 182, 212, 0.1); color: #06b6d4; }
    .bg-soft-danger { background: rgba(239, 68, 68, 0.1); color: #ef4444; }
    .btn-soft-success { background: rgba(16, 185, 129, 0.1); color: #10b981; border: none; font-weight: 600; }
    .btn-soft-primary { background: rgba(59, 130, 246, 0.1); color: #3b82f6; border: none; font-weight: 600; }
    .btn-soft-warning { background: rgba(245, 158, 11, 0.1); color: #f59e0b; border: none; font-weight: 600; }
</style>
@endsection
