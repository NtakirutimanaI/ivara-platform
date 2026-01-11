@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper">
    @php
        $categorySlug = request('category');
        $categoryName = $categorySlug ? ucwords(str_replace('-', ' ', $categorySlug)) : 'Global';
        $title = $categorySlug ? "{$categoryName} Providers" : "Business Registry";
        $subtitle = $categorySlug ? "Verified professionals in {$categoryName}" : "Managing all registered businesses and freelancers";
    @endphp

    <x-admin.header :title="$title" :subtitle="$subtitle">
        <button class="btn-outline-premium me-2">
            <i class="fas fa-download me-2"></i>Export
        </button>
        <button class="btn-premium">
            <i class="fas fa-user-check me-2"></i>Verify New
        </button>
    </x-admin.header>

    <div class="row g-4 mb-4">
        <!-- Contextual Stats -->
        <div class="col-md-4">
             <x-admin.metric-card label="Total Providers" value="892" trend="+15" icon="fas fa-users-cog"/>
        </div>
        <div class="col-md-4">
             <x-admin.metric-card label="Pending Verification" value="24" trendColor="danger" icon="fas fa-clock"/>
        </div>
        <div class="col-md-4">
             <x-admin.metric-card label="Avg. Rating" value="4.8" trendColor="success" icon="fas fa-star"/>
        </div>
    </div>

    <x-admin.card title="Registered Businesses" icon="fas fa-building">
        <x-admin.table :headers="['Business Name', 'Category', 'Owner', 'Location', 'Verification', 'Actions']">
            <!-- Mock 1 -->
            <tr>
                <td class="ps-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 36px; height: 36px;">
                            AP
                        </div>
                        <div>
                            <span class="fw-bold text-dark d-block">Ace Plumbing & Co</span>
                            <small class="text-muted">Since 2024</small>
                        </div>
                    </div>
                </td>
                <td><span class="badge bg-light text-dark border">Technical & Repair</span></td>
                <td>John Smith</td>
                <td>New York, NY</td>
                <td><x-admin.status-badge status="verified" /></td>
                <td>
                    <button class="btn btn-sm btn-icon text-muted"><i class="fas fa-eye"></i></button>
                    <button class="btn btn-sm btn-icon text-muted"><i class="fas fa-ban"></i></button>
                </td>
            </tr>

            <!-- Mock 2 -->
             <tr>
                <td class="ps-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 36px; height: 36px;">
                            EL
                        </div>
                        <div>
                            <span class="fw-bold text-dark d-block">Elite Legal Advisors</span>
                            <small class="text-muted">Since 2023</small>
                        </div>
                    </div>
                </td>
                <td><span class="badge bg-light text-dark border">Legal & Professional</span></td>
                <td>Sarah Connor</td>
                <td>Chicago, IL</td>
                <td><x-admin.status-badge status="pending" /></td>
                <td>
                    <button class="btn btn-sm btn-icon text-muted"><i class="fas fa-eye"></i></button>
                    <button class="btn btn-sm btn-icon text-muted"><i class="fas fa-check"></i></button>
                </td>
            </tr>
        </x-admin.table>

         <div class="p-3 border-top text-center">
            <button class="btn btn-link text-muted text-decoration-none">Load More Records</button>
        </div>
    </x-admin.card>
</div>
@endsection
