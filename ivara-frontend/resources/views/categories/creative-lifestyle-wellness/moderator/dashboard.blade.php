@extends('layouts.app')

@section('title', 'Moderator Dashboard')

@section('content')
<div class="container-fluid p-4">
    <h2 class="mb-4">Moderator Dashboard</h2>
    <p>Content & Community Moderation</p>
    
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Pending Reviews</h5>
                    <p class="display-4">0</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>User Reports</h5>
                    <p class="display-4">0</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Violations</h5>
                    <p class="display-4">0</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Approved Today</h5>
                    <p class="display-4">0</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
