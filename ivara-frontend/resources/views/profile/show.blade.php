@include('layouts.header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - IVARA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    :root {
        --primary: #924FC2;
        --bg-gradient: radial-gradient(circle at top right, #fdf4ff, #f3f4f6);
        --text-main: #000000;
        --text-muted: #64748b;
        --card-bg: rgba(255,255,255,0.8);
        --item-bg: #ffffff;
        --item-border: #e2e8f0;
    }
    .dark {
        --bg-gradient: radial-gradient(circle at top right, #0f172a, #020617);
        --text-main: #f8fafc;
        --text-muted: #94a3b8;
        --card-bg: rgba(30,41,59,0.8);
        --item-bg: rgba(51,65,85,0.5);
        --item-border: rgba(255,255,255,0.1);
    }
    body {
        margin:0;
        background:var(--bg-gradient);
        color:var(--text-main);
        min-height:100vh;
        display:flex;
        flex-direction:column;
        justify-content:center;
        align-items:center;
        font-family:'Inter',-apple-system,sans-serif;
    }
    .profile-card {
        background:var(--card-bg);
        border:1px solid var(--item-border);
        border-radius:20px;
        padding:40px;
        max-width:700px;
        width:100%;
        box-shadow:0 20px 40px rgba(0,0,0,0.1);
        text-align:center;
    }
    .avatar-wrapper {
        margin:0 auto 20px;
        width:150px;
        height:150px;
        border-radius:20px;
        background:var(--item-bg);
        overflow:hidden;
        display:flex;
        align-items:center;
        justify-content:center;
    }
    .avatar-wrapper img { width:100%; height:100%; object-fit:cover; }
    .action-buttons {
        display:flex;
        gap:15px;
        flex-wrap:wrap;
        justify-content:center;
        margin-top:20px;
    }
    .action-buttons a, .action-buttons button {
        flex:1;
        min-width:140px;
        max-width:180px;
        padding:12px 0;
        border-radius:6px;
        font-weight:600;
        text-decoration:none;
        border:none;
        cursor:pointer;
    }
    .action-buttons a.btn-primary { background:var(--primary); color:#fff; }
    .action-buttons a.btn-secondary { background:transparent; color:var(--text-muted); border:1px solid var(--item-border); }
    .action-buttons button.btn-danger { background:#e53e3e; color:#fff; }
    .btn-back-hover:hover {
        transform: translateY(-2px);
        border-color: var(--primary) !important;
        color: var(--primary) !important;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
</style>
</head>
<body style="display:flex;flex-direction:column;min-height:100vh;">
    <button id="theme-toggle" style="position:fixed;top:10px;right:10px;padding:8px;background:var(--primary);color:#fff;border:none;border-radius:4px;cursor:pointer;">Toggle Dark Mode</button>
    <script>
        const toggle = document.getElementById('theme-toggle');
        const root = document.documentElement;
        if (localStorage.getItem('theme') === 'dark') { root.classList.add('dark'); }
        toggle.addEventListener('click', () => {
            root.classList.toggle('dark');
            localStorage.setItem('theme', root.classList.contains('dark') ? 'dark' : 'light');
        });
    </script>
    <div class="content-wrapper" style="flex:1;display:flex;flex-direction:column;justify-content:center;align-items:center;padding:40px 20px;">
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
                    <i class="fas fa-user-circle fa-3x" style="color:var(--primary);"></i>
                @endif
            </div>
            <h2 style="text-align:center;margin-top:12px;">{{ auth()->user()->name }}</h2>
            <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
            <p><strong>Role:</strong> {{ ucfirst(auth()->user()->role) }}</p>
            <div class="action-buttons">
                <a href="{{ route('profile.edit') }}" class="btn-primary">Edit Profile</a>
                <a href="{{ route('profile.edit') }}#password" class="btn-secondary">Change Password</a>
                <form id="delete-form" action="{{ route('profile.destroy') }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <input type="hidden" name="password" id="delete-password-input">
                    <button type="button" class="btn-danger" 
                        onclick="const pwd=prompt('To confirm deletion, please enter your password:');if(pwd){document.getElementById('delete-password-input').value=pwd;document.getElementById('delete-form').submit();}">
                        Delete Account
                    </button>
                </form>
            </div>
        </div>

        <div style="margin-top: 30px;">
            <a href="javascript:history.back()" class="btn-back-hover" style="display:inline-block; padding: 12px 30px; border-radius: 50px; background: var(--card-bg); border: 1px solid var(--item-border); color: var(--text-main); text-decoration: none; font-weight: 600; box-shadow: 0 4px 10px rgba(0,0,0,0.05); transition: all 0.3s ease; backdrop-filter: blur(10px);">
                <i class="fas fa-arrow-left" style="margin-right: 8px;"></i> Back
            </a>
        </div>
    </div>
@include('layouts.footer')
</body>
</html>

