@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper">
    @php
        $categorySlug = request('category');
        $categoryName = $categorySlug ? ucwords(str_replace('-', ' ', $categorySlug)) : 'Global';
        $title = $categorySlug ? "{$categoryName} Services" : "Service Registry";
        $subtitle = $categorySlug ? "Managing service catalog for {$categoryName}" : "Centralized database of all platform services";
    @endphp

    <x-admin.header :title="$title" :subtitle="$subtitle">
        <button class="btn-outline-premium me-2">
            <i class="fas fa-filter me-2"></i>Filter
        </button>
        <button class="btn-premium">
            <i class="fas fa-plus me-2"></i>Add Service
        </button>
    </x-admin.header>

    <div class="row g-4 mb-4">
        <!-- Contextual Stats -->
        <div class="col-md-4">
             <x-admin.metric-card label="Total Services" value="142" trend="+3" icon="fas fa-concierge-bell"/>
        </div>
        <div class="col-md-4">
             <x-admin.metric-card label="Avg. Price" value="$450" icon="fas fa-tag"/>
        </div>
        <div class="col-md-4">
             <x-admin.metric-card label="Active Promos" value="8" trendColor="warning" icon="fas fa-percentage"/>
        </div>
    </div>

    <x-admin.card title="Service Catalog" icon="fas fa-list">
        <x-admin.table :headers="['Service Name', 'Category', 'Base Price', 'Providers', 'Status', 'Actions']">
            <!-- Mock Data 1 -->
            <tr>
                <td class="ps-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="icon-circle-sm bg-light text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            <i class="fas fa-wrench"></i>
                        </div>
                        <div>
                            <span class="fw-bold text-dark d-block">Premium Device Repair</span>
                            <small class="text-muted">ID: SRV-1001</small>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="badge bg-light text-dark border">Technical & Repair</span>
                </td>
                <td class="fw-bold">$120.00</td>
                <td>
                    <div class="d-flex -space-x-2">
                        <span class="badge bg-light text-muted">24 Active</span>
                    </div>
                </td>
                <td><x-admin.status-badge status="active" /></td>
                <td>
                    <button class="btn btn-sm btn-icon text-muted"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-sm btn-icon text-muted"><i class="fas fa-ellipsis-v"></i></button>
                </td>
            </tr>

            <!-- Mock Data 2 -->
             <tr>
                <td class="ps-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="icon-circle-sm bg-light text-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            <i class="fas fa-paint-brush"></i>
                        </div>
                        <div>
                            <span class="fw-bold text-dark d-block">Interior Design Consult</span>
                            <small class="text-muted">ID: SRV-2042</small>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="badge bg-light text-dark border">Creative & Lifestyle</span>
                </td>
                <td class="fw-bold">$500.00</td>
                <td>
                    <div class="d-flex -space-x-2">
                        <span class="badge bg-light text-muted">12 Active</span>
                    </div>
                </td>
                <td><x-admin.status-badge status="review" /></td>
                <td>
                    <button class="btn btn-sm btn-icon text-muted"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-sm btn-icon text-muted"><i class="fas fa-ellipsis-v"></i></button>
                </td>
            </tr>
        </x-admin.table>
        
        <div class="p-3 border-top text-center">
            <button class="btn btn-link text-muted text-decoration-none">Load More Records</button>
        </div>
    </x-admin.card>
</div>
@endsection
