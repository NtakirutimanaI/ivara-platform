@extends('layouts.app')

@section('title', 'Platform Settings - IVARA Admin')

@section('styles')
<style>
    :root {
        --settings-sidebar-w: 260px;
        --card-radius: 16px;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Layout Wrapper */
    .settings-wrapper {
        display: flex;
        gap: 30px;
        max-width: 1600px;
        margin: 0 auto;
        padding: 40px 30px;
        min-height: calc(100vh - 80px); /* Adjust for header */
        animation: fadeIn 0.5s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Inner Sidebar (Settings Nav) */
    .settings-nav {
        width: var(--settings-sidebar-w);
        flex-shrink: 0;
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: var(--card-radius);
        padding: 24px;
        height: fit-content;
        position: sticky;
        top: 100px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
    }

    .nav-group-title {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #94a3b8;
        font-weight: 700;
        margin: 24px 0 12px 12px;
    }

    .nav-group-title:first-child {
        margin-top: 0;
    }

    .nav-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        margin-bottom: 4px;
        border-radius: 12px;
        color: #64748b;
        font-weight: 500;
        font-size: 0.95rem;
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
        border: 1px solid transparent;
    }

    .nav-item:hover {
        background: rgba(146, 79, 194, 0.05); /* Brand Primary Tint */
        color: #924FC2;
    }

    .nav-item.active {
        background: linear-gradient(135deg, #924FC2 0%, #7a3fa3 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(146, 79, 194, 0.25);
    }

    .nav-item i {
        width: 20px;
        text-align: center;
        font-size: 1.1em;
    }

    /* Main Configuration Area */
    .settings-main {
        flex: 1;
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: var(--card-radius);
        padding: 40px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
        position: relative;
        overflow: hidden;
    }

    /* Header */
    .settings-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 40px;
        padding-bottom: 24px;
        border-bottom: 1px solid #e2e8f0;
    }

    .page-title h1 {
        font-size: 2rem;
        font-weight: 800;
        color: #1e293b;
        letter-spacing: -0.02em;
        margin: 0;
        background: linear-gradient(45deg, #1e293b, #475569);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .page-title p {
        color: #64748b;
        margin-top: 8px;
        font-size: 1rem;
    }

    /* Action Button */
    .btn-save-master {
        background: #10b981; /* Success Green */
        color: white;
        border: none;
        padding: 14px 28px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: var(--transition);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
    }

    .btn-save-master:hover {
        background: #059669;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    }

    .btn-save-master:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }

    /* Form Content */
    .settings-panel {
        display: none;
        animation: slideUp 0.4s ease-out;
    }
    
    .settings-panel.active {
        display: block;
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .section-label {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 1.1rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 24px;
        padding-left: 10px;
        border-left: 4px solid #924FC2;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 24px;
        margin-bottom: 32px;
    }

    .form-group {
        position: relative;
    }

    .form-group label {
        display: block;
        font-size: 0.85rem;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.02em;
    }

    .form-control {
        width: 100%;
        padding: 14px 16px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        font-size: 1rem;
        color: #1e293b;
        transition: var(--transition);
    }

    .form-control:focus {
        background: white;
        border-color: #924FC2;
        box-shadow: 0 0 0 4px rgba(146, 79, 194, 0.1);
        outline: none;
    }

    select.form-control {
        cursor: pointer;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
        -webkit-appearance: none;
        appearance: none;
    }

    /* Dark Mode Overrides */
    [data-theme="dark"] .settings-wrapper {
         /* Background handled by main layout */
    }

    [data-theme="dark"] .settings-nav,
    [data-theme="dark"] .settings-main {
        background: #1e293b; /* Dark Slate */
        border-color: rgba(255, 255, 255, 0.05);
    }

    [data-theme="dark"] .page-title h1 {
        background: none;
        -webkit-text-fill-color: initial;
        color: #f8fafc;
    }

    [data-theme="dark"] .page-title p,
    [data-theme="dark"] .nav-group-title,
    [data-theme="dark"] .form-group label {
        color: #94a3b8;
    }

    [data-theme="dark"] .settings-header {
        border-bottom-color: rgba(255, 255, 255, 0.1);
    }

    [data-theme="dark"] .nav-item {
        color: #cbd5e1;
    }

    [data-theme="dark"] .nav-item:hover {
        background: rgba(255, 255, 255, 0.05);
        color: #fff;
    }

    [data-theme="dark"] .nav-item.active {
        background: linear-gradient(135deg, #924FC2 0%, #7a3fa3 100%); /* Maintain Brand Color */
        color: white;
    }

    [data-theme="dark"] .form-control {
        background: #0f172a; /* Very Dark Blue */
        border-color: rgba(255, 255, 255, 0.1);
        color: #f8fafc;
    }

    [data-theme="dark"] .form-control:focus {
        border-color: #924FC2;
        background: #0f172a;
    }
    
    [data-theme="dark"] .section-label {
        color: #f8fafc;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .settings-wrapper {
            flex-direction: column;
            padding: 20px;
        }
        
        .settings-nav {
            width: 100%;
            display: flex;
            overflow-x: auto;
            position: relative;
            top: 0;
            padding: 16px;
            gap: 12px;
            mask-image: linear-gradient(to right, black 90%, transparent 100%);
        }

        .nav-group-title {
            display: none;
        }

        .nav-item {
            flex-shrink: 0;
            white-space: nowrap;
            margin: 0;
        }
    }
</style>
@endsection

@section('content')
<div class="settings-wrapper">
    <!-- Secondary Sidebar Navigation -->
    <nav class="settings-nav">
        <div class="nav-group-title">Account</div>
        <a class="nav-item active" onclick="showPanel('profile', this)">
            <i class="fas fa-user-circle"></i> Profile
        </a>
        <a class="nav-item" onclick="showPanel('subscription', this)">
            <i class="fas fa-crown"></i> Subscription
        </a>
        <a class="nav-item" onclick="showPanel('business', this)">
            <i class="fas fa-building"></i> Business Info
        </a>

        <div class="nav-group-title">System</div>
        <a class="nav-item" onclick="showPanel('services', this)">
            <i class="fas fa-cogs"></i> Configuration
        </a>
        <a class="nav-item" onclick="showPanel('inventory', this)">
            <i class="fas fa-warehouse"></i> Inventory
        </a>
        <a class="nav-item" onclick="showPanel('notifications', this)">
            <i class="fas fa-bell"></i> Notifications
        </a>
        <a class="nav-item" onclick="showPanel('security', this)">
            <i class="fas fa-shield-alt"></i> Security
        </a>
    </nav>

    <!-- Main Content Area -->
    <main class="settings-main">
        <form id="settingsForm" method="POST" action="{{ route('admin.settings.update') }}">
            @csrf
            
            <div class="settings-header">
                <div class="page-title">
                    <h1>Settings</h1>
                    <p>Manage your platform preferences and configurations.</p>
                </div>
                <button type="submit" class="btn-save-master">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </div>

            <!-- Profile Panel -->
            <div id="profile" class="settings-panel active">
                <div class="section-label">Profile Information</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $settings['name'] ?? '') }}" placeholder="Enter full name">
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $settings['email'] ?? '') }}" placeholder="email@example.com">
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $settings['phone'] ?? '') }}" placeholder="+250 7...">
                    </div>
                    <div class="form-group">
                        <label>System Role</label>
                        <select name="role" class="form-control">
                            @foreach(['Admin','Manager','Supervisor','Technician','Businessperson'] as $role)
                                <option value="{{ $role }}" {{ (old('role', $settings['role'] ?? '') == $role) ? 'selected' : '' }}>{{ $role }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Subscription Panel -->
            <div id="subscription" class="settings-panel">
                <div class="section-label">Plan & Billing</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Current Plan</label>
                        <select name="subscription_type" class="form-control">
                            <option value="monthly" {{ (old('subscription_type', $settings['subscription_type'] ?? '') == 'monthly') ? 'selected' : '' }}>Monthly Standard</option>
                            <option value="yearly" {{ (old('subscription_type', $settings['subscription_type'] ?? '') == 'yearly') ? 'selected' : '' }}>Yearly Premium</option>
                            <option value="enterprise" {{ (old('subscription_type', $settings['subscription_type'] ?? '') == 'enterprise') ? 'selected' : '' }}>Enterprise</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="payment_status" class="form-control">
                            <option value="active" {{ (old('payment_status', $settings['payment_status'] ?? '') == 'active') ? 'selected' : '' }}>Active</option>
                            <option value="pending" {{ (old('payment_status', $settings['payment_status'] ?? '') == 'pending') ? 'selected' : '' }}>Pending Payment</option>
                            <option value="expired" {{ (old('payment_status', $settings['payment_status'] ?? '') == 'expired') ? 'selected' : '' }}>Expired</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Business Info -->
            <div id="business" class="settings-panel">
                <div class="section-label">Company Details</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Company Name</label>
                        <input type="text" name="business_name" class="form-control" value="{{ old('business_name', $settings['business_name'] ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>Team Size</label>
                        <input type="number" name="team_members" class="form-control" value="{{ old('team_members', $settings['team_members'] ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>Platform Commission (%)</label>
                        <input type="number" step="0.1" name="mediator_commission" class="form-control" value="{{ old('mediator_commission', $settings['mediator_commission'] ?? '') }}">
                    </div>
                </div>
            </div>

            <!-- Configuration -->
            <div id="services" class="settings-panel">
                 <div class="section-label">Service Configuration</div>
                 <div class="form-grid">
                    <div class="form-group">
                        <label>Device Tracking</label>
                        <select name="track_stolen" class="form-control">
                            <option value="enabled" {{ (old('track_stolen', $settings['track_stolen'] ?? '') == 'enabled') ? 'selected' : '' }}>Enabled</option>
                            <option value="disabled" {{ (old('track_stolen', $settings['track_stolen'] ?? '') == 'disabled') ? 'selected' : '' }}>Disabled</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Repair Tracking</label>
                        <select name="repair_tracking" class="form-control">
                            <option value="yes" {{ (old('repair_tracking', $settings['repair_tracking'] ?? '') == 'yes') ? 'selected' : '' }}>Active</option>
                            <option value="no" {{ (old('repair_tracking', $settings['repair_tracking'] ?? '') == 'no') ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                     <div class="form-group">
                        <label>Meeting Reminder Time</label>
                        <input type="time" name="meeting_alert" class="form-control" value="{{ old('meeting_alert', $settings['meeting_alert'] ?? '') }}">
                    </div>
                     <div class="form-group">
                        <label>E-Learning Module</label>
                        <select name="elearning" class="form-control">
                            <option value="yes" {{ (old('elearning', $settings['elearning'] ?? '') == 'yes') ? 'selected' : '' }}>Enabled</option>
                            <option value="no" {{ (old('elearning', $settings['elearning'] ?? '') == 'no') ? 'selected' : '' }}>Disabled</option>
                        </select>
                    </div>
                 </div>
            </div>

            <!-- Inventory -->
            <div id="inventory" class="settings-panel">
                 <div class="section-label">Inventory Logic</div>
                 <div class="form-grid">
                     <div class="form-group">
                        <label>Low Stock Alerts</label>
                         <select name="stock_alerts" class="form-control">
                             <option value="yes" {{ (old('stock_alerts', $settings['stock_alerts'] ?? '') == 'yes') ? 'selected' : '' }}>Enabled</option>
                             <option value="no" {{ (old('stock_alerts', $settings['stock_alerts'] ?? '') == 'no') ? 'selected' : '' }}>Disabled</option>
                         </select>
                     </div>
                 </div>
            </div>

            <!-- Notifications -->
            <div id="notifications" class="settings-panel">
                <div class="section-label">Notification Channels</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Preferred Method</label>
                         <select name="notification_type" class="form-control">
                            <option value="all" {{ (old('notification_type', $settings['notification_type'] ?? '') == 'all') ? 'selected' : '' }}>All Channels</option>
                            <option value="email" {{ (old('notification_type', $settings['notification_type'] ?? '') == 'email') ? 'selected' : '' }}>Email Only</option>
                            <option value="sms" {{ (old('notification_type', $settings['notification_type'] ?? '') == 'sms') ? 'selected' : '' }}>SMS Only</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Report Frequency</label>
                        <select name="report_frequency" class="form-control">
                            <option value="daily" {{ (old('report_frequency', $settings['report_frequency'] ?? '') == 'daily') ? 'selected' : '' }}>Daily Reports</option>
                            <option value="monthly" {{ (old('report_frequency', $settings['report_frequency'] ?? '') == 'monthly') ? 'selected' : '' }}>Monthly Summary</option>
                            <option value="custom" {{ (old('report_frequency', $settings['report_frequency'] ?? '') == 'custom') ? 'selected' : '' }}>On Demand</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>User Feedback Collection</label>
                         <select name="feedback_enabled" class="form-control">
                            <option value="yes" {{ (old('feedback_enabled', $settings['feedback_enabled'] ?? '') == 'yes') ? 'selected' : '' }}>Enabled</option>
                            <option value="no" {{ (old('feedback_enabled', $settings['feedback_enabled'] ?? '') == 'no') ? 'selected' : '' }}>Disabled</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Security -->
            <div id="security" class="settings-panel">
                 <div class="section-label">System Security</div>
                 <div class="form-grid">
                      <div class="form-group">
                        <label>Auto-Logout Timer (Minutes)</label>
                        <input type="number" name="auto_logout" class="form-control" value="{{ old('auto_logout', $settings['auto_logout'] ?? '30') }}">
                      </div>
                 </div>
            </div>

        </form>
    </main>
</div>
@endsection

@section('scripts')
<script>
    function showPanel(panelId, navItem) {
        // Update Nav
        document.querySelectorAll('.settings-nav .nav-item').forEach(el => el.classList.remove('active'));
        navItem.classList.add('active');

        // Update Panel
        document.querySelectorAll('.settings-panel').forEach(el => el.classList.remove('active'));
        const target = document.getElementById(panelId);
        if(target) target.classList.add('active');
    }

    // AJAX Form Submission
    document.getElementById('settingsForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const btn = this.querySelector('.btn-save-master');
        const originalContent = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
        btn.disabled = true;

        const formData = new FormData(this);

        try {
            const response = await fetch(this.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: formData
            });

            const result = await response.json();

            if (response.ok) {
                toastr.success('Settings updated successfully!');
            } else {
                toastr.error('Failed to update settings.');
            }
        } catch (error) {
            console.error(error);
            toastr.error('Connection error. Please try again.');
        } finally {
            btn.innerHTML = originalContent;
            btn.disabled = false;
        }
    });

    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif
    
    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif
</script>
@endsection
