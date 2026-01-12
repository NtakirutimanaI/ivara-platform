@extends('layouts.app')

@section('title', 'System Credentials Documentation')

@section('content')
<div class="unique-credentials-wrapper">
    <div class="container-fluid p-0">
        <!-- Header Section -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
            <div>
                <h1 class="cred-page-title mb-1">System Credentials</h1>
                <p class="cred-page-subtitle mb-0">Secure access points for development and testing environments.</p>
            </div>
            
            <div class="d-flex align-items-center gap-3 w-100 w-md-auto">
                <div class="cred-search-box">
                    <i class="fas fa-search cred-search-icon"></i>
                    <input type="text" id="credentialSearch" class="form-control cred-search-input" placeholder="Search roles..." onkeyup="filterCredentials()">
                </div>
                <div class="cred-dev-badge">
                    <i class="fas fa-code"></i>
                    <span class="d-none d-sm-inline ms-2">Dev Mode</span>
                </div>
            </div>
        </div>

        <!-- Credentials Grid -->
        <div class="row g-3" id="credentialsGrid">
            
            <!-- Core Admin Section -->
            <div class="col-12 cred-section-item mb-2" data-category="Core Administrators">
                <div class="cred-glass-card h-100">
                    <div class="cred-card-header border-primary">
                        <div class="d-flex align-items-center gap-2">
                            <div class="cred-icon-box bg-primary-soft">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <h5 class="fw-bold mb-0">Core Administrators</h5>
                        </div>
                        <!-- Add button removed -->
                    </div>
                    <div class="cred-card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-sm align-middle mb-0 cred-table">
                                <thead>
                                    <tr>
                                        <th class="ps-3">Role</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th>Scope</th>
                                        <th class="text-end pe-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="cred-table-body">
                                    @foreach([
                                        ['Super Admin', 'superadmin@ivara.com', 'password', 'Global Control'],
                                        ['Standard Admin', 'admin@ivara.com', 'password', 'System Management'],
                                        ['Technical Admin', 'technical_admin@ivara.com', 'password', 'Tech Category'],
                                        ['Manager', 'manager@ivara.com', 'password', 'Operations'],
                                        ['Supervisor', 'supervisor@ivara.com', 'password', 'Site Monitoring']
                                    ] as $user)
                                    <tr class="cred-row">
                                        <td class="fw-bold text-dark role-cell ps-3">{{ $user[0] }}</td>
                                        <td><code class="cred-copy-text email-cell" onclick="copyToClipboard('{{ $user[1] }}')">{{ $user[1] }}</code></td>
                                        <td><code class="text-muted password-cell">••••••••</code> <span class="d-none">{{ $user[2] }}</span></td>
                                        <td><span class="badge bg-light text-dark border scope-cell py-1">{{ $user[3] }}</span></td>
                                        <td class="text-end text-nowrap pe-3">
                                            <div class="d-inline-flex gap-1">
                                                <button class="cred-action-btn" onclick="copyToClipboard('{{ $user[1] }}')" title="Copy Email"><i class="far fa-copy"></i></button>
                                                <button class="cred-action-btn edit" onclick="editCredential(this)" title="Edit"><i class="far fa-edit"></i></button>
                                                <button class="cred-action-btn delete" onclick="deleteCredential(this)" title="Delete"><i class="far fa-trash-alt"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Categories Loop -->
            @php
                $categories = [
                    ['title' => 'Technical & Repair', 'icon' => 'fa-tools', 'color' => 'info', 'users' => [['Technician', 'technician@ivara.com'], ['Mechanic', 'mechanic@ivara.com'], ['Electrician', 'electrician@ivara.com'], ['Builder', 'builder@ivara.com'], ['Tailor', 'tailor@ivara.com'], ['Mediator', 'mediator@ivara.com'], ['Artisan', 'craftsperson@ivara.com'], ['Business', 'business@ivara.com'], ['Intern', 'intern@ivara.com']]],
                    ['title' => 'Driving & Transport', 'icon' => 'fa-car', 'color' => 'success', 'users' => [['Taxi Driver', 'taxidriver@ivara.com'], ['Moto Rider', 'motodriver@ivara.com'], ['Bus Driver', 'busdriver@ivara.com'], ['Tour Driver', 'tourdriver@ivara.com'], ['Delivery', 'deliverydriver@ivara.com'], ['Special', 'specialtransport@ivara.com']]],
                    ['title' => 'Creative & Wellness', 'icon' => 'fa-spa', 'color' => 'warning', 'users' => [['Sports Academy', 'sportsacademy@ivara.com'], ['Gym Trainer', 'gymtrainer@ivara.com'], ['Fitness Coach', 'fitnesscoach@ivara.com'], ['Yoga Trainer', 'yogatrainer@ivara.com'], ['Aerobics', 'aerobics@ivara.com'], ['Martial Arts', 'martialarts@ivara.com'], ['Pilates', 'pilates@ivara.com']]],
                    ['title' => 'Food, Events & Fashion', 'icon' => 'fa-utensils', 'color' => 'danger', 'users' => [['Customer', 'customer@food.com'], ['Food Vendor', 'vendor@food.com'], ['Event Organizer', 'events@ivara.com'], ['Fashion Vendor', 'fashion@ivara.com'], ['Delivery Agent', 'delivery@food.com'], ['Category Admin', 'foodadmin@ivara.com']]],
                    ['title' => 'Education & Knowledge', 'icon' => 'fa-graduation-cap', 'color' => 'info', 'users' => [['Student', 'student@edu.com'], ['Teacher', 'teacher@edu.com'], ['Tutor', 'tutor@edu.com'], ['Content Creator', 'content@edu.com'], ['Institution', 'institution@edu.com'], ['Edu Admin', 'eduadmin@ivara.com']]],
                    ['title' => 'Agriculture & Environment', 'icon' => 'fa-seedling', 'color' => 'success', 'users' => [['Farmer', 'farmer@agri.com'], ['Farm Manager', 'manager@agri.com'], ['Input Supplier', 'supplier@agri.com'], ['Extension Officer', 'officer@agri.com'], ['Produce Buyer', 'buyer@agri.com'], ['Sustainability', 'eco@agri.com'], ['Agri Admin', 'agriadmin@ivara.com']]],
                    ['title' => 'Media & Entertainment', 'icon' => 'fa-play-circle', 'color' => 'danger', 'users' => [['Consumer', 'consumer@media.com'], ['Creator', 'creator@media.com'], ['Producer', 'producer@media.com'], ['Advertiser', 'advertiser@media.com'], ['Distributor', 'distributor@media.com'], ['Media Admin', 'mediaadmin@ivara.com']]],
                    ['title' => 'Legal & Professional', 'icon' => 'fa-balance-scale', 'color' => 'primary', 'users' => [['Client', 'client@legal.com'], ['Legal Pro', 'pro@legal.com'], ['Consultant', 'consultant@legal.com'], ['Firm', 'firm@legal.com'], ['Regulator', 'regulator@legal.com'], ['Legal Admin', 'legaladmin@ivara.com']]]
                ];
            @endphp

            @foreach($categories as $category)
            <div class="col-12 cred-section-item mb-2" data-category="{{ $category['title'] }}">
                <div class="cred-glass-card h-100 cred-hover-effect">
                    <div class="cred-card-header border-{{ $category['color'] }}">
                        <div class="d-flex align-items-center gap-2">
                            <div class="cred-icon-box bg-{{ $category['color'] }}-soft">
                                <i class="fas {{ $category['icon'] }}"></i>
                            </div>
                            <h6 class="fw-bold mb-0">{{ $category['title'] }}</h6>
                        </div>
                        <!-- Add button removed -->
                    </div>
                    <div class="cred-card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-sm align-middle mb-0 cred-table">
                                <thead>
                                    <tr>
                                        <th class="ps-3">Role</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th>Scope</th>
                                        <th class="text-end pe-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="cred-table-body">
                                    @foreach($category['users'] as $user)
                                    <tr class="cred-row">
                                        <td class="fw-semibold text-dark role-cell ps-3">{{ $user[0] }}</td>
                                        <td><code class="cred-copy-text email-cell" onclick="copyToClipboard('{{ $user[1] }}')">{{ $user[1] }}</code></td>
                                        <td><code class="text-muted password-cell">••••••••</code> <span class="d-none">password</span></td>
                                        <td><span class="badge bg-light text-dark border scope-cell py-1">{{ explode(' ', $category['title'])[0] }} Access</span></td>
                                        <td class="text-end text-nowrap pe-3">
                                            <div class="d-inline-flex gap-1">
                                                <button class="cred-action-btn" onclick="copyToClipboard('{{ $user[1] }}')" title="Copy Email"><i class="far fa-copy"></i></button>
                                                <button class="cred-action-btn edit" onclick="editCredential(this)" title="Edit"><i class="far fa-edit"></i></button>
                                                <button class="cred-action-btn delete" onclick="deleteCredential(this)" title="Delete"><i class="far fa-trash-alt"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- System Notice -->
        <div class="cred-notice-alert mt-4">
            <div class="d-flex align-items-center gap-3">
                <i class="fas fa-shield-alt text-warning fs-4"></i>
                <div>
                    <h6 class="fw-bold mb-0">Security Notice</h6>
                    <small class="text-muted">These credentials are for development use only.</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="credentialModal" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content cred-glass-card border-0">
            <div class="modal-header border-0 pb-0">
                <h6 class="modal-title fw-bold" id="modalTitle">Edit Credential</h6>
                <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-3">
                <div class="mb-2">
                    <label class="form-label fw-bold x-small text-muted mb-1" style="font-size: 0.75rem;">Role Name</label>
                    <input type="text" class="form-control form-control-sm rounded-pill" id="roleInput">
                </div>
                <div class="mb-2">
                    <label class="form-label fw-bold x-small text-muted mb-1" style="font-size: 0.75rem;">Email Address</label>
                    <input type="email" class="form-control form-control-sm rounded-pill" id="emailInput">
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-sm btn-light rounded-pill" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-sm btn-primary rounded-pill px-3" onclick="saveCredential()">Save</button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Unique Namespace for Credentials Page */
    .unique-credentials-wrapper {
        font-family: 'Inter', sans-serif;
        padding-top: 3rem;
        padding-bottom: 2rem;
    }

    .cred-page-title {
        font-weight: 800;
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-size: 1.75rem;
    }

    .cred-page-subtitle {
        font-size: 0.95rem;
    }

    /* Grid & Cards */
    .cred-glass-card {
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s, box-shadow 0.2s;
        overflow: hidden;
    }

    .cred-hover-effect:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
    }

    .cred-card-header {
        padding: 12px 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: linear-gradient(to right, rgba(248, 250, 252, 0.5), transparent);
        border-bottom: 1px solid rgba(226, 232, 240, 0.6);
    }
    
    .cred-card-header.border-primary { border-left: 4px solid #6366f1; }
    .cred-card-header.border-info { border-left: 4px solid #0ea5e9; }
    .cred-card-header.border-success { border-left: 4px solid #10b981; }
    .cred-card-header.border-warning { border-left: 4px solid #f59e0b; }
    .cred-card-header.border-danger { border-left: 4px solid #ef4444; }

    .cred-card-body {
        padding: 0;
    }

    /* Icons */
    .cred-icon-box {
        width: 28px;
        height: 28px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
    }
    .bg-primary-soft { background: rgba(99, 102, 241, 0.1); color: #6366f1; }
    .bg-info-soft { background: rgba(14, 165, 233, 0.1); color: #0ea5e9; }
    .bg-success-soft { background: rgba(16, 185, 129, 0.1); color: #10b981; }
    .bg-warning-soft { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }
    .bg-danger-soft { background: rgba(239, 68, 68, 0.1); color: #ef4444; }

    /* Search & Badge */
    .cred-search-box {
        position: relative;
        max-width: 300px;
        width: 100%;
    }

    .cred-search-input {
        padding-left: 36px;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        font-size: 0.9rem;
        height: 38px;
    }

    .cred-search-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 0.8rem;
    }

    .cred-dev-badge {
        background: #f1f5f9;
        color: #64748b;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        border: 1px solid #e2e8f0;
    }

    /* Table & Actions */
    .cred-table th {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #94a3b8;
        background: rgba(248, 250, 252, 0.5);
        padding: 16px 24px; /* Increased Spacing */
    }

    .cred-table td {
        font-size: 0.85rem;
        padding: 16px 24px; /* Increased Spacing */
    }

    .cred-copy-text {
        font-family: 'JetBrains Mono', monospace;
        background: rgba(241, 245, 249, 0.8);
        color: #475569;
        padding: 2px 6px;
        border-radius: 4px;
        font-size: 0.8rem;
        cursor: pointer;
    }
    .cred-copy-text:hover {
        background: #e0e7ff;
        color: #4338ca;
    }

    .cred-action-btn {
        width: 24px;
        height: 24px;
        border-radius: 6px;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: transparent;
        color: #94a3b8;
        transition: all 0.2s;
        font-size: 0.8rem;
    }
    
    .d-inline-flex.gap-1 {
        display: inline-flex !important;
        flex-wrap: nowrap !important;
        white-space: nowrap !important;
    }
    
    .cred-action-btn:hover { background: #e0e7ff; color: #4338ca; }
    .cred-action-btn.edit:hover { background: #fef3c7; color: #d97706; }
    .cred-action-btn.delete:hover { background: #fee2e2; color: #dc2626; }

    .cred-btn-add {
        border: none;
        border-radius: 20px;
        font-size: 0.75rem;
        padding: 4px 12px;
        font-weight: 600;
        transition: 0.2s;
        display: flex;
        align-items: center;
    }
    .cred-btn-add:hover { opacity: 0.9; }

    .cred-notice-alert {
        background: rgba(255, 255, 255, 0.8);
        border: 1px solid rgba(255, 237, 213, 1);
        padding: 15px;
        border-radius: 12px;
        border-left: 4px solid #f59e0b;
    }
    
    /* Force Modal Centering - Standard Bootstrap Fix */
    .modal-dialog-centered {
        display: flex;
        align-items: center;
        min-height: calc(100% - 1rem); 
    }
    
    /* Ensure Inputs are Visible */
    #roleInput, #emailInput {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        color: #334155;
    }

    /* Dark Mode Support */
    [data-theme="dark"] .cred-glass-card { background: #1e293b; border-color: #334155; }
    [data-theme="dark"] .cred-card-header { border-bottom-color: #334155; }
    [data-theme="dark"] .cred-page-title { color: #f8fafc; }
    [data-theme="dark"] .cred-table th { background: #1e293b; color: #94a3b8; }
    [data-theme="dark"] .cred-table td { color: #cbd5e1; }
    [data-theme="dark"] .text-dark { color: #f1f5f9 !important; }
    [data-theme="dark"] .cred-copy-text { background: #0f172a; color: #94a3b8; }
    [data-theme="dark"] .cred-search-input { background: #1e293b; border-color: #334155; color: #fff; }
    [data-theme="dark"] .cred-dev-badge { background: #1e293b; border-color: #334155; color: #94a3b8; }
    [data-theme="dark"] .cred-notice-alert { background: #1e293b; border-color: #334155; }
    
    /* Dark Mode Inputs */
    [data-theme="dark"] #roleInput, 
    [data-theme="dark"] #emailInput {
        background-color: #0f172a; 
        border-color: #334155;
        color: #f1f5f9;
        caret-color: #fff;
    }
    
</style>

<script>

    function filterCredentials() {
        const query = document.getElementById('credentialSearch').value.toLowerCase();
        document.querySelectorAll('.cred-section-item').forEach(section => {
            const rows = section.querySelectorAll('.cred-row');
            let hasMatch = false;
            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                const match = text.includes(query);
                row.style.display = match ? '' : 'none';
                if(match) hasMatch = true;
            });
            section.style.display = hasMatch ? '' : 'none';
        });
    }

    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            if(window.showNotify) showNotify('Copied: ' + text, 'success');
        });
    }

    // Global State for Edit
    let currentEditingRow = null;

    function editCredential(btn) {
        const row = btn.closest('tr');
        if (!row) return;
        currentEditingRow = row;
        
        const role = row.querySelector('.role-cell').innerText.trim();
        const email = row.querySelector('.email-cell').innerText.trim();
        
        document.getElementById('roleInput').value = role;
        document.getElementById('emailInput').value = email;
        document.getElementById('modalTitle').innerText = 'Edit Credential';
        
        const modalEl = document.getElementById('credentialModal');
        if(modalEl && window.bootstrap) {
            const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
            modal.show();
        }
    }

    function saveCredential() {
        const role = document.getElementById('roleInput').value;
        const email = document.getElementById('emailInput').value;

        if(!role || !email) {
            if(window.showNotify) showNotify('Please fill in all fields', 'error');
            return;
        }

        if(currentEditingRow) {
            // Update Existing Row
            const roleCell = currentEditingRow.querySelector('.role-cell');
            const emailCell = currentEditingRow.querySelector('.email-cell');
            
            if(roleCell) roleCell.innerText = role;
            if(emailCell) {
                emailCell.innerText = email;
                // Update click handler locally if needed
                emailCell.setAttribute('onclick', `copyToClipboard('${email}')`);
            }
            
            // Update Actions Copy Button
            const copyBtn = currentEditingRow.querySelector('.cred-action-btn'); 
            if(copyBtn) copyBtn.setAttribute('onclick', `copyToClipboard('${email}')`);

            if(window.showNotify) showNotify('Credential updated!', 'success');
        }
        
        const modalEl = document.getElementById('credentialModal');
        if(modalEl && window.bootstrap) {
            bootstrap.Modal.getInstance(modalEl).hide();
        }
    }

    function deleteCredential(btn) {
        if(confirm('Are you sure you want to delete this credential?')) {
            const row = btn.closest('tr');
            row.style.transition = 'all 0.3s';
            row.style.opacity = '0';
            setTimeout(() => row.remove(), 300);
            if(window.showNotify) showNotify('Credential deleted', 'success');
        }
    }
</script>
@endsection
