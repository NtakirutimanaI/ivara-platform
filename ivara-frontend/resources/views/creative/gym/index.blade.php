@extends('layouts.app')

@section('title', 'Gym Trainer Dashboard')

@section('content')
<div class="wellness-dashboard-container">
    <div class="container-fluid p-3">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold display-5 mb-1 text-primary">Gym Trainer Console</h1>
                <p class="text-muted lead mb-0">Manage training sessions, clients, and progress.</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                 <div class="status-pill available">
                    <span class="dot"></span> In Session: 45m left
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
                <div class="card-icon bg-soft-primary text-primary"><i class="fas fa-users"></i></div>
                <h3 class="metric-value">24</h3>
                <span class="metric-label">Active Clients</span>
            </div>
            
            <div class="bento-card bg-glass">
                <div class="card-icon bg-soft-warning text-warning"><i class="fas fa-calendar-check"></i></div>
                <h3 class="metric-value">8</h3>
                <span class="metric-label">Sessions Today</span>
            </div>

            <div class="bento-card bg-glass">
                <div class="card-icon bg-soft-success text-success"><i class="fas fa-dollar-sign"></i></div>
                <h3 class="metric-value">250,000</h3>
                <span class="metric-label">Monthly Revenue (RWF)</span>
            </div>

            <div class="bento-card bg-glass">
                <div class="card-icon bg-soft-info text-info"><i class="fas fa-star"></i></div>
                <h3 class="metric-value">4.9</h3>
                <span class="metric-label">Avg Rating</span>
            </div>

            <!-- Schedule -->
            <div class="bento-card bg-glass span-2 row-2">
                <h5 class="card-title mb-3">Today's Training Schedule</h5>
                <div class="list-group list-group-flush bg-transparent">
                    <div class="list-group-item bg-transparent d-flex justify-content-between align-items-center">
                        <div>
                            <span class="badge bg-primary me-2">08:00</span>
                            <strong>Mike Ross</strong>
                            <div class="small text-muted">Focus: Strength Training</div>
                        </div>
                        <button class="btn btn-sm btn-outline-primary">Log Result</button>
                    </div>
                    <div class="list-group-item bg-transparent d-flex justify-content-between align-items-center">
                        <div>
                            <span class="badge bg-warning me-2">10:00</span>
                             <strong>Sarah James</strong>
                            <div class="small text-muted">Focus: Weight Loss / Cardio</div>
                        </div>
                        <button class="btn btn-sm btn-outline-primary">Log Result</button>
                    </div>
                </div>
            </div>

            <!-- Quick Tools -->
            <div class="bento-card bg-glass span-2">
                <h5 class="card-title mb-3">Training Tools</h5>
                <div class="d-flex gap-3">
                    <button class="btn btn-outline-primary flex-fill p-3"><i class="fas fa-dumbbell d-block fs-3 mb-2"></i>New Routine</button>
                    <button class="btn btn-outline-primary flex-fill p-3"><i class="fas fa-weight d-block fs-3 mb-2"></i>Body Stats</button>
                    <button class="btn btn-outline-primary flex-fill p-3"><i class="fas fa-apple-alt d-block fs-3 mb-2"></i>Diet Plan</button>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    :root { --grid-gap: 20px; --card-radius: 20px; --card-bg: rgba(255,255,255,0.9); }
    .wellness-dashboard-container { width: 96%; margin-left: 15px; }
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
