@extends('layouts.app')

@section('title', 'Inventory & Parts')

@section('content')
<div class="technician-page-container">
    <div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold text-primary">Parts & Inventory</h1>
                <p class="text-muted">Manage your technician stock and spare parts.</p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary rounded-pill"><i class="fas fa-barcode me-2"></i> Scan Part</button>
                <button class="btn btn-primary rounded-pill"><i class="fas fa-plus me-2"></i> Request Stock</button>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-8">
                <div class="glass-card p-4">
                    <h5 class="fw-bold mb-4">My Dashboard Stock</h5>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="p-3 bg-light rounded-4 text-center">
                                <h2 class="fw-bold text-primary">124</h2>
                                <div class="small text-muted fw-bold">TOTAL ITEMS</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-light rounded-4 text-center">
                                <h2 class="fw-bold text-danger">5</h2>
                                <div class="small text-muted fw-bold">CRITICAL LOW</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-light rounded-4 text-center">
                                <h2 class="fw-bold text-success">82%</h2>
                                <div class="small text-muted fw-bold">STOCK HEALTH</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="glass-card p-4 h-100">
                    <h5 class="fw-bold mb-3">Quick Search</h5>
                    <div class="mb-3">
                        <label class="small fw-bold text-muted mb-1">PART NAME / SKU</label>
                        <input type="text" class="form-control glass-input" placeholder="e.g. iPhone Display">
                    </div>
                    <div>
                        <label class="small fw-bold text-muted mb-1">CATEGORY</label>
                        <select class="form-select glass-input">
                            <option>Displays</option>
                            <option>Batteries</option>
                            <option>Internal Cables</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="glass-card p-0 overflow-hidden">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Part Name</th>
                        <th>SKU / Serial</th>
                        <th>Category</th>
                        <th>In Stock</th>
                        <th>Reserved</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-mobile-alt me-3 text-muted"></i>
                                <strong>iPhone 14 Pro Max Display</strong>
                            </div>
                        </td>
                        <td class="small font-monospace">SKU-DISP-4491</td>
                        <td>Screens</td>
                        <td><span class="badge bg-success rounded-pill px-3">8 Units</span></td>
                        <td>2 Units</td>
                        <td><button class="btn btn-sm btn-outline-primary">Use</button></td>
                    </tr>
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-battery-full me-3 text-danger"></i>
                                <strong>MacBook M2 Battery Kit</strong>
                            </div>
                        </td>
                        <td class="small font-monospace text-danger">SKU-BATT-0021</td>
                        <td>Batteries</td>
                        <td><span class="badge bg-danger rounded-pill px-3">2 Units</span></td>
                        <td>0 Units</td>
                        <td><button class="btn btn-sm btn-primary">Order Now</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .technician-page-container { width: 96%; margin-left: 15px; }
    .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.3); border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    .glass-input { background: rgba(255, 255, 255, 0.5); border: 1px solid rgba(0,0,0,0.05); border-radius: 12px; }
</style>
@endsection
