@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper">
    <style>
        /* Scoped Theme Variables */
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
    </style>

    {{-- Header --}}
    <header class="pro-header">
        <div>
            <h1>Edit Administrator</h1>
            <p>Update account details and permissions</p>
        </div>
        <div>
            <a href="{{ route('super_admin.admins.index') }}" class="btn-glass secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </header>

    <div class="pro-card glass-panel" style="max-width: 800px; margin: 0 auto;">
        <form id="editAdminForm" onsubmit="handleUpdateAdmin(event)">
            @csrf
            @method('PUT')
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px;">
                {{-- Mocking data since we don't have a DB connected yet for this $id --}}
                @php
                    $mockName = 'Sarah Connor';
                    $mockEmail = 'sarah@ivara.com';
                    if(is_numeric($id) && $id > 1000) { $mockName = 'Assistant ' . ($id/1000); $mockEmail = 'assist'.$id.'@ivara.com'; }
                @endphp

                <div style="grid-column: 1 / -1;">
                    <h3 style="margin: 0 0 15px; font-size: 1.1rem; color: var(--primary);">Account Information</h3>
                </div>

                <div>
                    <label style="font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase;">Full Name</label>
                    <input type="text" name="name" class="glass-input" value="{{ $mockName }}" required>
                </div>
                <div>
                    <label style="font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase;">Email Address</label>
                    <input type="email" name="email" class="glass-input" value="{{ $mockEmail }}" required>
                </div>
                
                <div>
                    <label style="font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase;">Role</label>
                    <select class="glass-input" name="role">
                        <option value="super_admin">Super Administrator</option>
                        <option value="admin">Platform Admin</option>
                        <option value="manager" selected>Category Manager</option>
                        <option value="support">Support Agent</option>
                        <option value="finance">Finance Officer</option>
                    </select>
                </div>

                <div>
                    <label style="font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase;">Category Assignment</label>
                    <select class="glass-input" name="category">
                        <option value="" disabled>Select Category</option>
                        <option value="technical-repair" selected>Technical & Repair</option>
                        <option value="creative-lifestyle">Creative & Lifestyle</option>
                        <option value="transport-travel">Transport & Travel</option>
                        <option value="food-fashion-events">Food, Fashion & Events</option>
                        <option value="education-knowledge">Education & Knowledge</option>
                        <option value="agriculture-environment">Agriculture & Environment</option>
                        <option value="media-entertainment">Media & Entertainment</option>
                        <option value="legal-professional">Legal & Professional</option>
                        <option value="other-services">Other Services</option>
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
                <a href="{{ route('super_admin.admins.index') }}" class="btn-glass secondary" style="background: transparent; border: 1px solid #e5e7eb;">Cancel</a>
                <button type="submit" class="btn-glass primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
    function handleUpdateAdmin(e) {
        e.preventDefault();
        const form = document.getElementById('editAdminForm');
        const formData = new FormData(form);
        // Add _method PUT for Laravel to process it as PUT request
        formData.append('_method', 'PUT');

        fetch("{{ route('super_admin.admins.update', $id) }}", {
            method: "POST", // Browser forms support POST, Laravel reads _method
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
                // Optional: Redirect after short delay
                setTimeout(() => {
                    window.location.href = "{{ route('super_admin.admins.index') }}";
                }, 1000);
            } else {
                toastr.error('Error updating admin');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            toastr.error('Something went wrong');
        });
    }
</script>
@endsection
