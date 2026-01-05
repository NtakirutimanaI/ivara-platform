@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container-fluid p-5">
    <div class="text-center mb-5">
        <h1 class="font-monospace fw-bold display-4">FASHION ATELIER</h1>
        <p class="text-muted letter-spacing-2">TAILORING & ALTERATIONS</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-dark mb-4">
                <div class="card-header bg-dark text-white">
                    Active Job Cards
                </div>
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">Tuxedo Adjustment - Mr. Bond</h5>
                            <small>Sleeves +2cm | Hem Trousers</small>
                        </div>
                        <span class="badge bg-warning text-dark">Fitting: Today</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">Bridal Gown - Ms. Vesper</h5>
                            <small>Waist reduction | Lace repair</small>
                        </div>
                        <span class="badge bg-danger">Urgent: Jan 4</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
