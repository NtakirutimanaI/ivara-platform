@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper">
    <header class="pro-header">
        <div>
            <h1>Marketplace Management</h1>
            <p>Oversee product listings, approvals, and quality control.</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-light"><i class="fas fa-filter me-2"></i>Filter</button>
            <button class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add Product</button>
        </div>
    </header>

    <div class="dashboard-grid mb-4">
        <div class="metric-card">
            <span class="metric-title">Total Products</span>
            <h3 class="metric-value">1,240</h3>
        </div>
        <div class="metric-card">
             <span class="metric-title">Pending Review</span>
             <h3 class="metric-value text-warning">15</h3>
        </div>
        <div class="metric-card">
             <span class="metric-title">Flagged Items</span>
             <h3 class="metric-value text-danger">3</h3>
        </div>
    </div>

    <div class="pro-card glass-panel">
        <h4 class="mb-4">Recent Listings</h4>
        <div class="table-responsive">
            <table class="pro-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Seller</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-secondary rounded" style="width: 40px; height: 40px;"></div>
                                <span class="fw-bold">Vintage Denim Jacket</span>
                            </div>
                        </td>
                        <td>FashionHub Ltd</td>
                        <td>Food & Fashion</td>
                        <td>15,000 RWF</td>
                        <td><span class="status-badge status-completed">Active</span></td>
                        <td>
                            <button class="icon-btn" title="Edit"><i class="fas fa-edit"></i></button>
                            <button class="icon-btn text-danger" title="Remove"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-secondary rounded" style="width: 40px; height: 40px;"></div>
                                <span class="fw-bold">Organic Fertilizers (50kg)</span>
                            </div>
                        </td>
                        <td>AgriGrow Co</td>
                        <td>Agriculture</td>
                        <td>32,000 RWF</td>
                        <td><span class="status-badge status-pending">Pending</span></td>
                        <td>
                            <button class="btn btn-sm btn-success me-1">Approve</button>
                            <button class="btn btn-sm btn-danger">Reject</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
