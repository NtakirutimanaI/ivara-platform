@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    :root {
        --edu-primary: #1a237e; /* Deep Indigo */
        --edu-secondary: #0d47a1; /* Blue */
        --edu-accent: #924FC2; /* Purple */
    }
    .bg-edu-primary { background-color: var(--edu-primary) !important; color: white; }
    .text-edu-primary { color: var(--edu-primary) !important; }
    .card-dashboard { border: none; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: transform 0.2s; }
    .card-dashboard:hover { transform: translateY(-5px); }
</style>

<div class="container-fluid p-5 bg-light" style="min-height: 100vh;">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="fw-bold text-edu-primary"><i class="fas fa-university me-3"></i>Education Admin Portal</h1>
            <p class="text-muted">Academic Oversight & Institutional Management</p>
        </div>
        <div>
            <span class="badge bg-secondary p-2 me-2">Term: Spring 2026</span>
            <button class="btn btn-outline-primary">Generate Reports</button>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card card-dashboard p-4 bg-white">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-1 text-uppercase fw-bold" style="font-size: 0.8rem;">Total Students</p>
                        <h2 class="fw-bold text-edu-primary">12,450</h2>
                    </div>
                    <div class="bg-light p-2 rounded-circle text-primary">
                        <i class="fas fa-user-graduate fa-lg"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="text-success small fw-bold"><i class="fas fa-arrow-up"></i> 5.2%</span> <span class="text-muted small">vs last term</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-dashboard p-4 bg-white">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-1 text-uppercase fw-bold" style="font-size: 0.8rem;">Faculty Staff</p>
                        <h2 class="fw-bold text-edu-primary">840</h2>
                    </div>
                    <div class="bg-light p-2 rounded-circle text-info">
                        <i class="fas fa-chalkboard-teacher fa-lg"></i>
                    </div>
                </div>
                <div class="mt-3">
                     <span class="text-muted small">98% Active</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-dashboard p-4 bg-white">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-1 text-uppercase fw-bold" style="font-size: 0.8rem;">Courses Active</p>
                        <h2 class="fw-bold text-edu-primary">325</h2>
                    </div>
                    <div class="bg-light p-2 rounded-circle text-warning">
                        <i class="fas fa-book-open fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-dashboard p-4 bg-white">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-1 text-uppercase fw-bold" style="font-size: 0.8rem;">Revenue (YTD)</p>
                        <h2 class="fw-bold text-edu-primary">$1.2M</h2>
                    </div>
                    <div class="bg-light p-2 rounded-circle text-success">
                        <i class="fas fa-dollar-sign fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="row g-4">
        <!-- Faculty Performance -->
        <div class="col-md-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom-0 py-3">
                    <h5 class="card-title fw-bold text-edu-primary mb-0">Faculty Performance (Recent Reviews)</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-muted">
                            <tr>
                                <th class="ps-4">Instructor</th>
                                <th>Department</th>
                                <th>Rating</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-4 fw-bold">Dr. Sarah Higgins</td>
                                <td>Physics</td>
                                <td><i class="fas fa-star text-warning"></i> 4.9</td>
                                <td><span class="badge bg-success bg-opacity-10 text-success">Excellent</span></td>
                                <td><button class="btn btn-sm btn-light">View</button></td>
                            </tr>
                            <tr>
                                <td class="ps-4 fw-bold">Prof. James Doe</td>
                                <td>Literature</td>
                                <td><i class="fas fa-star text-warning"></i> 4.5</td>
                                <td><span class="badge bg-secondary bg-opacity-10 text-secondary">Good</span></td>
                                <td><button class="btn btn-sm btn-light">View</button></td>
                            </tr>
                            <tr>
                                <td class="ps-4 fw-bold">Dr. Emily Chen</td>
                                <td>Mathematics</td>
                                <td><i class="fas fa-star text-warning"></i> 4.8</td>
                                <td><span class="badge bg-success bg-opacity-10 text-success">Excellent</span></td>
                                <td><button class="btn btn-sm btn-light">View</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-edu-primary text-white h-100">
                 <div class="card-body p-4">
                     <h4 class="fw-bold mb-4">Quick Management</h4>
                     <div class="d-grid gap-3">
                         <button class="btn btn-light text-start fw-bold text-primary"><i class="fas fa-plus-circle me-2"></i> Add New Course</button>
                         <button class="btn btn-light text-start fw-bold text-primary"><i class="fas fa-user-plus me-2"></i> Enroll Student</button>
                         <button class="btn btn-outline-light text-start fw-bold"><i class="fas fa-bullhorn me-2"></i> Campus Announcement</button>
                         <button class="btn btn-outline-light text-start fw-bold"><i class="fas fa-calendar-alt me-2"></i> Schedule Exam</button>
                     </div>
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection
