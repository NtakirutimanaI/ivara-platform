@extends('layouts.app')

@section('title', 'Yoga Trainer Dashboard')

@section('content')
<div class="wellness-dashboard-container">
    <div class="container-fluid p-3">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold display-5 mb-1 text-primary">Yoga Studio Console</h1>
                <p class="text-muted lead mb-0">Manage classes, students, and wellness sessions.</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                 <div class="status-pill available">
                    <span class="dot"></span> Next Class: 15:00
                </div>
            </div>
        </div>

        <!-- Bento Grid -->
        <div class="bento-grid">
            <div class="bento-card bg-glass">
                <div class="card-icon bg-soft-primary text-primary"><i class="fas fa-spa"></i></div>
                <h3 class="metric-value">3</h3>
                <span class="metric-label">Classes Today</span>
            </div>
            <div class="bento-card bg-glass">
                <div class="card-icon bg-soft-warning text-warning"><i class="fas fa-users"></i></div>
                <h3 class="metric-value">45</h3>
                <span class="metric-label">Active Members</span>
            </div>
             <div class="bento-card bg-glass span-2 row-2">
                <h5 class="card-title mb-3">Live Feed</h5>
                <p class="text-muted">Students are booking for the sunset Vinyasa session.</p>
            </div>
        </div>
    </div>
</div>
@endsection
