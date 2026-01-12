@extends('layouts.app')

@section('content')
<style>
    :root {
        --p-indigo: #4F46E5;
        --p-indigo-light: #EEF2FF;
        --glass-bg: rgba(255, 255, 255, 0.95);
        --glass-border: rgba(0, 0, 0, 0.08);
        --card-shadow: 0 15px 30px rgba(0, 0, 0, 0.04);
        --premium-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
        --premium-gradient: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
    }

    [data-theme="dark"] {
        --glass-bg: #111827;
        --glass-border: rgba(255, 255, 255, 0.08);
        --text-main: #f8fafc;
        --text-muted: #9ca3af;
    }

    .dashboard-wrapper { 
        padding-top: 40px !important; 
        animation: fadeIn 0.8s ease-out;
    }
    
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

    /* Premium Modals */
    .modal-overlay {
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(15, 23, 42, 0.3); z-index: 11000;
        display: none; align-items: center; justify-content: center;
        backdrop-filter: blur(12px);
    }
    .modal-glass {
        background: var(--glass-bg); padding: 40px; border-radius: 35px;
        width: 520px; max-width: 90%;
        border: 1px solid var(--glass-border);
        box-shadow: var(--premium-shadow);
        animation: modalEntrance 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        position: relative;
    }
    @keyframes modalEntrance { from{opacity:0; transform:scale(0.9) translateY(20px);} to{opacity:1; transform:scale(1) translateY(0);} }

    .glass-input {
        width: 100%; padding: 14px 20px; margin-top: 10px;
        border-radius: 16px; border: 1px solid var(--glass-border);
        background: rgba(0,0,0,0.02); color: var(--text-main);
        font-size: 0.95rem; outline: none; transition: 0.3s; font-weight: 500;
    }
    [data-theme="dark"] .glass-input { background: rgba(255, 255, 255, 0.03); }
    .glass-input:focus { border-color: var(--p-indigo); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); }
    
    .btn-glass {
        padding: 14px 28px; border-radius: 18px; font-weight: 800; 
        border: none; cursor: pointer; transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        display: inline-flex; align-items: center; gap: 10px; font-size: 0.9rem;
    }
    .btn-glass:hover { transform: translateY(-3px) scale(1.02); }
    .btn-glass.primary { background: var(--p-indigo); color: #fff; box-shadow: 0 10px 20px rgba(79, 70, 229, 0.3); }
    .btn-glass.secondary { background: rgba(0,0,0,0.05); color: var(--text-main); }
    [data-theme="dark"] .btn-glass.secondary { background: rgba(255,255,255,0.05); }

    /* Advanced Grid & Cards */
    .employee-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 24px; }
    
    .employee-card {
        background: var(--glass-bg); border: 1px solid var(--glass-border);
        border-radius: 35px; padding: 35px; transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative; overflow: hidden; height: 100%;
        display: flex; flex-direction: column; box-shadow: var(--card-shadow);
        backdrop-filter: blur(20px);
    }
    .employee-card:hover { 
        transform: translateY(-12px); 
        box-shadow: var(--premium-shadow); 
        border-color: var(--p-indigo); 
    }
    
    .role-icon-box {
        width: 60px; height: 60px; border-radius: 20px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem; margin-bottom: 20px;
        background: var(--p-indigo-light); color: var(--p-indigo);
        transition: 0.3s;
    }
    .employee-card:hover .role-icon-box { transform: scale(1.1) rotate(5deg); background: var(--p-indigo); color: #fff; }

    .card-profile h4 { color: var(--text-main); margin-bottom: 5px; font-weight: 900; font-size: 1.25rem; letter-spacing: -0.5px; }
    
    .role-badge {
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
        background: var(--p-indigo); color: #fff; width: 36px; height: 36px; 
        border-radius: 12px; display: flex; align-items: center; justify-content: center;
        border: none; cursor: pointer; transition: 0.2s; box-shadow: 0 4px 10px rgba(79, 70, 229, 0.2);
    }
    .btn-action-trigger:hover { transform: scale(1.1) rotate(5deg); background: var(--accent); }

    /* Role Card Action Menu */
    .card-menu { position: absolute; top: 25px; right: 25px; z-index: 100; }
    
    .menu-dots {
        width: 38px; height: 38px; border-radius: 12px; border: 1px solid var(--glass-border);
        background: var(--glass-bg); color: var(--text-muted);
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .menu-dots:hover { transform: scale(1.1) rotate(90deg); background: var(--p-indigo); color: #fff; border-color: var(--p-indigo); }

    .dropdown-menu-custom {
        position: absolute; right: 0; top: 48px; width: 220px;
        background: var(--glass-bg); border: 1px solid var(--glass-border);
        border-radius: 20px; padding: 12px; display: none;
        backdrop-filter: blur(25px); box-shadow: var(--premium-shadow);
        animation: menuEntrance 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        z-index: 1000;
    }
    @keyframes menuEntrance { from { opacity: 0; transform: translateY(-10px) scale(0.95); } to { opacity: 1; transform: translateY(0) scale(1); } }
    .card-menu:hover .dropdown-menu-custom { display: block; }

    .dropdown-menu-custom button {
        width: 100%; padding: 10px 15px; border-radius: 12px; border: none;
        background: transparent; color: var(--text-main); font-size: 0.85rem; font-weight: 700;
        display: flex; align-items: center; gap: 12px; transition: all 0.2s;
        text-align: left; cursor: pointer; margin-bottom: 4px;
    }
    .dropdown-menu-custom button:last-child { margin-bottom: 0; }
    .dropdown-menu-custom button i { font-size: 1rem; opacity: 0.7; transition: 0.2s; }
    
    .dropdown-menu-custom button:hover { background: var(--p-indigo-light); color: var(--p-indigo); }
    [data-theme="dark"] .dropdown-menu-custom button:hover { background: rgba(79, 70, 229, 0.15); color: #818cf8; }
    .dropdown-menu-custom button:hover i { opacity: 1; transform: scale(1.1); }

    .dropdown-menu-custom button.status-revoke { color: #ef4444 !important; }
    .dropdown-menu-custom button.status-revoke:hover { background: rgba(239, 68, 68, 0.1) !important; color: #f87171 !important; }
    
    [data-theme="dark"] .dropdown-menu-custom { background: rgba(17, 24, 39, 0.95); }

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
                    <button onclick="window.location.href='/super_admin/users?role={{ $role['slug'] }}'"><i class="fas fa-users me-2"></i>View Entities</button>
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
                <button class="btn-action-trigger" onclick="managePermissions('{{ $role['slug'] }}', '{{ $role['name'] }}', {{ json_encode($role['permissions']) }})" title="Authorize Capabilities">
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
                        <option value="System">System</option>
                        <option value="Management">Management</option>
                        <option value="Operations">Operations</option>
                        <option value="Technical">Technical</option>
                        <option value="Support">Support</option>
                        <option value="Partner">Partner</option>
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
    let activePermSlug = null;

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

    async function handleRoleSubmit(e) {
        e.preventDefault();
        const slug = document.getElementById('edit_role_slug').value;
        const isEdit = !!slug;
        
        const formData = {
            name: document.getElementById('role_name').value,
            badge: document.getElementById('role_badge').value,
            color: document.getElementById('role_color').value,
            description: document.getElementById('role_desc').value,
            _token: '{{ csrf_token() }}'
        };

        const url = isEdit ? `/super_admin/roles/${slug}` : '/super_admin/roles';
        const method = isEdit ? 'PUT' : 'POST';

        try {
            const response = await fetch(url, {
                method: method,
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify(formData)
            });
            const data = await response.json();
            
            if (data.success) {
                showNotify(data.message, 'success');
                toggleModal('roleModal', false);
                setTimeout(() => window.location.reload(), 1000);
            } else {
                showNotify(data.message || 'Operation failed', 'error');
            }
        } catch (error) {
            showNotify('Network error occurred.', 'error');
        }
    }

    function confirmRevoke(name, slug) {
        activeRevokeSlug = slug;
        document.getElementById('revoke_target_name').textContent = name;
        toggleModal('revokeModal', true);
    }

    async function executeRevoke() {
        try {
            const response = await fetch(`/super_admin/roles/${activeRevokeSlug}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
            });
            const data = await response.json();
            if (data.success) {
                showNotify(data.message, 'success');
                toggleModal('revokeModal', false);
                setTimeout(() => window.location.reload(), 1000);
            }
        } catch (error) {
            showNotify('Failed to revoke role.', 'error');
        }
    }

    function managePermissions(slug, name, existingPerms) {
        activePermSlug = slug;
        document.getElementById('perm_role_name').textContent = name;
        
        // Reset checkboxes
        document.querySelectorAll('#permModal input[type="checkbox"]').forEach(cb => {
            cb.checked = existingPerms && existingPerms.includes(cb.value);
        });
        
        toggleModal('permModal', true);
    }

    async function savePermissions() {
        const selectedPerms = Array.from(document.querySelectorAll('#permModal input[name="perms[]"]:checked'))
                                   .map(cb => cb.value);
        
        try {
            const response = await fetch(`/super_admin/roles/${activePermSlug}/permissions`, {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json', 
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ permissions: selectedPerms })
            });
            const data = await response.json();
            if (data.success) {
                showNotify(data.message, 'success');
                toggleModal('permModal', false);
                setTimeout(() => window.location.reload(), 1000);
            }
        } catch (error) {
            showNotify('Failed to sync capabilities.', 'error');
        }
    }

    window.onclick = function(event) {
        if (event.target.classList.contains('modal-overlay')) {
            event.target.style.display = 'none';
        }
    }
</script>
@endsection


