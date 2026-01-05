@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container-fluid p-5 bg-light">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="fw-bold text-dark">Admin Control Panel</h1>
            <p class="text-muted">Food, Events & Fashion Category</p>
        </div>
        <button class="btn btn-dark">System Settings</button>
    </div>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 text-center">
                <h2 class="fw-bold text-primary">124</h2>
                <small class="text-uppercase text-muted">Active Events</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 text-center">
                <h2 class="fw-bold text-success">$54k</h2>
                <small class="text-uppercase text-muted">Monthly Revenue</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 text-center">
                <h2 class="fw-bold text-warning">15</h2>
                <small class="text-uppercase text-muted">Pending Vendors</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 text-center">
                <h2 class="fw-bold text-danger">3</h2>
                <small class="text-uppercase text-muted">Disputes</small>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h5 class="fw-bold mb-3">Recent Activity</h5>
        <table class="table table-white bg-white shadow-sm rounded">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Action</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#LOG-001</td>
                    <td>Wedding Planner A</td>
                    <td>Created new event</td>
                    <td>Just now</td>
                </tr>
                <tr>
                    <td>#LOG-002</td>
                    <td>Catering Co.</td>
                    <td>Updated menu</td>
                    <td>10 mins ago</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
