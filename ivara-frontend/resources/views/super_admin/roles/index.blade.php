@extends('layouts.app')

@section('content')
<style>
    /* Scoped Theme Variables */
    :root {
        --primary: #4F46E5;
        --secondary: #64748B; 
        --accent: #924FC2;
        --bg-glass: rgba(255, 255, 255, 0.95);
        --border-glass: rgba(0, 0, 0, 0.08);
        --text-main: #1e293b;
        --text-muted: #64748b;
    }

    [data-theme="dark"] {
        --bg-glass: #111827;
        --border-glass: rgba(255, 255, 255, 0.1);
        --text-main: #f8fafc;
        --text-muted: #9ca3af;
    }

    .dashboard-wrapper { padding-top: 40px !important; }

    /* Modal Styles */
    .modal-overlay {
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0,0,0,0.6); z-index: 11000;
        display: none; align-items: center; justify-content: center;
        backdrop-filter: blur(8px);
    }
    .modal-glass {
        background: var(--bg-glass); padding: 32px; border-radius: 24px;
        width: 500px; max-width: 90%;
        border: 1px solid var(--border-glass);
        box-shadow: 0 25px 50px -12px rgba(0,0,0,0.4);
        animation: zoomIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        position: relative;
    }
    .modal-header-custom {
        display: flex; justify-content: space-between; align-items: center;
        margin-bottom: 25px;
    }
    .modal-header-custom h3 { margin: 0; font-size: 20px; font-weight: 700; color: var(--text-main); }
    
    .glass-input {
        width: 100%; padding: 12px; margin-top: 8px;
        border-radius: 12px; border: 1px solid var(--border-glass);
        background: rgba(255, 255, 255, 0.5); color: var(--text-main);
        font-size: 14px; outline: none; transition: 0.3s;
    }
    [data-theme="dark"] .glass-input { background: rgba(0,0,0,0.2); }
    .glass-input:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1); }
    
    @keyframes zoomIn { from{opacity:0; transform:scale(0.95);} to{opacity:1; transform:scale(1);} }

    /* Custom buttons */
    .btn-glass {
        padding: 12px 24px; border-radius: 14px; font-weight: 700; 
        border: none; cursor: pointer; transition: all 0.2s;
        display: inline-flex; align-items: center; gap: 8px;
        font-size: 14px;
    }
    .btn-glass:hover { transform: translateY(-2px); filter: brightness(1.1); }
    .btn-glass.primary { background: var(--primary); color: #fff; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3); }
    .btn-glass.secondary { background: var(--secondary); color: #fff; }

    .employee-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; }
    
    .card-menu { position: absolute; top: 15px; right: 15px; z-index: 5; }
    .menu-dots { background: none; border: none; font-size: 16px; color: var(--text-muted); cursor: pointer; padding: 5px; }
    .dropdown-menu-custom {
        position: absolute; right: 0; top: 30px; background: var(--bg-glass); 
        border-radius: 16px; width: 160px; display: none; 
        border: 1px solid var(--border-glass);
        box-shadow: 0 10px 25px -3px rgba(0,0,0,0.2); z-index: 100;
        overflow: hidden;
        backdrop-filter: blur(20px);
    }
    .card-menu:hover .dropdown-menu-custom { display: block; }
    .dropdown-menu-custom button, .dropdown-menu-custom a {
        display: block; width: 100%; padding: 12px 15px; text-align: left; background: none; 
        border: none; font-size: 13px; color: var(--text-main); text-decoration: none; cursor: pointer;
        transition: 0.2s; border-bottom: 1px solid var(--border-glass);
    }
    .dropdown-menu-custom button:last-child { border-bottom: none; }
    .dropdown-menu-custom button:hover, .dropdown-menu-custom a:hover { background: rgba(79, 70, 229, 0.1); color: var(--primary); }

    /* Card Stylings */
    .employee-card {
        background: var(--bg-glass); border: 1px solid var(--border-glass);
        border-radius: 28px; padding: 25px; transition: all 0.3s ease;
        position: relative; overflow: hidden; height: 100%;
        display: flex; flex-direction: column;
    }
    .employee-card:hover { transform: translateY(-8px); box-shadow: 0 20px 40px -10px rgba(0,0,0,0.1); border-color: var(--primary); }
    
    .card-profile { margin-bottom: 15px; }
    .card-profile h4 { color: var(--text-main); margin-bottom: 5px; font-weight: 800; }
    .role-badge {
        display: inline-block; font-size: 0.65rem; color: #4F46E5; font-weight: 800; background: #EEF2FF; 
        padding: 4px 10px; border-radius: 50px; text-transform: uppercase; letter-spacing: 1px;
    }
    [data-theme="dark"] .role-badge { background: rgba(79, 70, 229, 0.2); color: #818cf8; border: 1px solid rgba(79, 70, 229, 0.3); }

    .card-details { flex-grow: 1; }
    .card-details .description { color: var(--text-muted); font-size: 0.85rem; line-height: 1.5; margin-bottom: 20px; }
    
    .permission-chips { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 20px; }
    .perm-chip { 
        font-size: 11px; font-weight: 700; padding: 5px 10px; 
        background: rgba(0,0,0,0.04); border-radius: 8px; color: var(--text-muted);
        border: 1px solid var(--border-glass); transition: 0.2s;
    }
    [data-theme="dark"] .perm-chip { background: rgba(255,255,255,0.04); }
    .perm-chip:hover { border-color: var(--primary); color: var(--primary); }

    .card-footer {
        margin-top: auto; padding-top: 20px; border-top: 1px solid var(--border-glass);
        display: flex; align-items: center; justify-content: space-between;
    }
    .population { display: flex; align-items: center; gap: 8px; color: var(--text-muted); font-size: 0.8rem; font-weight: 600; }
    .population i { font-size: 14px; opacity: 0.7; }

    .btn-action-trigger {
        background: var(--primary); color: #fff; width: 36px; height: 36px; 
        border-radius: 12px; display: flex; align-items: center; justify-content: center;
        border: none; cursor: pointer; transition: 0.2s; box-shadow: 0 4px 10px rgba(79, 70, 229, 0.2);
    }
    .btn-action-trigger:hover { transform: scale(1.1) rotate(5deg); background: var(--accent); }

    /* Forms */
    .form-group { margin-bottom: 18px; }
    .form-group label { display: block; font-size: 12px; font-weight: 800; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; }

    .status-revoke { color: #ef4444 !important; }
    .status-revoke:hover { background: rgba(239, 68, 68, 0.1) !important; }
</style>

<div class="dashboard-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="fw-800" style="color: var(--text-main); font-size: 2.2rem; margin: 0;">Access Management</h1>
            <p style="color: var(--text-muted); font-weight: 500;">Define and regulate platform-wide authorization boundaries.</p>
        </div>
        <button class="btn-glass primary" onclick="toggleModal('roleModal', true)">
            <i class="fas fa-plus-shield"></i>Provision Role
        </button>
    </div>

    <div class="employee-grid">
        @foreach($roles as $role)
        <div class="employee-card">
            <div class="card-menu">
                <button class="menu-dots"><i class="fas fa-ellipsis-v"></i></button>
                <div class="dropdown-menu-custom">
                    <button onclick="editRole({{ json_encode($role) }})"><i class="fas fa-edit me-2"></i>Modify Mandate</button>
                    <button><i class="fas fa-users me-2"></i>View Entities</button>
                    @if($role['badge'] !== 'System')
                    <button class="status-revoke" onclick="confirmRevoke('{{ $role['name'] }}', '{{ $role['slug'] }}')">
                        <i class="fas fa-trash-alt me-2"></i>Revoke Role
                    </button>
                    @endif
                </div>
            </div>

            <div class="card-profile">
                <div class="role-badge" style="color: {{ $role['color'] }}; background: {{ $role['color'] }}15;">
                    {{ $role['badge'] }}
                </div>
                <h4 class="mt-2">{{ $role['name'] }}</h4>
            </div>

            <div class="card-details">
                <p class="description">{{ $role['description'] }}</p>
                <div class="permission-chips">
                    @foreach(array_slice($role['permissions'], 0, 3) as $p)
                    <span class="perm-chip">{{ str_replace('_', ' ', $p) }}</span>
                    @endforeach
                    @if(count($role['permissions']) > 3)
                    <span class="perm-chip">+{{ count($role['permissions']) - 3 }}</span>
                    @endif
                </div>
            </div>

            <div class="card-footer">
                <div class="population">
                    <i class="fas fa-fingerprint"></i>
                    <span>{{ number_format($role['users_count']) }} Entities</span>
                </div>
                <button class="btn-action-trigger" onclick="managePermissions('{{ $role['slug'] }}', '{{ $role['name'] }}')" title="Authorize Capabilities">
                    <i class="fas fa-lock-open"></i>
                </button>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Elite Custom Modals -->

<!-- 1. Provision/Edit Modal -->
<div id="roleModal" class="modal-overlay">
    <div class="modal-glass">
        <div class="modal-header-custom">
            <h3 id="roleModalTitle">Provision New Role</h3>
            <button class="btn-close-custom" onclick="toggleModal('roleModal', false)" style="background:none; border:none; color:var(--text-muted); cursor:pointer;"><i class="fas fa-times"></i></button>
        </div>
        <form id="roleForm" onsubmit="handleRoleSubmit(event)">
            <input type="hidden" id="edit_role_slug">
            <div class="form-group">
                <label>Role Identity</label>
                <input type="text" id="role_name" class="glass-input" placeholder="e.g. Regional Auditor" required>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label>Operational Scope</label>
                    <select id="role_badge" class="glass-input">
                        <option value="Management">Management</option>
                        <option value="Operations">Operations</option>
                        <option value="Technical">Technical</option>
                        <option value="Support">Support</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Visual Token Color</label>
                    <input type="color" id="role_color" class="glass-input" style="height: 48px; padding: 5px;" value="#4F46E5">
                </div>
            </div>
            <div class="form-group">
                <label>Access Mandate (Description)</label>
                <textarea id="role_desc" class="glass-input" rows="3" placeholder="Define boundaries..." required></textarea>
            </div>
            <div style="display: flex; gap: 12px; margin-top: 30px;">
                <button type="button" class="btn-glass secondary" style="flex: 1;" onclick="toggleModal('roleModal', false)">Discard</button>
                <button type="submit" id="roleSubmitBtn" class="btn-glass primary" style="flex: 1;">Provision</button>
            </div>
        </form>
    </div>
</div>

<!-- 2. Confirmation Revoke Modal -->
<div id="revokeModal" class="modal-overlay">
    <div class="modal-glass" style="width: 400px; text-align: center;">
        <div style="color: #ef4444; font-size: 3rem; margin-bottom: 20px;">
            <i class="fas fa-exclamation-circle"></i>
        </div>
        <h3 style="color: var(--text-main); margin-bottom: 15px;">Confirm Revocation</h3>
        <p style="color: var(--text-muted); line-height: 1.5; margin-bottom: 30px;">
            Are you sure you want to revoke the <strong id="revoke_target_name" style="color: var(--text-main);"></strong> role? This is a critical administrative action.
        </p>
        <div style="display: flex; gap: 12px;">
            <button class="btn-glass secondary" style="flex: 1;" onclick="toggleModal('revokeModal', false)">Cancel</button>
            <button class="btn-glass primary" style="flex: 1; background: #ef4444;" onclick="executeRevoke()">Revoke</button>
        </div>
    </div>
</div>

<!-- 3. Capability Matrix Modal -->
<div id="permModal" class="modal-overlay">
    <div class="modal-glass" style="width: 650px;">
        <div class="modal-header-custom">
            <h3>Capability Matrix: <span id="perm_role_name" style="color: var(--primary);"></span></h3>
            <button onclick="toggleModal('permModal', false)" style="background:none; border:none; color:var(--text-muted); cursor:pointer;"><i class="fas fa-times"></i></button>
        </div>
        <div style="max-height: 400px; overflow-y: auto; padding-right: 10px;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                @php 
                    $allPerms = ['full_access', 'manage_users', 'view_analytics', 'moderate_content', 'assign_tasks', 'approve_applications', 'verify_completion', 'field_checks', 'update_status', 'manage_services', 'receive_payouts', 'create_orders', 'chat_providers'];
                @endphp
                @foreach($allPerms as $idx => $p)
                <label style="display: flex; align-items: center; gap: 10px; background: rgba(0,0,0,0.03); padding: 12px; border-radius: 12px; cursor: pointer; border: 1px solid var(--border-glass);">
                    <input type="checkbox" name="perms[]" value="{{ $p }}" style="width: 18px; height: 18px; accent-color: var(--primary);">
                    <span style="font-size: 13px; font-weight: 600; color: var(--text-main);">{{ ucwords(str_replace('_', ' ', $p)) }}</span>
                </label>
                @endforeach
            </div>
        </div>
        <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 30px; padding-top: 20px; border-top: 1px solid var(--border-glass);">
            <button class="btn-glass secondary" onclick="toggleModal('permModal', false)">Cancel</button>
            <button class="btn-glass primary" onclick="savePermissions()">Sync Capabilities</button>
        </div>
    </div>
</div>

<script>
    let activeRevokeSlug = null;

    function toggleModal(id, show) {
        const modal = document.getElementById(id);
        modal.style.display = show ? 'flex' : 'none';
        if(show && id === 'roleModal' && !document.getElementById('edit_role_slug').value) {
            document.getElementById('roleForm').reset();
            document.getElementById('roleModalTitle').textContent = 'Provision New Role';
            document.getElementById('roleSubmitBtn').textContent = 'Provision';
        }
    }

    function editRole(role) {
        document.getElementById('edit_role_slug').value = role.slug;
        document.getElementById('role_name').value = role.name;
        document.getElementById('role_badge').value = role.badge;
        document.getElementById('role_color').value = role.color;
        document.getElementById('role_desc').value = role.description;
        
        document.getElementById('roleModalTitle').textContent = 'Modify Mandate: ' + role.name;
        document.getElementById('roleSubmitBtn').textContent = 'Update Mandate';
        toggleModal('roleModal', true);
    }

    function handleRoleSubmit(e) {
        e.preventDefault();
        const isEdit = !!document.getElementById('edit_role_slug').value;
        showToast(isEdit ? 'Role mandate updated successfully.' : 'New role provisioned successfully.', 'success');
        toggleModal('roleModal', false);
        setTimeout(() => window.location.reload(), 1000);
    }

    function confirmRevoke(name, slug) {
        activeRevokeSlug = slug;
        document.getElementById('revoke_target_name').textContent = name;
        toggleModal('revokeModal', true);
    }

    function executeRevoke() {
        showToast('Revocation process initiated for role enclave.', 'error');
        toggleModal('revokeModal', false);
        setTimeout(() => window.location.reload(), 1500);
    }

    function managePermissions(slug, name) {
        document.getElementById('perm_role_name').textContent = name;
        // Reset checkboxes
        document.querySelectorAll('#permModal input[type="checkbox"]').forEach(cb => cb.checked = false);
        // Simulate random existing perms
        const cbs = document.querySelectorAll('#permModal input[type="checkbox"]');
        [0, 1, 4, 8].forEach(idx => { if(cbs[idx]) cbs[idx].checked = true; });
        
        toggleModal('permModal', true);
    }

    function savePermissions() {
        showToast('Capability matrix synchronized successfully.', 'success');
        toggleModal('permModal', false);
    }

    function showToast(text, type) {
        if (typeof Toastify !== 'undefined') {
            Toastify({
                text: text,
                duration: 3000,
                gravity: "top",
                position: "right",
                style: { 
                    background: type === 'success' ? 'linear-gradient(to right, #4F46E5, #924FC2)' : '#ef4444',
                    borderRadius: '12px',
                    fontWeight: '600'
                }
            }).showToast();
        } else {
            alert(text);
        }
    }

    // Close modal on background click
    window.onclick = function(event) {
        if (event.target.classList.contains('modal-overlay')) {
            event.target.style.display = 'none';
        }
    }
</script>
@endsection


