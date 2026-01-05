@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body { background-color: #f0fdf4; font-family: 'Segoe UI', sans-serif; }
    .compliance-card { background: white; border: 1px solid #dcfce7; border-radius: 8px; padding: 20px; margin-bottom: 20px; }
    .score-circle { width: 100px; height: 100px; border-radius: 50%; border: 8px solid #22c55e; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: bold; color: #15803d; margin: 0 auto; }
</style>
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h2 class="fw-bold text-success"><i class="fas fa-user-shield me-2"></i>Safety & Compliance Officer</h2>
        <button class="btn btn-outline-success"><i class="fas fa-file-download me-2"></i> Download Monthly Report</button>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="compliance-card text-center h-100">
                <h5 class="fw-bold mb-4">Overall Fleet Safety Score</h5>
                <div class="score-circle mb-3">94%</div>
                <p class="text-success fw-bold">Excellent</p>
                <p class="text-muted small">Based on last 30 days of data</p>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="compliance-card h-100">
                <h5 class="fw-bold mb-4">Pending Audits</h5>
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fw-bold">Taxi Fleet #A4 - Annual Inspection</div>
                            <small class="text-muted">Due: Tomorrow</small>
                        </div>
                        <span class="badge bg-warning text-dark">Urgent</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fw-bold">Bus Driver Certifications Review</div>
                            <small class="text-muted">Due: in 3 days</small>
                        </div>
                        <span class="badge bg-info text-dark">Scheduled</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
