@include('layouts.header')
@include('layouts.sidebar')

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Settings - IVARA Platform</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
<style>
    :root {
        --primary: #924FC2;
        --primary-hover: #7a3fa3;
        --bg-gradient: radial-gradient(circle at top right, #fdf4ff, #f3f4f6);
        --text-main: #1e293b;
        --text-muted: #64748b;
        --card-bg: rgba(255,255,255,0.9);
        --sidebar-bg: rgba(255,255,255,0.95);
        --item-bg: #ffffff;
        --item-border: #e2e8f0;
        --danger: #ef4444;
        --success: #10b981;
        --glass-shadow: 0 8px 30px rgba(0,0,0,0.05);
        --radius-lg: 16px;
        --radius-md: 10px;
    }
    
    body.dark-theme {
        --bg-gradient: radial-gradient(circle at top right, #0f172a, #020617);
        --text-main: #f8fafc;
        --text-muted: #94a3b8;
        --card-bg: rgba(30,41,59,0.7);
        --sidebar-bg: rgba(15,23,42,0.8);
        --item-bg: rgba(51,65,85,0.4);
        --item-border: rgba(255,255,255,0.1);
        --glass-shadow: 0 8px 30px rgba(0,0,0,0.4);
    }

    body {
        margin: 0;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        background: var(--bg-gradient);
        color: var(--text-main);
        min-height: 100vh;
        overflow-x: hidden;
    }

    .settings-layout {
        display: flex;
        width: 80%;
        margin-left: 222px;
        margin-top: 20px;
        margin-bottom: 40px;
        gap: 30px;
        padding: 80px 30px 0; /* Top padding for header */
        min-height: calc(100vh - 100px);
    }

    /* Sidebar Navigation container */
    .settings-sidebar-container {
        width: 280px;
        flex-shrink: 0;
    }

    .settings-sidebar {
        background: var(--sidebar-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--item-border);
        border-radius: var(--radius-lg);
        padding: 20px;
        position: sticky;
        top: 100px; 
        box-shadow: var(--glass-shadow);
    }

    .settings-nav-title {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--text-muted);
        margin: 0 0 10px 10px;
        font-weight: 700;
        opacity: 0.8;
    }

    .settings-nav-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        color: var(--text-muted);
        text-decoration: none;
        border-radius: var(--radius-md);
        margin-bottom: 5px;
        font-weight: 500;
        transition: all 0.2s ease;
        cursor: pointer;
        border: 1px solid transparent;
    }

    .settings-nav-item:hover {
        background: var(--item-bg);
        color: var(--primary);
        border-color: var(--item-border);
    }

    .settings-nav-item.active {
        background: var(--primary);
        color: #fff;
        box-shadow: 0 4px 12px rgba(146, 79, 194, 0.3);
        border-color: transparent;
    }

    .settings-nav-item i {
        width: 20px;
        text-align: center;
    }

    /* Main Content Area */
    .settings-content {
        flex: 1;
        background: var(--card-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--item-border);
        border-radius: var(--radius-lg);
        padding: 40px;
        box-shadow: var(--glass-shadow);
        position: relative;
        min-height: 600px;
    }

    .settings-header {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--item-border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .settings-title {
        font-size: 1.75rem;
        font-weight: 800;
        margin: 0;
        color: var(--text-main);
        letter-spacing: -0.5px;
    }

    .settings-subtitle {
        color: var(--text-muted);
        margin-top: 5px;
        font-size: 0.95rem;
    }

    /* Form Styles */
    .form-section {
        display: none;
        animation: fadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .form-section.active { display: block; }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 24px;
        margin-bottom: 24px;
    }

    .form-group {
        margin-bottom: 24px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--text-main);
        font-size: 0.9rem;
    }

    .form-control {
        width: 100%;
        padding: 12px 16px;
        background: var(--item-bg);
        border: 1px solid var(--item-border);
        border-radius: var(--radius-md);
        color: var(--text-main);
        font-size: 0.95rem;
        transition: all 0.2s;
        box-sizing: border-box;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(146, 79, 194, 0.1);
    }

    .section-heading {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 20px;
        color: var(--primary);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-save {
        background: var(--primary);
        color: white;
        border: none;
        padding: 12px 24px;
        font-size: 0.95rem;
        font-weight: 600;
        border-radius: var(--radius-md);
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-save:hover {
        background: var(--primary-hover);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(146, 79, 194, 0.3);
    }

    .btn-save:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .settings-layout {
            flex-direction: column;
            padding: 80px 15px 20px;
        }
        .settings-sidebar-container {
            width: 100%;
        }
        .settings-sidebar {
            position: relative;
            top: 0;
            display: flex;
            overflow-x: auto;
            padding: 10px;
            gap: 10px;
        }
        .settings-nav-title { display: none; }
        .settings-nav-item { 
            flex-shrink: 0; 
            white-space: nowrap; 
            margin-bottom: 0;
            padding: 10px 14px;
            font-size: 0.9rem;
        }
        .settings-content {
            padding: 25px;
        }
    }
</style>
</head>
<body>

<div class="settings-layout">
    <!-- Sidebar -->
    <div class="settings-sidebar-container">
        <aside class="settings-sidebar">
            <div class="settings-nav-title">General</div>
            <a class="settings-nav-item active" onclick="switchTab('profile')">
                <i class="fas fa-user-circle"></i> Profile & Roles
            </a>
            <a class="settings-nav-item" onclick="switchTab('subscription')">
                <i class="fas fa-credit-card"></i> Subscription
            </a>
            <a class="settings-nav-item" onclick="switchTab('business')">
                <i class="fas fa-briefcase"></i> Business Info
            </a>

            <div class="settings-nav-title" style="margin-top: 20px;">Configuration</div>
            <a class="settings-nav-item" onclick="switchTab('services')">
                <i class="fas fa-tools"></i> Services & Repairs
            </a>
            <a class="settings-nav-item" onclick="switchTab('inventory')">
                <i class="fas fa-box-open"></i> Inventory & Stock
            </a>
            <a class="settings-nav-item" onclick="switchTab('modules')">
                <i class="fas fa-cubes"></i> Features & Modules
            </a>
            
            <div class="settings-nav-title" style="margin-top: 20px;">System</div>
            <a class="settings-nav-item" onclick="switchTab('notifications')">
                <i class="fas fa-bell"></i> Notifications
            </a>
            <a class="settings-nav-item" onclick="switchTab('security')">
                <i class="fas fa-shield-alt"></i> Account Security
            </a>
             <a class="settings-nav-item" onclick="switchTab('feedback')">
                <i class="fas fa-comment-dots"></i> User Feedback
            </a>
        </aside>
    </div>

    <!-- Content -->
    <main class="settings-content">
        <form id="settingsForm" method="POST" action="{{ route('admin.settings.update') }}">
            @csrf
            
            <!-- Header -->
            <div class="settings-header">
                <div>
                    <h1 class="settings-title">Settings</h1>
                    <p class="settings-subtitle">Manage platform configurations and preferences.</p>
                </div>
                <button type="submit" class="btn-save">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </div>

            <!-- Profile Section -->
            <div id="profile" class="form-section active">
                <div class="section-heading"><i class="fas fa-user-circle"></i> User Profile & Roles</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $settings['name'] ?? '') }}" placeholder="Enter full name">
                    </div>
                    <div class="form-group">
                        <label class="form-label">System Role</label>
                        <select name="role" class="form-control">
                            @foreach(['Admin','Manager','Supervisor','Technician','Mechanician','Businessperson','Craftsperson','Mediator','Tailor','Client'] as $role)
                                <option value="{{ $role }}" {{ (old('role', $settings['role'] ?? '') == $role) ? 'selected' : '' }}>{{ $role }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $settings['email'] ?? '') }}" placeholder="name@ivara.com">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $settings['phone'] ?? '') }}" placeholder="+250...">
                    </div>
                </div>
            </div>

            <!-- Subscription Section -->
            <div id="subscription" class="form-section">
                <div class="section-heading"><i class="fas fa-credit-card"></i> Subscription & Billing</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Subscription Tier</label>
                        <select name="subscription_type" class="form-control">
                            <option value="monthly" {{ (old('subscription_type', $settings['subscription_type'] ?? '') == 'monthly') ? 'selected' : '' }}>Monthly Standard</option>
                            <option value="yearly" {{ (old('subscription_type', $settings['subscription_type'] ?? '') == 'yearly') ? 'selected' : '' }}>Yearly Premium</option>
                            <option value="custom" {{ (old('subscription_type', $settings['subscription_type'] ?? '') == 'custom') ? 'selected' : '' }}>Enterprise Custom</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Payment Status</label>
                        <select name="payment_status" class="form-control">
                            <option value="active" {{ (old('payment_status', $settings['payment_status'] ?? '') == 'active') ? 'selected' : '' }}>Active</option>
                            <option value="pending" {{ (old('payment_status', $settings['payment_status'] ?? '') == 'pending') ? 'selected' : '' }}>Pending</option>
                            <option value="expired" {{ (old('payment_status', $settings['payment_status'] ?? '') == 'expired') ? 'selected' : '' }}>Expired</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Business Section -->
            <div id="business" class="form-section">
                <div class="section-heading"><i class="fas fa-building"></i> Business Details</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Business / Company Name</label>
                        <input type="text" name="business_name" class="form-control" value="{{ old('business_name', $settings['business_name'] ?? '') }}" placeholder="e.g. Acme Corp">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Team Size</label>
                        <input type="number" name="team_members" class="form-control" value="{{ old('team_members', $settings['team_members'] ?? '') }}" placeholder="e.g. 10">
                    </div>
                    <div class="form-group">
                         <label class="form-label">Mediator Commission (%)</label>
                        <input type="number" step="0.1" name="mediator_commission" class="form-control" value="{{ old('mediator_commission', $settings['mediator_commission'] ?? '') }}" placeholder="e.g. 5.5">
                    </div>
                </div>
            </div>

             <!-- Services Section -->
             <div id="services" class="form-section">
                <div class="section-heading"><i class="fas fa-tools"></i> Service Configuration</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Track Stolen Devices</label>
                        <select name="track_stolen" class="form-control">
                            <option value="enabled" {{ (old('track_stolen', $settings['track_stolen'] ?? '') == 'enabled') ? 'selected' : '' }}>Enabled</option>
                            <option value="disabled" {{ (old('track_stolen', $settings['track_stolen'] ?? '') == 'disabled') ? 'selected' : '' }}>Disabled</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Repair Tracking System</label>
                        <select name="repair_tracking" class="form-control">
                            <option value="yes" {{ (old('repair_tracking', $settings['repair_tracking'] ?? '') == 'yes') ? 'selected' : '' }}>Active</option>
                            <option value="no" {{ (old('repair_tracking', $settings['repair_tracking'] ?? '') == 'no') ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                     <div class="form-group">
                        <label class="form-label">Meeting Reminder Time</label>
                        <input type="time" name="meeting_alert" class="form-control" value="{{ old('meeting_alert', $settings['meeting_alert'] ?? '') }}">
                    </div>
                </div>
            </div>

             <!-- Inventory Section -->
             <div id="inventory" class="form-section">
                <div class="section-heading"><i class="fas fa-box-open"></i> Inventory Controls</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Stock Level Alerts</label>
                        <select name="stock_alerts" class="form-control">
                             <option value="yes" {{ (old('stock_alerts', $settings['stock_alerts'] ?? '') == 'yes') ? 'selected' : '' }}>Enable Alerts</option>
                            <option value="no" {{ (old('stock_alerts', $settings['stock_alerts'] ?? '') == 'no') ? 'selected' : '' }}>Disable Alerts</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Modules (Generic) -->
            <div id="modules" class="form-section">
                <div class="section-heading"><i class="fas fa-cubes"></i> Module Features</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">E-Learning Module</label>
                        <select name="elearning" class="form-control">
                            <option value="yes" {{ (old('elearning', $settings['elearning'] ?? '') == 'yes') ? 'selected' : '' }}>Enabled</option>
                            <option value="no" {{ (old('elearning', $settings['elearning'] ?? '') == 'no') ? 'selected' : '' }}>Disabled</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Notifications -->
            <div id="notifications" class="form-section">
                <div class="section-heading"><i class="fas fa-bell"></i> Notification Preferences</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Preferred Channels</label>
                        <select name="notification_type" class="form-control">
                            <option value="all" {{ (old('notification_type', $settings['notification_type'] ?? '') == 'all') ? 'selected' : '' }}>All (Email, SMS, App)</option>
                            <option value="email" {{ (old('notification_type', $settings['notification_type'] ?? '') == 'email') ? 'selected' : '' }}>Email Only</option>
                            <option value="sms" {{ (old('notification_type', $settings['notification_type'] ?? '') == 'sms') ? 'selected' : '' }}>SMS Only</option>
                            <option value="in-app" {{ (old('notification_type', $settings['notification_type'] ?? '') == 'in-app') ? 'selected' : '' }}>In-App Only</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Automated Report Frequency</label>
                        <select name="report_frequency" class="form-control">
                            <option value="daily" {{ (old('report_frequency', $settings['report_frequency'] ?? '') == 'daily') ? 'selected' : '' }}>Daily</option>
                            <option value="monthly" {{ (old('report_frequency', $settings['report_frequency'] ?? '') == 'monthly') ? 'selected' : '' }}>Monthly</option>
                            <option value="custom" {{ (old('report_frequency', $settings['report_frequency'] ?? '') == 'custom') ? 'selected' : '' }}>Custom / On Demand</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <!-- Security -->
            <div id="security" class="form-section">
                <div class="section-heading"><i class="fas fa-shield-alt"></i> Security Settings</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Auto-Deactivate Inactive Users (Days)</label>
                        <input type="number" name="deactivate_days" class="form-control" value="{{ old('deactivate_days', $settings['deactivate_days'] ?? '') }}" placeholder="e.g. 90">
                    </div>
                </div>
            </div>

             <!-- Feedback -->
            <div id="feedback" class="form-section">
                <div class="section-heading"><i class="fas fa-comment-dots"></i> Feedback</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Collect User Feedback</label>
                         <select name="feedback_enabled" class="form-control">
                            <option value="yes" {{ (old('feedback_enabled', $settings['feedback_enabled'] ?? '') == 'yes') ? 'selected' : '' }}>Yes, Enable Collection</option>
                            <option value="no" {{ (old('feedback_enabled', $settings['feedback_enabled'] ?? '') == 'no') ? 'selected' : '' }}>No, Disable Collection</option>
                        </select>
                    </div>
                </div>
            </div>

        </form>
    </main>
</div>

<!-- Toastr & Jquery -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    // Tab Switching Logic
    function switchTab(tabId) {
        // Remove active class from all nav items
        document.querySelectorAll('.settings-nav-item').forEach(el => {
            el.classList.remove('active');
        });
        
        // Add active to clicked item (if event exists)
        if (event && event.currentTarget) {
            event.currentTarget.classList.add('active');
        } else {
            // Fallback finding the link that calls this function
            const activeLink = Array.from(document.querySelectorAll('.settings-nav-item')).find(el => el.getAttribute('onclick').includes(tabId));
            if(activeLink) activeLink.classList.add('active');
        }

        // Hide all sections
        document.querySelectorAll('.form-section').forEach(el => {
            el.classList.remove('active');
        });

        // Show target section
        const target = document.getElementById(tabId);
        if(target) target.classList.add('active');
    }

    // Toastr Config
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "timeOut": "4000"
    };

    // AJAX Submission
    document.getElementById('settingsForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const btn = this.querySelector('.btn-save');
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
            toastr.error('An error occurred. Check console.');
        } finally {
            btn.innerHTML = originalContent;
            btn.disabled = false;
        }
    });
</script>

</body>
</html>
