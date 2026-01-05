@extends('layouts.app')
@section('title', 'Food & Fashion Workspace')
@section('content')
<div class="container-fluid p-4 text-center">
    <div class="bento-card bg-glass py-5 shadow-sm border-0 rounded-5">
        <i class="fas fa-utensils display-1 text-primary mb-4"></i>
        <h2 class="fw-bold">Food, Events & Fashion Workspace</h2>
        <p class="text-muted lead">Welcome to your specialized dashboard. We are setting up your personalized tools for commerce and management.</p>
        <div class="d-flex justify-content-center gap-4 mt-5">
             <div class="p-4 bg-soft-primary rounded-4 text-center" style="min-width: 150px;">
                <i class="fas fa-shopping-cart d-block mb-3 fs-3"></i>
                <span class="fw-bold text-uppercase small">Inventory</span>
             </div>
             <div class="p-4 bg-soft-success rounded-4 text-center" style="min-width: 150px;">
                <i class="fas fa-truck-loading d-block mb-3 fs-3"></i>
                <span class="fw-bold text-uppercase small">Logistics</span>
             </div>
             <div class="p-4 bg-soft-warning rounded-4 text-center" style="min-width: 150px;">
                <i class="fas fa-calendar-star d-block mb-3 fs-3"></i>
                <span class="fw-bold text-uppercase small">Events</span>
             </div>
        </div>
    </div>
</div>
@endsection
