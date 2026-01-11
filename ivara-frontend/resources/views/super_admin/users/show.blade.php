@extends('layouts.app')

@section('content')
<div class="dashboard-page">
    <div class="header-premium p-4 d-flex justify-content-between align-items-center bg-white border-bottom">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('super_admin.users.index') }}" class="btn btn-outline-secondary rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h4 class="fw-bold mb-0">User Profile</h4>
                <p class="text-muted small mb-0">Manage detailed account information</p>
            </div>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-danger px-4 rounded-pill" onclick="banUser({{ $user->id }})">
                <i class="fas fa-ban me-2"></i>Ban Account
            </button>
            <button class="btn btn-primary px-4 rounded-pill">
                <i class="fas fa-edit me-2"></i>Edit Details
            </button>
        </div>
    </div>

    <div class="content p-4">
        <div class="row g-4">
            <!-- Left Col: Identity Card -->
            <div class="col-lg-4">
                <div class="card border shadow-sm rounded-4 overflow-hidden">
                    <div class="p-5 text-center bg-light border-bottom">
                        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center fw-bold shadow-lg mb-4" style="width: 120px; height: 120px; font-size: 2.5rem; background: linear-gradient(135deg, #4F46E5 0%, #4338ca 100%) !important;">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                        <h4 class="fw-bold text-dark mb-1">{{ $user->name }}</h4>
                        <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-bold" style="font-size: 0.8rem;">{{ ucfirst($user->role) }}</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <label class="text-muted small fw-bold text-uppercase d-block mb-1">Account Status</label>
                            <x-admin.status-badge :status="$user->status" />
                        </div>
                        <div class="mb-4">
                            <label class="text-muted small fw-bold text-uppercase d-block mb-1">Service Category</label>
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-layer-group text-primary"></i>
                                <span class="fw-bold text-dark">{{ $user->category ?? 'General' }}</span>
                            </div>
                        </div>
                        <div class="mb-0">
                            <label class="text-muted small fw-bold text-uppercase d-block mb-1">Member Since</label>
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-calendar-alt text-muted"></i>
                                <span class="text-dark">{{ $user->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Col: Information & Stats -->
            <div class="col-lg-8">
                <div class="card border shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white p-4 border-bottom">
                        <h5 class="fw-bold mb-0">Account Information</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-2">Full Name</label>
                                <div class="p-3 bg-light rounded-3 border fw-bold">{{ $user->name }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-2">Email Address</label>
                                <div class="p-3 bg-light rounded-3 border fw-bold">{{ $user->email }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-2">Username</label>
                                <div class="p-3 bg-light rounded-3 border fw-bold">{{ $user->username }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-2">Phone Number</label>
                                <div class="p-3 bg-light rounded-3 border fw-bold">{{ $user->phone ?? 'Not provided' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity Mockup -->
                <div class="card border shadow-sm rounded-4">
                    <div class="card-header bg-white p-4 border-bottom d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">Recent Activity</h5>
                        <button class="btn btn-sm btn-light border rounded-pill px-3">View All</button>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4 py-3 small text-muted">EVENT</th>
                                        <th class="py-3 small text-muted">DATE</th>
                                        <th class="py-3 small text-muted">IP ADDRESS</th>
                                        <th class="pe-4 py-3 small text-muted">STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="ps-4">Account Login</td>
                                        <td>Just now</td>
                                        <td>192.168.1.1</td>
                                        <td><span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2">Success</span></td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4">Profile Update</td>
                                        <td>2 hours ago</td>
                                        <td>197.243.12.1</td>
                                        <td><span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2">Success</span></td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 border-0">Password Change</td>
                                        <td class="border-0">Yesterday</td>
                                        <td class="border-0">197.243.12.1</td>
                                        <td class="pe-4 border-0"><span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2">Success</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function banUser(userId) {
    if (confirm('Are you sure you want to restrict this account? The user will no longer be able to access their dashboard.')) {
        fetch(`/super_admin/users/${userId}/ban`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                window.location.reload();
            }
        });
    }
}
</script>
@endsection
