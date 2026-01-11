@if(Auth::check() && !Route::is('index') && !Route::is('home') && !Route::is('aboutus') && !Route::is('support') && !Route::is('products') && !Route::is('team') && !Route::is('privacy_policy') && !Route::is('terms'))
    {{-- Dashboard Footer --}}
    <footer class="dashboard-footer {{ Route::is('auth.*') ? 'selection-footer' : '' }}">
        <div class="footer-content">
            <p>&copy; {{ date('Y') }} IVARA Management System. All rights reserved.</p>
            <div class="footer-links">
                <a href="#">Support</a>
                <a href="#">Feedback</a>
                <a href="{{ route('web.terms') }}">Terms</a>
            </div>
        </div>
    </footer>
    <style>
        .dashboard-footer {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.05);
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            color: #888;
            font-size: 14px;
            text-align: center;
        }
        
        @media (prefers-color-scheme: dark) {
            .dashboard-footer {
                border-top-color: rgba(255, 255, 255, 0.05);
            }
        }

        .dashboard-footer.selection-footer {
            margin-left: 0;
            text-align: center;
            background: transparent;
            border-top: none;
        }

        .footer-content { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            max-width: 1200px; 
            margin: 0 auto; 
        }

        .selection-footer .footer-content {
            flex-direction: column;
            justify-content: center;
            gap: 10px;
        }

        .footer-links a { margin-left: 15px; color: #924FC2; text-decoration: none; }
        .selection-footer .footer-links a { margin: 0 10px; }

        @media (max-width: 1024px) { .dashboard-footer { margin-left: 0; } }
    </style>
@else
    {{-- Web Footer (Yo!Kart Improved Style) --}}
    <footer class="ivara-web-footer">
            {{-- Top Row: Logo + Newsletter --}}
            <div class="footer-top">
                <div class="footer-brand">
                    <img src="{{ asset('images/logo.jpg') }}" alt="IVARA" style="height: 50px; margin-bottom: 15px;">
                    <p style="color: #b0b0b0; font-size: 14px; line-height: 1.6;">
                        IVARA is Rwanda's premier service marketplace connecting customers with professionals across 9 categories including Technical Repair, Transport, Food & Fashion, and more.
                    </p>
                </div>
                <div class="footer-newsletter">
                    <h4>Subscribe to Our Newsletter</h4>
                    <p>Get the latest updates and offers</p>
                    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="newsletter-form">
                        @csrf
                        <div class="newsletter-input-group">
                            <input type="email" name="email" placeholder="Enter your email" required>
                            <button type="submit">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Mid Row: Columns --}}
            <div class="footer-grid">
                {{-- Column 1: Solutions --}}
                <div class="footer-col">
                    <h4>Solutions</h4>
                    <ul>
                        <li><a href="{{ route('index') }}#services">Technical Services</a></li>
                        <li><a href="{{ route('index') }}#services">Logistics Network</a></li>
                        <li><a href="{{ route('marketplace.index') }}">B2B Marketplace</a></li>
                        <li><a href="{{ route('index') }}#mobile-app">eCommerce Mobile Apps</a></li>
                    </ul>
                    
                    <h4 class="mt-4">Use Cases</h4>
                    <ul>
                        <li><a href="{{ route('marketplace.index') }}">Fashion</a></li>
                        <li><a href="{{ route('marketplace.index') }}">Furniture</a></li>
                        <li><a href="{{ route('marketplace.index') }}">Healthcare</a></li>
                        <li><a href="{{ route('marketplace.index') }}">Electronics</a></li>
                        <li><a href="{{ route('marketplace.index') }}">Education</a></li>
                    </ul>
                </div>

                {{-- Column 2: Features --}}
                <div class="footer-col">
                    <h4>Features</h4>
                    <ul>
                        <li><a href="{{ route('index') }}#services">All System Features</a></li>
                        <li><a href="{{ route('login') }}">Admin Dashboard</a></li>
                        <li><a href="{{ route('marketplace.index') }}">Buyer Features</a></li>
                        <li><a href="{{ route('register') }}">Seller Features</a></li>
                        <li><a href="{{ route('index') }}#pricing">Secure Payments</a></li>
                        <li><a href="{{ route('bookings.index') }}">Real-time Tracking</a></li>
                        <li><a href="{{ route('aboutus') }}">Security & Performance</a></li>
                        <li><a href="{{ route('index') }}#mobile-app">Mobile App Features</a></li>
                    </ul>
                </div>

                {{-- Column 3: Work / Demo --}}
                <div class="footer-col">
                    <h4>Work</h4>
                    <ul>
                        <li><a href="{{ route('portfolio.index') }}">Our Clients</a></li>
                        <li><a href="{{ route('portfolio.index') }}">Success Stories</a></li>
                        <li><a href="{{ route('team') }}">Testimonials</a></li>
                    </ul>

                    <h4 class="mt-4">IVARA Demo</h4>
                    <ul>
                         <li><a href="{{ route('register') }}">Try IVARA Demo</a></li>
                         <li><a href="{{ route('index') }}#contact">Book Personalized Demo</a></li>
                    </ul>
                </div>

                {{-- Column 4: Company / Resources --}}
                <div class="footer-col">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="{{ route('aboutus') }}">About Us</a></li>
                        <li><a href="{{ route('contact.index') }}">Partner with Us</a></li>
                        <li><a href="{{ route('contact.index') }}">Contact Us</a></li>
                    </ul>

                    <h4 class="mt-4">Resources</h4>
                    <ul>
                        <li><a href="{{ route('resources.index') }}">Blog</a></li>
                        <li><a href="{{ route('resources.index') }}">Documentation</a></li>
                        <li><a href="{{ route('faq.index') }}">FAQs</a></li>
                        <li><a href="{{ route('web.terms') }}">Terms of Service</a></li>
                    </ul>
                </div>
            </div>

            {{-- Bottom Row: Legal, Social & Copyright --}}
            <div class="footer-bottom">
                <div class="bottom-links">
                    <a href="{{ route('web.sitemap') }}">Site Map</a>
                    <a href="{{ route('web.terms') }}">Terms & Conditions</a>
                    <a href="{{ route('web.privacy-policy') }}">Privacy Policy</a>
                </div>
                
                <div class="social-icons">
                    <a href="https://facebook.com/ivara" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com/ivara" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="https://linkedin.com/company/ivara" target="_blank" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <a href="https://instagram.com/ivara" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://youtube.com/@ivara" target="_blank" title="YouTube"><i class="fab fa-youtube"></i></a>
                </div>
                
                <div class="copyright">
                    <p>Made with ❤️ by IVARA Team © 2024-{{ date('Y') }} All Rights Reserved.</p>
                    <p class="powered-by">
                        <a href="https://make-it-solutions.com" target="_blank" rel="noopener noreferrer">
                            This Platform Powered by MAKE IT SOLUTIONS Ltd
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <style>
        .ivara-web-footer {
            background-color: #233848;
            color: #b0b0b0;
            padding: 60px 20px 30px 20px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            position: relative;
        }
        
        /* Zigzag wave pattern at top of footer */
        .ivara-web-footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 20px;
            background: 
                linear-gradient(135deg, #233848 25%, transparent 25%) -10px 0,
                linear-gradient(225deg, #233848 25%, transparent 25%) -10px 0,
                linear-gradient(315deg, #233848 25%, transparent 25%),
                linear-gradient(45deg, #233848 25%, transparent 25%);
            background-size: 20px 20px;
            background-color: transparent;
            transform: translateY(-100%);
        }
        
        /* Additional zigzag wave overlay at top */
        .ivara-web-footer::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 8px;
            background: repeating-linear-gradient(
                90deg,
                transparent,
                transparent 8px,
                rgba(255, 255, 255, 0.15) 8px,
                rgba(255, 255, 255, 0.15) 16px
            );
        }

        .footer-container {
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 0;
            margin-bottom: 0;
            padding: 0;
        }

        /* Footer Top: Brand + Newsletter */
        .footer-top {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 60px;
            padding-bottom: 50px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 40px;
        }

        .footer-brand img {
            /* Logo should be visible - removed invert filter */
            max-width: 100%;
            height: auto;
        }

        .footer-newsletter h4 {
            color: #fff;
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 18px;
        }

        .footer-newsletter p {
            color: #b0b0b0;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .newsletter-input-group {
            display: flex;
            border-radius: 50px;
            overflow: hidden;
            background: #1f2631;
            border: 2px solid rgba(255, 255, 255, 0.3);
            transition: border-color 0.3s;
        }

        .newsletter-input-group:focus-within {
            border-color: #924FC2;
        }

        .newsletter-input-group input {
            flex: 1;
            border: none;
            padding: 14px 20px;
            background: transparent;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
        }

        .newsletter-input-group input::placeholder {
            color: #7a839e;
        }

        .newsletter-input-group input:focus {
            outline: none;
        }

        .newsletter-input-group button {
            background: #924FC2;
            border: none;
            padding: 0 25px;
            cursor: pointer;
            color: #0A1128;
            font-size: 16px;
            transition: all 0.3s;
        }

        .newsletter-input-group button:hover {
            background: #ffc933;
            transform: scale(1.05);
        }

        /* Footer Grid */
        .footer-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
            padding-bottom: 40px;
            margin-bottom: 30px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .footer-col h4 {
            color: #fff;
            font-weight: 700;
            margin-bottom: 20px;
            font-size: 16px;
        }

        .footer-col .mt-4 { margin-top: 30px; }

        .footer-col ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-col ul li {
            margin-bottom: 12px;
        }

        .footer-col ul li a {
            color: #b0b0b0;
            text-decoration: none;
            transition: all 0.2s;
            font-weight: 400;
        }

        .footer-col ul li a:hover {
            color: #924FC2;
            padding-left: 5px;
        }

        /* Footer Bottom */
        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            padding-top: 20px;
        }

        .bottom-links {
            display: flex;
            gap: 25px;
            flex-wrap: wrap;
        }

        .bottom-links a {
            color: #7a839e;
            text-decoration: none;
            font-size: 13px;
            transition: color 0.3s;
        }
        .bottom-links a:hover { color: #924FC2; }

        .social-icons {
            display: flex;
            gap: 15px;
        }
        .social-icons a {
            color: #fff;
            font-size: 18px;
            transition: all 0.3s;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
        }
        .social-icons a:hover {
             color: #0A1128;
             background: #924FC2;
             transform: translateY(-3px);
        }

        .copyright {
            flex-basis: 100%;
            text-align: center;
            margin-top: 20px;
        }

        .copyright p {
            margin: 5px 0;
            color: #555e70;
            font-size: 13px;
        }

        .powered-by a {
            color: #7a839e;
            text-decoration: none;
            transition: color 0.3s;
        }

        .powered-by a:hover {
            color: #924FC2;
        }

        @media (max-width: 1024px) {
            .footer-top { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 768px) {
            .footer-grid { grid-template-columns: 1fr; }
            .footer-bottom { flex-direction: column; text-align: center; }
            .social-icons { justify-content: center; }
        }
    </style>
@endif
