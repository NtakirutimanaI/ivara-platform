@extends('layouts.app')
@section('title', 'Fashion & Style Dashboard')
@section('content')
<div class="container-fluid p-4">
    <div class="bento-card bg-glass p-5 text-center">
        <i class="fas fa-tshirt text-info display-3 mb-4"></i>
        <h2 class="fw-bold">Fashion & Clothing Production</h2>
        <p class="text-muted">Direct oversight of tailoring, boutique inventory, and style trends.</p>
        <div class="row g-4 mt-4 text-start">
            <div class="col-lg-8">
                <div class="p-4 bg-white rounded-4 shadow-sm">
                    <h5 class="fw-bold mb-3">Inventory Status</h5>
                    <div class="progress mb-3" style="height: 10px;">
                        <div class="progress-bar bg-info" style="width: 75%"></div>
                    </div>
                    <small class="text-muted">75% of Spring Collection fabric in stock.</small>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="p-4 bg-soft-info rounded-4 text-center">
                    <i class="fas fa-cut d-block mb-2 fs-4"></i>
                    <span class="d-block fw-bold">12 Orders</span>
                    <small>In Production</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
