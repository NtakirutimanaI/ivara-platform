@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body { background-color: #f0f7f4; } /* Very Light Green */
    .bg-chalkboard { background-color: #2d4036; color: #fff; }
    .card-lesson { border-left: 5px solid #2d4036; transition: all 0.3s; }
    .card-lesson:hover { shadow: 0 5px 15px rgba(0,0,0,0.1); transform: translateX(5px); }
</style>

<div class="container-fluid p-5">
    <!-- Header Section -->
    <div class="p-5 rounded-4 bg-chalkboard mb-5 shadow position-relative overflow-hidden">
        <div class="position-relative z-1">
            <h1 class="display-5 fw-bold"><i class="fas fa-chalkboard-teacher me-3"></i>Instructor Dashboard</h1>
            <p class="lead mb-0">Good Morning, Prof. Instructor</p>
        </div>
        <i class="fas fa-book position-absolute opacity-25" style="font-size: 15rem; right: -2rem; bottom: -4rem; color: white;"></i>
    </div>

    <div class="row g-4">
        <!-- Upcoming Classes -->
        <div class="col-lg-8">
            <h4 class="fw-bold text-dark mb-4">Today's Schedule</h4>
            <div class="card card-lesson bg-white shadow-sm mb-3">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-bold mb-1">Introduction to Algorithms</h5>
                        <p class="text-muted mb-0"><i class="far fa-clock me-1"></i> 09:00 AM - 10:30 AM | <i class="fas fa-map-marker-alt me-1"></i> Hall A2</p>
                    </div>
                    <button class="btn btn-primary rounded-pill px-4">Start Class</button>
                </div>
            </div>
            
            <div class="card card-lesson bg-white shadow-sm mb-3">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-bold mb-1">Data Structures Advanced</h5>
                        <p class="text-muted mb-0"><i class="far fa-clock me-1"></i> 11:00 AM - 12:30 PM | <i class="fas fa-video me-1"></i> Virtual Room</p>
                    </div>
                    <button class="btn btn-outline-primary rounded-pill px-4">Join Link</button>
                </div>
            </div>

             <div class="card card-lesson bg-white shadow-sm mb-3" style="opacity: 0.7;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-bold mb-1">Office Hours</h5>
                        <p class="text-muted mb-0"><i class="far fa-clock me-1"></i> 02:00 PM - 04:00 PM</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Tools -->
        <div class="col-lg-4">
            <h4 class="fw-bold text-dark mb-4">Quick Tools</h4>
            <div class="row g-3">
                <div class="col-6">
                    <div class="p-3 bg-white rounded shadow-sm text-center h-100 border">
                        <i class="fas fa-clipboard-list fa-2x text-success mb-2"></i>
                        <br>
                        <small class="fw-bold">Attendance</small>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 bg-white rounded shadow-sm text-center h-100 border">
                        <i class="fas fa-poll fa-2x text-warning mb-2"></i>
                        <br>
                        <small class="fw-bold">Grades</small>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 bg-white rounded shadow-sm text-center h-100 border">
                        <i class="fas fa-cloud-upload-alt fa-2x text-info mb-2"></i>
                        <br>
                        <small class="fw-bold">Upload Material</small>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 bg-white rounded shadow-sm text-center h-100 border">
                        <i class="fas fa-comments fa-2x text-danger mb-2"></i>
                        <br>
                        <small class="fw-bold">Messages</small>
                        <span class="badge bg-danger rounded-pill">3</span>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm mt-4 bg-light">
                <div class="card-body">
                    <h6 class="fw-bold"><i class="fas fa-bell text-warning me-2"></i>Student Alerts</h6>
                    <ul class="list-unstyled small mb-0">
                        <li class="mb-2 border-bottom pb-1">John Doe missed 3 classes.</li>
                        <li>Assignment 2 submission deadline today.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
