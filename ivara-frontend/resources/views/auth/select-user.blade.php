@include('layouts.header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Profile - IVARA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #924FC2;
            --primary-glow: rgba(146, 79, 194, 0.3);
            --bg-gradient: radial-gradient(circle at top right, #fdf4ff, #f3f4f6);
            --text-main: #000000;
            --text-muted: #64748b;
            --card-bg: rgba(255, 255, 255, 0.7);
            --item-bg: #ffffff;
            --item-border: #e2e8f0;
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --bg-gradient: radial-gradient(circle at top right, #0f172a, #020617);
                --text-main: #f8fafc;
                --text-muted: #94a3b8;
                --card-bg: rgba(30, 41, 59, 0.7);
                --item-bg: rgba(51, 65, 85, 0.4);
                --item-border: rgba(255, 255, 255, 0.1);
            }
        
        }

.dark {
    --bg-gradient: radial-gradient(circle at top right, #0f172a, #020617);
    --text-main: #f8fafc;
    --text-muted: #94a3b8;
    --card-bg: rgba(30, 41, 59, 0.7);
    --item-bg: rgba(51, 65, 85, 0.4);
    --item-border: rgba(255, 255, 255, 0.1);
}

        body { 
            margin: 0;
            background: var(--bg-gradient); 
            color: var(--text-main); 
            min-height: 100vh; 
            display: flex; 
            flex-direction: column; 
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            transition: background 0.3s ease;
        }

        .selection-wrapper { 
            flex-grow: 1; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            padding: 30px 20px; 
        }

        .selection-card { 
            background: var(--card-bg); 
            backdrop-filter: blur(20px); 
            border-radius: 20px; 
            border: 1px solid var(--item-border); 
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1); 
            width: 100%; 
            max-width: 400px; 
            padding: 20px; 
            animation: slideUp 0.5s ease-out; 
        }

        .selection-title { 
            font-size: 26px; 
            font-weight: 800; 
            text-align: center; 
            margin-bottom: 8px; 
            color: var(--text-main);
        }

        .selection-subtitle { 
            text-align: center; 
            color: var(--text-muted); 
            margin-bottom: 30px; 
            font-size: 14px;
        }

        .user-list { display: flex; flex-direction: column; gap: 16px; }

        .user-item { 
            background: var(--item-bg); 
            border-radius: 20px; 
            padding: 20px 28px; 
            border: 1px solid var(--item-border); 
            cursor: pointer; 
            transition: all 0.3s ease; 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            text-decoration: none; 
            width: 100%;
        }

        .user-item:hover { 
            transform: scale(1.02);
            border-color: var(--primary); 
            box-shadow: 0 10px 20px rgba(0,0,0,0.05); 
            background: rgba(146, 79, 194, 0.05);
        }

        .user-meta { display: flex; align-items: center; gap: 20px; }

        .user-avatar { 
            width: 54px; 
            height: 54px; 
            border-radius: 14px; 
            background: var(--primary); 
            color: #fff; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-weight: 800; 
            font-size: 20px;
            box-shadow: 0 4px 10px var(--primary-glow);
        }

        .user-info h4 { 
            margin: 0 0 4px 0; 
            font-size: 18px; 
            color: var(--text-main); 
            font-weight: 700;
        }

        .user-info p { 
            margin: 0; 
            font-size: 14px; 
            color: var(--text-muted); 
        }

        .btn-enter { 
            color: var(--primary); 
            font-size: 20px; 
            transition: transform 0.3s;
        }

        .user-item:hover .btn-enter { transform: translateX(5px); }

        .back-link { 
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 35px; 
            color: var(--text-muted); 
            text-decoration: none; 
            font-size: 15px; 
            font-weight: 600; 
            transition: color 0.3s;
        }

        .back-link:hover { color: var(--primary); }

        @keyframes slideUp { 
            from { opacity: 0; transform: translateY(30px); } 
            to { opacity: 1; transform: translateY(0); } 
        }
    </style>
</head>
<body>
    <button id="theme-toggle" style="position:fixed;top:10px;right:10px;padding:8px;background:var(--primary);color:#fff;border:none;border-radius:4px;cursor:pointer;">Toggle Dark Mode</button>
    <script>
        const toggle = document.getElementById('theme-toggle');
        const root = document.documentElement;
        if (localStorage.getItem('theme') === 'dark') {
            root.classList.add('dark');
        }
        toggle.addEventListener('click', () => {
            root.classList.toggle('dark');
            localStorage.setItem('theme', root.classList.contains('dark') ? 'dark' : 'light');
        });
    </script>
    <div class="selection-wrapper">
        <div class="selection-card">
            <h1 class="selection-title">Select Profile</h1>
            <p class="selection-subtitle">Access your <strong>{{ ucwords(str_replace('_', ' ', $category)) }}</strong> workspace</p>
            
            <form action="{{ route('auth.enter-dashboard') }}" method="POST" class="user-list">
                @csrf
                <input type="hidden" name="category" value="{{ $category }}">
                
                @foreach($users as $user)
                <button type="submit" name="user_id" value="{{ $user->id }}" class="user-item">
                    <div class="user-meta">
                        <div class="user-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                        <div class="user-info">
                            <h4>{{ $user->name }}</h4>
                            <p>{{ ucfirst($user->role) }} Workspace</p>
                        </div>
                    </div>
                    <div class="btn-enter"><i class="fas fa-arrow-right"></i></div>
                </button>
                @endforeach
            </form>

            <a href="{{ route('auth.select-category') }}" class="back-link">
                <i class="fas fa-chevron-left"></i> Change Category
            </a>
        </div>
    </div>
</body>
</html>
@include('layouts.footer')

