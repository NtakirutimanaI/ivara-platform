@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper">
    <header class="pro-header">
        <div>
            <h1>Support Center</h1>
            <p>Manage tickets, user inquiries, and help requests.</p>
        </div>
        <button class="btn btn-primary">Create Ticket</button>
    </header>

    <div class="main-grid">
        <div class="pro-card glass-panel">
            <h4 class="mb-4">Active Tickets</h4>
             <div class="table-responsive">
                <table class="pro-table">
                    <thead>
                        <tr>
                            <th>Ticket ID</th>
                            <th>Subject</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Last Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#T-2024</td>
                            <td>Payment Gateway Issue</td>
                            <td><span class="badge bg-danger">High</span></td>
                            <td><span class="text-warning">In Progress</span></td>
                            <td>10 mins ago</td>
                        </tr>
                        <tr>
                            <td>#T-2023</td>
                            <td>Profile Update Error</td>
                            <td><span class="badge bg-info">Medium</span></td>
                            <td><span class="text-success">Resolved</span></td>
                            <td>2 hours ago</td>
                        </tr>
                         <tr>
                            <td>#T-2022</td>
                            <td>Feature Request: Mobile App</td>
                            <td><span class="badge bg-secondary">Low</span></td>
                            <td><span class="text-muted">Open</span></td>
                            <td>1 day ago</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex flex-column gap-3">
            <div class="pro-card glass-panel">
                <h4>Support Performance</h4>
                <div class="mt-3">
                    <label class="d-flex justify-content-between">Resolution Time <span class="fw-bold">2.4 hrs</span></label>
                    <div class="progress mt-1" style="height: 6px;"><div class="progress-bar bg-success" style="width: 80%"></div></div>
                </div>
                <div class="mt-3">
                     <label class="d-flex justify-content-between">Customer Satisfaction <span class="fw-bold">4.8/5</span></label>
                    <div class="progress mt-1" style="height: 6px;"><div class="progress-bar bg-warning" style="width: 95%"></div></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
