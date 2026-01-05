@extends('layouts.app')

@section('title', 'Media & Entertainment Workspace')

@section('content')
<div class="container-fluid p-4 text-center">
    <div class="bento-card bg-glass py-5 shadow-sm border-0 rounded-5">
        <div class="mb-4">
            <span class="display-1 text-danger"><i class="fas fa-play-circle"></i></span>
        </div>
        <h2 class="fw-bold display-6 text-danger">Media & Entertainment</h2>
        <p class="text-muted lead mx-auto" style="max-width: 700px;">
            Broadcast your vision with IVARA. We are preparing your specialized tools for journalism, content creation, and event promotion.
        </p>
        
        <div class="row g-4 justify-content-center mt-5">
            <div class="col-6 col-md-2">
                <div class="p-4 bg-soft-danger rounded-4 transition-hover h-100">
                    <i class="fas fa-newspaper d-block mb-3 fs-3"></i>
                    <span class="fw-bold text-uppercase small">Newsroom</span>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <div class="p-4 bg-soft-primary rounded-4 transition-hover h-100">
                    <i class="fas fa-share-alt d-block mb-3 fs-3"></i>
                    <span class="fw-bold text-uppercase small">Socials</span>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <div class="p-4 bg-soft-warning rounded-4 transition-hover h-100">
                    <i class="fas fa-music d-block mb-3 fs-3"></i>
                    <span class="fw-bold text-uppercase small">Studio</span>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <div class="p-4 bg-soft-info rounded-4 transition-hover h-100">
                    <i class="fas fa-ticket-alt d-block mb-3 fs-3"></i>
                    <span class="fw-bold text-uppercase small">Events</span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .transition-hover:hover { transform: translateY(-5px); cursor: pointer; background: rgba(var(--bs-danger-rgb), 0.15) !important; }
    .bg-soft-danger { background: rgba(220, 38, 38, 0.1); color: #dc2626; }
    .bg-soft-primary { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
    .bg-soft-warning { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }
    .bg-soft-info { background: rgba(6, 182, 212, 0.1); color: #06b6d4; }
</style>
@endsection
