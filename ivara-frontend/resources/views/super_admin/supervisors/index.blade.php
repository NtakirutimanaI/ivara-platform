@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper" style="padding-top: 40px !important;">
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
        border: none; cursor: pointer; transition: all 0.3s ease;
        display: inline-flex; align-items: center; gap: 10px; font-size: 0.9rem;
    }
    .btn-glass:hover { transform: translateY(-3px); }
    .btn-glass.primary { background: var(--p-indigo); color: #fff; box-shadow: 0 10px 20px rgba(79, 70, 229, 0.3); }

    /* Grid & Cards */
    .employee-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 24px; }
    
    .employee-card {
        background: var(--glass-bg); border: 1px solid var(--glass-border);
        border-radius: 32px; transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative; overflow: hidden; height: 100%;
        backdrop-filter: blur(20px); box-shadow: var(--card-shadow);
    }
    .employee-card:hover { transform: translateY(-10px); box-shadow: var(--premium-shadow); border-color: var(--p-indigo); }
    
    .category-separator {
        grid-column: 1 / -1; margin-top: 40px; margin-bottom: 25px;
        display: flex; align-items: center; gap: 20px;
    }
    .category-separator h3 { font-size: 1.25rem; font-weight: 900; color: var(--text-main); margin: 0; letter-spacing: -0.5px; }
    .category-line { flex: 1; height: 1px; background: var(--glass-border); }

    .card-profile h4 { color: var(--text-main); font-weight: 900; margin-bottom: 8px; }
    .role-badge {
        display: inline-block; padding: 6px 14px; border-radius: 50px;
        background: var(--p-indigo-light); color: var(--p-indigo);
        font-weight: 800; font-size: 0.7rem; text-transform: uppercase;
    }

    .card-menu { position: absolute; top: 20px; right: 20px; }
    .menu-dots { 
        width: 34px; height: 34px; border: none; background: rgba(0,0,0,0.03); 
        color: var(--text-muted); border-radius: 10px; cursor: pointer; transition: 0.3s;
    }
    .menu-dots:hover { background: var(--p-indigo); color: #fff; transform: rotate(90deg); }

    .dropdown-menu-custom {
        position: absolute; right: 0; top: 40px; background: var(--glass-bg); 
        border-radius: 18px; width: 160px; display: none; 
        border: 1px solid var(--glass-border);
        box-shadow: var(--premium-shadow); z-index: 50;
        overflow: hidden; backdrop-filter: blur(20px);
    }
    .card-menu:hover .dropdown-menu-custom { display: block; animation: slideIn 0.3s ease; }
    @keyframes slideIn { from{opacity:0; transform:translateY(-10px);} to{opacity:1; transform:translateY(0);} }

    .dropdown-menu-custom button, .dropdown-menu-custom a {
        display: block; width: 100%; padding: 12px 18px; text-align: left; background: none; 
        border: none; font-size: 0.85rem; color: var(--text-main); font-weight: 600;
        transition: 0.2s; border-bottom: 1px solid var(--glass-border);
    }
    .dropdown-menu-custom button:hover { background: var(--p-indigo-light); color: var(--p-indigo); }
</style>

    {{-- Header --}}
    <header class="pro-header">
        <div>
            <h1>Supervisor Management</h1>
            <p>Manage field supervisors and team leads</p>
        </div>
        <div>
            <button type="button" class="btn-primary action-btn" onClick="document.getElementById('createSupervisorModal').style.display='flex'">
                <i class="fas fa-plus-circle"></i> Create New Supervisor
            </button>
        </div>
    </header>

    {{-- Stats Row --}}
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px; margin-bottom: 25px;">
        <div class="glass-panel d-flex align-items-center gap-2" style="padding: 12px 15px;">
            <div class="metric-icon" style="background: rgba(147, 51, 234, 0.1); color: #9333ea; width:38px; height:38px; min-width:38px; display:flex; align-items:center; justify-content:center; border-radius:10px;">
                <i class="fas fa-user-check" style="font-size: 1rem;"></i>
            </div>
            <div style="line-height: 1.2;">
                <h3 class="m-0 fw-bold" style="font-size: 1.2rem;">{{ $overview['total_supervisors'] }}</h3>
                <span class="text-muted" style="font-size: 0.75rem; font-weight: 600;">Total Supervisors</span>
            </div>
        </div>
        <div class="glass-panel d-flex align-items-center gap-2" style="padding: 12px 15px;">
             <div class="metric-icon" style="background: rgba(16, 185, 129, 0.1); color: #10b981; width:38px; height:38px; min-width:38px; display:flex; align-items:center; justify-content:center; border-radius:10px;">
                <i class="fas fa-circle" style="font-size: 0.8rem;"></i>
            </div>
            <div style="line-height: 1.2;">
                <h3 class="m-0 fw-bold" style="font-size: 1.2rem;">{{ $overview['online_supervisors'] }}</h3>
                <span class="text-muted" style="font-size: 0.75rem; font-weight: 600;">Online Now</span>
            </div>
        </div>
         <div class="glass-panel d-flex align-items-center gap-2" style="padding: 12px 15px;">
            <div class="metric-icon" style="background: rgba(59, 130, 246, 0.1); color: #3b82f6; width:38px; height:38px; min-width:38px; display:flex; align-items:center; justify-content:center; border-radius:10px;">
                <i class="fas fa-check-double" style="font-size: 0.9rem;"></i>
            </div>
            <div style="line-height: 1.2;">
                <h3 class="m-0 fw-bold" style="font-size: 1.2rem;">{{ $overview['total_orders'] }}</h3>
                <span class="text-muted" style="font-size: 0.75rem; font-weight: 600;">Tasks Verified</span>
            </div>
        </div>
         <div class="glass-panel d-flex align-items-center gap-2" style="padding: 12px 15px;">
             <div class="metric-icon" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b; width:38px; height:38px; min-width:38px; display:flex; align-items:center; justify-content:center; border-radius:10px;">
                <i class="fas fa-bell" style="font-size: 0.9rem;"></i>
            </div>
            <div style="line-height: 1.2;">
                <h3 class="m-0 fw-bold" style="font-size: 1.2rem;">3</h3>
                <span class="text-muted" style="font-size: 0.75rem; font-weight: 600;">New Updates</span>
            </div>
        </div>
    </div>

    <div>
        <div class="pro-card glass-panel">
            <div class="panel-toolbar mb-4 d-flex justify-content-between align-items-center">
                <div class="mega-search" style="max-width: 400px;">
                    <i class="fas fa-search"></i>
                    <input type="text" id="employeeSearch" placeholder="Search supervisors..." onkeyup="filterEmployees()">
                </div>
            </div>

            <div class="all-admins-wrapper">
                @foreach($categories as $cat)
                    @php 
                        $group = $supervisors[$cat['slug']] ?? [];
                    @endphp
                    @if(count($group) > 0)
                        <div class="category-section" style="margin-bottom: 40px;">
                            <div class="category-separator" style="margin-bottom: 25px; display: flex; align-items: center; gap: 15px; justify-content: center;">
                                <div class="category-line" style="flex: 1; height: 1px; background: #e5e7eb;"></div>
                                <h3 style="font-size: 1.1rem; font-weight: 700; color: #4b5563; margin: 0; white-space: nowrap;">{{ $cat['name'] }}</h3>
                                <div class="category-line" style="flex: 1; height: 1px; background: #e5e7eb;"></div>
                            </div>

                            <div class="cards-container" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 30px;">
                                @foreach($group as $item)
                                <div class="employee-card glass-panel" style="width: 320px; padding: 25px; display: flex; flex-direction: column; align-items: center; text-align: center; position: relative;">
                                    <div class="card-menu" style="position: absolute; top: 15px; right: 15px;">
                                        <button class="menu-dots"><i class="fas fa-ellipsis-v"></i></button>
                                        <div class="dropdown-menu-custom">
                                            <button onclick="openMessageModal({{ $item['id'] }}, '{{ $item['name'] }}')">Message</button>
                                            <a href="{{ route('super_admin.supervisors.show', $item['id']) }}">View Profile</a>
                                            <button onclick="suspendUser(event, {{ $item['id'] }})" style="color: #ef4444; width: 100%; text-align: left; background: none; border: none; padding: 8px 12px; font-size: 12px; cursor: pointer;">Suspend</button>
                                        </div>
                                    </div>
                                    
                                    <div class="card-profile" style="margin-bottom: 15px;">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($item['name']) }}&background=E0E7FF&color=4F46E5&size=128" class="avatar-img" alt="Avatar" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 3px solid #fff; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                                        <h4 style="margin: 10px 0 5px; font-size: 1.1rem; font-weight: 700;">{{ $item['name'] }}</h4>
                                        <span class="role-badge">{{ $item['role'] }}</span>
                                    </div>

                                    <div class="card-details" style="width: 100%; margin-bottom: 20px;">
                                        <div class="detail-item" style="margin-bottom: 8px;">
                                            <i class="far fa-envelope" style="color: #9ca3af; margin-right: 5px;"></i> {{ $item['email'] }}
                                        </div>
                                        <div class="detail-item" style="margin-bottom: 8px;">
                                            <i class="fas fa-circle" style="font-size: 8px; margin-right: 5px; color: {{ $item['status'] == 'online' ? '#10b981' : '#ccc' }}"></i> 
                                            {{ ucfirst($item['status']) }}
                                        </div>
                                    </div>

                                    <div class="card-actions" style="display: flex; gap: 10px; justify-content: center; width: 100%;">
                                        <button class="btn-action" onclick="openMessageModal({{ $item['id'] }}, '{{ $item['name'] }}')" title="Message"><i class="far fa-comment-alt"></i></button>
                                        <a href="{{ route('super_admin.supervisors.edit', $item['id']) }}" class="btn-action" title="Edit"><i class="far fa-edit"></i></a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
             <div id="noResults" class="empty-state" style="display: none; text-align: center; padding: 40px; color: #6b7280;">
                <i class="far fa-folder-open" style="font-size: 48px; opacity: 0.5;"></i>
                <h3>No supervisors found</h3>
                <p>Try adjusting your search query</p>
            </div>
        </div>
    </div>
