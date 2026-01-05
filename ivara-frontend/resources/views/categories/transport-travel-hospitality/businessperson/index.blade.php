@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body { background-color: #f8fafc; font-family: 'Segoe UI', sans-serif; }
    .biz-card { background: white; border-radius: 4px; border: 1px solid #e2e8f0; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
    .kpi-title { font-size: 0.8rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; }
    .kpi-val { font-size: 2rem; color: #0f172a; font-weight: 700; }
</style>
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h2 class="fw-bold text-dark">Business Analytics</h2>
        <div class="btn-group">
            <button class="btn btn-white border">This Week</button>
            <button class="btn btn-white border">This Month</button>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="biz-card">
                <div class="kpi-title mb-2">Total Revenue</div>
                <div class="kpi-val">$124,500</div>
                <div class="text-success small mt-2"><i class="fas fa-arrow-up"></i> 12% vs last month</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="biz-card">
                <div class="kpi-title mb-2">Fleet Utilization</div>
                <div class="kpi-val">87%</div>
                <div class="text-danger small mt-2"><i class="fas fa-arrow-down"></i> 2% vs last month</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="biz-card">
                <div class="kpi-title mb-2">Active Contracts</div>
                <div class="kpi-val">34</div>
                <div class="text-success small mt-2"><i class="fas fa-plus"></i> 3 new</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="biz-card">
                <div class="kpi-title mb-2">OpEx</div>
                <div class="kpi-val">$45,200</div>
                <div class="text-secondary small mt-2">Stable</div>
            </div>
        </div>
    </div>
    
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="biz-card h-100">
                <h5 class="fw-bold mb-4">Revenue Trend</h5>
                <div class="d-flex align-items-end justify-content-between" style="height: 200px; padding: 0 20px;">
                    <!-- Mock Chart Bars -->
                    <div class="bg-primary opacity-25" style="width: 10%; height: 40%;"></div>
                    <div class="bg-primary opacity-50" style="width: 10%; height: 55%;"></div>
                    <div class="bg-primary opacity-75" style="width: 10%; height: 45%;"></div>
                    <div class="bg-primary" style="width: 10%; height: 75%;"></div>
                    <div class="bg-primary" style="width: 10%; height: 60%;"></div>
                    <div class="bg-primary" style="width: 10%; height: 85%;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="biz-card h-100">
                 <h5 class="fw-bold mb-4">Recent Transactions</h5>
                 <ul class="list-unstyled">
                     <li class="d-flex justify-content-between mb-3 border-bottom pb-2">
                         <span>Logistics Contract A</span>
                         <span class="fw-bold text-success">+$12,000</span>
                     </li>
                     <li class="d-flex justify-content-between mb-3 border-bottom pb-2">
                         <span>Fuel Expense</span>
                         <span class="fw-bold text-danger">-$3,400</span>
                     </li>
                     <li class="d-flex justify-content-between mb-3 border-bottom pb-2">
                         <span>Vehicle Maintenance</span>
                         <span class="fw-bold text-danger">-$1,200</span>
                     </li>
                 </ul>
            </div>
        </div>
    </div>
</div>
@endsection
