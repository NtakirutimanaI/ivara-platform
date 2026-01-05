@include('layouts.header')
@include('layouts.sidebar')

<style>
    :root {
        --category-color: {{ $categoryColor ?? '#E91E63' }};
        --category-glow: {{ $categoryColor ?? '#E91E63' }}40;
        --primary: #924FC2;
        --success: #00C853;
        --warning: #FFAB00;
        --danger: #FF1744;
        --info: #2196F3;
        --bg-panel: #fdf4ff;
        --text-primary: #1e293b;
        --text-secondary: #64748b;
        --card-bg: #ffffff;
        --border-color: #e2e8f0;
    }

    body.dark-theme {
        --bg-panel: #0f172a !important;
        --text-primary: #f8fafc !important;
        --text-secondary: #cbd5e1 !important;
        --card-bg: rgba(30, 41, 59, 0.6) !important;
        --border-color: rgba(255, 255, 255, 0.1) !important;
    }

    body {
        background: var(--bg-panel) !important;
        color: var(--text-primary) !important;
        font-family: 'Poppins', sans-serif;
    }

    .category-panel {
        width: 80%;
        max-width: 1600px;
        margin-left: auto;
        margin-right: auto;
        padding: 30px 20px;
        padding-left: 270px;
    }

    /* Category Header */
    .category-header {
        background: linear-gradient(135deg, var(--category-color), {{ $categoryColor ?? '#E91E63' }}cc);
        border-radius: 20px;
        padding: 30px 40px;
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 10px 40px var(--category-glow);
        position: relative;
        overflow: hidden;
    }

    .category-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }

    .category-header::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: 20%;
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
    }

    .category-header-content {
        position: relative;
        z-index: 1;
    }

    .category-header h1 {
        color: white;
        font-size: 28px;
        font-weight: 800;
        margin: 0 0 8px 0;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .category-header h1 i {
        font-size: 32px;
    }

    .category-header p {
        color: rgba(255,255,255,0.85);
        margin: 0;
        font-size: 15px;
    }

    .category-header-actions {
        position: relative;
        z-index: 1;
        display: flex;
        gap: 12px;
    }

    .btn-header {
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        border: none;
    }

    .btn-header.primary {
        background: white;
        color: var(--category-color);
    }

    .btn-header.primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }

    .btn-header.outline {
        background: rgba(255,255,255,0.15);
        color: white;
        border: 1px solid rgba(255,255,255,0.3);
    }

    .btn-header.outline:hover {
        background: rgba(255,255,255,0.25);
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: var(--card-bg);
        border-radius: 16px;
        padding: 24px;
        display: flex;
        align-items: center;
        gap: 18px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border: 1px solid var(--border-color);
        transition: all 0.3s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px var(--category-glow);
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        flex-shrink: 0;
    }

    .stat-icon.primary { background: rgba(233, 30, 99, 0.12); color: var(--category-color); }
    .stat-icon.success { background: rgba(0, 200, 83, 0.12); color: var(--success); }
    .stat-icon.warning { background: rgba(255, 171, 0, 0.12); color: var(--warning); }
    .stat-icon.info { background: rgba(33, 150, 243, 0.12); color: var(--info); }
    .stat-icon.purple { background: rgba(146, 79, 194, 0.12); color: var(--primary); }
    .stat-icon.danger { background: rgba(255, 23, 68, 0.12); color: var(--danger); }

    .stat-content { flex: 1; }
    .stat-label { font-size: 12px; color: var(--text-secondary); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
    .stat-value { font-size: 28px; font-weight: 800; color: var(--text-primary); margin: 4px 0 0 0; }

    /* Quick Actions Grid */
    .section-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title i {
        color: var(--category-color);
    }

    .quick-actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 16px;
        margin-bottom: 30px;
    }

    .quick-action-card {
        background: var(--card-bg);
        border-radius: 16px;
        padding: 24px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        border: 1px solid var(--border-color);
        text-decoration: none;
        display: block;
    }

    .quick-action-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border-color: var(--category-color);
    }

    .quick-action-icon {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        background: linear-gradient(135deg, var(--category-color), {{ $categoryColor ?? '#E91E63' }}cc);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
        font-size: 24px;
        color: white;
    }

    .quick-action-label {
        font-size: 14px;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 4px;
    }

    .quick-action-desc {
        font-size: 12px;
        color: var(--text-secondary);
    }

    /* Content Grid */
    .content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 25px;
    }

    .content-card {
        background: var(--card-bg);
        border-radius: 16px;
        padding: 24px;
        border: 1px solid var(--border-color);
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .content-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid var(--border-color);
    }

    .content-card-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .content-card-title i {
        color: var(--category-color);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
    }

    .empty-state-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: var(--category-glow);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 36px;
        color: var(--category-color);
    }

    .empty-state h4 {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0 0 8px 0;
    }

    .empty-state p {
        color: var(--text-secondary);
        margin: 0 0 20px 0;
    }

    .btn-action {
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        border: none;
        background: linear-gradient(135deg, var(--category-color), {{ $categoryColor ?? '#E91E63' }}cc);
        color: white;
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px var(--category-glow);
    }

    /* Activity List */
    .activity-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .activity-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid var(--border-color);
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .activity-content {
        flex: 1;
    }

    .activity-title {
        font-size: 14px;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 4px;
    }

    .activity-time {
        font-size: 12px;
        color: var(--text-secondary);
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .category-panel { width: 95%; padding-left: 270px; }
        .content-grid { grid-template-columns: 1fr; }
    }

    @media (max-width: 992px) {
        .category-panel { width: 100%; padding-left: 20px; padding-right: 20px; }
        .category-header { flex-direction: column; text-align: center; gap: 20px; }
        .category-header-actions { justify-content: center; }
    }

    @media (max-width: 600px) {
        .quick-actions-grid { grid-template-columns: repeat(2, 1fr); }
    }
