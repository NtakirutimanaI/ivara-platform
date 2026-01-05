@extends('layouts.app')
@section('title', 'Food & Fashion Customer Workspace')
@section('content')
<div class="container-fluid p-4">
    <div class="bento-card bg-glass p-5 text-center">
        <i class="fas fa-utensils text-primary display-3 mb-4"></i>
        <h2 class="fw-bold">My Food & Style Dashboard</h2>
        <p class="text-muted">Browse your orders, saved vendors, and exclusive culinary events.</p>
        <div class="row g-4 mt-4">
            <div class="col-md-4">
                <div class="p-4 bg-soft-primary rounded-4">
                    <i class="fas fa-receipt d-block mb-3 fs-3"></i>
                    <span class="fw-bold text-uppercase small">My Orders</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 bg-soft-success rounded-4">
                    <i class="fas fa-heart d-block mb-3 fs-3"></i>
                    <span class="fw-bold text-uppercase small">Saved Items</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 bg-soft-warning rounded-4">
                    <i class="fas fa-calendar-alt d-block mb-3 fs-3"></i>
                    <span class="fw-bold text-uppercase small">Bookings</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
