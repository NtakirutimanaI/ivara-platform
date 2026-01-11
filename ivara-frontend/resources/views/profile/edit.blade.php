@extends('layouts.app')

@section('title', 'Edit Profile - IVARA')

@section('styles')
<style>
    /* Profile specific styles overriding or adding to global */
    .profile-container {
        padding: 40px 20px;
        display: flex;
        justify-content: center;
        width: 100%;
        margin-top: 60px; /* Offset for fixed header if needed, though dashboard-pro.css usually handles it */
    }

    .edit-card {
        background: var(--surface);
        border: 1px solid var(--header-border);
        border-radius: 20px;
        padding: 40px;
        max-width: 800px;
        width: 100%;
        box-shadow: 0 20px 40px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }

    [data-theme="dark"] .edit-card {
        box-shadow: 0 20px 40px rgba(0,0,0,0.3);
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 10px;
        color: var(--text-main);
        border-bottom: 1px solid var(--header-border);
        padding-bottom: 15px;
    }

    .section-desc {
        font-size: 0.95rem;
        color: var(--text-muted);
        margin-bottom: 30px;
        line-height: 1.5;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        display: block;
        margin-bottom: 10px;
        font-weight: 600;
        color: var(--text-main);
        font-size: 0.95rem;
    }

    .form-input {
        width: 100%;
        padding: 14px 16px;
        border-radius: 12px;
        border: 1px solid var(--header-border);
        background: var(--body-bg); /* Slight contrast from card */
        color: var(--text-main);
        font-size: 1rem;
        outline: none;
        transition: all 0.3s;
    }

    .form-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        background: var(--surface);
    }

    .btn {
        padding: 12px 28px;
        border-radius: 12px;
        border: none;
        cursor: pointer;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn:hover { transform: translateY(-2px); }
    .btn-primary { 
        background: linear-gradient(135deg, var(--primary), var(--indigo)); 
        color: #fff; 
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }
    .btn-secondary { 
        background: transparent; 
        color: var(--text-muted); 
        border: 1px solid var(--header-border); 
    }
    .btn-secondary:hover {
        background: var(--body-bg);
        color: var(--text-main);
    }
    .btn-danger { background: #ef4444; color: #fff; }

    .grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
    }

    @media (max-width: 768px) {
        .grid-2 { grid-template-columns: 1fr; }
        .profile-container { padding: 20px; margin-top: 20px; }
        .edit-card { padding: 25px; }
    }

    .avatar-upload {
        display: flex;
        align-items: center;
        gap: 30px;
        margin-bottom: 35px;
        padding: 20px;
        background: var(--body-bg);
        border-radius: 16px;
        border: 1px dashed var(--header-border);
    }
    
    .avatar-preview {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: var(--surface);
        overflow: hidden;
        border: 3px solid var(--surface);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .avatar-preview img { width: 100%; height: 100%; object-fit: cover; }
    
    /* Toggle Tabs */
    .profile-tabs {
        display: flex;
        gap: 10px;
        margin-bottom: 30px;
    }
    
    .tab-btn {
        padding: 10px 20px;
        border-radius: 10px;
        background: transparent;
        color: var(--text-muted);
        border: none;
        cursor: pointer;
        font-weight: 600;
        transition: 0.3s;
    }
    
    .tab-btn.active {
        background: rgba(59, 130, 246, 0.1);
        color: var(--primary);
    }
</style>
@endsection

@section('content')
<div class="profile-container">
    <div class="edit-card">
        
        <div class="profile-tabs">
            <button class="tab-btn active" onclick="switchTab('profile')">Profile Details</button>
            <button class="tab-btn" onclick="switchTab('password')">Security</button>
        </div>

        <!-- Profile Info Section -->
        <section id="profile-section">
            <div class="section-title">Profile Information</div>
            <div class="section-desc">Update your account's profile information and email address.</div>
            
            <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                
                <div class="avatar-upload">
                    <div class="avatar-preview">
                        @php
                            $user = auth()->user();
                            $photo = $user->profile_photo;
                            if ($photo && !str_starts_with($photo, 'http')) {
                                $backendUrl = rtrim(env('BACKEND_API_URL', 'http://localhost:5001'), '/');
                                // Remove /api suffix if present to get base URL
                                if (str_ends_with($backendUrl, '/api')) { 
                                    $backendUrl = substr($backendUrl, 0, -4); 
                                }
                                $photo = $backendUrl . '/' . ltrim($photo, '/');
                            }
                        @endphp
                        @if($photo)
                             <img src="{{ $photo }}" alt="Profile Photo" onerror="this.onerror=null;this.src='{{ asset('images/default-avatar.png') }}';">
                        @else
                            <div style="color:var(--text-muted);">
                                <i class="fas fa-user fa-3x"></i>
                            </div>
                        @endif
                    </div>
                    <div style="flex: 1;">
                        <label class="form-label" for="profile_photo">Change Profile Photo</label>
                        <input type="file" name="profile_photo" id="profile_photo" class="form-input" style="padding: 10px;">
                        <div style="margin-top: 8px; font-size: 0.85rem; color: var(--text-muted);">
                            Allowed formats: JPG, PNG, GIF. Max size: 2MB.
                        </div>
                    </div>
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label class="form-label" for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-input" value="{{ old('name', $user->name) }}" placeholder="e.g. John Doe" required autofocus>
                        @error('name') <span style="color:var(--danger);font-size:0.85rem;margin-top:5px;display:block;">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-input" value="{{ old('email', $user->email) }}" placeholder="e.g. john@example.com" required>
                        @error('email') <span style="color:var(--danger);font-size:0.85rem;margin-top:5px;display:block;">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div style="display:flex; justify-content:flex-end; align-items:center; margin-top:30px; gap: 15px;">
                    @if (session('status') === 'profile-updated')
                        <span style="color: #10b981; font-weight: 500; font-size: 0.9rem;"><i class="fas fa-check-circle"></i> Saved successfully.</span>
                    @endif
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </section>

        <!-- Update Password Section -->
        <section id="password-section" style="display:none;">
            <div class="section-title">Update Password</div>
            <div class="section-desc">Ensure your account is using a long, random password to stay secure.</div>
            
            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')
                
                <div class="form-group">
                    <label class="form-label" for="current_password">Current Password</label>
                    <input type="password" name="current_password" id="current_password" class="form-input" placeholder="Enter your current password">
                    @error('current_password') <span style="color:var(--danger);font-size:0.85rem;margin-top:5px;display:block;">{{ $message }}</span> @enderror
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label class="form-label" for="password">New Password</label>
                        <input type="password" name="password" id="password" class="form-input" placeholder="Enter new password">
                        @error('password') <span style="color:var(--danger);font-size:0.85rem;margin-top:5px;display:block;">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" placeholder="Confirm new password">
                    </div>
                </div>

                <div style="display:flex; justify-content:flex-end; align-items:center; margin-top:30px;">
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
            </form>
        </section>
    </div>
</div>

<script>
    function switchTab(tabName) {
        const profileSection = document.getElementById('profile-section');
        const passwordSection = document.getElementById('password-section');
        const tabs = document.querySelectorAll('.tab-btn');
        
        // Update URL hash
        window.location.hash = tabName;

        if (tabName === 'password') {
            profileSection.style.display = 'none';
            passwordSection.style.display = 'block';
            tabs[0].classList.remove('active');
            tabs[1].classList.add('active');
        } else {
            profileSection.style.display = 'block';
            passwordSection.style.display = 'none';
            tabs[0].classList.add('active');
            tabs[1].classList.remove('active');
        }
    }

    function handleHash() {
        const hash = window.location.hash.replace('#', '');
        if (hash === 'password') {
            switchTab('password');
        } else {
            switchTab('profile'); // Default
        }
    }

    window.addEventListener('hashchange', handleHash);
    document.addEventListener('DOMContentLoaded', handleHash);
</script>
@endsection
