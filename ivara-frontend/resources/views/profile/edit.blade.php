@include('layouts.header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - IVARA</title>
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
            --danger: #e53e3e;
        }
        .dark {
            --bg-gradient: radial-gradient(circle at top right, #0f172a, #020617);
            --text-main: #ffffff;
            --text-muted: #94a3b8;
            --card-bg: rgba(30,41,59,0.8);
            --item-bg: rgba(51,65,85,0.5);
            --item-border: rgba(255,255,255,0.1);
        }
        body {
            margin: 0;
            background: var(--bg-gradient);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-family: 'Inter', -apple-system, sans-serif;
        }
        .content-wrapper {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
            width: 100%;
        }
        .edit-card {
            background: var(--card-bg);
            border: 1px solid var(--item-border);
            border-radius: 20px;
            padding: 40px;
            max-width: 700px;
            width: 100%;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--text-main);
            border-bottom: 1px solid var(--item-border);
            padding-bottom: 10px;
        }
        .section-desc {
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-main);
        }
        .form-input {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid var(--item-border);
            background: var(--item-bg);
            color: var(--text-main);
            font-size: 1rem;
            outline: none;
            transition: border-color 0.3s;
        }
        .form-input:focus {
            border-color: var(--primary);
        }
        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            font-size: 1rem;
            transition: opacity 0.3s;
        }
        .btn:hover { opacity: 0.9; }
        .btn-primary { background: var(--primary); color: #fff; }
        .btn-secondary { background: transparent; color: var(--text-muted); border: 1px solid var(--item-border); }
        .btn-danger { background: var(--danger); color: #fff; }
        
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .full-width { grid-column: span 2; }
        
        @media (max-width: 600px) {
            .grid-2 { grid-template-columns: 1fr; }
            .full-width { grid-column: span 1; }
        }

        .avatar-upload {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
        }
        .avatar-preview {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: var(--item-bg);
            overflow: hidden;
            border: 1px solid var(--item-border);
        }
        .avatar-preview img { width: 100%; height: 100%; object-fit: cover; }
    </style>
</head>
<body>
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
    
    <div class="content-wrapper">
        <div class="edit-card">

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
                                $photo = $user->profile_photo;
                                if ($photo && !str_starts_with($photo, 'http')) {
                                    $photo = rtrim($backendUrl, '/') . '/' . ltrim($photo, '/');
                                }
                            @endphp
                            @if($photo)
                                <img src="{{ $photo }}" alt="Profile Photo">
                            @else
                                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:var(--text-muted);">
                                    <i class="fas fa-user fa-2x"></i>
                                </div>
                            @endif
                        </div>
                        <div>
                            <label class="form-label" for="profile_photo">Profile Photo</label>
                            <input type="file" name="profile_photo" id="profile_photo" class="form-input" style="padding: 8px;">
                        </div>
                    </div>

                    <div class="grid-2">
                        <div class="form-group">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-input" value="{{ old('name', $user->name) }}" placeholder="e.g. John Doe" required autofocus>
                            @error('name') <span style="color:var(--danger);font-size:0.8rem;">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-input" value="{{ old('email', $user->email) }}" placeholder="e.g. john@example.com" required>
                            @error('email') <span style="color:var(--danger);font-size:0.8rem;">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div style="display:flex; justify-content:space-between; align-items:center; margin-top:20px;">
                        <a href="{{ route('profile.show') }}" class="btn btn-secondary" style="text-decoration:none;">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                    @if (session('status') === 'profile-updated')
                        <p style="color:var(--primary);margin-top:10px;text-align:right;">Saved successfully.</p>
                    @endif
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
                        @error('current_password') <span style="color:var(--danger);font-size:0.8rem;">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid-2">
                        <div class="form-group">
                            <label class="form-label" for="password">New Password</label>
                            <input type="password" name="password" id="password" class="form-input" placeholder="Enter new password">
                            @error('password') <span style="color:var(--danger);font-size:0.8rem;">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" placeholder="Confirm new password">
                        </div>
                    </div>

                    <div style="display:flex; justify-content:space-between; align-items:center; margin-top:20px;">
                        <a href="{{ route('profile.show') }}" class="btn btn-secondary" style="text-decoration:none;">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </div>
                </form>
            </section>
        </div>
    </div>

    @include('layouts.footer')

    <script>
        function handleHash() {
            const hash = window.location.hash;
            const profileSection = document.getElementById('profile-section');
            const passwordSection = document.getElementById('password-section');
            
            if (hash === '#password') {
                profileSection.style.display = 'none';
                passwordSection.style.display = 'block';
            } else {
                profileSection.style.display = 'block';
                passwordSection.style.display = 'none';
            }
        }
        window.addEventListener('hashchange', handleHash);
        document.addEventListener('DOMContentLoaded', handleHash);
    </script>
    
    <!-- Toastr & Jquery -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "5000"
        };
        @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif
        @if(Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif
        @if(Session::has('info'))
            toastr.info("{{ Session::get('info') }}");
        @endif
        @if(Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}");
        @endif
        @if(Session::has('status'))
            toastr.success("{{ Session::get('status') }}");
        @endif
        
        // Display validation errors if any
        @if($errors->any())
            @foreach($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>
</body>
</html>
