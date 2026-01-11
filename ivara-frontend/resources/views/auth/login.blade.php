@include('layouts.header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login | IVARA - Access Your Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #924FC2;
            --primary-light: #ffc83b;
            --primary-dark: #cc9200;
            --secondary: #1a2a5e;
            --dark-bg: #0A1128;
            --glass-bg: rgba(22, 36, 71, 0.4);
            --glass-border: rgba(255, 255, 255, 0.1);
            --text-main: #ffffff;
            --text-dim: rgba(255, 255, 255, 0.7);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--dark-bg);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
            position: relative;
        }

        /* Animated Background */
        .bg-glow {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: -1;
            background: 
                radial-gradient(circle at 10% 20%, rgba(26, 42, 94, 0.8) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(255, 183, 0, 0.1) 0%, transparent 40%),
                radial-gradient(circle at 50% 50%, #0A1128 0%, #050816 100%);
            animation: bgShift 20s ease infinite alternate;
        }

        @keyframes bgShift {
            0% { transform: scale(1); }
            100% { transform: scale(1.1); }
        }

        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
        }

        .auth-card {
            display: flex;
            width: 100%;
            max-width: 950px;
            min-height: 600px;
            background: var(--glass-bg);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid var(--glass-border);
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 40px 100px rgba(0, 0, 0, 0.6);
            transition: transform 0.3s ease;
            animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* LEFT SIDE - DESIGN / IMAGE */
        .auth-visual {
            width: 45%;
            background: linear-gradient(135deg, rgba(26, 42, 94, 0.9), rgba(10, 17, 40, 0.9)), url('{{ asset("images/register.jpeg") }}');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem;
            text-align: center;
            position: relative;
            color: white;
        }

        .auth-visual::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; bottom: 0;
            background: radial-gradient(circle at center, transparent, rgba(0,0,0,0.4));
        }

        .visual-content {
            position: relative;
            z-index: 2;
        }

        .visual-logo {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 20px;
            padding: 10px;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            display: inline-block;
        }

        .visual-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .visual-title {
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: 1rem;
            line-height: 1.2;
            letter-spacing: -1px;
        }

        .visual-text {
            font-size: 1rem;
            color: var(--text-dim);
            max-width: 280px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* RIGHT SIDE - FORM */
        .auth-form-container {
            width: 55%;
            padding: 4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: rgba(255, 255, 255, 0.02);
        }

        .form-header {
            margin-bottom: 2.5rem;
        }

        .form-title {
            font-size: 2.2rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 0.5rem;
            letter-spacing: -0.5px;
        }

        .form-subtitle {
            color: var(--text-dim);
            font-size: 1rem;
            font-weight: 500;
        }

        /* Error/Status Messages */
        .alert {
            padding: 1rem 1.2rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
        }

        @keyframes shake {
            10%, 90% { transform: translate3d(-1px, 0, 0); }
            20%, 80% { transform: translate3d(2px, 0, 0); }
            30%, 50%, 70% { transform: translate3d(-4px, 0, 0); }
            40%, 60% { transform: translate3d(4px, 0, 0); }
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.15);
            color: #ff8080;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.15);
            color: #4ade80;
            border: 1px solid rgba(34, 197, 94, 0.2);
        }

        /* Input Styles */
        .input-group {
            margin-bottom: 1.2rem;
            position: relative;
        }

        .input-label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-dim);
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .input-wrapper {
            position: relative;
            width: 100%;
        }

        .input-icon {
            position: absolute;
            left: 1.2rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-dim);
            font-size: 1.1rem;
            transition: color 0.3s;
        }

        .custom-input {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1.5px solid rgba(255, 255, 255, 0.1);
            padding: 0.9rem 1.2rem 0.9rem 3.2rem;
            border-radius: 14px;
            color: #fff;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s;
            outline: none;
        }

        .custom-input:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(146, 79, 194, 0.15);
        }

        .custom-input:focus + .input-icon {
            color: var(--primary);
        }

        .custom-input::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        .toggle-pw {
            position: absolute;
            right: 1.2rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-dim);
            cursor: pointer;
            font-size: 1.1rem;
            transition: color 0.3s;
        }

        .toggle-pw:hover {
            color: var(--primary);
        }

        /* Options Tool */
        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 1.5rem 0;
            font-size: 0.9rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            color: var(--text-dim);
            user-select: none;
        }

        .remember-me input {
            cursor: pointer;
            accent-color: var(--primary);
            width: 16px; height: 16px;
        }

        .forgot-password {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .forgot-password:hover {
            color: var(--primary-light);
            text-decoration: underline;
        }

        /* Buttons */
        .btn-login {
            width: 100%;
            padding: 1rem;
            background: var(--primary);
            color: #000;
            border: none;
            border-radius: 14px;
            font-size: 1.1rem;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 1.5rem;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            background: white;
            box-shadow: 0 15px 30px rgba(146, 79, 194, 0.3);
        }

        .btn-login:active {
            transform: translateY(-1px);
        }

        .divider {
            position: relative;
            text-align: center;
            margin: 2rem 0;
            color: rgba(255, 255, 255, 0.2);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 700;
        }

        .divider::before, .divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 30%;
            height: 1px;
            background: rgba(255, 255, 255, 0.1);
        }

        .divider::before { left: 0; }
        .divider::after { right: 0; }

        .btn-google {
            width: 100%;
            padding: 0.9rem;
            background: white;
            color: #333;
            border: none;
            border-radius: 14px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            text-decoration: none;
        }

        .btn-google img { height: 20px; }

        .btn-google:hover {
            background: #f8f8f8;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .footer-links {
            text-align: center;
            margin-top: 2.5rem;
            font-size: 0.95rem;
            color: var(--text-dim);
        }

        .footer-links a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 700;
            margin-left: 5px;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 900px) {
            .auth-card {
                flex-direction: column;
                max-width: 500px;
                min-height: auto;
            }
            .auth-visual {
                width: 100%;
                padding: 3rem 2rem;
            }
            .auth-form-container {
                width: 100%;
                padding: 3rem 2rem;
            }
        }

        @media (max-width: 480px) {
            .form-title { font-size: 1.8rem; }
            .auth-card { border-radius: 20px; }
            .main-content { padding: 1rem; }
        }
    </style>
