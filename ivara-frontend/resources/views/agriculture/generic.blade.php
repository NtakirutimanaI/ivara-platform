@extends('layouts.app')

@section('title', 'Agriculture & Environment Workspace')

@section('content')
<div class="container-fluid p-4 text-center">
    <div class="bento-card bg-glass py-5 shadow-sm border-0 rounded-5">
        <div class="mb-4">
            <span class="display-1 text-success"><i class="fas fa-seedling"></i></span>
        </div>
        <h2 class="fw-bold display-6 text-success">Agriculture, Farming & Environment</h2>
        <p class="text-muted lead mx-auto" style="max-width: 700px;">
            Cultivating the future with IVARA. We are preparing your specialized tools for farm management, sustainability tracking, and agribusiness operations.
        </p>
        
        <div class="row g-4 justify-content-center mt-5">
            <div class="col-6 col-md-2">
                <div class="p-4 bg-soft-success rounded-4 transition-hover h-100">
                    <i class="fas fa-tractor d-block mb-3 fs-3"></i>
                    <span class="fw-bold text-uppercase small">Farm Ops</span>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <div class="p-4 bg-soft-primary rounded-4 transition-hover h-100">
                    <i class="fas fa-hand-holding-usd d-block mb-3 fs-3"></i>
                    <span class="fw-bold text-uppercase small">Markets</span>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <div class="p-4 bg-soft-warning rounded-4 transition-hover h-100">
                    <i class="fas fa-cloud-sun-rain d-block mb-3 fs-3"></i>
                    <span class="fw-bold text-uppercase small">Climate</span>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <div class="p-4 bg-soft-info rounded-4 transition-hover h-100">
                    <i class="fas fa-leaf d-block mb-3 fs-3"></i>
                    <span class="fw-bold text-uppercase small">Ecology</span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .transition-hover:hover { transform: translateY(-5px); cursor: pointer; background: rgba(var(--bs-success-rgb), 0.15) !important; }
    .bg-soft-success { background: rgba(16, 185, 129, 0.1); color: #10b981; }
    .bg-soft-primary { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
    .bg-soft-warning { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }
    .bg-soft-info { background: rgba(6, 182, 212, 0.1); color: #06b6d4; }
</style>
@endsection
