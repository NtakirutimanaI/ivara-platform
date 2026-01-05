@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')
<div class="edu-dashboard-container p-4">
    <!-- Header -->
    <div class="row align-items-center mb-5">
        <div class="col-md-8">
            <h1 class="fw-bold display-5 mb-1 text-primary">Learner Workspace</h1>
            <p class="text-muted lead mb-0">Track your progress, join live classes, and access your study materials.</p>
        </div>
        <div class="col-md-4 text-md-end">
            <div class="bg-glass d-inline-block p-3 rounded-pill shadow-sm border">
                <span class="me-3"><i class="fas fa-calendar-alt text-primary me-2"></i> {{ date('D, M d, Y') }}</span>
                <span class="badge bg-primary rounded-pill px-3">Enrolled</span>
            </div>
        </div>
    </div>

    <!-- Bento Grid -->
    <div class="bento-grid">
        <!-- Progress Summary -->
        <div class="bento-card span-2 bg-glass border-soft-primary">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">Course Progress</h5>
                <span class="text-primary fw-bold">75% Overall</span>
            </div>
            <div class="progress rounded-pill mb-3" style="height: 12px;">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 75%"></div>
            </div>
            <div class="row text-center mt-3">
                <div class="col-4 border-end">
                    <h4 class="fw-bold mb-0">12</h4>
                    <p class="small text-muted text-uppercase mb-0">Courses</p>
                </div>
                <div class="col-4 border-end">
                    <h4 class="fw-bold mb-0">45</h4>
                    <p class="small text-muted text-uppercase mb-0">Lessons</p>
                </div>
                <div class="col-4">
                    <h4 class="fw-bold mb-0">3</h4>
                    <p class="small text-muted text-uppercase mb-0">Certificates</p>
                </div>
            </div>
        </div>

        <!-- Live Session -->
        <div class="bento-card bg-glass border-soft-danger animate-pulse">
            <div class="card-icon bg-soft-danger text-danger mb-3"><i class="fas fa-video"></i></div>
            <h6 class="fw-bold mb-1">Live: Advanced Physics</h6>
            <p class="small text-muted mb-3">Started 15 mins ago</p>
            <button class="btn btn-danger btn-sm w-100 rounded-pill">Join Class</button>
        </div>

        <!-- Upcoming Task -->
        <div class="bento-card bg-glass border-soft-warning">
            <div class="card-icon bg-soft-warning text-warning mb-3"><i class="fas fa-tasks"></i></div>
            <h6 class="fw-bold mb-1">Assignment Due</h6>
            <p class="small text-muted mb-3">UI/UX Design Case Study</p>
            <span class="badge bg-soft-warning text-warning rounded-pill">2 Days Left</span>
        </div>

        <!-- Recommended Courses -->
        <div class="bento-card span-2 row-2 bg-glass">
            <h5 class="fw-bold mb-4">Recommended for You</h5>
            <div class="list-group list-group-flush">
                <div class="list-group-item bg-transparent px-0 border-soft-light mb-2">
                    <div class="d-flex align-items-center">
                        <div class="bg-soft-info p-3 rounded-4 me-3"><i class="fas fa-code"></i></div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0 fw-bold">Python for Data Science</h6>
                            <small class="text-muted">6 Weeks • Intermediate</small>
                        </div>
                        <i class="fas fa-chevron-right text-muted"></i>
                    </div>
                </div>
                <div class="list-group-item bg-transparent px-0 border-soft-light mb-2">
                    <div class="d-flex align-items-center">
                        <div class="bg-soft-success p-3 rounded-4 me-3"><i class="fas fa-chart-line"></i></div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0 fw-bold">Digital Marketing Mastery</h6>
                            <small class="text-muted">4 Weeks • Beginner</small>
                        </div>
                        <i class="fas fa-chevron-right text-muted"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Access -->
        <div class="bento-card span-2 bg-glass">
            <h5 class="fw-bold mb-3">Study Resources</h5>
            <div class="d-flex gap-2">
                <button class="btn btn-soft-primary flex-grow-1 py-3 rounded-4">
                    <i class="fas fa-file-pdf mb-2 d-block"></i> Library
                </button>
                <button class="btn btn-soft-success flex-grow-1 py-3 rounded-4">
                    <i class="fas fa-headset mb-2 d-block"></i> Tutoring
                </button>
                <button class="btn btn-soft-warning flex-grow-1 py-3 rounded-4">
                    <i class="fas fa-comments mb-2 d-block"></i> Forum
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .bento-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
    .bento-card { background: rgba(255, 255, 255, 0.8); border-radius: 28px; padding: 24px; border: 1px solid rgba(0,0,0,0.03); }
    .span-2 { grid-column: span 2; }
    .row-2 { grid-row: span 2; }
    .card-icon { width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; border-radius: 14px; font-size: 1.2rem; }
    .animate-pulse { animation: pulse 2s infinite; }
    @keyframes pulse { 0% { box-shadow: 0 0 0 0 rgba(220, 38, 38, 0.2); } 70% { box-shadow: 0 0 0 10px rgba(220, 38, 38, 0); } 100% { box-shadow: 0 0 0 0 rgba(220, 38, 38, 0); } }
    .bg-soft-primary { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
    .bg-soft-success { background: rgba(16, 185, 129, 0.1); color: #10b981; }
    .bg-soft-warning { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }
    .bg-soft-info { background: rgba(6, 182, 212, 0.1); color: #06b6d4; }
    .btn-soft-primary { background: rgba(59, 130, 246, 0.1); color: #3b82f6; border: none; font-weight: 600; }
    .btn-soft-success { background: rgba(16, 185, 129, 0.1); color: #10b981; border: none; font-weight: 600; }
    .btn-soft-warning { background: rgba(245, 158, 11, 0.1); color: #f59e0b; border: none; font-weight: 600; }
</style>
@endsection
