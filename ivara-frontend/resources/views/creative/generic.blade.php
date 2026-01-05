@extends('layouts.app')
@section('title', 'Wellness Workspace')
@section('content')
<div class="container-fluid p-4 text-center">
    <div class="bento-card bg-glass py-5">
        <i class="fas fa-heartbeat display-1 text-primary mb-4"></i>
        <h2 class="fw-bold">Wellness Professional Workspace</h2>
        <p class="text-muted">Welcome to your specialized dashboard. We are currently loading your specific tools.</p>
        <div class="d-flex justify-content-center gap-3 mt-4">
             <div class="p-4 bg-soft-primary rounded-4">
                <i class="fas fa-calendar-alt d-block mb-2"></i>
                <span>Schedule</span>
             </div>
             <div class="p-4 bg-soft-success rounded-4">
                <i class="fas fa-users d-block mb-2"></i>
                <span>Clients</span>
             </div>
        </div>
    </div>
</div>
@endsection
