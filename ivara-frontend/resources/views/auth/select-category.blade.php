@include('layouts.header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Category - IVARA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #924FC2;
            --bg-gradient: radial-gradient(circle at top right, #fdf4ff, #f3f4f6);
            --text-main: #000000;
            --text-muted: #64748b;
            --card-bg: rgba(255, 255, 255, 0.8);
            --item-bg: #ffffff;
            --item-border: #e2e8f0;
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --bg-gradient: radial-gradient(circle at top right, #0f172a, #020617);
                --text-main: #f8fafc;
                --text-muted: #94a3b8;
                --card-bg: rgba(30, 41, 59, 0.8);
                --item-bg: rgba(51, 65, 85, 0.5);
                --item-border: rgba(255, 255, 255, 0.1);
            }
        
                
        }
        .dark {
            --bg-gradient: radial-gradient(circle at top right, #0f172a, #020617);
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --card-bg: rgba(30, 41, 59, 0.8);
            --item-bg: rgba(51, 65, 85, 0.5);
            --item-border: rgba(255, 255, 255, 0.1);
        }

        body { 
            margin: 0;
            background: var(--bg-gradient); 
            color: var(--text-main); 
            min-height: 100vh; 
            display: flex; 
            flex-direction: column; 
            font-family: 'Inter', -apple-system, sans-serif;
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
            border-radius: 24px; 
            border: 1px solid var(--item-border); 
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1); 
            width: 100%; 
            max-width: 950px; 
            padding: 40px; 
            animation: fadeIn 0.5s ease-out; 
        }

        .selection-title { 
            font-size: 28px; 
            font-weight: 800; 
            text-align: center; 
            margin-bottom: 8px; 
            color: var(--text-main);
        }

        .selection-subtitle { 
            text-align: center; 
            color: var(--text-muted); 
            margin-bottom: 35px; 
            font-size: 15px;
        }

        .category-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); 
            gap: 16px; 
        }

        .category-item { 
            background: var(--item-bg); 
            border-radius: 16px; 
            padding: 20px; 
            border: 1px solid var(--item-border); 
            cursor: pointer; 
            transition: all 0.2s ease; 
            display: flex; 
            align-items: center; 
            gap: 15px; 
            text-decoration: none; 
        }

        .category-item:hover { 
            transform: translateY(-3px); 
            border-color: var(--primary); 
            box-shadow: 0 8px 15px rgba(0,0,0,0.05); 
        }

        .category-icon { 
            width: 48px; 
            height: 48px; 
            border-radius: 12px; 
            background: var(--primary); 
            color: #fff; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 18px; 
            flex-shrink: 0; 
        }

        .category-info h3 { 
            margin: 0 0 2px 0; 
            font-size: 16px; 
            font-weight: 700; 
            color: var(--text-main); 
        }

        .category-info p { 
            margin: 0; 
            font-size: 13px; 
            color: var(--text-muted); 
            line-height: 1.4; 
        }

        @keyframes fadeIn { 
            from { opacity: 0; transform: translateY(10px); } 
            to { opacity: 1; transform: translateY(0); } 
        }
    </style>
</head>
<body>
    <button id="theme-toggle" style="position:fixed;top:10px;right:10px;padding:8px;background:var(--primary);color:#fff;border:none;border-radius:4px;cursor:pointer;">Toggle Dark Mode</button>
<script>
    const toggle = document.getElementById('theme-toggle');
    const root = document.documentElement;
    // Initialize theme from localStorage
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
            <h1 class="selection-title">Welcome Back, {{ auth()->user()->name ?? session('user')['name'] ?? 'Guest' }}</h1>
            <p class="selection-subtitle">Choose the category you want to manage today</p>
            
            <div class="category-grid">
                @foreach($categories as $cat)
                <a href="{{ route('auth.select-user', ['category' => $cat['id']]) }}" class="category-item">
                    <div class="category-icon">
                        <i class="{{ $cat['icon'] }}"></i>
                    </div>
                    <div class="category-info">
                        <h3>{{ $cat['name'] }}</h3>
                        <p>{{ $cat['desc'] }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>
@include('layouts.footer')

