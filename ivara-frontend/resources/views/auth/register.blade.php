@include('layouts.header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register | IVARA - Join the Future</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #ffb700;
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
            padding: 2.5rem 2rem;
            position: relative;
        }

        .auth-card {
            display: flex;
            width: 100%;
            max-width: 1000px;
            min-height: 750px;
            background: var(--glass-bg);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid var(--glass-border);
            border-radius: 35px;
            overflow: hidden;
            box-shadow: 0 40px 100px rgba(0, 0, 0, 0.6);
            animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* LEFT SIDE - DESIGN / IMAGE */
        .auth-visual {
            width: 40%;
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
            width: 60%;
            padding: 3.5rem 4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: rgba(255, 255, 255, 0.02);
            overflow-y: auto;
        }

        .form-header {
            margin-bottom: 2rem;
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

        /* Alerts */
        .alert {
            padding: 0.8rem 1.2rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-size: 0.85rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
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
        .input-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.2rem;
            margin-bottom: 1.2rem;
        }

        .input-group {
            margin-bottom: 1rem;
            position: relative;
        }

        .input-label {
            display: block;
            margin-bottom: 0.4rem;
            font-size: 0.75rem;
            font-weight: 700;
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
            font-size: 1rem;
            transition: color 0.3s;
            z-index: 2;
        }

        .custom-input, .custom-select {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1.5px solid rgba(255, 255, 255, 0.1);
            padding: 0.8rem 1.2rem 0.8rem 2.8rem;
            border-radius: 14px;
            color: #fff;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.3s;
            outline: none;
        }

        .phone-input-group {
            display: flex;
            gap: 10px;
        }

        .custom-select {
            padding-left: 1.2rem;
            width: 120px;
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='white' viewBox='0 0 24 24'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 20px;
        }

        .phone-number-field {
            flex: 1;
        }

        .custom-input:focus, .custom-select:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(255, 183, 0, 0.15);
        }

        .custom-input::placeholder {
            color: rgba(255, 255, 255, 0.25);
        }

        /* PASSWORD SPECIFIC */
        .toggle-pw {
            position: absolute;
            right: 0.8rem;
            top: 50%;
            transform: translateY(-50%);
            background: #000; /* User requested BLACK icon background/button */
            border: none;
            color: #fff; /* White icon on black circle */
            cursor: pointer;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            transition: all 0.3s;
            z-index: 5;
        }

        /* Alternatively, if they just meant the icon itself is black, but usually black contrast is better like this */
        .toggle-pw i {
            color: #fff;
        }

        .toggle-pw:hover {
            transform: translateY(-50%) scale(1.1);
            background: #333;
        }

        .password-rules {
            font-size: 0.7rem;
            color: var(--text-dim);
            background: rgba(255, 255, 255, 0.05);
            padding: 8px 12px;
            border-radius: 10px;
            margin-top: 0.5rem;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .feedback {
            font-size: 0.7rem;
            margin-top: 4px;
            padding-left: 10px;
            font-weight: 600;
        }
        .feedback.accepted { color: #4ade80; }
        .feedback.not-accepted { color: #f87171; }

        /* Buttons */
        .btn-register {
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
            margin-top: 1rem;
        }

        .btn-register:hover {
            transform: translateY(-3px);
            background: white;
            box-shadow: 0 15px 30px rgba(255, 183, 0, 0.3);
        }

        .divider {
            position: relative;
            text-align: center;
            margin: 1.5rem 0;
            color: rgba(255, 255, 255, 0.2);
            font-size: 0.75rem;
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
            padding: 0.8rem;
            background: white;
            color: #333;
            border: none;
            border-radius: 14px;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
        }

        .btn-google img { height: 18px; }

        .btn-google:hover {
            background: #f8f8f8;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .footer-links {
            text-align: center;
            margin-top: 2rem;
            font-size: 0.9rem;
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

        /* Scrollbar */
        .auth-form-container::-webkit-scrollbar { width: 5px; }
        .auth-form-container::-webkit-scrollbar-track { background: transparent; }
        .auth-form-container::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.1); border-radius: 10px; }

        /* Responsive Design */
        @media (max-width: 1000px) {
            .auth-card {
                flex-direction: column;
                max-width: 550px;
                min-height: auto;
            }
            .auth-visual {
                width: 100%;
                padding: 2.5rem 2rem;
            }
            .auth-form-container {
                width: 100%;
                padding: 2.5rem 2rem;
            }
            .input-grid {
                grid-template-columns: 1fr;
            }
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
                    <h2 class="visual-title">Join The Future <br>of Excellence</h2>
                    <p class="visual-text">Get started with IVARA today and experience the next generation of professional service management.</p>
                </div>
            </div>

            <!-- Right Side: Form -->
            <div class="auth-form-container">
                <div class="form-header">
                    <h1 class="form-title">Create Account</h1>
                    <p class="form-subtitle">Register to get started</p>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>
                            @foreach ($errors->all() as $error) {{ $error }} @endforeach
                        </span>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="input-grid">
                        <div class="input-group">
                            <label class="input-label">Full Name</label>
                            <div class="input-wrapper">
                                <i class="fas fa-user input-icon"></i>
                                <input id="name" type="text" class="custom-input" name="name" value="{{ old('name') }}" required placeholder="John Doe" oninput="validateField(this, /^[a-zA-Z\s]{3,}$/)" />
                                <div id="name-feedback" class="feedback"></div>
                            </div>
                        </div>

                        <div class="input-group">
                            <label class="input-label">Username</label>
                            <div class="input-wrapper">
                                <i class="fas fa-at input-icon"></i>
                                <input id="username" type="text" class="custom-input" name="username" value="{{ old('username') }}" required placeholder="johndoe123" oninput="validateField(this, /^[a-zA-Z0-9_]{3,}$/)" />
                                <div id="username-feedback" class="feedback"></div>
                            </div>
                        </div>
                    </div>

                    <div class="input-group">
                        <label class="input-label">Phone Number</label>
                        <div class="phone-input-group">
                            <select name="country_code" class="custom-select" required>
                                <option value="250" {{ old('country_code') == '250' ? 'selected' : '' }}>🇷🇼 +250</option>
                                <option value="254" {{ old('country_code') == '254' ? 'selected' : '' }}>🇰🇪 +254</option>
                                <option value="1" {{ old('country_code') == '1' ? 'selected' : '' }}>🇺🇸 +1</option>
                                <option value="255" {{ old('country_code') == '255' ? 'selected' : '' }}>🇹🇿 +255</option>
                                <option value="256" {{ old('country_code') == '256' ? 'selected' : '' }}>🇺🇬 +256</option>
                            </select>
                            <div class="input-wrapper phone-number-field">
                                <i class="fas fa-phone input-icon" style="left: 1rem;"></i>
                                <input type="text" name="phone" value="{{ old('phone') }}" class="custom-input" placeholder="788 000 000" required oninput="this.value = this.value.replace(/[^0-9]/g, '')" style="padding-left: 2.8rem;" />
                            </div>
                        </div>
                        <div id="phone-feedback" class="feedback"></div>
                    </div>

                    <div class="input-group">
                        <label class="input-label">Email Address</label>
                        <div class="input-wrapper">
                            <i class="fas fa-envelope input-icon"></i>
                            <input id="email" type="email" class="custom-input" name="email" value="{{ old('email') }}" required placeholder="john@example.com" oninput="validateEmail()" />
                            <div id="email-feedback" class="feedback"></div>
                        </div>
                    </div>

                    <div class="input-grid">
                        <div class="input-group">
                            <label class="input-label">Password</label>
                            <div class="input-wrapper">
                                <i class="fas fa-lock input-icon"></i>
                                <input id="password" type="password" class="custom-input" name="password" required placeholder="••••••••" oninput="validatePassword()" />
                                <button type="button" class="toggle-pw" onclick="togglePassword('password', this)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="input-group">
                            <label class="input-label">Confirm Password</label>
                            <div class="input-wrapper">
                                <i class="fas fa-shield-alt input-icon"></i>
                                <input id="password_confirmation" type="password" class="custom-input" name="password_confirmation" required placeholder="••••••••" oninput="validateConfirmPassword()" />
                                <button type="button" class="toggle-pw" onclick="togglePassword('password_confirmation', this)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="password-rules">
                        <i class="fas fa-info-circle me-1"></i> Use 8+ characters with mixed case, numbers & symbols.
                        <div id="password-feedback" class="feedback" style="display:inline-block; margin:0; padding-left:10px;"></div>
                        <div id="confirm-feedback" class="feedback" style="display:inline-block; margin:0; padding-left:10px;"></div>
                    </div>

                    <button type="submit" class="btn-register">
                        <span>Register Account</span>
                        <i class="fas fa-user-plus"></i>
                    </button>

                    <div class="divider">Or Sign up with</div>

                    <a href="{{ route('google.redirect') }}" class="btn-google">
                        <img src="{{asset('images/google_img.png')}}" alt="Google">
                        <span>Sign up with Google</span>
                    </a>

                    <div class="footer-links">
                        Already have an account? <a href="{{ route('login') }}">Log In</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const registeredEmails = ["test@example.com", "admin@domain.com"]; 
        
        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            const icon = btn.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
        
        function validateField(input, regex) {
          const feedback = document.getElementById(input.id + '-feedback');
          if (feedback) {
            if (regex.test(input.value)) {
              feedback.textContent = '✔ Valid';
              feedback.className = 'feedback accepted';
            } else {
              feedback.textContent = '✖ Too short/Invalid';
              feedback.className = 'feedback not-accepted';
            }
          }
        }

        function validateEmail() {
          const emailInput = document.getElementById('email');
          const feedback = document.getElementById('email-feedback');
          const value = emailInput.value.trim();
          const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

          if (!regex.test(value)) {
            feedback.textContent = '✖ Invalid email';
            feedback.className = 'feedback not-accepted';
          } else if (registeredEmails.includes(value.toLowerCase())) {
            feedback.textContent = '✖ Email Taken';
            feedback.className = 'feedback not-accepted';
          } else {
            feedback.textContent = '✔ Available';
            feedback.className = 'feedback accepted';
          }
        }

        function validatePassword() {
          const input = document.getElementById('password');
          const feedback = document.getElementById('password-feedback');
          const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
          if (regex.test(input.value)) {
            feedback.textContent = '✔ Strong';
            feedback.className = 'feedback accepted';
          } else {
            feedback.textContent = '✖ Week';
            feedback.className = 'feedback not-accepted';
          }
        }

        function validateConfirmPassword() {
          const pass = document.getElementById('password').value;
          const confirm = document.getElementById('password_confirmation').value;
          const feedback = document.getElementById('confirm-feedback');
          if (confirm && pass === confirm) {
            feedback.textContent = '✔ Match';
            feedback.className = 'feedback accepted';
          } else {
            feedback.textContent = '✖ Mismatch';
            feedback.className = 'feedback not-accepted';
          }
        }

        // Add subtle parallax effect to card
        document.addEventListener('mousemove', (e) => {
            const card = document.querySelector('.auth-card');
            const xAxis = (window.innerWidth / 2 - e.pageX) / 80;
            const yAxis = (window.innerHeight / 2 - e.pageY) / 80;
            if (window.innerWidth > 1000) {
                card.style.transform = `rotateY(${xAxis}deg) rotateX(${yAxis}deg)`;
            }
        });

        document.addEventListener('mouseleave', () => {
            const card = document.querySelector('.auth-card');
            card.style.transform = `rotateY(0deg) rotateX(0deg)`;
        });
    </script>
</body>
</html>
@include('layouts.footer')
