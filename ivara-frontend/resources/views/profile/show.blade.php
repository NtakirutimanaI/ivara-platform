@extends('layouts.app')

@section('title', 'Profile - IVARA')

@section('styles')
<style>
    :root {
        --bg-gradient: radial-gradient(circle at top right, #fdf4ff, #f3f4f6);
        --card-bg: rgba(255,255,255,0.8);
        --item-bg: #ffffff;
        --item-border: #e2e8f0;
    }
    [data-theme="dark"] {
        --bg-gradient: radial-gradient(circle at top right, #0f172a, #020617);
        --card-bg: rgba(30, 41, 59, 0.95); /* Darker opacity for better contrast */
        --item-bg: rgba(51, 65, 85, 0.5);
        --item-border: rgba(255, 255, 255, 0.1);
    }
    
    .profile-card {
        background: var(--card-bg);
        border: 1px solid var(--item-border);
        border-radius: 20px;
        padding: 40px;
        max-width: 700px;
        width: 100%;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        text-align: center;
        margin: 0 auto;
        backdrop-filter: blur(10px);
    }
    .avatar-wrapper {
        margin: 0 auto 20px;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: var(--item-bg);
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 4px solid var(--item-border);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .avatar-wrapper img { width: 100%; height: 100%; object-fit: cover; }
    
    .profile-info h2 { font-weight: 800; color: var(--text-main); margin-bottom: 20px; }
    .profile-info p { color: var(--text-muted); font-size: 1rem; margin-bottom: 10px; }
    .profile-info strong { color: var(--text-main); font-weight: 700; }

    .action-buttons {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 30px;
    }
    .action-buttons a, .action-buttons button {
        flex: 1;
        min-width: 140px;
        max-width: 180px;
        padding: 12px 0;
        border-radius: 12px;
        font-weight: 700;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 0.9rem;
    }
    .btn-primary { background: var(--primary); color: #fff; box-shadow: 0 4px 6px rgba(59, 130, 246, 0.3); }
    .btn-primary:hover { background: var(--primary-hover); transform: translateY(-2px); }
    
    .btn-secondary { background: transparent; color: var(--text-muted); border: 1px solid var(--item-border); }
    .btn-secondary:hover { background: var(--item-bg); color: var(--text-main); border-color: var(--text-main); }
    
    .btn-danger { background: rgba(239, 68, 68, 0.1); color: #ef4444; }
    .btn-danger:hover { background: #ef4444; color: white; }

    .btn-back-hover:hover {
        transform: translateY(-2px);
        border-color: var(--primary) !important;
        color: var(--primary) !important;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
</style>
@endsection

@section('content')
    <div style="flex:1; display:flex; flex-direction:column; justify-content:center; align-items:center; padding: 40px 20px; min-height: 80vh;">
        <div class="profile-card">
            <div class="avatar-wrapper">
                @php
                    $photo = auth()->user()->profile_photo;
                    if ($photo && !str_starts_with($photo, 'http')) {
                        $photo = rtrim($backendUrl, '/') . '/' . ltrim($photo, '/');
                    }
                @endphp
                @if($photo)
                    <img src="{{ $photo }}" alt="Profile Photo">
                @else
                    <i class="fas fa-user-circle fa-4x" style="color: var(--secondary);"></i>
                @endif
            </div>
            
            <div class="profile-info">
                <h2>{{ auth()->user()->name }}</h2>
                <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                <p><strong>Role:</strong> <span class="badge" style="background: rgba(59, 130, 246, 0.1); color: var(--primary); padding: 5px 10px; border-radius: 6px;">{{ ucfirst(auth()->user()->role) }}</span></p>
            </div>

            <div class="action-buttons">
                <a href="{{ route('profile.edit') }}" class="btn-primary"><i class="fas fa-edit"></i> Edit Profile</a>
                <a href="{{ route('profile.edit') }}#password" class="btn-secondary"><i class="fas fa-key"></i> Password</a>
                <form id="delete-form" action="{{ route('profile.destroy') }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <input type="hidden" name="password" id="delete-password-input">
                    <button type="button" class="btn-danger" 
                        onclick="const pwd=prompt('To confirm deletion, please enter your password:');if(pwd){document.getElementById('delete-password-input').value=pwd;document.getElementById('delete-form').submit();}">
                        <i class="fas fa-trash-alt"></i> Delete Account
                    </button>
                </form>
            </div>
        </div>

        <div style="margin-top: 30px;">
            <a href="javascript:history.back()" class="btn-back-hover" style="display:inline-flex; align-items:center; padding: 12px 30px; border-radius: 50px; background: var(--card-bg); border: 1px solid var(--item-border); color: var(--text-main); text-decoration: none; font-weight: 600; box-shadow: 0 4px 10px rgba(0,0,0,0.05); transition: all 0.3s ease; backdrop-filter: blur(10px);">
                <i class="fas fa-arrow-left" style="margin-right: 8px;"></i> Back
            </a>
        </div>
    </div>
@endsection

