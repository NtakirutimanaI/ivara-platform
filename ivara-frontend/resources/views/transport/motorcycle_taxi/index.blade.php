@extends('layouts.app')

@section('title', 'Motorcycle Taxi Dashboard')

@section('content')
<div class="transport-dashboard-container">
    <div class="container-fluid p-3">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold display-5 mb-1 text-primary">Moto Console</h1>
                <p class="text-muted lead mb-0">Track your rides and bike condition.</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                 <div class="status-pill available">
                    <span class="dot"></span> Online
                </div>
            </div>
        </div>

        <!-- Bento Grid -->
        <div class="bento-grid">
            <div class="bento-card bg-glass">
                <div class="card-icon bg-soft-primary text-primary"><i class="fas fa-motorcycle"></i></div>
                <h3 class="metric-value">18</h3>
                <span class="metric-label">Rides Today</span>
            </div>
            <div class="bento-card bg-glass">
                <div class="card-icon bg-soft-warning text-warning"><i class="fas fa-coins"></i></div>
                <h3 class="metric-value">12,500</h3>
                <span class="metric-label">Earnings (RWF)</span>
            </div>
            <div class="bento-card bg-glass span-2 row-2">
                <h5 class="card-title mb-3">Live Trips</h5>
                <p class="text-muted">No active trips at the moment.</p>
            </div>
        </div>
    </div>
</div>
@endsection
