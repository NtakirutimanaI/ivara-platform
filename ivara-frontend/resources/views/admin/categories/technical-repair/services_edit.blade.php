@extends('layouts.app')

@section('title', 'Edit Service - Technical & Repair')

@section('content')
<div class="dashboard-wrapper">
    <!-- Header Section -->
    <header class="pro-header">
        <div>
            <h1>Edit Service</h1>
            <p>Updating configuration for: <span class="text-primary fw-bold">{{ $service->name }}</span></p>
        </div>
        <div>
            <a href="{{ route('admin.technical-repair.services') }}" class="action-btn secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </header>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="pro-card glass-panel border-top border-primary border-4">
                <div class="card-header border-bottom">
                    <h3><i class="fas fa-edit text-primary"></i> Modify Service Details</h3>
                </div>
                <div class="card-body p-4">
                    @include('admin.categories.partials.entity_form', [
                        'action' => route('admin.technical-repair.services.update', $service->_id ?? $service->id), 
                        'method' => 'PUT', 
                        'model' => $service, 
                        'entity' => 'Service'
                    ])
                </div>
            </div>

            <div class="mt-4 p-3 glass-panel rounded-3 border-0" style="background: rgba(245, 158, 11, 0.05);">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle text-warning fs-4 me-3"></i>
                    <div>
                        <h6 class="mb-1 fw-bold">Update Visibility</h6>
                        <p class="mb-0 small text-muted">Changes to service names or pricing will reflect across all new bookings. Existing bookings will retain their original price points.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
