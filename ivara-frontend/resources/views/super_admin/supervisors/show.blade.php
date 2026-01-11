@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper">
    <style>
        .dashboard-wrapper {
            --primary: #4F46E5;
            --secondary: #64748B; 
            --accent: #924FC2;
        }
        
        .profile-header-card {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 20px;
            padding: 40px;
            color: white;
            display: flex;
            align-items: center;
            gap: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.4);
        }
        
        .profile-avatar {
            width: 100px; height: 100px;
            border-radius: 50%;
            border: 4px solid rgba(255,255,255,0.3);
            background: #fff;
        }

        .stat-badge {
            background: rgba(255,255,255,0.2);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            backdrop-filter: blur(5px);
        }

        .grid-layout {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 30px;
        }

        .info-row {
            padding: 15px 0;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
        }
        .info-label { color: var(--secondary); font-weight: 500; font-size: 0.9rem; }
        .info-value { color: #1e293b; font-weight: 600; }

        /* Dark Mode */
        body.dark-mode .info-row { border-bottom-color: #374151; }
        body.dark-mode .info-label { color: #9ca3af; }
        body.dark-mode .info-value { color: #f3f4f6; }
        body.dark-mode .glass-panel { background: #1f2937 !important; border-color: #374151; }
        body.dark-mode h3 { color: #fff !important; }
        body.dark-mode .pro-header h1 { color: #fff; }
        body.dark-mode .action-btn.secondary { background: #374151; color: #fff; border: 1px solid #4b5563; }
    </style>

    {{-- Variables from Controller --}}
    @php
        $name = $admin['name'] ?? 'Unknown';
        $role = $admin['role'] ?? 'Supervisor';
        $email = $admin['email'] ?? 'N/A';
        $category = $admin['category'] ?? 'General';
        $status = $admin['status'] ?? 'offline';
    @endphp

    <header class="pro-header">
        <div>
            <h1>Supervisor Profile</h1>
            <p>View supervisor details and activity</p>
        </div>
        <div>
            <a href="{{ route('super_admin.supervisors.index') }}" class="action-btn secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <a href="{{ route('super_admin.supervisors.edit', $id) }}" class="action-btn btn-primary" style="margin-left: 10px;">
                <i class="fas fa-edit"></i> Edit Profile
            </a>
        </div>
    </header>

    <div class="profile-header-card">
        <img src="https://ui-avatars.com/api/?name={{ urlencode($name) }}&background=ffffff&color=4F46E5" class="profile-avatar" alt="Avatar">
        <div style="flex: 1;">
            <h2 style="margin: 0; font-size: 2rem; font-weight: 800;">{{ $name }}</h2>
            <div style="display: flex; gap: 10px; margin-top: 10px;">
                <span class="stat-badge"><i class="fas fa-id-badge"></i> {{ $role }}</span>
                <span class="stat-badge"><i class="fas fa-circle" style="color: {{ $status == 'online' ? '#4ade80' : '#ccc' }};"></i> {{ ucfirst($status) }}</span>
                <span class="stat-badge"><i class="fas fa-clock"></i> Joined Jan 2024</span>
            </div>
        </div>
        <div style="text-align: right;">
            <div style="font-size: 2rem; font-weight: 800;">98%</div>
            <div style="opacity: 0.8; font-size: 0.9rem;">Satisfaction Score</div>
        </div>
    </div>

    <div class="grid-layout">
        <div class="pro-card glass-panel" style="height: fit-content;">
            <h3 style="margin-top: 0; color: #1e293b;">Contact Info</h3>
            
            <div class="info-row">
                <span class="info-label">Email</span>
                <span class="info-value">{{ $email }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Phone</span>
                <span class="info-value">+250 788 123 456</span>
            </div>
            <div class="info-row">
                <span class="info-label">Location</span>
                <span class="info-value">Kigali, Rwanda</span>
            </div>
            <div class="info-row">
                <span class="info-label">Category</span>
                <span class="info-value">{{ $category }}</span>
            </div>
        </div>

        <div class="pro-card glass-panel">
            <h3 style="margin-top: 0; color: #1e293b; margin-bottom: 20px;">Recent Activity</h3>
            
            <div class="timeline-container">
                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                        <h4 style="margin: 0; font-size: 1rem;">Site Inspection Completed</h4>
                        <p style="margin: 5px 0 0; color: var(--text-muted); font-size: 0.85rem;">2 hours ago</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-marker" style="background: #924FC2;"></div>
                    <div class="timeline-content">
                        <h4 style="margin: 0; font-size: 1rem;">Task Escalation</h4>
                        <p style="margin: 5px 0 0; color: var(--text-muted); font-size: 0.85rem;">Yesterday, 4:30 PM</p>
                    </div>
                </div>
                <!-- ... -->
            </div>
        </div>
    </div>
</div>
@endsection
