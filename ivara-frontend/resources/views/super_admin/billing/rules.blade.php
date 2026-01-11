@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper">
    <header class="pro-header">
        <div>
            <h1>Control Billing Rules</h1>
            <p>Set platform commission rates and tax policies.</p>
        </div>
    </header>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="pro-card glass-panel h-100">
                <h4 class="mb-4 text-warning"><i class="fas fa-percentage me-2"></i>Commission Structure</h4>
                <div class="mb-3">
                    <label class="form-label d-flex justify-content-between">
                        Standard Service Commission
                        <span class="text-warning fw-bold">15%</span>
                    </label>
                    <input type="range" class="form-range" min="0" max="30" step="1" id="stdComm" value="15">
                </div>
                <div class="mb-3">
                    <label class="form-label d-flex justify-content-between">
                        Premium Provider Commission
                        <span class="text-warning fw-bold">10%</span>
                    </label>
                    <input type="range" class="form-range" min="0" max="30" step="1" id="premComm" value="10">
                </div>
                 <div class="mb-3">
                    <label class="form-label d-flex justify-content-between">
                        Product Sales Commission
                        <span class="text-warning fw-bold">5%</span>
                    </label>
                    <input type="range" class="form-range" min="0" max="30" step="1" id="prodComm" value="5">
                </div>
                <button class="btn btn-warning w-100 mt-3">Update Rates</button>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="pro-card glass-panel h-100">
                <h4 class="mb-4 text-info"><i class="fas fa-file-invoice-dollar me-2"></i>Tax & Fees</h4>
                <div class="form-check form-switch mb-3">
                     <input class="form-check-input" type="checkbox" id="vat" checked>
                     <label class="form-check-label" for="vat">Apply VAT (18%) automatically</label>
                </div>
                <div class="mb-3">
                    <label class="form-label">Fixed Transaction Fee</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent text-white">$</span>
                        <input type="number" class="form-control pro-input" value="0.50">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Payout Schedule</label>
                    <select class="form-select pro-select">
                        <option>Weekly (Mondays)</option>
                        <option>Bi-Weekly</option>
                        <option>Monthly (1st)</option>
                        <option>Instant (On Request)</option>
                    </select>
                </div>
                <button class="btn btn-info w-100 mt-3">Save Financial Policies</button>
            </div>
        </div>
    </div>
</div>
@endsection
