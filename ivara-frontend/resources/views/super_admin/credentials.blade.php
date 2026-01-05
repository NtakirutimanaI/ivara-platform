@extends('layouts.app')

@section('title', 'System Credentials Documentation')

@section('content')
<div class="credentials-container p-4">
    <div class="glass-card p-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="display-5 fw-bold text-primary">System Credentials</h1>
                <p class="text-muted lead">Comprehensive list of all pre-populated test accounts and roles.</p>
            </div>
            <div class="badge bg-soft-primary text-primary p-3 rounded-pill h4 mb-0">
                <i class="fas fa-shield-alt me-2"></i> Super Admin Access
            </div>
        </div>

        <div class="row g-4">
            <!-- Administrators -->
            <div class="col-md-12">
                <div class="role-section border-start border-4 border-primary ps-4 mb-5">
                    <h3 class="fw-bold mb-4"><i class="fas fa-user-shield me-2"></i> Core Administrators</h3>
                    <div class="table-responsive">
                        <table class="table table-hover glass-table">
                            <thead>
                                <tr>
                                    <th>Role Name</th>
                                    <th>Email Address</th>
                                    <th>Password</th>
                                    <th>Scope</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td>Super Admin</td><td><code>superadmin@ivara.com</code></td><td><code>password</code></td><td>Global Control</td></tr>
                                <tr><td>Standard Admin</td><td><code>admin@ivara.com</code></td><td><code>password</code></td><td>System Management</td></tr>
                                <tr><td>Technical Admin</td><td><code>technical_admin@ivara.com</code></td><td><code>password</code></td><td>Tech Category</td></tr>
                                <tr><td>Manager</td><td><code>manager@ivara.com</code></td><td><code>password</code></td><td>Operations</td></tr>
                                <tr><td>Supervisor</td><td><code>supervisor@ivara.com</code></td><td><code>password</code></td><td>Site Monitoring</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Technical & Repair -->
            <div class="col-md-6">
                <div class="role-section border-start border-4 border-info ps-4">
                    <h3 class="fw-bold mb-4 text-info"><i class="fas fa-tools me-2"></i> Technical & Repair</h3>
                    <div class="table-responsive">
                        <table class="table table-sm glass-table">
                            <thead>
                                <tr><th>Role</th><th>Email</th></tr>
                            </thead>
                            <tbody>
                                <tr><td>Technician</td><td><code>technician@ivara.com</code></td></tr>
                                <tr><td>Mechanic</td><td><code>mechanic@ivara.com</code></td></tr>
                                <tr><td>Electrician</td><td><code>electrician@ivara.com</code></td></tr>
                                <tr><td>Builder</td><td><code>builder@ivara.com</code></td></tr>
                                <tr><td>Tailor</td><td><code>tailor@ivara.com</code></td></tr>
                                <tr><td>Mediator</td><td><code>mediator@ivara.com</code></td></tr>
                                <tr><td>Artisan</td><td><code>craftsperson@ivara.com</code></td></tr>
                                <tr><td>Business</td><td><code>business@ivara.com</code></td></tr>
                                <tr><td>Intern</td><td><code>intern@ivara.com</code></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Driving & Transport -->
            <div class="col-md-4">
                <div class="role-section border-start border-4 border-success ps-4">
                    <h3 class="fw-bold mb-4 text-success"><i class="fas fa-car me-2"></i> Driving & Transport</h3>
                    <div class="table-responsive">
                        <table class="table table-sm glass-table">
                            <thead><tr><th>Role</th><th>Email</th></tr></thead>
                            <tbody>
                                <tr><td>Taxi Driver</td><td><code>taxidriver@ivara.com</code></td></tr>
                                <tr><td>Moto Rider</td><td><code>motodriver@ivara.com</code></td></tr>
                                <tr><td>Bus Driver</td><td><code>busdriver@ivara.com</code></td></tr>
                                <tr><td>Tour Driver</td><td><code>tourdriver@ivara.com</code></td></tr>
                                <tr><td>Delivery</td><td><code>deliverydriver@ivara.com</code></td></tr>
                                <tr><td>Special</td><td><code>specialtransport@ivara.com</code></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Creative & Wellness -->
            <div class="col-md-4">
                <div class="role-section border-start border-4 border-warning ps-4 mb-5">
                    <h3 class="fw-bold mb-4 text-warning"><i class="fas fa-spa me-2"></i> Creative & Wellness</h3>
                    <div class="table-responsive">
                        <table class="table table-sm glass-table">
                            <thead><tr><th>Role</th><th>Email</th></tr></thead>
                            <tbody>
                                <tr><td>Sports Academy</td><td><code>sportsacademy@ivara.com</code></td></tr>
                                <tr><td>Gym Trainer</td><td><code>gymtrainer@ivara.com</code></td></tr>
                                <tr><td>Fitness Coach</td><td><code>fitnesscoach@ivara.com</code></td></tr>
                                <tr><td>Yoga Trainer</td><td><code>yogatrainer@ivara.com</code></td></tr>
                                <tr><td>Aerobics</td><td><code>aerobics@ivara.com</code></td></tr>
                                <tr><td>Martial Arts</td><td><code>martialarts@ivara.com</code></td></tr>
                                <tr><td>Pilates</td><td><code>pilates@ivara.com</code></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Food, Events & Fashion -->
            <div class="col-md-4">
                <div class="role-section border-start border-4 border-danger ps-4 mb-5">
                    <h3 class="fw-bold mb-4 text-danger"><i class="fas fa-utensils me-2"></i> Food, Events & Fashion</h3>
                    <div class="table-responsive">
                        <table class="table table-sm glass-table">
                            <thead><tr><th>Role</th><th>Email</th></tr></thead>
                            <tbody>
                                <tr><td>Customer</td><td><code>customer@food.com</code></td></tr>
                                <tr><td>Food Vendor</td><td><code>vendor@food.com</code></td></tr>
                                <tr><td>Event Organizer</td><td><code>events@ivara.com</code></td></tr>
                                <tr><td>Fashion Vendor</td><td><code>fashion@ivara.com</code></td></tr>
                                <tr><td>Delivery Agent</td><td><code>delivery@food.com</code></td></tr>
                                <tr><td>Category Admin</td><td><code>foodadmin@ivara.com</code></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Education & Knowledge -->
            <div class="col-md-4">
                <div class="role-section border-start border-4 border-info ps-4 mb-5">
                    <h3 class="fw-bold mb-4 text-info"><i class="fas fa-graduation-cap me-2"></i> Education & Knowledge</h3>
                    <div class="table-responsive">
                        <table class="table table-sm glass-table">
                            <thead><tr><th>Role</th><th>Email</th></tr></thead>
                            <tbody>
                                <tr><td>Student</td><td><code>student@edu.com</code></td></tr>
                                <tr><td>Teacher</td><td><code>teacher@edu.com</code></td></tr>
                                <tr><td>Tutor</td><td><code>tutor@edu.com</code></td></tr>
                                <tr><td>Content Creator</td><td><code>content@edu.com</code></td></tr>
                                <tr><td>Institution</td><td><code>institution@edu.com</code></td></tr>
                                <tr><td>Edu Admin</td><td><code>eduadmin@ivara.com</code></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Agriculture & Environment -->
            <div class="col-md-6">
                <div class="role-section border-start border-4 border-success ps-4 mb-5">
                    <h3 class="fw-bold mb-4 text-success"><i class="fas fa-seedling me-2"></i> Agriculture & Environment</h3>
                    <div class="table-responsive">
                        <table class="table table-sm glass-table">
                            <thead><tr><th>Role</th><th>Email</th></tr></thead>
                            <tbody>
                                <tr><td>Farmer</td><td><code>farmer@agri.com</code></td></tr>
                                <tr><td>Farm Manager</td><td><code>manager@agri.com</code></td></tr>
                                <tr><td>Input Supplier</td><td><code>supplier@agri.com</code></td></tr>
                                <tr><td>Extension Officer</td><td><code>officer@agri.com</code></td></tr>
                                <tr><td>Produce Buyer</td><td><code>buyer@agri.com</code></td></tr>
                                <tr><td>Sustainability</td><td><code>eco@agri.com</code></td></tr>
                                <tr><td>Agri Admin</td><td><code>agriadmin@ivara.com</code></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Media & Entertainment -->
            <div class="col-md-6">
                <div class="role-section border-start border-4 border-danger ps-4 mb-5">
                    <h3 class="fw-bold mb-4 text-danger"><i class="fas fa-play-circle me-2"></i> Media & Entertainment</h3>
                    <div class="table-responsive">
                        <table class="table table-sm glass-table">
                            <thead><tr><th>Role</th><th>Email</th></tr></thead>
                            <tbody>
                                <tr><td>Consumer</td><td><code>consumer@media.com</code></td></tr>
                                <tr><td>Creator</td><td><code>creator@media.com</code></td></tr>
                                <tr><td>Producer</td><td><code>producer@media.com</code></td></tr>
                                <tr><td>Advertiser</td><td><code>advertiser@media.com</code></td></tr>
                                <tr><td>Distributor</td><td><code>distributor@media.com</code></td></tr>
                                <tr><td>Media Admin</td><td><code>mediaadmin@ivara.com</code></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Legal & Professional -->
            <div class="col-md-6">
                <div class="role-section border-start border-4 border-primary ps-4 mb-5">
                    <h3 class="fw-bold mb-4 text-primary"><i class="fas fa-balance-scale me-2"></i> Legal & Professional</h3>
                    <div class="table-responsive">
                        <table class="table table-sm glass-table">
                            <thead><tr><th>Role</th><th>Email</th></tr></thead>
                            <tbody>
                                <tr><td>Client</td><td><code>client@legal.com</code></td></tr>
                                <tr><td>Legal Pro</td><td><code>pro@legal.com</code></td></tr>
                                <tr><td>Consultant</td><td><code>consultant@legal.com</code></td></tr>
                                <tr><td>Firm</td><td><code>firm@legal.com</code></td></tr>
                                <tr><td>Regulator</td><td><code>regulator@legal.com</code></td></tr>
                                <tr><td>Legal Admin</td><td><code>legaladmin@ivara.com</code></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="alert alert-soft-warning mt-5 rounded-4 border-warning d-flex align-items-center">
            <i class="fas fa-info-circle fs-3 me-3"></i>
            <div>
                <strong>Security Note:</strong> These accounts are for development and testing purposes only. Credentials should be rotated before deployment to production.
            </div>
        </div>
    </div>
</div>

<style>
    .glass-card { background: rgba(255, 255, 255, 0.9); border-radius: 30px; border: 1px solid rgba(0,0,0,0.05); box-shadow: 0 20px 40px rgba(0,0,0,0.05); }
    .glass-table { border-collapse: separate; border-spacing: 0 8px; }
    .glass-table thead th { border-bottom: none; color: #64748b; font-weight: 600; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 1px; }
    .glass-table tbody tr { background: #f8fafc; transition: transform 0.2s; }
    .glass-table tbody tr:hover { transform: scale(1.01); background: #f1f5f9; }
    .glass-table td { padding: 15px; border: none; vertical-align: middle; }
    .glass-table td:first-child { border-radius: 12px 0 0 12px; font-weight: 700; color: #1e293b; }
    .glass-table td:last-child { border-radius: 0 12px 12px 0; }
    code { background: rgba(59, 130, 246, 0.1); color: #2563eb; padding: 4px 8px; border-radius: 6px; font-weight: 600; font-size: 0.9rem; }
    .bg-soft-primary { background: rgba(59, 130, 246, 0.1); }
    .bg-soft-warning { background: rgba(245, 158, 11, 0.05); color: #d97706; }
</style>
@endsection
