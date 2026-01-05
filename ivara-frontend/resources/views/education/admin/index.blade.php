@extends('layouts.app')

@section('title', 'Education & Knowledge Workspace')

@section('content')
<div class="container-fluid p-4 text-center">
    <div class="bento-card bg-glass py-5 shadow-sm border-0 rounded-5">
        <div class="mb-4">
            <span class="display-1 text-primary"><i class="fas fa-graduation-cap"></i></span>
        </div>
        <h2 class="fw-bold display-6">Education & Knowledge Base</h2>
        <p class="text-muted lead mx-auto" style="max-width: 700px;">
            Welcome to the IVARA learning ecosystem. We are preparing your specialized tools for knowledge sharing and academic management.
        </p>
        
        <div class="row g-4 justify-content-center mt-5">
            <div class="col-6 col-md-2">
                <div class="p-4 bg-soft-primary rounded-4 transition-hover h-100">
                    <i class="fas fa-book-open d-block mb-3 fs-3"></i>
                    <span class="fw-bold text-uppercase small">Courses</span>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <div class="p-4 bg-soft-success rounded-4 transition-hover h-100">
                    <i class="fas fa-chalkboard-teacher d-block mb-3 fs-3"></i>
                    <span class="fw-bold text-uppercase small">Classes</span>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <div class="p-4 bg-soft-warning rounded-4 transition-hover h-100">
                    <i class="fas fa-certificate d-block mb-3 fs-3"></i>
                    <span class="fw-bold text-uppercase small">Certificates</span>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <div class="p-4 bg-soft-info rounded-4 transition-hover h-100">
                    <i class="fas fa-users-class d-block mb-3 fs-3"></i>
                    <span class="fw-bold text-uppercase small">Community</span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .transition-hover:hover { transform: translateY(-5px); cursor: pointer; background: rgba(var(--bs-primary-rgb), 0.15) !important; }
    .bg-soft-primary { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
    .bg-soft-success { background: rgba(16, 185, 129, 0.1); color: #10b981; }
    .bg-soft-warning { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }
    .bg-soft-info { background: rgba(6, 182, 212, 0.1); color: #06b6d4; }
</style>
@endsection
