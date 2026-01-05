@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container-fluid p-5">
    <div class="row mb-5">
        <div class="col-md-8">
            <h1 class="fw-bold" style="color: #558b2f;"><i class="fas fa-search-location me-3"></i>Crop Monitoring</h1>
            <p class="text-muted">Field Inspection & Health Analysis</p>
        </div>
        <div class="col-md-4 text-end">
            <button class="btn btn-success btn-lg shadow-sm"><i class="fas fa-plus me-2"></i>New Inspection</button>
        </div>
    </div>

    <div class="row g-4">
        <!-- Farm List -->
        <div class="col-md-4">
             <div class="card border-0 shadow-sm rounded-4 h-100">
                 <div class="card-header bg-white border-bottom fw-bold text-success">Assigned Farms</div>
                 <div class="list-group list-group-flush">
                     <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center active" aria-current="true" style="background-color: #558b2f; border-color: #558b2f;">
                         <div>
                             <strong>Green Acres</strong>
                             <br><small>Corn Field A</small>
                         </div>
                         <i class="fas fa-chevron-right"></i>
                     </a>
                     <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                         <div>
                             <strong>River Side Coop</strong>
                             <br><small>Soybean Plot</small>
                         </div>
                         <span class="badge bg-warning text-dark">Check Req.</span>
                     </a>
                     <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                         <div>
                             <strong>Highland Estate</strong>
                             <br><small>Tea Plantation</small>
                         </div>
                         <i class="fas fa-chevron-right"></i>
                     </a>
                 </div>
             </div>
        </div>

        <!-- Detail View -->
        <div class="col-md-8">
            <div class="card border-0 shadow rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between mb-4">
                        <h4 class="fw-bold text-dark">Green Acres Report</h4>
                        <span class="text-muted">ID: #FM-9921</span>
                    </div>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-sm-4">
                            <div class="p-3 bg-light rounded text-center">
                                <small class="text-uppercase fw-bold text-muted">Moisture</small>
                                <h3 class="text-primary mb-0">65%</h3>
                            </div>
                        </div>
                         <div class="col-sm-4">
                            <div class="p-3 bg-light rounded text-center">
                                <small class="text-uppercase fw-bold text-muted">Growth Stage</small>
                                <h3 class="text-success mb-0">Flowering</h3>
                            </div>
                        </div>
                         <div class="col-sm-4">
                            <div class="p-3 bg-light rounded text-center">
                                <small class="text-uppercase fw-bold text-muted">Risk Level</small>
                                <h3 class="text-warning mb-0">Low</h3>
                            </div>
                        </div>
                    </div>

                    <h5 class="fw-bold mb-3">Today's Observations</h5>
                    <form>
                        <div class="mb-3">
                            <textarea class="form-control bg-light border-0" rows="4" placeholder="Enter notes about leaf color, pest presence, etc..."></textarea>
                        </div>
                        <button class="btn btn-success fw-bold px-4">Submit Report</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
