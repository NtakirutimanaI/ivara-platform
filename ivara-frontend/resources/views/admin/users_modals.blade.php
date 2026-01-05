{{-- View User Modal --}}
<div id="viewUserModal" class="modal-wrapper">
    <div class="glass-modal small">
        <div class="modal-header-premium">
            <h3><i class="far fa-eye"></i> User Profile Details</h3>
            <button onclick="closeModal('viewUserModal')" class="btn-close">&times;</button>
        </div>
        <div class="premium-form">
            <div class="view-item">
                <label>Full Name</label>
                <div id="view_name" class="view-value"></div>
            </div>
            <div class="view-item">
                <label>Username</label>
                <div id="view_username" class="view-value"></div>
            </div>
            <div class="view-item">
                <label>Email Address</label>
                <div id="view_email" class="view-value"></div>
            </div>
            <div class="view-item">
                <label>Phone Number</label>
                <div id="view_phone" class="view-value"></div>
            </div>
            <div class="view-item">
                <label>Member Since</label>
                <div id="view_joined" class="view-value"></div>
            </div>
        </div>
    </div>
</div>

{{-- Add User Modal --}}
<div id="addUserModal" class="modal-wrapper">
    <div class="glass-modal">
        <div class="modal-header-premium">
            <h3><i class="fas fa-user-plus"></i> Create New Account</h3>
            <button onclick="closeModal('addUserModal')" class="btn-close">&times;</button>
        </div>
        <form action="{{ route('admin.users.store') }}" method="POST" class="premium-form">
            @csrf
            <div class="form-grid">
                <div class="field">
                    <label>Full Name</label>
                    <input type="text" name="name" placeholder="John Doe" required>
                </div>
                <div class="field">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="johndoe" required>
                </div>
                <div class="field">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="john@example.com" required>
                </div>
                <div class="field">
                    <label>Phone Number</label>
                    <input type="text" name="phone" placeholder="+250 ...">
                </div>
                <div class="field">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
                <div class="field">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" required>
                </div>
                <div class="field full">
                    <label>Assign Roles</label>
                    <div class="role-selector">
                        @foreach($roles as $role)
                        <label class="role-option">
                            <input type="checkbox" name="roles[]" value="{{ $role->name }}">
                            <span>{{ $role->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="form-footer">
                <button type="button" onclick="closeModal('addUserModal')" class="btn-cancel">Discard</button>
                <button type="submit" class="btn-save">Create User Account</button>
            </div>
        </form>
    </div>
</div>

{{-- Reset Password Modal --}}
<div id="resetPasswordModal" class="modal-wrapper">
    <div class="glass-modal small">
        <div class="modal-header-premium">
            <h3><i class="fas fa-key"></i> Reset Password</h3>
            <button onclick="closeModal('resetPasswordModal')" class="btn-close">&times;</button>
        </div>
        <form id="resetPasswordForm" method="POST" class="premium-form">
            @csrf
            <div class="field">
                <label>New Password</label>
                <input type="password" name="password" required>
            </div>
            <div class="field">
                <label>Confirm New Password</label>
                <input type="password" name="password_confirmation" required>
            </div>
            <div class="form-footer">
                <button type="submit" class="btn-save full">Update Password</button>
            </div>
        </form>
    </div>
</div>

{{-- Edit User Modal (Basic logic link) --}}
<div id="editUserModal" class="modal-wrapper">
    <div class="glass-modal">
        <div class="modal-header-premium">
            <h3><i class="fas fa-user-edit"></i> Edit User Profile</h3>
            <button onclick="closeModal('editUserModal')" class="btn-close">&times;</button>
        </div>
        <form id="editUserForm" method="POST" class="premium-form">
            @csrf @method('PUT')
            <div class="form-grid">
                <div class="field">
                    <label>Full Name</label>
                    <input type="text" id="edit_name" name="name" required>
                </div>
                <div class="field">
                    <label>Username</label>
                    <input type="text" id="edit_username" name="username" required>
                </div>
                <div class="field">
                    <label>Email Address</label>
                    <input type="email" id="edit_email" name="email" required>
                </div>
                <div class="field">
                    <label>Phone Number</label>
                    <input type="text" id="edit_phone" name="phone">
                </div>
            </div>
            <div class="form-footer">
                <button type="submit" class="btn-save">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<style>
    .modal-wrapper {
        position: fixed; inset: 0; background: rgba(15, 23, 42, 0.7);
        backdrop-filter: blur(8px); z-index: 9999; display: none;
        align-items: center; justify-content: center; padding: 20px;
    }
    
    body.dark-theme .modal-wrapper {
        background: rgba(0, 0, 0, 0.85);
    }
    
    .glass-modal {
        background: white; 
        border-radius: 20px; 
        width: 100%; 
        max-width: 600px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        overflow: hidden; 
        animation: zoomIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    
    body.dark-theme .glass-modal {
        background: rgba(15, 23, 42, 0.98);
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6);
    }
    
    .glass-modal.small { max-width: 400px; }
    
    @keyframes zoomIn { from { transform: scale(0.9); opacity: 0; } to { transform: scale(1); opacity: 1; } }

    .modal-header-premium {
        padding: 20px 30px; 
        border-bottom: 1px solid #f1f5f9;
        display: flex; 
        justify-content: space-between; 
        align-items: center;
    }
    
    body.dark-theme .modal-header-premium {
        border-bottom-color: rgba(255, 255, 255, 0.1);
    }
    
    .modal-header-premium h3 { 
        margin: 0; 
        font-size: 18px; 
        font-weight: 700; 
        color: #1e293b; 
    }
    
    body.dark-theme .modal-header-premium h3 {
        color: #f8fafc;
    }
    
    .btn-close { 
        background: none; 
        border: none; 
        font-size: 24px; 
        color: #94a3b8; 
        cursor: pointer; 
        transition: color 0.2s;
    }
    
    .btn-close:hover {
        color: #ef4444;
    }
    
    body.dark-theme .btn-close {
        color: #cbd5e1;
    }

    .premium-form { padding: 20px 30px; }
    
    .view-item { margin-bottom: 20px; }
    .view-item label { 
        font-size: 11px; 
        text-transform: uppercase; 
        color: #94a3b8; 
        font-weight: 700; 
        letter-spacing: 1px; 
        display: block; 
        margin-bottom: 5px; 
    }
    
    body.dark-theme .view-item label {
        color: #94a3b8;
    }
    
    .view-value { 
        font-size: 16px; 
        font-weight: 600; 
        color: #1e293b; 
    }
    
    body.dark-theme .view-value {
        color: #f8fafc;
    }
    
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    .field.full { grid-column: span 2; }
    .field label { 
        display: block; 
        font-size: 13px; 
        font-weight: 600; 
        color: #475569; 
        margin-bottom: 8px; 
    }
    
    body.dark-theme .field label {
        color: #cbd5e1;
    }
    
    .field input {
        width: 100%; 
        padding: 12px 16px; 
        border-radius: 12px;
        border: 1px solid #e2e8f0; 
        font-family: inherit; 
        font-size: 14px;
        transition: 0.3s;
        background: white;
        color: #1e293b;
    }
    
    body.dark-theme .field input {
        background: rgba(30, 41, 59, 0.6);
        border-color: rgba(255, 255, 255, 0.1);
        color: #f8fafc;
    }
    
    .field input:focus { 
        border-color: var(--primary); 
        outline: none; 
        box-shadow: 0 0 0 4px rgba(146, 79, 194, 0.1); 
    }
    
    body.dark-theme .field input:focus {
        box-shadow: 0 0 0 4px rgba(146, 79, 194, 0.2);
    }
    
    body.dark-theme .field input::placeholder {
        color: #64748b;
    }

    .role-selector { display: flex; flex-wrap: wrap; gap: 10px; }
    .role-option { cursor: pointer; }
    .role-option input { display: none; }
    .role-option span {
        padding: 6px 14px; 
        border-radius: 8px; 
        border: 1px solid #e2e8f0;
        font-size: 13px; 
        font-weight: 500; 
        transition: 0.2s; 
        display: inline-block;
        background: white;
        color: #475569;
    }
    
    body.dark-theme .role-option span {
        background: rgba(30, 41, 59, 0.6);
        border-color: rgba(255, 255, 255, 0.1);
        color: #cbd5e1;
    }
    
    .role-option input:checked + span { 
        background: var(--primary); 
        color: white; 
        border-color: var(--primary); 
    }

    .form-footer { 
        margin-top: 30px; 
        display: flex; 
        justify-content: flex-end; 
        gap: 12px; 
    }
    
    .btn-cancel { 
        background: #f1f5f9; 
        border: none; 
        padding: 12px 24px; 
        border-radius: 12px; 
        font-weight: 600; 
        cursor: pointer;
        color: #475569;
        transition: all 0.2s;
    }
    
    .btn-cancel:hover {
        background: #e2e8f0;
    }
    
    body.dark-theme .btn-cancel {
        background: rgba(30, 41, 59, 0.6);
        color: #cbd5e1;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    body.dark-theme .btn-cancel:hover {
        background: rgba(30, 41, 59, 0.8);
    }
    
    .btn-save { 
        background: var(--primary); 
        color: white; 
        border: none; 
        padding: 12px 24px; 
        border-radius: 12px; 
        font-weight: 700; 
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(146, 79, 194, 0.3);
    }
    
    .btn-save.full { width: 100%; }
</style>

<script>
    function openModal(id) { document.getElementById(id).style.display = 'flex'; }
    function closeModal(id) { document.getElementById(id).style.display = 'none'; }
    
    function openViewModal(id) {
        fetch(`/admin/users/${id}/edit`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('view_name').innerText = data.name;
                document.getElementById('view_username').innerText = data.username;
                document.getElementById('view_email').innerText = data.email;
                document.getElementById('view_phone').innerText = data.phone || 'Not provided';
                document.getElementById('view_joined').innerText = new Date(data.created_at).toLocaleDateString();
                openModal('viewUserModal');
            });
    }

    function openResetModal(id) {
        document.getElementById('resetPasswordForm').action = "/admin/users/" + id + "/reset-password";
        openModal('resetPasswordModal');
    }

    function openEditModal(id) {
        // Fetch and Populate (Simplified - can be enhanced with AJAX)
        fetch(`/admin/users/${id}/edit`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('edit_name').value = data.name;
                document.getElementById('edit_username').value = data.username;
                document.getElementById('edit_email').value = data.email;
                document.getElementById('edit_phone').value = data.phone;
                document.getElementById('editUserForm').action = `/admin/users/${id}`;
                openModal('editUserModal');
            });
    }
</script>
