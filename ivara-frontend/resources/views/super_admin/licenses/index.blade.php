@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper">
    <header class="pro-header">
        <div>
            <h1>License & Compliance</h1>
            <p>Verification of professional certifications and operating permits.</p>
        </div>
    </header>

    <div class="row">
         <div class="col-md-8">
             <div class="pro-card glass-panel mb-4">
                 <h4 class="mb-4">Verification Queue</h4>
                 <div class="table-responsive">
                    <table class="pro-table">
                        <thead>
                            <tr>
                                <th>Entity</th>
                                <th>Document Type</th>
                                <th>Submitted</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Green Harvest Coop</td>
                                <td>RDB Certificate</td>
                                <td>2 hours ago</td>
                                <td><button class="btn btn-sm btn-outline-primary">Review</button></td>
                            </tr>
                             <tr>
                                <td>City Lawyers</td>
                                <td>Bar Association ID</td>
                                <td>1 day ago</td>
                                <td><button class="btn btn-sm btn-outline-primary">Review</button></td>
                            </tr>
                        </tbody>
                    </table>
                 </div>
             </div>
         </div>
         <div class="col-md-4">
             <div class="pro-card glass-panel text-center">
                 <div class="mb-3">
                     <i class="fas fa-certificate fa-3x text-success"></i>
                 </div>
                 <h1>98%</h1>
                 <p class="text-muted">Compliance Rate</p>
                 <hr class="border-secondary">
                 <div class="d-flex justify-content-between">
                     <span>Expiring Soon</span>
                     <span class="text-warning">12</span>
                 </div>
             </div>
         </div>
    </div>
</div>
@endsection
