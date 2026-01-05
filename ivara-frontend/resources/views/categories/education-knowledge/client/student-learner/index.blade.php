@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container-fluid p-5 bg-white">
    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            <h1 class="fw-bold" style="color: #0277bd;">My Learning Space</h1>
            <p class="text-muted">Keep pushing forward, you're doing great!</p>
        </div>
        <div class="col-md-6 text-end">
             <div class="d-inline-block text-center px-4 border-end">
                 <h2 class="fw-bold mb-0">85%</h2>
                 <small class="text-muted">Avg. Grade</small>
             </div>
             <div class="d-inline-block text-center px-4">
                 <h2 class="fw-bold mb-0 text-success">12</h2>
                 <small class="text-muted">Completed</small>
             </div>
        </div>
    </div>

    <!-- Active Courses -->
    <h3 class="fw-bold mb-4">Current Courses</h3>
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow rounded-4 overflow-hidden h-100">
                <div class="bg-primary p-4 text-white text-center position-relative">
                     <i class="fas fa-code fa-3x mb-2 opacity-50"></i>
                     <h5 class="fw-bold position-relative">Web Development</h5>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between small text-muted mb-2">
                        <span>Progress</span>
                        <span>75%</span>
                    </div>
                    <div class="progress mb-3" style="height: 6px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 75%"></div>
                    </div>
                    <button class="btn btn-outline-primary w-100 rounded-pill">Continue Learning</button>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow rounded-4 overflow-hidden h-100">
                <div class="bg-warning p-4 text-dark text-center position-relative">
                     <i class="fas fa-paint-brush fa-3x mb-2 opacity-50"></i>
                     <h5 class="fw-bold position-relative">Graphic Design</h5>
                </div>
                <div class="card-body p-4">
                     <div class="d-flex justify-content-between small text-muted mb-2">
                        <span>Progress</span>
                        <span>40%</span>
                    </div>
                    <div class="progress mb-3" style="height: 6px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"></div>
                    </div>
                    <button class="btn btn-outline-primary w-100 rounded-pill">Continue Learning</button>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow rounded-4 overflow-hidden h-100">
                <div class="bg-info p-4 text-white text-center position-relative">
                     <i class="fas fa-language fa-3x mb-2 opacity-50"></i>
                     <h5 class="fw-bold position-relative">Spanish 101</h5>
                </div>
                <div class="card-body p-4">
                     <div class="d-flex justify-content-between small text-muted mb-2">
                        <span>Progress</span>
                        <span>10%</span>
                    </div>
                    <div class="progress mb-3" style="height: 6px;">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 10%"></div>
                    </div>
                    <button class="btn btn-outline-primary w-100 rounded-pill">Continue Learning</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Deadlines -->
    <div class="card bg-light border-0 rounded-4 p-4">
        <h5 class="fw-bold mb-3"><i class="fas fa-stopwatch text-danger me-2"></i>Upcoming Deadlines</h5>
        <div class="d-flex gap-3 overflow-auto">
            <div class="bg-white p-3 rounded shadow-sm border" style="min-width: 250px;">
                <small class="text-danger fw-bold">TOMORROW</small>
                <h6 class="fw-bold mt-1">Design Mockup</h6>
                <p class="text-muted small mb-0">Graphic Design</p>
            </div>
            <div class="bg-white p-3 rounded shadow-sm border" style="min-width: 250px;">
                <small class="text-muted fw-bold">JAN 15</small>
                <h6 class="fw-bold mt-1">JS Function Quiz</h6>
                <p class="text-muted small mb-0">Web Development</p>
            </div>
        </div>
    </div>
</div>
@endsection
