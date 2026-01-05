@extends('layouts.app')

@section('title', 'Bus Driver Dashboard')

@section('content')
<div class="transport-dashboard-container">
    <div class="container-fluid p-3">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold display-5 mb-1 text-primary">Bus Driver Console</h1>
                <p class="text-muted lead mb-0">Route management and passenger logging.</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="status-pill available">
                    <span class="dot"></span> On Route: Line 205
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
                <div class="card-icon bg-soft-primary text-primary"><i class="fas fa-bus"></i></div>
                <h3 class="metric-value">RAC 123 B</h3>
                <span class="metric-label">Assigned Vehicle</span>
            </div>
            
            <div class="bento-card bg-glass">
                <div class="card-icon bg-soft-warning text-warning"><i class="fas fa-users"></i></div>
                <h3 class="metric-value">450</h3>
                <span class="metric-label">Passengers Today</span>
            </div>

            <div class="bento-card bg-glass">
                <div class="card-icon bg-soft-success text-success"><i class="fas fa-ticket-alt"></i></div>
                <h3 class="metric-value">120,500</h3>
                <span class="metric-label">Revenue (RWF)</span>
            </div>

            <div class="bento-card bg-glass">
                <div class="card-icon bg-soft-info text-info"><i class="fas fa-clock"></i></div>
                <h3 class="metric-value">On Time</h3>
                <span class="metric-label">Schedule Status</span>
            </div>

            <!-- Next Stops -->
            <div class="bento-card bg-glass span-2 row-2">
                <h5 class="card-title mb-3">Today's Schedule</h5>
                <div class="list-group list-group-flush bg-transparent">
                    <div class="list-group-item bg-transparent d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Downtown - Kimironko</strong>
                            <div class="small text-muted">Departure: 10:30 (In 5 mins)</div>
                        </div>
                        <span class="badge bg-primary">Upcoming</span>
                    </div>
                    <div class="list-group-item bg-transparent d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Kimironko - Nyabugogo</strong>
                            <div class="small text-muted">Departure: 12:00</div>
                        </div>
                        <span class="badge bg-secondary">Waiting</span>
                    </div>
                </div>
            </div>

            <!-- Maintenance Info -->
            <div class="bento-card bg-glass span-2">
                <h5 class="card-title mb-3">Route Alerts</h5>
                <div class="alert alert-soft-info d-flex align-items-center mb-0">
                    <i class="fas fa-info-circle me-3 fs-3"></i>
                    <div>
                        <strong>Road Work:</strong> Gisozi road closed. Use bypass.
                    </div>
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
    .alert-soft-info { background: rgba(6, 182, 212, 0.05); border: 1px solid rgba(6, 182, 212, 0.2); color: #0891b2; border-radius: 12px; }
    .status-pill.available { background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 5px 12px; border-radius: 20px; font-weight: 700; display: flex; align-items: center; }
    .status-pill .dot { width: 8px; height: 8px; background: #10b981; border-radius: 50%; margin-right: 8px; animation: blink 2s infinite; }
    @keyframes blink { 50% { opacity: 0.5; } }
    @media (max-width: 1200px) { .bento-grid { grid-template-columns: 1fr 1fr; } }
</style>
@endsection
