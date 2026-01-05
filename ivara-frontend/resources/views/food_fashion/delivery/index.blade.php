@extends('layouts.app')
@section('title', 'Food & Package Delivery Dashboard')
@section('content')
<div class="container-fluid p-4">
    <div class="bento-card bg-glass p-5 text-center">
        <i class="fas fa-motorcycle text-danger display-3 mb-4"></i>
        <h2 class="fw-bold">Delivery & Logistics Hub</h2>
        <p class="text-muted">Real-time tracking of food deliveries and package transit.</p>
        <div class="bg-soft-danger p-4 rounded-4 mt-4 d-inline-block">
            <span class="fs-1 fw-black">4</span>
            <p class="mb-0 fw-bold text-uppercase small">Active Drivers Online</p>
        </div>
        <div class="mt-5 text-start">
            <h6 class="fw-bold mb-3"><i class="fas fa-map-pin me-2 text-danger"></i>Live Transitions</h6>
            <div class="p-3 border-start border-4 border-danger bg-white mb-2">
                <strong>Order #442</strong> - En route to Kigali Heights
            </div>
            <div class="p-3 border-start border-4 border-secondary bg-white text-muted">
                <strong>Order #441</strong> - Delivered (Kimironko)
            </div>
        </div>
    </div>
</div>
@endsection
