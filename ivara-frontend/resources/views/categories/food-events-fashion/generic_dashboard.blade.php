@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container-fluid p-5">
    <div class="d-flex align-items-center mb-5">
        <div class="bg-primary text-white p-3 rounded me-3"><i class="fas fa-briefcase fa-2x"></i></div>
        <div>
            <h2 class="fw-bold m-0">Professional Dashboard</h2>
            <p class="text-muted m-0">Welcome back to your workspace</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="p-4 bg-white rounded shadow-sm border-top border-4 border-primary h-100">
                <h5 class="fw-bold text-muted">Pending Tasks</h5>
                <h1 class="fw-bold display-4">3</h1>
                <p>High priority items requiring attention.</p>
                <button class="btn btn-primary btn-sm">View Tasks</button>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 bg-white rounded shadow-sm border-top border-4 border-success h-100">
                <h5 class="fw-bold text-muted">Performance</h5>
                <h1 class="fw-bold display-4 text-success">98%</h1>
                <p>Client satisfaction rating this month.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 bg-white rounded shadow-sm border-top border-4 border-info h-100">
                <h5 class="fw-bold text-muted">Schedule</h5>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span>Team Meeting</span>
                    <span class="badge bg-light text-dark">10:00 AM</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span>Project Review</span>
                    <span class="badge bg-light text-dark">02:00 PM</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