</div>

{{-- Create Supervisor Modal --}}
<div id="createSupervisorModal" class="modal-overlay">
    <div class="modal-glass">
        <div class="modal-header-custom">
            <h3>Register New Supervisor</h3>
            <button class="btn-close-custom" onclick="document.getElementById('createSupervisorModal').style.display='none'">&times;</button>
        </div>
        <form id="createSupervisorForm" onsubmit="handleCreateSupervisor(event)">
            @csrf
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div>
                    <label style="font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase;">Full Name</label>
                    <input type="text" name="name" class="glass-input" required>
                </div>
                <div>
                    <label style="font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase;">Email Address</label>
                    <input type="email" name="email" class="glass-input" required>
                </div>
                
                <div>
                    <label style="font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase;">Role</label>
                    <select class="glass-input" name="role">
                        <option value="Field Supervisor">Field Supervisor</option>
                        <option value="Team Lead">Team Lead</option>
                        <option value="Site Inspector">Site Inspector</option>
                    </select>
                </div>

                <div>
                    <label style="font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase;">Category</label>
                    <select class="glass-input" name="category">
                        @foreach($categories as $cat)
                             <option value="{{ Str::slug($cat['name']) }}">{{ $cat['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label style="font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase;">Password</label>
                    <input type="password" name="password" class="glass-input" required>
                </div>
                <div>
                    <label style="font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase;">Confirm</label>
                    <input type="password" name="password_confirmation" class="glass-input" required>
                </div>
            </div>

            <div style="margin-top: 25px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="btn-glass" onclick="document.getElementById('createSupervisorModal').style.display='none'">Cancel</button>
                <button type="submit" class="btn-glass primary">Create Account</button>
            </div>
        </form>
    </div>
</div>

<script>
    function showToast(message, type = 'success') {
        toastr.options = { "positionClass": "toast-top-right", "timeOut": "3000" };
        if(type === 'success') toastr.success(message); else toastr.error(message);
    }

    function handleCreateSupervisor(e) {
        e.preventDefault();
        const form = document.getElementById('createSupervisorForm');
        const formData = new FormData(form);

        fetch("{{ route('super_admin.supervisors.store') }}", {
            method: "POST",
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                "Accept": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                showToast(data.message);
                document.getElementById('createSupervisorModal').style.display = 'none';
                form.reset();
                setTimeout(() => location.reload(), 1000); 
            } else {
                showToast('Error creating supervisor', 'error');
            }
        });
    }

    function filterEmployees() {
        // Reuse filter logic
        const input = document.getElementById('employeeSearch').value.toLowerCase();
        document.querySelectorAll('.employee-card').forEach(card => {
             const text = card.textContent.toLowerCase();
             card.style.display = text.includes(input) ? 'flex' : 'none';
        });
    }
</script>
@endsection
