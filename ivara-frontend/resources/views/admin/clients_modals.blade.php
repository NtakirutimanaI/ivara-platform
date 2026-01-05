{{-- Add Client Modal --}}
<div id="addClientModal" class="modal-wrapper">
    <div class="modal-card">
        <div class="modal-header">
            <h3>Register New Partner Client</h3>
            <button class="close-btn" onclick="closeModal('addClientModal')">&times;</button>
        </div>
        <form id="addClientForm" action="{{ route('admin.clients.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="name" placeholder="Business or Individual Name" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone" placeholder="+250..." required>
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" placeholder="client@example.com">
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" name="city" placeholder="Kigali">
                    </div>
                    <div class="form-group">
                        <label>Country</label>
                        <input type="text" name="country" value="Rwanda">
                    </div>
                    <div class="form-group">
                        <label>Initial Status</label>
                        <select name="status">
                            <option value="active">Active</option>
                            <option value="pending">Pending</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeModal('addClientModal')">Cancel</button>
                <button type="submit" class="btn-primary">Register Client</button>
            </div>
        </form>
    </div>
</div>

{{-- Edit Client Modal --}}
<div id="editClientModal" class="modal-wrapper">
    <div class="modal-card">
        <div class="modal-header">
            <h3>Edit Client Partnership</h3>
            <button class="close-btn" onclick="closeModal('editClientModal')">&times;</button>
        </div>
        <form id="editClientForm" method="POST">
            @csrf
            @method('POST') {{-- Controller uses update method via POST or similar --}}
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="name" id="edit_name" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone" id="edit_phone" required>
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" id="edit_email">
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" name="city" id="edit_city">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="edit_status">
                            <option value="active">Active</option>
                            <option value="pending">Pending</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeModal('editClientModal')">Cancel</button>
                <button type="submit" class="btn-primary">Update Details</button>
            </div>
        </form>
    </div>
</div>

{{-- View Client Modal --}}
<div id="viewClientModal" class="modal-wrapper">
    <div class="modal-card">
        <div class="modal-header">
            <h3>Client Overview</h3>
            <button class="close-btn" onclick="closeModal('viewClientModal')">&times;</button>
        </div>
        <div class="modal-body">
            <div class="view-item">
                <label>Legal Name</label>
                <div id="view_name" class="view-value"></div>
            </div>
            <div class="view-grid">
                <div class="view-item">
                    <label>Phone</label>
                    <div id="view_phone" class="view-value"></div>
                </div>
                <div class="view-item">
                    <label>Email</label>
                    <div id="view_email" class="view-value"></div>
                </div>
                <div class="view-item">
                    <label>City</label>
                    <div id="view_city" class="view-value"></div>
                </div>
                <div class="view-item">
                    <label>Country</label>
                    <div id="view_country" class="view-value"></div>
                </div>
            </div>
            <div class="view-item">
                <label>Current Status</label>
                <div id="view_status" class="view-value status-pill"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-primary" onclick="closeModal('viewClientModal')">Close Overview</button>
        </div>
    </div>
</div>

<style>
    .modal-wrapper {
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(10, 17, 40, 0.4); backdrop-filter: blur(8px);
        display: none; align-items: center; justify-content: center; z-index: 2000;
    }
    .modal-card {
        background: white; width: 550px; border-radius: 24px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        animation: modalSlide 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    @keyframes modalSlide {
        from { opacity: 0; transform: translateY(20px) scale(0.95); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }
    .modal-header { padding: 25px 30px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; }
    .modal-header h3 { margin: 0; font-size: 18px; font-weight: 800; color: #1e293b; }
    .close-btn { background: none; border: none; font-size: 24px; color: #94a3b8; cursor: pointer; }

    .modal-body { padding: 30px; }
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    .form-group label { display: block; font-size: 13px; font-weight: 700; color: #64748b; margin-bottom: 8px; }
    .form-group input, .form-group select { 
        width: 100%; padding: 12px; border-radius: 12px; border: 1.5px solid #e2e8f0; 
        font-size: 14px; outline: none; transition: all 0.2s;
    }
    .form-group input:focus { border-color: var(--primary); box-shadow: 0 0 0 4px rgba(146, 79, 194, 0.1); }

    .view-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    .view-item { margin-bottom: 20px; }
    .view-item label { display: block; font-size: 12px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; }
    .view-value { font-size: 15px; font-weight: 600; color: #1e293b; margin-top: 5px; }
    
    .modal-footer { padding: 20px 30px; border-top: 1px solid #f1f5f9; display: flex; justify-content: flex-end; gap: 12px; }
    .btn-secondary { background: #f1f5f9; color: #475569; border: none; padding: 12px 20px; border-radius: 12px; font-weight: 700; cursor: pointer; }

    function openModal(id) { document.getElementById(id).style.display = 'flex'; }
    function closeModal(id) { document.getElementById(id).style.display = 'none'; }
</style>
