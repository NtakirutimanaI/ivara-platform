@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container-fluid p-5">
    <div class="d-flex align-items-center mb-5">
        <h1 class="fw-bold text-primary me-3">Tech & Sound Hub</h1>
        <span class="badge bg-dark">LIVE</span>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="p-4 bg-dark text-white rounded shadow h-100">
                <h4 class="fw-bold"><i class="fas fa-sliders-h me-2"></i>Active Mixer</h4>
                <div class="d-flex justify-content-around mt-4">
                    <div class="text-center">
                        <div class="bg-success rounded-circle mb-2" style="width: 10px; height: 10px; margin: 0 auto;"></div>
                        <small>Ch. 1</small>
                    </div>
                    <div class="text-center">
                        <div class="bg-success rounded-circle mb-2" style="width: 10px; height: 10px; margin: 0 auto;"></div>
                        <small>Ch. 2</small>
                    </div>
                    <div class="text-center">
                        <div class="bg-secondary rounded-circle mb-2" style="width: 10px; height: 10px; margin: 0 auto;"></div>
                        <small>Ch. 3</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-4 bg-white border rounded shadow-sm h-100">
                 <h4 class="fw-bold mb-3">Upcoming Gigs</h4>
                 <ul class="list-group list-group-flush">
                     <li class="list-group-item d-flex justify-content-between">
                         <span>Corporate Gala (Audio)</span>
                         <span class="text-muted">Jan 14</span>
                     </li>
                     <li class="list-group-item d-flex justify-content-between">
                         <span>Wedding Reception (Lighting)</span>
                         <span class="text-muted">Jan 16</span>
                     </li>
                 </ul>
            </div>
        </div>
    </div>
</div>
@endsection
