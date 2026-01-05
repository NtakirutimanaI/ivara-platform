@extends('layouts.app')

@section('title', 'Builder Dashboard')

@section('content')
<div class="technical-dashboard-container">
    <div class="container-fluid p-3">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold display-5 mb-1 text-primary">Builder Workspace</h1>
                <p class="text-muted lead mb-0">Manage projects, blueprints, and site reports.</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                 <div class="status-pill available">
                    <span class="dot"></span> On Site
                </div>
                <div class="text-end ms-4 border-start ps-3 border-secondary">
                    <h5 class="mb-0 fw-bold">{{ now()->format('H:i') }}</h5>
                    <small class="text-muted">{{ now()->format('D, M d') }}</small>
                </div>
            </div>
        </div>

        <!-- Bento Grid -->
        <div class="bento-grid">
            
            <!-- Metrics -->
            <div class="bento-card bg-glass">
                <div class="card-icon bg-soft-primary text-primary"><i class="fas fa-hard-hat"></i></div>
                <h3 class="metric-value">2</h3>
                <span class="metric-label">Active Projects</span>
            </div>
            
            <div class="bento-card bg-glass">
                <div class="card-icon bg-soft-secondary text-secondary"><i class="fas fa-drafting-compass"></i></div>
                <h3 class="metric-value">5</h3>
                <span class="metric-label">Drafts Pending</span>
            </div>

            <div class="bento-card bg-glass">
                <div class="card-icon bg-soft-success text-success"><i class="fas fa-check-circle"></i></div>
                <h3 class="metric-value">98%</h3>
                <span class="metric-label">Safety Score</span>
            </div>

            <div class="bento-card bg-glass">
                <div class="card-icon bg-soft-info text-info"><i class="fas fa-users"></i></div>
                <h3 class="metric-value">14</h3>
                <span class="metric-label">Team Members</span>
            </div>

            <!-- Projects (Large) -->
            <div class="bento-card bg-glass span-2 row-2">
                <h5 class="card-title mb-3">Current Projects</h5>
                <div class="table-responsive">
                    <table class="table table-borderless align-middle">
                        <tbody>
                            <tr>
                                <td><span class="fw-bold">Villa Renovation</span><br><small class="text-muted">Phase 2: Framing</small></td>
                                <td><div class="progress" style="height: 5px; width: 80px;"><div class="progress-bar" style="width: 45%"></div></div></td>
                                <td class="text-end"><span class="badge bg-soft-primary text-primary">Active</span></td>
                            </tr>
                            <tr>
                                <td><span class="fw-bold">Commercial Block B</span><br><small class="text-muted">Phase 1: Foundation</small></td>
                                <td><div class="progress" style="height: 5px; width: 80px;"><div class="progress-bar bg-warning" style="width: 15%"></div></div></td>
                                <td class="text-end"><span class="badge bg-soft-warning text-warning">Delayed</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bento-card bg-glass span-2">
                <h5 class="card-title mb-3">Site Management</h5>
                <div class="d-flex gap-3">
                    <button class="btn btn-primary flex-fill p-3"><i class="fas fa-camera d-block fs-3 mb-2"></i>Log Visit</button>
                    <button class="btn btn-outline-secondary flex-fill p-3"><i class="fas fa-ruler-combined d-block fs-3 mb-2"></i>Blueprints</button>
                    <button class="btn btn-outline-secondary flex-fill p-3"><i class="fas fa-clipboard-list d-block fs-3 mb-2"></i>Daily Report</button>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    /* Reuse consistent technical styling */
    :root { --grid-gap: 20px; --card-radius: 20px; --card-bg: rgba(255,255,255,0.9); }
    .technical-dashboard-container { width: 96%; margin-left: 15px; }
    .bento-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: var(--grid-gap); }
    .bento-card { background: var(--card-bg); border-radius: var(--card-radius); padding: 20px; border: 1px solid rgba(0,0,0,0.05); box-shadow: 0 4px 6px rgba(0,0,0,0.02); transition: transform 0.2s; }
    .bento-card:hover { transform: translateY(-3px); box-shadow: 0 10px 15px rgba(0,0,0,0.05); }
    .span-2 { grid-column: span 2; } .row-2 { grid-row: span 2; }
    .metric-value { font-size: 2rem; font-weight: 800; color: #1e293b; }
    .metric-label { font-size: 0.85rem; text-transform: uppercase; font-weight: 600; color: #64748b; }
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
