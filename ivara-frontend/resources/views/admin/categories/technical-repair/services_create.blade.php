@extends('layouts.app')

@section('title', 'Create Service - Technical & Repair')

@section('content')
<div class="dashboard-wrapper">
    <!-- Header Section -->
    <header class="pro-header">
        <div>
            <h1>Create New Service</h1>
            <p>Add a new professional repair or technical service to the registry</p>
        </div>
        <div>
            <a href="{{ route('admin.technical-repair.services') }}" class="action-btn secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </header>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="pro-card glass-panel">
                <div class="card-header border-bottom">
                    <h3><i class="fas fa-plus-circle text-primary"></i> Service Details</h3>
                </div>
                <div class="card-body p-4">
                    @include('admin.categories.partials.entity_form', [
                        'action' => route('admin.technical-repair.services.store'), 
                        'method' => 'POST', 
                        'model' => null, 
                        'entity' => 'Service'
                    ])
                </div>
            </div>

            <div class="mt-4 p-3 glass-panel rounded-3 border-0" style="background: rgba(99, 102, 241, 0.05);">
                <div class="d-flex align-items-center">
                    <i class="fas fa-info-circle text-primary fs-4 me-3"></i>
                    <div>
                        <h6 class="mb-1 fw-bold">Important Note</h6>
                        <p class="mb-0 small text-muted">New services will be immediately available for selection in booking forms once created. Ensure price and descriptions are accurate.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
