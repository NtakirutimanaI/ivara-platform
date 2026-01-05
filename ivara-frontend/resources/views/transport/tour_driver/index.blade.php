@extends('layouts.app')

@section('title', 'Tour Driver Dashboard')

@section('content')
<div class="transport-dashboard-container">
    <div class="container-fluid p-3">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold display-5 mb-1 text-primary">Tour Console</h1>
                <p class="text-muted lead mb-0">Guided trips, bookings, and destinations.</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="status-pill available">
                    <span class="dot"></span> Booked: Volcano National Park
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
                <div class="card-icon bg-soft-primary text-primary"><i class="fas fa-suitcase-rolling"></i></div>
                <h3 class="metric-value">3</h3>
                <span class="metric-label">Active Bookings</span>
            </div>
            
            <div class="bento-card bg-glass">
                <div class="card-icon bg-soft-warning text-warning"><i class="fas fa-map-marked-alt"></i></div>
                <h3 class="metric-value">12</h3>
                <span class="metric-label">Destinations Visited</span>
            </div>

            <div class="bento-card bg-glass">
                <div class="card-icon bg-soft-success text-success"><i class="fas fa-star-half-alt"></i></div>
                <h3 class="metric-value">5.0</h3>
                <span class="metric-label">Guest Rating</span>
            </div>

            <div class="bento-card bg-glass">
                <div class="card-icon bg-soft-info text-info"><i class="fas fa-language"></i></div>
                <h3 class="metric-value">EN / FR</h3>
                <span class="metric-label">Guest Languages</span>
            </div>

            <!-- Current Tour -->
            <div class="bento-card bg-glass span-2 row-2">
                <h5 class="card-title mb-3">Upcoming Tours</h5>
                <div class="list-group list-group-flush bg-transparent">
                    <div class="list-group-item bg-transparent d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Nyungwe Rainforest Walk</strong>
                            <div class="small text-muted">Group of 5 - Tomorrow, 06:00</div>
                        </div>
                        <button class="btn btn-sm btn-outline-primary">Checklist</button>
                    </div>
                    <div class="list-group-item bg-transparent d-flex justify-content-between align-items-center border-0">
                        <div>
                            <strong>Akagera Safari Drive</strong>
                            <div class="small text-muted">Couple - Friday, 05:30</div>
                        </div>
                        <button class="btn btn-sm btn-outline-primary">Checklist</button>
                    </div>
                </div>
            </div>

            <!-- Destinations -->
            <div class="bento-card bg-glass span-2" style="background: linear-gradient(rgba(255,255,255,0.9), rgba(255,255,255,0.9)), url('https://images.unsplash.com/photo-1516422317953-268d41a51024?auto=format&fit=crop&w=400&q=80'); background-size: cover;">
                <h5 class="card-title mb-3">Destination Insights</h5>
                <p class="small text-muted">Weather at Akagera: 24°C, Sunny. Perfect for animal viewing today.</p>
                <button class="btn btn-primary btn-sm">View Map</button>
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
