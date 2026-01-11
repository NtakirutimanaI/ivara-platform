@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper" style="padding-top: 120px !important;">
    <style>
        /* Scoped Theme Variables */
        .dashboard-page .content .dashboard-wrapper {
            --primary: #4F46E5;
            --secondary: #64748B; 
            --accent: #924FC2;
            padding-top: 120px !important; 
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.5); z-index: 11000;
            display: none; align-items: center; justify-content: center;
            backdrop-filter: blur(5px);
        }
        .modal-glass {
            background: #ffffff; padding: 30px; border-radius: 20px;
            width: 500px; max-width: 90%;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);
            animation: zoomIn 0.2s ease;
        }
        .modal-header-custom {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 25px;
        }
        .modal-header-custom h3 { margin: 0; font-size: 20px; font-weight: 700; }
        
        .glass-input {
            width: 100%; padding: 12px; margin-top: 8px;
            border-radius: 10px; border: 1px solid #e5e7eb;
            background: #f9fafb;
            font-size: 14px; outline: none;
        }
        
        @keyframes zoomIn { from{opacity:0; transform:scale(0.95);} to{opacity:1; transform:scale(1);} }

        /* Custom buttons */
        .btn-glass {
            padding: 10px 20px; border-radius: 12px; font-weight: 600; 
            border: none; cursor: pointer; transition: all 0.2s;
        }
        .btn-glass.primary { background: var(--primary); color: #fff; }

        .employee-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 25px; }
        
        .card-menu { position: absolute; top: 15px; right: 15px; }
        .menu-dots { background: none; border: none; font-size: 14px; color: #6b7280; cursor: pointer; }
        .dropdown-menu-custom {
            position: absolute; right: 0; top: 20px; background: #fff; 
            border-radius: 8px; width: 120px; display: none; box-shadow: 0 4px 12px rgba(0,0,0,0.1); z-index: 10;
        }
        .card-menu:hover .dropdown-menu-custom { display: block; }
        .dropdown-menu-custom button, .dropdown-menu-custom a {
            display: block; width: 100%; padding: 8px 12px; text-align: left; background: none; 
            border: none; font-size: 12px; color: #374151; text-decoration: none; cursor: pointer;
        }
        .dropdown-menu-custom button:hover, .dropdown-menu-custom a:hover { background: #f3f4f6; color: var(--primary); }

        .category-separator {
            grid-column: 1 / -1; margin-top: 20px; margin-bottom: 10px;
            display: flex; align-items: center; gap: 10px;
        }
        .category-separator h3 { font-size: 18px; font-weight: 700; margin: 0; }
        .category-line { flex: 1; height: 1px; background: #e5e7eb; }

        /* Dark Mode Overrides */
        body.dark-mode .category-separator h3 { color: #e5e7eb !important; }
        body.dark-mode .category-line { background: #374151 !important; }
        body.dark-mode .employee-card.glass-panel { background: #1f2937 !important; border: 1px solid #374151; }
        body.dark-mode .card-profile h4 { color: #f3f4f6 !important; }
        body.dark-mode .card-details .detail-item { color: #9ca3af !important; }
        body.dark-mode .card-menu .menu-dots { color: #9ca3af !important; }
        body.dark-mode .glass-panel { background: #1f2937 !important; border-color: #374151; }
        body.dark-mode .text-muted { color: #9ca3af !important; }
        body.dark-mode .card-actions .btn-action { background: #374151 !important; color: #e5e7eb !important; }
        body.dark-mode .modal-glass { background: #1f2937; color: #fff; }
        body.dark-mode .glass-input { background: #374151; color: #fff; border-color: #4b5563; }
        body.dark-mode .btn-close-custom { color: #fff; }
        body.dark-mode .dropdown-menu-custom { background: #1f2937; border: 1px solid #374151; box-shadow: 0 4px 12px rgba(0,0,0,0.3); }
        body.dark-mode .dropdown-menu-custom button, body.dark-mode .dropdown-menu-custom a { color: #e5e7eb; }
        body.dark-mode .dropdown-menu-custom button:hover, body.dark-mode .dropdown-menu-custom a:hover { background: #374151; }
    </style>

    {{-- Header --}}
    <header class="pro-header">
        <div>
            <h1>Manager Management</h1>
            <p>Oversee your category and area managers</p>
        </div>
        <div>
            <button type="button" class="btn-primary action-btn" onClick="document.getElementById('createManagerModal').style.display='flex'">
                <i class="fas fa-plus-circle"></i> Create New Manager
            </button>
        </div>
    </header>

    {{-- Stats Row --}}
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px; margin-bottom: 25px;">
        <div class="glass-panel d-flex align-items-center gap-2" style="padding: 12px 15px;">
            <div class="metric-icon" style="background: rgba(147, 51, 234, 0.1); color: #9333ea; width:38px; height:38px; min-width:38px; display:flex; align-items:center; justify-content:center; border-radius:10px;">
                <i class="fas fa-user-tie" style="font-size: 1rem;"></i>
            </div>
            <div style="line-height: 1.2;">
                <h3 class="m-0 fw-bold" style="font-size: 1.2rem;">45</h3>
                <span class="text-muted" style="font-size: 0.75rem; font-weight: 600;">Total Managers</span>
            </div>
        </div>
        <!-- Other stats... keeping same structure -->
       <div class="glass-panel d-flex align-items-center gap-2" style="padding: 12px 15px;">
             <div class="metric-icon" style="background: rgba(16, 185, 129, 0.1); color: #10b981; width:38px; height:38px; min-width:38px; display:flex; align-items:center; justify-content:center; border-radius:10px;">
                <i class="fas fa-circle" style="font-size: 0.8rem;"></i>
            </div>
            <div style="line-height: 1.2;">
                <h3 class="m-0 fw-bold" style="font-size: 1.2rem;">32</h3>
                <span class="text-muted" style="font-size: 0.75rem; font-weight: 600;">Online Now</span>
            </div>
        </div>
        <div class="glass-panel d-flex align-items-center gap-2" style="padding: 12px 15px;">
            <div class="metric-icon" style="background: rgba(59, 130, 246, 0.1); color: #3b82f6; width:38px; height:38px; min-width:38px; display:flex; align-items:center; justify-content:center; border-radius:10px;">
                <i class="fas fa-video" style="font-size: 0.9rem;"></i>
            </div>
            <div style="line-height: 1.2;">
                <h3 class="m-0 fw-bold" style="font-size: 1.2rem;">8</h3>
                <span class="text-muted" style="font-size: 0.75rem; font-weight: 600;">Meetings Today</span>
            </div>
        </div>
        <div class="glass-panel d-flex align-items-center gap-2" style="padding: 12px 15px;">
             <div class="metric-icon" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b; width:38px; height:38px; min-width:38px; display:flex; align-items:center; justify-content:center; border-radius:10px;">
                <i class="fas fa-bell" style="font-size: 0.9rem;"></i>
            </div>
            <div style="line-height: 1.2;">
                <h3 class="m-0 fw-bold" style="font-size: 1.2rem;">5</h3>
                <span class="text-muted" style="font-size: 0.75rem; font-weight: 600;">New Updates</span>
            </div>
        </div>
    </div>

    <div>
        <div class="pro-card glass-panel">
            <div class="panel-toolbar mb-4 d-flex justify-content-between align-items-center">
                <div class="mega-search" style="max-width: 400px;">
                    <i class="fas fa-search"></i>
                    <input type="text" id="employeeSearch" placeholder="Search managers..." onkeyup="filterEmployees()">
                </div>
            </div>

            <div class="all-admins-wrapper">
                @foreach($categories as $cat)
                    @php 
                        $group = $admins[$cat['name']] ?? [];
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
                                            <a href="{{ route('super_admin.managers.show', $item['id']) }}">View Profile</a>
                                            <button onclick="suspendUser(event, {{ $item['id'] }})" style="color: #ef4444; width: 100%; text-align: left; background: none; border: none; padding: 8px 12px; font-size: 12px; cursor: pointer;">Suspend</button>
                                        </div>
                                    </div>
                                    
                                    <div class="card-profile" style="margin-bottom: 15px;">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($item['name']) }}&background=E0E7FF&color=4F46E5&size=128" class="avatar-img" alt="Avatar" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 3px solid #fff; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                                        <h4 style="margin: 10px 0 5px; font-size: 1.1rem; font-weight: 700;">{{ $item['name'] }}</h4>
                                        <span class="role" style="font-size: 0.85rem; color: #6b7280; font-weight: 500; background: #f3f4f6; padding: 4px 10px; border-radius: 20px;">{{ $item['role'] }}</span>
                                    </div>

                                    <div class="card-details" style="width: 100%; margin-bottom: 20px;">
                                        <div class="detail-item" style="font-size: 0.9rem; color: #4b5563; margin-bottom: 8px;">
                                            <i class="far fa-envelope" style="color: #9ca3af; margin-right: 5px;"></i> {{ $item['email'] }}
                                        </div>
                                        <div class="detail-item" style="font-size: 0.9rem; color: #4b5563; margin-bottom: 8px;">
                                            <i class="fas fa-circle" style="font-size: 8px; margin-right: 5px; color: {{ $item['status'] == 'online' ? '#10b981' : '#ccc' }}"></i> 
                                            {{ ucfirst($item['status']) }}
                                        </div>
                                    </div>

                                    <div class="card-actions" style="display: flex; gap: 10px; justify-content: center; width: 100%;">
                                        <button class="btn-action" onclick="openMessageModal({{ $item['id'] }}, '{{ $item['name'] }}')" title="Message" style="background: #f3f4f6; color: #4b5563; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: none; cursor: pointer; transition: 0.2s;"><i class="far fa-comment-alt"></i></button>
                                        <a href="{{ route('super_admin.managers.edit', $item['id']) }}" class="btn-action" title="Edit" style="background: #f3f4f6; color: #4b5563; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: 0.2s;"><i class="far fa-edit"></i></a>
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
                <h3>No managers found</h3>
                <p>Try adjusting your search query</p>
            </div>
        </div>
    </div>
</div>

{{-- Create Manager Modal --}}
<div id="createManagerModal" class="modal-overlay">
    <div class="modal-glass">
        <div class="modal-header-custom">
            <h3>Register New Manager</h3>
            <button class="btn-close-custom" onclick="document.getElementById('createManagerModal').style.display='none'">&times;</button>
        </div>
        <form id="createManagerForm" onsubmit="handleCreateManager(event)">
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
                        <option value="Area Manager">Area Manager</option>
                        <option value="Category Manager">Category Manager</option>
                        <option value="Operations Manager">Operations Manager</option>
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
                <button type="button" class="btn-glass" onclick="document.getElementById('createManagerModal').style.display='none'">Cancel</button>
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

    function handleCreateManager(e) {
        e.preventDefault();
        const form = document.getElementById('createManagerForm');
        const formData = new FormData(form);
        const categorySelect = form.querySelector('select[name="category"]');
        const categoryName = categorySelect.options[categorySelect.selectedIndex].text;

        fetch("{{ route('super_admin.managers.store') }}", {
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
                document.getElementById('createManagerModal').style.display = 'none';
                form.reset();
                setTimeout(() => location.reload(), 1000); // Simple reload for now to reflect new data
            } else {
                showToast('Error creating manager', 'error');
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
