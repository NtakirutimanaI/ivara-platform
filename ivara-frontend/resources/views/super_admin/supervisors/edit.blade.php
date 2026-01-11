@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper">
    <style>
        .dashboard-wrapper {
            --primary: #4F46E5;
            --secondary: #64748B; 
            --accent: #924FC2;
        }

        .glass-input {
            width: 100%; padding: 12px; margin-top: 8px;
            border-radius: 10px; border: 1px solid #e5e7eb;
            background: #f9fafb;
            font-size: 14px; outline: none;
        }
        .glass-input:focus { border-color: var(--primary); background: #fff; }

        .btn-glass {
            padding: 10px 20px; border-radius: 12px; font-weight: 600; 
            border: none; cursor: pointer; transition: all 0.2s; text-decoration: none;
        }
        .btn-glass.primary { background: var(--primary); color: #fff; }
        .btn-glass.secondary { background: #f3f4f6; color: var(--secondary); margin-right: 10px; }

        /* Dark Mode Overrides */
        body.dark-mode .glass-panel { background: #1f2937 !important; border-color: #374151; }
        body.dark-mode .glass-input { background: #374151; color: #fff; border-color: #4b5563; }
        body.dark-mode label { color: #9ca3af !important; }
        body.dark-mode .pro-header h1 { color: #fff; }
        body.dark-mode .pro-header p { color: #9ca3af; }
        body.dark-mode .btn-glass.secondary { background: #374151 !important; color: #e5e7eb !important; border-color: #4b5563; }
        body.dark-mode h3 { color: #fff !important; }
    </style>

    <header class="pro-header">
        <div>
            <h1>Edit Supervisor</h1>
            <p>Update account details and permissions</p>
        </div>
        <div>
            <a href="{{ route('super_admin.supervisors.index') }}" class="btn-glass secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </header>

    <div class="pro-card glass-panel" style="max-width: 800px; margin: 0 auto;">
        <form id="editSupervisorForm" onsubmit="handleUpdateSupervisor(event)">
            @csrf
            @method('PUT')
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px;">
                <div style="grid-column: 1 / -1;">
                    <h3 style="margin: 0 0 15px; font-size: 1.1rem; color: var(--primary);">Account Information</h3>
                </div>

                <div>
                    <label style="font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase;">Full Name</label>
                    <input type="text" name="name" class="glass-input" value="{{ $admin['name'] }}" required>
                </div>
                <div>
                    <label style="font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase;">Email Address</label>
                    <input type="email" name="email" class="glass-input" value="{{ $admin['email'] }}" required>
                </div>
                
                <div>
                    <label style="font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase;">Role</label>
                    <select class="glass-input" name="role">
                        <option value="Field Supervisor" {{ $admin['role'] == 'Field Supervisor' ? 'selected' : '' }}>Field Supervisor</option>
                        <option value="Team Lead" {{ $admin['role'] == 'Team Lead' ? 'selected' : '' }}>Team Lead</option>
                        <option value="Site Inspector" {{ $admin['role'] == 'Site Inspector' ? 'selected' : '' }}>Site Inspector</option>
                    </select>
                </div>

                <div>
                    <label style="font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase;">Category Assignment</label>
                    <select class="glass-input" name="category">
                        <option value="" disabled>Select Category</option>
                        <option value="technical-repair" {{ $admin['category'] == 'Technical & Repair' ? 'selected' : '' }}>Technical & Repair</option>
                        <option value="creative-lifestyle" {{ $admin['category'] == 'Creative & Lifestyle' ? 'selected' : '' }}>Creative & Lifestyle</option>
                        <option value="transport-travel" {{ $admin['category'] == 'Transport & Travel' ? 'selected' : '' }}>Transport & Travel</option>
                        <option value="food-fashion-events" {{ $admin['category'] == 'Food, Fashion & Events' ? 'selected' : '' }}>Food, Fashion & Events</option>
                        <option value="education-knowledge" {{ $admin['category'] == 'Education & Knowledge' ? 'selected' : '' }}>Education & Knowledge</option>
                        <option value="agriculture-environment" {{ $admin['category'] == 'Agriculture & Environment' ? 'selected' : '' }}>Agriculture & Environment</option>
                        <option value="media-entertainment" {{ $admin['category'] == 'Media & Entertainment' ? 'selected' : '' }}>Media & Entertainment</option>
                        <option value="legal-professional" {{ $admin['category'] == 'Legal & Professional' ? 'selected' : '' }}>Legal & Professional</option>
                        <option value="other-services" {{ $admin['category'] == 'Other Services' ? 'selected' : '' }}>Other Services</option>
                    </select>
                </div>

                <div style="grid-column: 1 / -1; margin-top: 15px;">
                    <h3 style="margin: 0 0 15px; font-size: 1.1rem; color: var(--primary);">Security</h3>
                </div>

                <div>
                    <label style="font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase;">New Password (Optional)</label>
                    <input type="password" name="password" class="glass-input" placeholder="Leave blank to keep current">
                </div>
                <div>
                    <label style="font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase;">Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="glass-input">
                </div>
            </div>

            <div style="margin-top: 35px; display: flex; justify-content: flex-end; gap: 10px; padding-top: 20px; border-top: 1px solid #e5e7eb;">
                <a href="{{ route('super_admin.supervisors.index') }}" class="btn-glass secondary" style="background: transparent; border: 1px solid #e5e7eb;">Cancel</a>
                <button type="submit" class="btn-glass primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
    function handleUpdateSupervisor(e) {
        e.preventDefault();
        const form = document.getElementById('editSupervisorForm');
        const formData = new FormData(form);
        formData.append('_method', 'PUT');

        fetch("{{ route('super_admin.supervisors.update', $id) }}", {
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
                toastr.success(data.message);
                setTimeout(() => {
                    window.location.href = "{{ route('super_admin.supervisors.index') }}";
                }, 1000);
            } else {
                toastr.error('Error updating supervisor');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            toastr.error('Something went wrong');
        });
    }
</script>
@endsection
