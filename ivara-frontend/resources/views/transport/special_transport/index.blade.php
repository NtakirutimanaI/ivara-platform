@extends('layouts.app')

@section('title', 'Special Transport Dashboard')

@section('content')
<div class="transport-dashboard-container">
    <div class="container-fluid p-3">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold display-5 mb-1 text-danger">Emergency Console</h1>
                <p class="text-muted lead mb-0">High-priority dispatch and life support logistics.</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="status-pill available bg-danger text-white">
                    <span class="dot bg-white"></span> On Standby
                </div>
            </div>
        </div>

        <!-- Bento Grid -->
        <div class="bento-grid">
            
            <div class="bento-card bg-glass border-danger shadow-sm">
                <div class="card-icon bg-danger text-white"><i class="fas fa-heartbeat"></i></div>
                <h3 class="metric-value">4m 30s</h3>
                <span class="metric-label">Avg Response Time</span>
            </div>
            
            <div class="bento-card bg-glass border-primary">
                <div class="card-icon bg-primary text-white"><i class="fas fa-ambulance"></i></div>
                <h3 class="metric-value">5</h3>
                <span class="metric-label">Calls Dispatched</span>
            </div>

            <div class="bento-card bg-glass">
                <div class="card-icon bg-soft-info text-info"><i class="fas fa-notes-medical"></i></div>
                <h3 class="metric-value">98%</h3>
                <span class="metric-label">Care Quality Score</span>
            </div>

            <div class="bento-card bg-glass">
                <div class="card-icon bg-soft-warning text-warning"><i class="fas fa-medkit"></i></div>
                <h3 class="metric-value">Restocked</h3>
                <span class="metric-label">Kit Status</span>
            </div>

            <!-- Priority Requests -->
            <div class="bento-card bg-glass span-2 row-2">
                <h5 class="card-title mb-3"><i class="fas fa-exclamation-triangle text-danger me-2"></i>Active Emergency Dispatches</h5>
                <div class="alert alert-danger bg-soft-danger border-danger">
                    <h6 class="alert-heading fw-bold">Critical: Cardiac Emergency</h6>
                    <p class="mb-0 small">Location: Guta (3.2km away). Estimated reach: 6 mins.</p>
                    <hr>
                    <button class="btn btn-danger btn-sm">Acknowledge Dispatch</button>
                </div>
                <div class="list-group list-group-flush bg-transparent mt-3">
                    <div class="list-group-item bg-transparent d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Special Needs Transport</strong>
                            <div class="small text-muted">Kigali Medical Center - 16:00</div>
                        </div>
                        <span class="badge bg-primary">Scheduled</span>
                    </div>
                </div>
            </div>

            <!-- Medical Log -->
            <div class="bento-card bg-glass span-2">
                <h5 class="card-title mb-3">Recent Incident Logs</h5>
                <div class="table-responsive">
                    <table class="table table-sm table-borderless small mb-0">
                        <thead>
                            <tr class="text-muted">
                                <th>Incident</th>
                                <th>Status</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>VIP Transfer</td>
                                <td><span class="badge bg-success">Done</span></td>
                                <td>09:12</td>
                            </tr>
                            <tr>
                                <td>Medical Transfer</td>
                                <td><span class="badge bg-success">Done</span></td>
                                <td>08:05</td>
                            </tr>
                        </tbody>
                    </table>
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
    .card-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 15px; font-size: 1.5rem; }
    .bg-soft-danger { background: rgba(239, 68, 68, 0.05); color: #ef4444; }
    .status-pill.available { padding: 5px 15px; border-radius: 20px; font-weight: 700; display: flex; align-items: center; }
    .status-pill .dot { width: 10px; height: 10px; border-radius: 50%; margin-right: 10px; animation: heartbeat 1.5s infinite; }
    @keyframes heartbeat { 0% { transform: scale(1); opacity: 1; } 50% { transform: scale(1.3); opacity: 0.7; } 100% { transform: scale(1); opacity: 1; } }
    @media (max-width: 1200px) { .bento-grid { grid-template-columns: 1fr 1fr; } }
</style>
@endsection
