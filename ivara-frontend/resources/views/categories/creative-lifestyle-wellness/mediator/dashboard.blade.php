@extends('layouts.app')

@section('title', 'Mediator Dashboard')

@section('content')
<div class="container-fluid p-4">
    <h2 class="mb-4">Mediator Dashboard</h2>
    <p>Dispute Resolution & Case Management</p>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Active Disputes</h5>
                    <p class="display-4">0</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Resolved Cases</h5>
                    <p class="display-4">0</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Pending Review</h5>
                    <p class="display-4">0</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