</style>

<div class="category-panel">
    <!-- Category Header -->
    <div class="category-header">
        <div class="category-header-content">
            <h1><i class="fas {{ $categoryIcon ?? 'fa-palette' }}"></i> {{ $categoryName ?? 'Creative & Lifestyle' }}</h1>
            <p>Manage photography, design, wellness, beauty, art, music and event services</p>
        </div>
        <div class="category-header-actions">
            <a href="{{ route('admin.creative-lifestyle.services') }}" class="btn-header outline">
                <i class="fas fa-cog"></i> Manage Services
            </a>
            <button class="btn-header primary" onclick="openModal('addServiceModal')">
                <i class="fas fa-plus"></i> Add Service
            </button>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon primary"><i class="fas fa-concierge-bell"></i></div>
            <div class="stat-content">
                <div class="stat-label">Total Services</div>
                <div class="stat-value">{{ $stats['total_services'] ?? 0 }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon info"><i class="fas fa-calendar-check"></i></div>
            <div class="stat-content">
                <div class="stat-label">Total Bookings</div>
                <div class="stat-value">{{ $stats['total_bookings'] ?? 0 }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon success"><i class="fas fa-user-tie"></i></div>
            <div class="stat-content">
                <div class="stat-label">Providers</div>
                <div class="stat-value">{{ $stats['total_providers'] ?? 0 }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon warning"><i class="fas fa-clock"></i></div>
            <div class="stat-content">
                <div class="stat-label">Pending</div>
                <div class="stat-value">{{ $stats['pending_bookings'] ?? 0 }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon purple"><i class="fas fa-check-double"></i></div>
            <div class="stat-content">
                <div class="stat-label">Completed</div>
                <div class="stat-value">{{ $stats['completed_bookings'] ?? 0 }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon danger"><i class="fas fa-dollar-sign"></i></div>
            <div class="stat-content">
                <div class="stat-label">Revenue</div>
                <div class="stat-value">{{ number_format($stats['total_revenue'] ?? 0) }}</div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <h3 class="section-title"><i class="fas fa-bolt"></i> Quick Actions</h3>
    <div class="quick-actions-grid">
        <a href="{{ route('admin.creative-lifestyle.services') }}" class="quick-action-card">
            <div class="quick-action-icon"><i class="fas fa-concierge-bell"></i></div>
            <div class="quick-action-label">Services</div>
            <div class="quick-action-desc">Manage services</div>
        </a>
        <a href="{{ route('admin.creative-lifestyle.bookings') }}" class="quick-action-card">
            <div class="quick-action-icon"><i class="fas fa-calendar-alt"></i></div>
            <div class="quick-action-label">Bookings</div>
            <div class="quick-action-desc">View bookings</div>
        </a>
        <a href="{{ route('admin.creative-lifestyle.providers') }}" class="quick-action-card">
            <div class="quick-action-icon"><i class="fas fa-user-tie"></i></div>
            <div class="quick-action-label">Providers</div>
            <div class="quick-action-desc">Service providers</div>
        </a>
        <a href="{{ route('admin.creative-lifestyle.products') }}" class="quick-action-card">
            <div class="quick-action-icon"><i class="fas fa-box"></i></div>
            <div class="quick-action-label">Products</div>
            <div class="quick-action-desc">Manage products</div>
        </a>
        <a href="{{ route('admin.creative-lifestyle.clients') }}" class="quick-action-card">
            <div class="quick-action-icon"><i class="fas fa-users"></i></div>
            <div class="quick-action-label">Clients</div>
            <div class="quick-action-desc">Client database</div>
        </a>
        <a href="{{ route('admin.creative-lifestyle.reports') }}" class="quick-action-card">
            <div class="quick-action-icon"><i class="fas fa-chart-bar"></i></div>
            <div class="quick-action-label">Reports</div>
            <div class="quick-action-desc">Analytics</div>
        </a>
        <a href="{{ route('admin.creative-lifestyle.payments') }}" class="quick-action-card">
            <div class="quick-action-icon"><i class="fas fa-credit-card"></i></div>
            <div class="quick-action-label">Payments</div>
            <div class="quick-action-desc">Transactions</div>
        </a>
        <a href="{{ route('admin.creative-lifestyle.reviews') }}" class="quick-action-card">
            <div class="quick-action-icon"><i class="fas fa-star"></i></div>
            <div class="quick-action-label">Reviews</div>
            <div class="quick-action-desc">Feedback</div>
        </a>
        <a href="{{ route('admin.creative-lifestyle.settings') }}" class="quick-action-card">
            <div class="quick-action-icon"><i class="fas fa-cog"></i></div>
            <div class="quick-action-label">Settings</div>
            <div class="quick-action-desc">Configuration</div>
        </a>
    </div>

    <!-- Content Grid -->
    <div class="content-grid">
        <!-- Recent Bookings -->
        <div class="content-card">
            <div class="content-card-header">
                <div class="content-card-title"><i class="fas fa-calendar-check"></i> Recent Bookings</div>
                <a href="{{ route('admin.creative-lifestyle.bookings') }}" class="btn-action" style="padding: 8px 16px; font-size: 12px;">View All</a>
            </div>
            <div class="empty-state">
                <div class="empty-state-icon"><i class="fas fa-calendar-plus"></i></div>
                <h4>No Bookings Yet</h4>
                <p>Start receiving bookings by adding services to this category.</p>
                <a href="{{ route('admin.creative-lifestyle.services') }}" class="btn-action">
                    <i class="fas fa-plus"></i> Add First Service
                </a>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="content-card">
            <div class="content-card-header">
                <div class="content-card-title"><i class="fas fa-history"></i> Recent Activity</div>
            </div>
            <div class="empty-state" style="padding: 30px 10px;">
                <div class="empty-state-icon" style="width: 60px; height: 60px; font-size: 24px;"><i class="fas fa-clock"></i></div>
                <h4 style="font-size: 16px;">No Activity Yet</h4>
                <p style="font-size: 13px;">Activity will appear here as you manage this category.</p>
            </div>
        </div>
    </div>
</div>

<!-- Add Service Modal (Placeholder) -->
<div id="addServiceModal" class="modal-wrapper" style="position: fixed; inset: 0; background: rgba(0,0,0,0.75); backdrop-filter: blur(12px); z-index: 9999; display: none; align-items: center; justify-content: center; padding: 20px;">
    <div style="background: var(--card-bg); border-radius: 20px; width: 100%; max-width: 500px; padding: 30px; border: 1px solid var(--border-color);">
        <h3 style="margin: 0 0 20px 0; color: var(--text-primary);"><i class="fas fa-plus" style="color: {{ $categoryColor ?? '#E91E63' }};"></i> Add New Service</h3>
        <p style="color: var(--text-secondary);">Service creation form will be implemented here.</p>
        <button onclick="closeModal('addServiceModal')" class="btn-action" style="margin-top: 20px; width: 100%;">
            <i class="fas fa-times"></i> Close
        </button>
    </div>
</div>

<script>
function openModal(id) {
    document.getElementById(id).style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeModal(id) {
    document.getElementById(id).style.display = 'none';
    document.body.style.overflow = '';
}

document.querySelectorAll('.modal-wrapper').forEach(modal => {
    modal.addEventListener('click', function(e) {
        if (e.target === this) closeModal(this.id);
    });
});
</script>
@include('layouts.footer')