</head>
<body>
    <div class="bg-glow"></div>

    <div class="main-content">
        <div class="auth-card">
            <!-- Left Side: Visual -->
            <div class="auth-visual">
                <div class="visual-content">
                    <div class="visual-logo">
                        <img src="{{ asset('images/logo.jpg') }}" alt="IVARA Logo">
                    </div>
                    <h2 class="visual-title">The Future of <br>Professional Services</h2>
                    <p class="visual-text">Join thousands of experts and clients in Rwanda's leading operational platform.</p>
                </div>
            </div>

            <!-- Right Side: Form -->
            <div class="auth-form-container">
                <div class="form-header">
                    <h1 class="form-title">Welcome Back</h1>
                    <p class="form-subtitle">Log in to your dashboard</p>
                </div>

                @if (session('status'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>
                            @if($errors->has('email')) Invalid credentials @else Please check your inputs @endif
                        </span>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-group">
                        <label class="input-label">Email Address</label>
                        <div class="input-wrapper">
                            <i class="fas fa-envelope input-icon"></i>
                            <input id="email" type="email" class="custom-input" name="email" value="{{ old('email') }}" required placeholder="jane@example.com" />
                        </div>
                    </div>

                    <div class="input-group">
                        <label class="input-label">Password</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock input-icon"></i>
                            <input id="password" type="password" class="custom-input" name="password" required placeholder="••••••••" />
                            <button type="button" class="toggle-pw" onclick="togglePassword()">
                                <i class="fas fa-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-options">
                        <label class="remember-me">
                            <input type="checkbox" name="remember" id="remember" /> 
                            <span>Remember me</span>
                        </label>
                        <a href="{{ route('password.request') }}" class="forgot-password">Forgot Password?</a>
                    </div>

                    <button type="submit" class="btn-login">
                        <span>Log In</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>

                    <div class="divider">Or login with</div>

                    <a href="{{ route('google.redirect') }}" class="btn-google">
                        <img src="{{asset('images/google_img.png')}}" alt="GoogleLogo">
                        <span>Google</span>
                    </a>

                    <div class="footer-links">
                        New to IVARA? <a href="{{ route('register') }}">Create Account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
            if(input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Add subtle parallax effect to card
        document.addEventListener('mousemove', (e) => {
            const card = document.querySelector('.auth-card');
            const xAxis = (window.innerWidth / 2 - e.pageX) / 50;
            const yAxis = (window.innerHeight / 2 - e.pageY) / 50;
            if (window.innerWidth > 900) {
                card.style.transform = `rotateY(${xAxis}deg) rotateX(${yAxis}deg)`;
            }
        });

        // Reset transform on mouse leave
        document.addEventListener('mouseleave', () => {
            const card = document.querySelector('.auth-card');
            card.style.transform = `rotateY(0deg) rotateX(0deg)`;
        });
    </script>
</body>
</html>
@include('layouts.footer')
