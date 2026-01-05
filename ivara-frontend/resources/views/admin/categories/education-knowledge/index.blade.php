@include('layouts.header')
@include('layouts.sidebar')

<style>
    :root { --category-color: {{ $categoryColor ?? '#9C27B0' }}; --category-glow: {{ $categoryColor ?? '#9C27B0' }}40; --primary: #924FC2; --success: #00C853; --warning: #FFAB00; --danger: #FF1744; --info: #2196F3; --bg-panel: #fdf4ff; --text-primary: #1e293b; --text-secondary: #64748b; --card-bg: #ffffff; --border-color: #e2e8f0; }
    body.dark-theme { --bg-panel: #0f172a !important; --text-primary: #f8fafc !important; --text-secondary: #cbd5e1 !important; --card-bg: rgba(30, 41, 59, 0.6) !important; --border-color: rgba(255, 255, 255, 0.1) !important; }
    body { background: var(--bg-panel) !important; color: var(--text-primary) !important; font-family: 'Poppins', sans-serif; }
    .category-panel { width: 80%; max-width: 1600px; margin: 0 auto; padding: 30px 20px; padding-left: 270px; }
    .category-header { background: linear-gradient(135deg, var(--category-color), #7B1FA2); border-radius: 20px; padding: 30px 40px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 10px 40px var(--category-glow); position: relative; overflow: hidden; }
    .category-header::before { content: ''; position: absolute; top: -50%; right: -10%; width: 300px; height: 300px; background: rgba(255,255,255,0.1); border-radius: 50%; }
    .category-header h1 { color: white; font-size: 28px; font-weight: 800; margin: 0 0 8px 0; display: flex; align-items: center; gap: 15px; position: relative; z-index: 1; }
    .category-header h1 i { font-size: 32px; }
    .category-header p { color: rgba(255,255,255,0.85); margin: 0; font-size: 15px; position: relative; z-index: 1; }
    .category-header-actions { position: relative; z-index: 1; display: flex; gap: 12px; }
    .btn-header { padding: 12px 24px; border-radius: 12px; font-weight: 600; font-size: 14px; cursor: pointer; transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; border: none; }
    .btn-header.primary { background: white; color: var(--category-color); }
    .btn-header.outline { background: rgba(255,255,255,0.15); color: white; border: 1px solid rgba(255,255,255,0.3); }
    .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px; }
    .stat-card { background: var(--card-bg); border-radius: 16px; padding: 24px; display: flex; align-items: center; gap: 18px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid var(--border-color); transition: all 0.3s; }
    .stat-card:hover { transform: translateY(-5px); box-shadow: 0 10px 30px var(--category-glow); }
    .stat-icon { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 24px; flex-shrink: 0; }
    .stat-icon.primary { background: rgba(156, 39, 176, 0.12); color: var(--category-color); }
    .stat-icon.success { background: rgba(0, 200, 83, 0.12); color: var(--success); }
    .stat-icon.warning { background: rgba(255, 171, 0, 0.12); color: var(--warning); }
    .stat-icon.info { background: rgba(33, 150, 243, 0.12); color: var(--info); }
    .stat-icon.purple { background: rgba(146, 79, 194, 0.12); color: var(--primary); }
    .stat-icon.danger { background: rgba(255, 23, 68, 0.12); color: var(--danger); }
    .stat-label { font-size: 12px; color: var(--text-secondary); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
    .stat-value { font-size: 28px; font-weight: 800; color: var(--text-primary); margin: 4px 0 0 0; }
    .section-title { font-size: 18px; font-weight: 700; color: var(--text-primary); margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
    .section-title i { color: var(--category-color); }
    .quick-actions-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; margin-bottom: 30px; }
    .quick-action-card { background: var(--card-bg); border-radius: 16px; padding: 24px; text-align: center; cursor: pointer; transition: all 0.3s; border: 1px solid var(--border-color); text-decoration: none; display: block; }
    .quick-action-card:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0,0,0,0.1); border-color: var(--category-color); }
    .quick-action-icon { width: 60px; height: 60px; border-radius: 16px; background: linear-gradient(135deg, var(--category-color), #7B1FA2); display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 24px; color: white; }
    .quick-action-label { font-size: 14px; font-weight: 600; color: var(--text-primary); margin-bottom: 4px; }
    .quick-action-desc { font-size: 12px; color: var(--text-secondary); }
    .content-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 25px; }
    .content-card { background: var(--card-bg); border-radius: 16px; padding: 24px; border: 1px solid var(--border-color); }
    .content-card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid var(--border-color); }
    .content-card-title { font-size: 16px; font-weight: 700; color: var(--text-primary); display: flex; align-items: center; gap: 10px; }
    .content-card-title i { color: var(--category-color); }
    .empty-state { text-align: center; padding: 40px 20px; }
    .empty-state-icon { width: 80px; height: 80px; border-radius: 50%; background: var(--category-glow); display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 36px; color: var(--category-color); }
    .empty-state h4 { font-size: 18px; font-weight: 700; color: var(--text-primary); margin: 0 0 8px 0; }
    .empty-state p { color: var(--text-secondary); margin: 0 0 20px 0; }
    .btn-action { padding: 12px 24px; border-radius: 12px; font-weight: 600; font-size: 14px; transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; border: none; background: linear-gradient(135deg, var(--category-color), #7B1FA2); color: white; }
    @media (max-width: 1200px) { .category-panel { width: 95%; padding-left: 270px; } .content-grid { grid-template-columns: 1fr; } }
    @media (max-width: 992px) { .category-panel { width: 100%; padding-left: 20px; } .category-header { flex-direction: column; text-align: center; gap: 20px; } }
</style>

<div class="category-panel">
    <div class="category-header">
        <div><h1><i class="fas {{ $categoryIcon ?? 'fa-graduation-cap' }}"></i> {{ $categoryName ?? 'Education & Knowledge' }}</h1><p>Manage tutoring, training, courses, workshops and certification programs</p></div>
        <div class="category-header-actions"><a href="{{ route('admin.education-knowledge.courses') }}" class="btn-header outline"><i class="fas fa-book"></i> Manage Courses</a><button class="btn-header primary"><i class="fas fa-plus"></i> Add Course</button></div>
    </div>

    <div class="stats-grid">
        <div class="stat-card"><div class="stat-icon primary"><i class="fas fa-book-open"></i></div><div><div class="stat-label">Total Courses</div><div class="stat-value">{{ $stats['total_courses'] ?? 0 }}</div></div></div>
        <div class="stat-card"><div class="stat-icon info"><i class="fas fa-user-graduate"></i></div><div><div class="stat-label">Enrollments</div><div class="stat-value">{{ $stats['total_enrollments'] ?? 0 }}</div></div></div>
        <div class="stat-card"><div class="stat-icon success"><i class="fas fa-chalkboard-teacher"></i></div><div><div class="stat-label">Instructors</div><div class="stat-value">{{ $stats['total_instructors'] ?? 0 }}</div></div></div>
        <div class="stat-card"><div class="stat-icon warning"><i class="fas fa-users"></i></div><div><div class="stat-label">Students</div><div class="stat-value">{{ $stats['total_students'] ?? 0 }}</div></div></div>
        <div class="stat-card"><div class="stat-icon purple"><i class="fas fa-play-circle"></i></div><div><div class="stat-label">Active Courses</div><div class="stat-value">{{ $stats['active_courses'] ?? 0 }}</div></div></div>
        <div class="stat-card"><div class="stat-icon danger"><i class="fas fa-dollar-sign"></i></div><div><div class="stat-label">Revenue</div><div class="stat-value">{{ number_format($stats['total_revenue'] ?? 0) }}</div></div></div>
    </div>

    <h3 class="section-title"><i class="fas fa-bolt"></i> Quick Actions</h3>
    <div class="quick-actions-grid">
        <a href="{{ route('admin.education-knowledge.courses') }}" class="quick-action-card"><div class="quick-action-icon"><i class="fas fa-book-open"></i></div><div class="quick-action-label">Courses</div><div class="quick-action-desc">Manage courses</div></a>
        <a href="{{ route('admin.education-knowledge.enrollments') }}" class="quick-action-card"><div class="quick-action-icon"><i class="fas fa-user-plus"></i></div><div class="quick-action-label">Enrollments</div><div class="quick-action-desc">View enrollments</div></a>
        <a href="{{ route('admin.education-knowledge.instructors') }}" class="quick-action-card"><div class="quick-action-icon"><i class="fas fa-chalkboard-teacher"></i></div><div class="quick-action-label">Instructors</div><div class="quick-action-desc">Manage teachers</div></a>
        <a href="{{ route('admin.education-knowledge.materials') }}" class="quick-action-card"><div class="quick-action-icon"><i class="fas fa-file-alt"></i></div><div class="quick-action-label">Materials</div><div class="quick-action-desc">Learning resources</div></a>
        <a href="{{ route('admin.education-knowledge.students') }}" class="quick-action-card"><div class="quick-action-icon"><i class="fas fa-user-graduate"></i></div><div class="quick-action-label">Students</div><div class="quick-action-desc">Student database</div></a>
        <a href="{{ route('admin.education-knowledge.reports') }}" class="quick-action-card"><div class="quick-action-icon"><i class="fas fa-chart-bar"></i></div><div class="quick-action-label">Reports</div><div class="quick-action-desc">Analytics</div></a>
        <a href="{{ route('admin.education-knowledge.payments') }}" class="quick-action-card"><div class="quick-action-icon"><i class="fas fa-credit-card"></i></div><div class="quick-action-label">Payments</div><div class="quick-action-desc">Tuition fees</div></a>
        <a href="{{ route('admin.education-knowledge.reviews') }}" class="quick-action-card"><div class="quick-action-icon"><i class="fas fa-star"></i></div><div class="quick-action-label">Reviews</div><div class="quick-action-desc">Ratings</div></a>
        <a href="{{ route('admin.education-knowledge.settings') }}" class="quick-action-card"><div class="quick-action-icon"><i class="fas fa-cog"></i></div><div class="quick-action-label">Settings</div><div class="quick-action-desc">Config</div></a>
    </div>

    <div class="content-grid">
        <div class="content-card"><div class="content-card-header"><div class="content-card-title"><i class="fas fa-user-graduate"></i> Recent Enrollments</div><a href="{{ route('admin.education-knowledge.enrollments') }}" class="btn-action" style="padding: 8px 16px; font-size: 12px;">View All</a></div><div class="empty-state"><div class="empty-state-icon"><i class="fas fa-graduation-cap"></i></div><h4>No Enrollments Yet</h4><p>Start receiving enrollments by adding courses.</p><a href="{{ route('admin.education-knowledge.courses') }}" class="btn-action"><i class="fas fa-plus"></i> Add First Course</a></div></div>
        <div class="content-card"><div class="content-card-header"><div class="content-card-title"><i class="fas fa-history"></i> Activity</div></div><div class="empty-state" style="padding: 30px 10px;"><div class="empty-state-icon" style="width: 60px; height: 60px; font-size: 24px;"><i class="fas fa-clock"></i></div><h4 style="font-size: 16px;">No Activity</h4><p style="font-size: 13px;">Activity appears here.</p></div></div>
    </div>
</div>
